<?php

namespace App\Http\Controllers;

use App\CouponCode;
use App\Events\OrderReviewed;
use App\Exceptions\CouponCodeUnavailableException;
use App\Exceptions\InvalidRequestException;
use App\Http\Requests\ApplyRefundRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\SendReviewRequest;
use App\Order;
use App\Services\OrderService;
use App\UserAddress;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['items.product', 'items.productSku'])
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        $this->authorize('own',$order);

        return view('orders.show', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    public function store(OrderRequest $request, OrderService $orderService)
    {
        $user    = $request->user();
        $address = UserAddress::find($request->input('address_id'));
        $coupon  = null;

        // 如果用户提交了优惠码
        if ($code = $request->input('coupon_code')) {
            $coupon = CouponCode::where('code', $code)->first();
            if (!$coupon) {
                throw new CouponCodeUnavailableException('优惠券不存在');
            }
        }

        return $orderService->store($user, $address, $request->input('remark'),
            $request->input('items'), $coupon);
    }

    // 确认收货
    public function received(Order $order, Request $request)
    {
        $this->authorize('own', $order);

        // 判断订单的发货状态是否为已发货
        if ($order->ship_status !== Order::SHIP_STATUS_DELIVERED) {
            throw new InvalidRequestException('发货状态不正确');
        }

        $order->update(['ship_status' => Order::SHIP_STATUS_RECEIVED]);

        // 返回原页面
        return $order;
    }
    
    // 评价页面 
    public function review(Order $order)
    {
        $this->authorize('own', $order);

        $order->checkReview($order);

        return view('orders.review', ['order' => $order->load(['items.productSku', 'items.product'])]);
    }

    // 保存评论
    public function sendReview(Order $order, SendReviewRequest  $request)
    {
        $this->authorize('own', $order);

        $order->checkReview($order);

       $reviews = $request->input('reviews');

        \DB::transaction(function () use ($order, $reviews){

            foreach ($reviews as $review){
                $itme = $order->items()->find($review['id']);
                // 保存评分和评价
                $itme->update([
                    'rating' => $review['rating'],
                    'review' => $review['review'],
                    'reviewed_at' => Carbon::now(),
                ]);
            }
            // 将订单标为已评价
            $order->update(['reviewed' => true]);

            // 触发事件 处理商品评分和评论数量
            event(new OrderReviewed($order));
        });

        return redirect()->back();
    }

    //退款
    public function applyRefund(Order $order, ApplyRefundRequest $request)
    {
        if (!$order->paid_at){
            throw new InvalidRequestException('该笔订单未支付');
        }

        if ($order->refund_status !== Order::REFUND_STATUS_PENDING){
            throw new InvalidRequestException('订单已经退款，请勿重复申请');
        }

        // 将用户输入的退款理由放到订单的 extra 字段中
        $extra                  = $order->extra ?: [];
        $extra['refund_reason'] = $request->input('reason');

        $order->update([
            'refund_status' => Order::REFUND_STATUS_APPLIED,
            'extra' => $extra,
        ]);
        return $order;
    }

}

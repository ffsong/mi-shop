<?php

namespace App\Listeners;

use App\Events\OrderPaid;
use App\OrderItem;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class UpdateProductSoldCount implements ShouldQueue
{

    public function handle(OrderPaid $event)
    {
        $order = $event->getOrder();

        // 增加销量
        $order->load('items.product');

        // 循环遍历订单的商品
        foreach ($order->items as $item) {
            $product   = $item->product;

            // 计算对应商品的销量
            $soldCount = OrderItem::query()
                ->where('product_id', $product->id)
                ->whereHas('order', function ($query) {
                    $query->whereNotNull('paid_at');  // 关联的订单状态是已支付
                })->sum('amount');
            // 更新商品销量
            $product->update([
                'sold_count' => $soldCount,
            ]);
        }

    }

    /**
     * 处理失败任务。
     *
     * @param  \App\Events\OrderShipped  $event
     * @param  \Exception  $exception
     * @return void
     */
    public function failed(OrderPaid $event, $exception)
    {
        Log::error($event->getOrder()->order.'增加销量失败');
    }
}

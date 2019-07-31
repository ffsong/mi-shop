<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Http\Requests\AddCartRequest;
use App\ProductSku;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // 加入购物车
    public function add(AddCartRequest $request)
    {
        $user = $request->user();
        $skuId = $request->input('sku_id');
        $amount = $request->input('amount');
        // 如果存在购物车 增加数量
        if($cart = $user->cartItems()->where('product_sku_id', $skuId)->first()){
            $cart->update([
                'amount' => $cart->amount + $amount,
            ]);
        }else {
            // 否则创建一个新的购物车记录
            $cart = new CartItem(['amount' => $amount]);
            $cart->user()->associate($user);
            $cart->productSku()->associate($skuId);
            $cart->save();
        }
    }

    public function index(Request $request)
    {
        $address = $request->user()->address()->orderBy('last_used_at', 'desc')->get();
        $cartItems = $request->user()->cartItems()->with('productSku.product')->get();

        return view('cart.index', ['cartItems' => $cartItems, 'addresses' => $address]);
    }

    // 购物车中移除
    public function remove(ProductSku $sku, Request $request)
    {
        $request->user()->cartItems()->where('product_sku_id', $sku->id)->delete();

        return [];
    }

}
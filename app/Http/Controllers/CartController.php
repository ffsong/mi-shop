<?php

namespace App\Http\Controllers;

use App\CartItem;
use App\Http\Requests\AddCartRequest;

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


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\ProductSku;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $address = $request->user()->address()->orderBy('last_used_at', 'desc')->get();
        $cartItems = $this->cartService->get();

        return view('cart.index', ['cartItems' => $cartItems, 'addresses' => $address]);
    }

    // 加入购物车
    public function add(AddCartRequest $request)
    {
        $this->cartService->add($request->input('sku_id'), $request->input('amount'));
        return [];
    }

    // 购物车中移除
    public function remove(ProductSku $sku)
    {
        $this->cartService->remove($sku->id);

        return [];
    }

}

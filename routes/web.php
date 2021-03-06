<?php

//Route::get('/','PageController@index')->name('root')->middleware('verified');
Route::get('/','PageController@index')->name('root');

// verify 参数 开启邮箱验证
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth']],function (){

    //收货地址
    Route::get('user_addresses','UserAddressController@index')
        ->name('user_addresses.index');
    Route::get('user_addresses/create', 'UserAddressController@create')->name('user_addresses.create');
    Route::post('user_addresses', 'UserAddressController@store')->name('user_addresses.store');
    Route::get('user_addresses/{user_address}','UserAddressController@edit')->name('user_addresses.edit');
    Route::put('user_addresses/{user_address}','UserAddressController@update')->name('user_addresses.update');
    Route::delete('user_addresses/{user_address}','UserAddressController@destroy')->name('user_addresses.destroy');

    // 收藏列表
    Route::get('products/favorites', 'ProductController@favorites')->name('products.favorites');
    // 收藏商品
    Route::post('products/{product}/favorite', 'ProductController@favor')->name('products.favor');
    // 取消收藏商品
    Route::delete('products/{product}/favorite', 'ProductController@disfavor')->name('products.disfavor');

    // 加入购物车
    Route::post('cart', 'CartController@add')->name('cart.add');
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

    // 定单
    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::get('orders/{order}', 'OrderController@show')->name('orders.show');
    Route::post('orders', 'OrderController@store')->name('orders.store');

    //支付宝支付
    Route::get('payment/{order}/alipay', 'PaymentController@payByAlipay')->name('payment.alipay');
    //支付宝同步回调
    Route::get('payment/alipay/return', 'PaymentController@alipayReturn')->name('payment.alipay.return');

    // 收货
    Route::post('orders/{order}/received', 'OrderController@received')->name('orders.received');

    // 评论
    Route::get('orders/{order}/review', 'OrderController@review')->name('orders.review.show');
    Route::post('orders/{order}/review', 'OrderController@sendReview')->name('orders.review.store');


    //退款
    Route::post('orders/{order}/apply_refund','OrderController@applyRefund')->name('orders.apply_refund');

    // 检查优惠券
    Route::get('coupon_codes/{code}', 'CouponCodeController@show')->name('coupon_codes.show');


});

//商品列表
Route::get('products','ProductController@index')->name('products.index');
Route::get('products/{product}','ProductController@show')->name('products.show');
Route::post('product','ProductController@getPrice')->name('products.price');


//支付宝异步回调
Route::post('payment/alipay/notify', 'PaymentController@alipayNotify')->name('payment.alipay.notify');
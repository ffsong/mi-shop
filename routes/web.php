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


});
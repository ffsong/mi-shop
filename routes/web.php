<?php

//Route::get('/','PageController@index')->name('root')->middleware('verified');
Route::get('/','PageController@index')->name('root');

// verify 参数 开启邮箱验证
Auth::routes(['verify' => true]);



Route::group(['middleware' => ['auth']],function (){

    Route::get('user_addresses','UserAddressController@index')
        ->name('user_addresses.index');

});
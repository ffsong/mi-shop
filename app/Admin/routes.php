<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');

    $router->resource('users', UsersController::class);

    $router->resource('products', ProductsController::class);

    $router->resource('product-sku-attributes', ProductAttributeController::class);

    $router->any('api/product',"ProductAttributeController@product");

    $router->resource('product-skus', ProductSkuController::class);
    $router->put('product-skus/{$id}','ProductSkuController@update')->name('product-skus.update');



});

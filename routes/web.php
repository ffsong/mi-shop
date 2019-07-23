<?php

Route::get('/','PageController@index')->name('root');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

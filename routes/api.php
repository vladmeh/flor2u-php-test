<?php

use Illuminate\Support\Facades\Route;


Route::get('/orders', 'OrderController@index');
Route::get('/orders/{order}', 'OrderController@edit');
Route::patch('/orders/{order}', 'OrderController@update');

Route::get('/products', 'ProductController@index');
Route::get('/products/{product}', 'ProductController@show');

Route::get('/partners', 'PartnerController@index');

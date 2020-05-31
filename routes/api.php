<?php

use App\Http\Resources\Order as OrderResource;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\PartnerCollection;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\ProductCollection;
use App\Order;
use App\Partner;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/orders', function () {
    return new OrderCollection(Order::paginate(10));
});
Route::get('/orders/{order}', function (Order $order) {
    return new OrderResource($order);
});
Route::patch('/orders/{order}', function (Request $request, Order $order) {
    return $request->all();
});

Route::get('/products', function () {
    return new ProductCollection(Product::paginate(25));
});
Route::get('/products/{product}', function (Product $product) {
    return new ProductResource($product);
});

Route::get('/partners', function () {
   return new PartnerCollection(Partner::all());
});

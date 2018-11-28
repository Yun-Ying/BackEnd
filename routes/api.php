<?php

use Illuminate\Http\Request;

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

Route::get('products', 'Api\ProductController@index');
Route::get('products/{product}', 'Api\ProductController@show');
Route::get('users', 'Api\UserController@index');
//Route::get('shoppingcarts', 'Api\ShoppingcartController@index');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

Route::middleware('auth:api')->group(function () {

    Route::post('orders', 'Api\OrderController@store');
    Route::post('logout', 'Api\AuthController@logout');
    Route::get('me', 'Api\AuthController@me');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('putincart', 'Api\ShoppingcartController@store');
    Route::post('deletecart', 'Api\ShoppingcartController@destroy');
    Route::post('shoppingcart', 'Api\ShoppingcartController@index');
});

Route::get('deletecart_debug/{x}/{y}', 'Api\ShoppingcartController@fake_destroy');
Route::get('putincart_debug/{user}/{product}', 'Api\ShoppingcartController@fake_store');
Route::get('users/{x}', 'Api\ShoppingcartController@fake_index');





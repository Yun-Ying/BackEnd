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

    Route::post('logout', 'Api\AuthController@logout');
    Route::get('me', 'Api\AuthController@me');
    Route::post('refresh', 'Api\AuthController@refresh');

    //shopping cart part
    //create
    Route::post('shopping_carts', 'Api\ShoppingcartController@store');
    //delete
    Route::delete('shopping_carts', 'Api\ShoppingcartController@destroy');
    //show not OKAY yet
    Route::get('shopping_carts/{user_id}', 'Api\ShoppingcartController@show');
    //update


    //order part

    //create
    Route::post('orders', 'Api\OrderController@create');

    //show
    Route::get('orders/{user_id}', 'Api\OrderController@show');

    //index(only for admin)
    Route::get('orders', 'Api\OrderController@index');

    //delete
    Route::delete('orders', 'Api\OrderController@destroy');
});
Route::get('deletecart_debug/{x}', 'Api\ShoppingcartController@fake_destroy');
Route::get('putincart_debug/{user}/{product}/{x}', 'Api\ShoppingcartController@fake_store');
Route::get('users/{x}', 'Api\ShoppingcartController@fake_index');
Route::get('shopping_carts/update_debug/{user}/{product}/{quantity}', 'Api\ShoppingcartController@fake_update');

//order part to test and debug
//create
Route::get('debug/orders/{x}', 'Api\OrderController@debug_create');

//show
Route::get('debug/orders_show/{user_id}', 'Api\OrderController@debug_show');

//index(only for admin)
Route::get('debug/orders', 'Api\OrderController@debug_index');

//delete
Route::delete('debug/orders', 'Api\OrderController@debug_destroy');





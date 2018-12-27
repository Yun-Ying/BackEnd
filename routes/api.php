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


//get Products Info
Route::get('products', 'Api\ProductController@index');
Route::get('products/{product}', 'Api\ProductController@show');
Route::get('products/categories/{category_id}', 'Api\ProductController@indexCategory');
Route::get('easyProduct','Api\ProductController@easyProduct');
Route::get('strongProduct','Api\ProductController@strongProduct');
Route::get('othersCategory', 'Api\CategoryController@index');
//login and register
Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');

//findpassword
Route::post('findpassword', 'Api\FindPasswordController@find');
//test find password
//Route::get('testFind/{user_id}', 'Api\FindPasswordController@testFind');
//mail
Route::post('mailTo', 'Api\FindPasswordController@mail');
//reset
Route::post('resetpassword', 'Api\FindPasswordController@reset');
//test test test test

//advertisement part
//slider
Route::get('sliderAd', 'Api\AdvertisementController@slider');

//rotation
Route::get('rotationAd', 'Api\AdvertisementController@rotation');



Route::middleware('auth:api')->group(function () {

    Route::post('logout', 'Api\AuthController@logout');
    Route::get('me', 'Api\AuthController@me');
    Route::post('refresh', 'Api\AuthController@refresh');

    //****shopping cart part****

    //create
    Route::post('shopping_carts', 'Api\ShoppingcartController@store');
    //delete
    Route::delete('shopping_carts/{shoppingcart}', 'Api\ShoppingcartController@destroy');
    //show
    Route::get('shopping_carts/{user_id}', 'Api\ShoppingcartController@show');
    //update
    Route::patch('shopping_carts/update', 'Api\ShoppingcartController@update');


    //***order part****

    //create
    Route::post('orders', 'Api\OrderController@create');

    //show
    Route::get('orders/{user_id}', 'Api\OrderController@show');

    //index(only for admin)
    Route::get('orders', 'Api\OrderController@index');

    //delete
    Route::delete('orders/{order}', 'Api\OrderController@destroy');



});



//tests reset done
//Route::get('testreset/{id}/{password}', 'Api\FindPasswordController@testreset');


//Route::get('deletecart_debug/{x}', 'Api\ShoppingcartController@fake_destroy');
//Route::get('putincart_debug/{user}/{product}/{x}', 'Api\ShoppingcartController@fake_store');
//Route::get('users/{x}', 'Api\ShoppingcartController@fake_index');
//Route::get('shopping_carts/update_debug/{user}/{product}/{quantity}', 'Api\ShoppingcartController@fake_update');
//Route::get('shopping_carts_debug/{user_id}', 'Api\ShoppingcartController@show_debug');
//
////order part to test and debug
////create //done
//Route::get('debug/orders/{x}', 'Api\OrderController@debug_create');

//show //done
//Route::get('debug/orders_show/{user_id}', 'Api\OrderController@debug_show');
//
////index(only for admin) //done
//Route::get('debug/orders', 'Api\OrderController@debug_index');
//
////delete
//Route::get('debug/orders_delete/{order_id}', 'Api\OrderController@debug_destroy');





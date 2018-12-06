<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::middleware('auth')->group(function () {

    //dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::get('products', 'ProductController@index')->name('products.index');
    Route::get('products/create', 'ProductController@create')->name('products.create');
    Route::post('products', 'ProductController@store')->name('products.store');
    Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');
    Route::patch('products/{product}', 'ProductController@update')->name('products.update');
    Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy');

    //pagging
    Route::get('pagging', 'ProductController@pagging')->name('products.pagging');

    //orders
    Route::get('orders', 'OrderController@index')->name('orders.index');
    Route::get('orders/create', 'OrderController@create')->name('orders.create');
    Route::get('orders/{order}/check', 'OrderController@check')->name('orders.check');
    Route::get('orders/{order}/edit', 'OrderController@edit')->name('orders.edit');
    Route::get('orders/{order}/show', 'OrderController@show')->name('orders.show');
    Route::delete('orders/{order}', 'OrderController@destroy')->name('orders.destroy');
    Route::patch('orders/{order}', 'OrderController@update')->name('orders.update');

});

Auth::routes();

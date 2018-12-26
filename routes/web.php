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

    //users
    //index
    Route::get('users', 'UsersController@index')->name('users.index');
    //create
    Route::get('users/create', 'UsersController@create')->name('users.create');
    //edit
    Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');
    //store
    Route::post('users', 'UsersController@store')->name('users.store');
    //show personal information, might not used
    Route::get('users/{user}/show', 'UsersController@show')->name('users.show');
    //delete
    Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');
    //update information
    Route::patch('users/{user}', 'UsersController@update')->name('users.update');

    //categories
    //index
    Route::get('categories', 'CategoryController@index')->name('categories.index');
    //create
    Route::get('categories/create', 'CategoryController@create')->name('categories.create');
    //edit
    Route::get('categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
    //store
    Route::post('categories', 'CategoryController@store')->name('categories.store');
    //show categories information, might not used
    Route::get('categories/{category}/show', 'CategoryController@show')->name('categories.show');
    //delete
    Route::delete('categories/{category}', 'CategoryController@destroy')->name('categories.destroy');
    //update information
    Route::patch('categories/{category}', 'CategoryController@update')->name('categories.update');

    //advertisements
    //index
    Route::get('advertisements', 'AdvertisementController@index')->name('advertisements.index');
    //create
    Route::get('advertisements/create', 'AdvertisementController@create')->name('advertisements.create');
    //edit
    Route::get('advertisements/{advertisement}/edit', 'AdvertisementController@edit')->name('advertisements.edit');
    //store
    Route::post('advertisements', 'AdvertisementController@store')->name('advertisements.store');
    //show advertisements information, might not used
    Route::get('advertisements/{advertisement}/show', 'AdvertisementController@show')->name('advertisements.show');
    //delete
    Route::delete('advertisements/{advertisement}', 'AdvertisementController@destroy')->name('advertisements.destroy');
    //update information
    Route::patch('advertisements/{advertisement}', 'AdvertisementController@update')->name('advertisements.update');

});

Auth::routes();

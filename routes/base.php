<?php

// Home Page
Route::get('/', 'App\Http\Controllers\IndexController@Index')->name('index');

// Online Store
Route::get('/products/{category?}', 'App\Http\Controllers\ProductsController@Home')->name('products.index');
Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@Product')->name('products.view');
Route::post('/product/{id}/add', 'App\Http\Controllers\ProductsController@AddProduct')->name('products.view.add');
Route::post('/product/{id}/remove', 'App\Http\Controllers\ProductsController@RemoveProduct')->name('products.view.remove');

Route::get('/shoppingcart', 'App\Http\Controllers\ShoppingCartController@index')->name('shoppingcart.index');
Route::get('/shoppingcart/checkout', 'App\Http\Controllers\ShoppingCartController@Checkout')->name('shoppingcart.checkout');
Route::get('/shoppingcart/callback', 'App\Http\Controllers\ShoppingCartController@Callback')->name('shoppingcart.callback');
Route::get('/shoppingcart/status', 'App\Http\Controllers\ShoppingCartController@Status')->name('shoppingcart.status');

// Banned Page
Route::get('/banned', 'App\Http\Controllers\IndexController@Banned')->name('banned');
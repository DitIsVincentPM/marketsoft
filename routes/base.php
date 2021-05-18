<?php

// Home Page
Route::get('/', 'App\Http\Controllers\IndexController@Index')->name('index');

// Online Store
Route::get('/products', 'App\Http\Controllers\ProductsController@Home')->name('products.index');
Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@Product')->name('products.view');
Route::post('/product/{id}/add', 'App\Http\Controllers\ProductsController@AddProduct')->name('products.view.add');
Route::post('/product/{id}/remove', 'App\Http\Controllers\ProductsController@RemoveProduct')->name('products.view.remove');

// Banned Page
Route::get('/banned', 'App\Http\Controllers\IndexController@Banned')->name('banned');
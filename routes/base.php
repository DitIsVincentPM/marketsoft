<?php

use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'App\Http\Controllers\IndexController@Index')->name('index');
    Route::get('/users', 'App\Http\Controllers\IndexController@Users')->name('users');

    Route::get('/products', 'App\Http\Controllers\ProductsController@Home')->name('products.index');
    Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@Product')->name('products.view');
});
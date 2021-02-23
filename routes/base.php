<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'isbanned'], function () {
    Route::get('/', 'App\Http\Controllers\IndexController@Index')->name('index');
    Route::get('/users', 'App\Http\Controllers\IndexController@Users')->name('users');

    Route::get('/products', 'App\Http\Controllers\ProductsController@Home')->name('products.index');
    Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@Product')->name('products.view');
    Route::post('/product/{id}/add', 'App\Http\Controllers\ProductsController@AddProduct')->name('products.view.add');
    Route::post('/product/{id}/remove', 'App\Http\Controllers\ProductsController@RemoveProduct')->name('products.view.remove');

    // Announcements
    Route::get('/announcements', 'App\Http\Controllers\InfoController@Announcements')->name('announcements.index');
    Route::get('/announcements/{id}', 'App\Http\Controllers\InfoController@AnnounceView')->name('announcements.view');

    // Knowledgebase
    Route::get('/knowledgebase', 'App\Http\Controllers\InfoController@Knowledgebase')->name('knowledgebase.index');
    Route::get('/knowledgebase/category/{id}', 'App\Http\Controllers\InfoController@KnowledgebaseCategory')->name('knowledgebase.category');
    Route::get('/knowledgebase/article/{id}', 'App\Http\Controllers\InfoController@KnowledgeView')->name('knowledgebase.articel.view');

    // Legal Documents
    Route::get('/tos', 'App\Http\Controllers\InfoController@tos')->name('legal.tos');
    Route::get('/privacy', 'App\Http\Controllers\InfoController@privacy')->name('legal.privacy');
});

Route::get('/banned', 'App\Http\Controllers\IndexController@Banned')->name('banned');


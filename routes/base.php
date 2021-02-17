<?php

use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'isbanned'], function () {
    Route::get('/', 'App\Http\Controllers\IndexController@Index')->name('index');
    Route::get('/users', 'App\Http\Controllers\IndexController@Users')->name('users');

    Route::get('/products', 'App\Http\Controllers\ProductsController@Home')->name('products.index');
    Route::get('/product/{id}', 'App\Http\Controllers\ProductsController@Product')->name('products.view');

    // Announcements
    Route::get('/announcements', 'App\Http\Controllers\InfoController@Announcements')->name('announcements.index');
    Route::get('/announcements/{id}', 'App\Http\Controllers\InfoController@AnnounceView')->name('announcements.view');

    // Knowledgebase
    Route::get('/knowledgebase', 'App\Http\Controllers\InfoController@Knowledgebase')->name('knowledgebase.index');
    Route::get('/knowledgebase/category/{id}', 'App\Http\Controllers\InfoController@KnowledgebaseCategory')->name('knowledgebase.category');
    Route::get('/knowledgebase/article/{id}', 'App\Http\Controllers\InfoController@KnowledgeView')->name('knowledgebase.articel.view');
});

Route::get('/banned', 'App\Http\Controllers\IndexController@Banned')->name('banned');


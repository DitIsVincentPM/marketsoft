<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'user'], function () {
    Route::post('/', 'App\Http\Controllers\Api\Controller@user')->name('api.user');
    Route::post('/all', 'App\Http\Controllers\Api\Controller@users')->name('api.users');
    Route::post('/search', 'App\Http\Controllers\Api\Controller@userssearch')->name('api.users.search');
});

Route::group(['prefix'=>'ticket'], function () {
    Route::post('/comments', 'App\Http\Controllers\Api\Controller@ticketcomments')->name('api.tickets.comments');

    Route::post('/', 'App\Http\Controllers\Api\Controller@tickets')->name('api.tickets');
    Route::post('/search', 'App\Http\Controllers\Api\Controller@ticketssearch')->name('api.tickets.search');

    Route::post('/categorys', 'App\Http\Controllers\Api\Controller@ticketcategorys')->name('api.tickets.categorys');
    Route::post('/categorys/search', 'App\Http\Controllers\Api\Controller@ticketcategoryssearch')->name('api.tickets.categorys.search');
});

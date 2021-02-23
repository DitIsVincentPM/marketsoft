<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'user'], function () {
    Route::post('/', 'App\Http\Controllers\Api\Controller@user')->name('api.user');
    Route::post('/all', 'App\Http\Controllers\Api\Controller@users')->name('api.users');
    Route::post('/search', 'App\Http\Controllers\Api\Controller@userssearch')->name('api.users.search');
});

Route::group(['prefix' => 'ticket'], function () {
    Route::post('/comments', 'App\Http\Controllers\Api\Controller@ticketcomments')->name('api.tickets.comments');

    Route::post('/', 'App\Http\Controllers\Api\Controller@tickets')->name('api.tickets');
    Route::post('/search', 'App\Http\Controllers\Api\Controller@ticketssearch')->name('api.tickets.search');

    Route::post('/categorys/get', 'App\Http\Controllers\Api\Controller@ticketcategoryget')->name('api.tickets.categorys.get');
    Route::post('/categorys/update', 'App\Http\Controllers\Api\Controller@ticketcategoryupdate')->name('api.tickets.categorys.update');

    Route::post('/categorys', 'App\Http\Controllers\Api\Controller@ticketcategorys')->name('api.tickets.categorys');
    Route::post('/categorys/search', 'App\Http\Controllers\Api\Controller@ticketcategoryssearch')->name('api.tickets.categorys.search');
});

Route::group(['prefix' => 'roles'], function () {
    Route::post('/', 'App\Http\Controllers\Api\Controller@roles')->name('api.roles');
});
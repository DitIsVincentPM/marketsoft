<?php

// Account Settings
Route::group(['prefix' => 'settings'], function () {
    Route::get('/', 'App\Http\Controllers\AuthController@accountsettings')->name('auth.settings');
    Route::post('/save', 'App\Http\Controllers\AuthController@accountsettingssave')->name('auth.settings.save');
});

// Frotend Login
Route::group(['prefix' => 'login'], function () {
    Route::get('/', 'App\Http\Controllers\AuthController@Login')->name('auth.login');
    Route::post('/', 'App\Http\Controllers\AuthController@loginuser')->name('auth.login.new');
});

// Frontend Logout
Route::group(['prefix' => 'logout'], function () {
    Route::get('/', 'App\Http\Controllers\AuthController@Logout')->name('auth.logout');
});

// Frontend Registration
Route::group(['prefix' => 'register'], function () {
    Route::get('/', 'App\Http\Controllers\AuthController@Register')->name('auth.register');
    Route::post('/newuser', 'App\Http\Controllers\AuthController@newuser')->name('auth.register.new');
});

// Frontend Seller
Route::group(['prefix' => 'seller'], function () {
    Route::get('/', 'App\Http\Controllers\AuthController@Seller')->name('auth.seller');
    Route::post('/newseller', 'App\Http\Controllers\AuthController@newseller')->name('auth.seller.new');
});
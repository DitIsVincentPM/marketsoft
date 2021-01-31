<?php

Route::group(['middleware' => 'web'], function () {
    // Account Settings
    Route::get('/settings', 'App\Http\Controllers\AuthController@accountsettings')->name('auth.settings');
    Route::post('/settings/save', 'App\Http\Controllers\AuthController@accountsettingssave')->name('auth.settings.save');

    // Frotend Login
    Route::get('/login', 'App\Http\Controllers\AuthController@Login')->name('auth.login');
    Route::post('/login', 'App\Http\Controllers\AuthController@loginuser')->name('auth.login.new');

    // Frontend Registration
    Route::get('/register', 'App\Http\Controllers\AuthController@Register')->name('auth.register');
    Route::post('/register/newuser', 'App\Http\Controllers\AuthController@newuser')->name('auth.register.new');

    // Frontend Seller
    Route::get('/seller', 'App\Http\Controllers\AuthController@Seller')->name('auth.seller');
    Route::post('/seller/newseller', 'App\Http\Controllers\AuthController@newseller')->name('auth.seller.new');
});
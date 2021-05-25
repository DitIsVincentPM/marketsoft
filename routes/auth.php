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

// Client Area
Route::group(['prefix' => 'clientarea'], function () {
    Route::get('/', 'App\Http\Controllers\ClientAreaController@index')->name('clientarea.index');
    Route::get('/invoices', 'App\Http\Controllers\ClientAreaController@invoices')->name('clientarea.invoices');
    Route::get('/invoice/{id}', 'App\Http\Controllers\ClientAreaController@invoice')->name('clientarea.invoice');
    Route::get('/services', 'App\Http\Controllers\ClientAreaController@services')->name('clientarea.services');
});
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\InstallationController@Index')->name('installation.index');
Route::post('/save', 'App\Http\Controllers\InstallationController@save')->name('installation.save');
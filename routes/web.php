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

// Home Page
Route::get('/', 'App\Http\Controllers\Controller@Index')->name('index');

// Register Page
Route::get('/register', 'App\Http\Controllers\Controller@Register')->name('register');
Route::post('/register/new', 'App\Http\Controllers\Controller@NewRegister')->name('register.new');

// Login Page
Route::get('/login', 'App\Http\Controllers\Controller@Login')->name('login');

// Pricing Page
Route::get('/pricing', 'App\Http\Controllers\Controller@Pricing')->name('pricing');

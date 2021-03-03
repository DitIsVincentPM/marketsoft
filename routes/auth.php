<?php
use Laravel\Socialite\Facades\Socialite;

Route::group(['middleware' => 'web'], function () {
    // Account Settings
    Route::get('/settings', 'App\Http\Controllers\AuthController@accountsettings')->name('auth.settings');
    Route::post('/settings/save', 'App\Http\Controllers\AuthController@accountsettingssave')->name('auth.settings.save');

    // Frotend Login
    Route::get('/login', 'App\Http\Controllers\AuthController@Login')->name('auth.login');
    Route::post('/login', 'App\Http\Controllers\AuthController@loginuser')->name('auth.login.new');

    // Frontend Logout
    Route::get('/logout', 'App\Http\Controllers\AuthController@Logout')->name('auth.logout');

    // Frontend Registration
    Route::get('/register', 'App\Http\Controllers\AuthController@Register')->name('auth.register');
    Route::post('/register/newuser', 'App\Http\Controllers\AuthController@newuser')->name('auth.register.new');

    // Frontend Seller
    Route::get('/seller', 'App\Http\Controllers\AuthController@Seller')->name('auth.seller');
    Route::post('/seller/newseller', 'App\Http\Controllers\AuthController@newseller')->name('auth.seller.new');

    // Discord Integration
    Route::get('/discord/connect', 'App\Http\Controllers\OAuth2Controller@DiscordRedirect')->name('discord.redirect');
    Route::get('/discord/callback', 'App\Http\Controllers\OAuth2Controller@DiscordCallback')->name('discord.callback');
    Route::get('/discord/remove', 'App\Http\Controllers\OAuth2Controller@DiscordRemove')->name('discord.remove');

    // Google Integration
    Route::get('/google/connect', 'App\Http\Controllers\OAuth2Controller@GoogleRedirect')->name('google.redirect');
    Route::get('/google/callback', 'App\Http\Controllers\OAuth2Controller@GoogleCallback')->name('google.callback');
    Route::get('/google/remove', 'App\Http\Controllers\OAuth2Controller@GoogleRemove')->name('google.remove');

    // GitHub Integration
    Route::get('/github/connect', 'App\Http\Controllers\OAuth2Controller@GithubRedirect')->name('github.redirect');
    Route::get('/github/callback', 'App\Http\Controllers\OAuth2Controller@GithubCallback')->name('github.callback');
    Route::get('/github/remove', 'App\Http\Controllers\OAuth2Controller@GithubRemove')->name('github.remove');
});
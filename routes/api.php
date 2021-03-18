<?php

use Illuminate\Support\Facades\Route;

// Active Users
Route::post('/activeusers', 'App\Http\Controllers\Api\Controller@activeusers')->name('api.activeusers');

// Users
Route::group(['prefix' => 'user'], function () {
    Route::post('/', 'App\Http\Controllers\Api\Controller@user')->name('api.user');
    Route::post('/all', 'App\Http\Controllers\Api\Controller@users')->name('api.users');
    Route::post('/edit', 'App\Http\Controllers\Api\Controller@usersedit')->name('api.users.edit');
    Route::post('/create', 'App\Http\Controllers\Api\Controller@userscreate')->name('api.users.create');
});

// Tickets
Route::group(['prefix' => 'ticket'], function () {
    Route::post('/comments', 'App\Http\Controllers\Api\Controller@ticketcomments')->name('api.tickets.comments');

    Route::post('/', 'App\Http\Controllers\Api\Controller@tickets')->name('api.tickets');
    Route::post('/search', 'App\Http\Controllers\Api\Controller@ticketssearch')->name('api.tickets.search');

    Route::post('/categorys/get', 'App\Http\Controllers\Api\Controller@ticketcategoryget')->name('api.tickets.categorys.get');
    Route::post('/categorys/update', 'App\Http\Controllers\Api\Controller@ticketcategoryupdate')->name('api.tickets.categorys.update');

    Route::post('/categorys', 'App\Http\Controllers\Api\Controller@ticketcategorys')->name('api.tickets.categorys');
    Route::post('/categorys/search', 'App\Http\Controllers\Api\Controller@ticketcategoryssearch')->name('api.tickets.categorys.search');
});

// Roles
Route::group(['prefix' => 'roles'], function () {
    Route::post('/', 'App\Http\Controllers\Api\Controller@roles')->name('api.roles');
    Route::post('/get', 'App\Http\Controllers\Api\Controller@role')->name('api.role');
});

// Products
Route::group(['prefix' => 'products'], function () {
    Route::post('/', 'App\Http\Controllers\Api\Controller@products')->name('api.products');
    Route::post('/categorys', 'App\Http\Controllers\Api\Controller@products_categorys')->name('api.products.categorys');
    Route::post('/images', 'App\Http\Controllers\Api\Controller@products_images')->name('api.products.images');
    Route::post('/sections', 'App\Http\Controllers\Api\Controller@products_sections')->name('api.products.sections');
    Route::post('/edit', 'App\Http\Controllers\Api\Controller@products_edit')->name('api.products.edit');
});

// OAuth2
Route::group(['prefix' => 'oauth2'], function () {
    Route::post('/status', 'App\Http\Controllers\Api\Controller@oauth2_status')->name('api.oauth2.status');
    Route::post('/refresh', 'App\Http\Controllers\Api\Controller@oauth2_refresh')->name('api.oauth2.refresh');
    Route::post('/update', 'App\Http\Controllers\Api\Controller@oauth2_update')->name('api.oauth2.update');
});

// Announcements
Route::group(['prefix' => 'announcements'], function () {
    Route::post('/create', 'App\Http\Controllers\Api\Controller@announcement_create')->name('api.announcement.create');
    Route::post('/refresh', 'App\Http\Controllers\Api\Controller@announcement_refresh')->name('api.announcement.refresh');
    Route::post('/edit', 'App\Http\Controllers\Api\Controller@announcement_modal')->name('api.announcement.edit');
});

// Knowledgebase
Route::group(['prefix' => 'knowledgebase'], function () {
    Route::post('/articles', 'App\Http\Controllers\Api\Controller@knowledgebase')->name('api.knowledgebase');
    Route::post('/article/get', 'App\Http\Controllers\Api\Controller@knowledgebaseget')->name('api.knowledgebase.get');
    Route::post('/article/update', 'App\Http\Controllers\Api\Controller@knowledgebasearticleupdate')->name('api.knowledgebase.update');
    Route::post('/article/create', 'App\Http\Controllers\Api\Controller@knowledgebasearticlecreate')->name('api.knowledgebase.create');

    Route::post('/search', 'App\Http\Controllers\Api\Controller@ticketssearch')->name('api.knowledgebase.search');

    Route::post('/category/get', 'App\Http\Controllers\Api\Controller@knowledgebasecategoryget')->name('api.knowledgebases.categorys.get');
    Route::post('/categories/update', 'App\Http\Controllers\Api\Controller@knowledgebasecategoryupdate')->name('api.knowledgebase.categories.update');
    Route::post('/categories/create', 'App\Http\Controllers\Api\Controller@knowledgebasecategorycreate')->name('api.knowledgebase.categories.create');
    Route::post('/categories', 'App\Http\Controllers\Api\Controller@knowledgebasecategories')->name('api.knowledgebase.categorys');
    Route::post('/categories/search', 'App\Http\Controllers\Api\Controller@ticketcategoriessearch')->name('api.tickets.knowledgebase.search');
});
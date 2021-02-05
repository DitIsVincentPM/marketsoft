<?php

Route::group(['middleware' => ['web', 'admin']], function () {

    // Admin Dashboard
    Route::get('/', 'App\Http\Controllers\Admin\IndexController@index')->name('admin.index');

    // Admin Product/s Management
    Route::get('/products', 'App\Http\Controllers\Admin\IndexController@products')->name('admin.products');

    // Admin Seller Requests
    Route::get('/seller-requests', 'App\Http\Controllers\Admin\SellerController@sellerrequests')->name('admin.sellerrequests');
    Route::post('/seller-requests/save', 'App\Http\Controllers\Admin\SellerController@sellerupdate')->name('admin.sellerrequests.store');

    // Admin System Settings
    Route::get('/settings', 'App\Http\Controllers\Admin\IndexController@settings')->name('admin.settings');
    Route::post('/settings/save', 'App\Http\Controllers\Admin\IndexController@settingssave')->name('admin.settings.save');
    
    // Admin System Announcements
    Route::get('/announcements', 'App\Http\Controllers\Admin\AnnouncementsController@index')->name('admin.announcements');
    Route::post('/announcements/new', 'App\Http\Controllers\Admin\AnnouncementsController@createnew')->name('admin.announcements.new');
    Route::post('/announcements/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@delete')->name('admin.announcements.delete');
    Route::post('/announcements/update/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@update')->name('admin.announcements.update');

    // Admin System Knowledgebase
    Route::get('/knowledgebase', 'App\Http\Controllers\Admin\KnowledgebaseController@index')->name('admin.knowledgebase');
    Route::post('/knowledgebase/new', 'App\Http\Controllers\Admin\KnowledgebaseController@new')->name('admin.knowledgebase.new');
    Route::post('/knowledgebase/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@delete')->name('admin.knowledgebase.delete');
    Route::post('/knowledgebase/update/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@update')->name('admin.knowledgebase.update');
});


<?php

Route::group(['middleware' => ['web', 'admin']], function () {
    Route::get('/', 'App\Http\Controllers\Admin\IndexController@index')->name('admin.index');

    Route::get('/products', 'App\Http\Controllers\Admin\IndexController@products')->name('admin.products');

    Route::get('/seller-requests', 'App\Http\Controllers\Admin\SellerController@sellerrequests')->name('admin.sellerrequests');
    Route::post('/seller-requests/save', 'App\Http\Controllers\Admin\SellerController@sellerupdate')->name('admin.sellerrequests.store');

    Route::get('/settings', 'App\Http\Controllers\Admin\IndexController@settings')->name('admin.settings');
    Route::post('/settings/save', 'App\Http\Controllers\Admin\IndexController@settingssave')->name('admin.settings.save');
    
    Route::get('/announcements', 'App\Http\Controllers\Admin\AnnouncementsController@index')->name('admin.announcements');
    Route::post('/announcements/new', 'App\Http\Controllers\Admin\AnnouncementsController@createnew')->name('admin.announcements.new');
    Route::post('/announcements/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@delete')->name('admin.announcements.delete');
    Route::post('/announcements/update/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@update')->name('admin.announcements.update');
});


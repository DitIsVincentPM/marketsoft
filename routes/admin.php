<?php

Route::group(['middleware' => ['web', 'admin']], function () {

    // Admin Dashboard
    Route::get('/', 'App\Http\Controllers\Admin\IndexController@index')->name('admin.index');

    // Admin Product/s Management
    Route::get('/products', 'App\Http\Controllers\Admin\IndexController@products')->name('admin.products');

    // Admin Users Management
    Route::get('/users', 'App\Http\Controllers\Admin\UsersController@index')->name('admin.users');
    Route::post('/users/update', 'App\Http\Controllers\Admin\UsersController@UserUpdate')->name('admin.users.update');

    // Admin Seller Requests
    Route::get('/seller-requests', 'App\Http\Controllers\Admin\SellerController@sellerrequests')->name('admin.sellerrequests');
    Route::post('/seller-requests/save', 'App\Http\Controllers\Admin\SellerController@sellerupdate')->name('admin.sellerrequests.store');

    // Admin System Settings
    Route::get('/settings', 'App\Http\Controllers\Admin\SettingsController@settings')->name('admin.settings');
    Route::post('/settings/save', 'App\Http\Controllers\Admin\SettingsController@settingssave')->name('admin.settings.save');

    // Admin System Announcements
    Route::get('/announcements', 'App\Http\Controllers\Admin\AnnouncementsController@index')->name('admin.announcements');
    Route::post('/announcements/new', 'App\Http\Controllers\Admin\AnnouncementsController@createnew')->name('admin.announcements.new');
    Route::post('/announcements/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@delete')->name('admin.announcements.delete');
    Route::post('/announcements/update/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@update')->name('admin.announcements.update');

    // Admin System Knowledgebase
    Route::get('/knowledgebase', 'App\Http\Controllers\Admin\KnowledgebaseController@index')->name('admin.knowledgebase');
    Route::post('/knowledgebase/category/new', 'App\Http\Controllers\Admin\KnowledgebaseController@categorynew')->name('admin.knowledgebase.category.new');
    Route::post('/knowledgebase/category/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@categorydelete')->name('admin.knowledgebase.category.delete');
    Route::post('/knowledgebase/category/update/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@categoryupdate')->name('admin.knowledgebase.category.update');
    Route::post('/knowledgebase/article/new', 'App\Http\Controllers\Admin\KnowledgebaseController@new')->name('admin.knowledgebase.new');
    Route::post('/knowledgebase/article/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@delete')->name('admin.knowledgebase.delete');
    Route::post('/knowledgebase/article/update/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@update')->name('admin.knowledgebase.update');

    // Tickets
    Route::get('/tickets', 'App\Http\Controllers\Admin\TicketsController@Index')->name('admin.tickets');
    Route::post('/tickets/category/create', 'App\Http\Controllers\Admin\TicketsController@CategoryCreate')->name('admin.category.create');
    Route::post('/tickets/category/update/{id}', 'App\Http\Controllers\Admin\TicketsController@CategoryUpdate')->name('admin.category.update');
    Route::post('/tickets/{id}/delete', 'App\Http\Controllers\Admin\TicketsController@TicketDelete')->name('admin.tickets.delete');
    Route::get('/tickets/{id}', 'App\Http\Controllers\Admin\TicketsController@ViewTicket')->name('admin.tickets.view');
    Route::post('/tickets/{id}/close', 'App\Http\Controllers\Admin\TicketsController@CloseTicket')->name('admin.tickets.close');
    Route::post('/tickets/{id}/open', 'App\Http\Controllers\Admin\TicketsController@OpenTicket')->name('admin.tickets.open');
    Route::post('/tickets/{id}/whisper', 'App\Http\Controllers\Admin\TicketsController@TicketWhisper')->name('admin.tickets.whisper');
    Route::post('/tickets/{id}/reply', 'App\Http\Controllers\Admin\TicketsController@TicketReply')->name('admin.tickets.reply');

    // Roles
    Route::post('/role/create', 'App\Http\Controllers\Admin\SettingsController@CreateRole')->name('admin.role.create');
});

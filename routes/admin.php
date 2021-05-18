<?php

Route::group(['middleware' => ['web', 'admin']], function () {

    // Admin Dashboard
    Route::get('/', 'App\Http\Controllers\Admin\IndexController@index')->name('admin.index');

    Route::get('/encrypted', 'App\Http\Controllers\Admin\TestController@index')->name('admin.encrypted');

    // Admin Users Management
    Route::get('/users', 'App\Http\Controllers\Admin\UsersController@index')->name('admin.users');
    Route::post('/users/update', 'App\Http\Controllers\Admin\UsersController@UserUpdate')->name('admin.users.update');

    // Admin Seller Requests
    Route::get('/seller-requests', 'App\Http\Controllers\Admin\SellerController@sellerrequests')->name('admin.sellerrequests');
    Route::post('/seller-requests/save', 'App\Http\Controllers\Admin\SellerController@sellerupdate')->name('admin.sellerrequests.store');

    // Admin System Settings
    Route::get('/settings', 'App\Http\Controllers\Admin\SettingsController@settings')->name('admin.settings');
    Route::post('/settings/save', 'App\Http\Controllers\Admin\SettingsController@settingssave')->name('admin.settings.save');
    Route::post('/settings/modules/{id}/toggle', 'App\Http\Controllers\Admin\SettingsController@modules_toggle')->name('admin.modules.toggle');
    Route::post('/settings/modules/upload', 'App\Http\Controllers\Admin\SettingsController@modules_upload')->name('admin.modules.upload');

    // Admin System Announcements
    Route::group(['prefix' => 'announcements'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\AnnouncementsController@index')->name('admin.announcements');
        Route::post('/new', 'App\Http\Controllers\Admin\AnnouncementsController@createnew')->name('admin.announcements.new');
        Route::post('/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@delete')->name('admin.announcements.delete');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\AnnouncementsController@update')->name('admin.announcements.update');
    });

    // Admin System Knowledgebase
    Route::group(['prefix' => 'knowledgebase'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\KnowledgebaseController@index')->name('admin.knowledgebase');

        Route::group(['prefix' => 'category'], function () {
            Route::post('/new', 'App\Http\Controllers\Admin\KnowledgebaseController@categorynew')->name('admin.knowledgebase.category.new');
            Route::post('/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@categorydelete')->name('admin.knowledgebase.category.delete');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@categoryupdate')->name('admin.knowledgebase.category.update');
        });

        Route::group(['prefix' => 'article'], function () {
            Route::post('/new', 'App\Http\Controllers\Admin\KnowledgebaseController@new')->name('admin.knowledgebase.new');
            Route::post('/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@delete')->name('admin.knowledgebase.delete');
            Route::post('/update/{id}', 'App\Http\Controllers\Admin\KnowledgebaseController@update')->name('admin.knowledgebase.update');
        });
    });

    // Tickets
    Route::group(['prefix' => 'tickets'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\TicketsController@Index')->name('admin.tickets');
        Route::post('/category/create', 'App\Http\Controllers\Admin\TicketsController@CategoryCreate')->name('admin.category.create');
        Route::post('/category/update/{id}', 'App\Http\Controllers\Admin\TicketsController@CategoryUpdate')->name('admin.category.update');
        Route::post('/{id}/delete', 'App\Http\Controllers\Admin\TicketsController@TicketDelete')->name('admin.tickets.delete');
        Route::get('/{id}', 'App\Http\Controllers\Admin\TicketsController@ViewTicket')->name('admin.tickets.view');
        Route::post('/{id}/close', 'App\Http\Controllers\Admin\TicketsController@CloseTicket')->name('admin.tickets.close');
        Route::post('/{id}/open', 'App\Http\Controllers\Admin\TicketsController@OpenTicket')->name('admin.tickets.open');
        Route::post('/{id}/whisper', 'App\Http\Controllers\Admin\TicketsController@TicketWhisper')->name('admin.tickets.whisper');
        Route::post('/{id}/reply', 'App\Http\Controllers\Admin\TicketsController@TicketReply')->name('admin.tickets.reply');
    });

    // Roles
    Route::group(['prefix' => 'role'], function () {
        Route::post('/create', 'App\Http\Controllers\Admin\SettingsController@CreateRole')->name('admin.role.create');
        Route::post('/update/{id}', 'App\Http\Controllers\Admin\SettingsController@UpdateRole')->name('admin.role.update');
        Route::post('/delete/{id}', 'App\Http\Controllers\Admin\SettingsController@DeleteRole')->name('admin.role.delete');
    });

    // Admin Legal Documents
    Route::group(['prefix' => 'tos'], function () {
        Route::post('/status', 'App\Http\Controllers\Admin\SettingsController@tosstatus')->name('admin.tos.status');
        Route::post('/create', 'App\Http\Controllers\Admin\SettingsController@tossection')->name('admin.tos.create');
        Route::post('/section/delete/{id}', 'App\Http\Controllers\Admin\SettingsController@tossectiondelete')->name('admin.tos.section.delete');
        Route::post('/section/update/{id}', 'App\Http\Controllers\Admin\SettingsController@tossectionedit')->name('admin.tos.section.update');
    });

    Route::group(['prefix' => 'privacy'], function () {
        Route::post('/status', 'App\Http\Controllers\Admin\SettingsController@privacystatus')->name('admin.privacy.status');
        Route::post('/create', 'App\Http\Controllers\Admin\SettingsController@privacysection')->name('admin.privacy.create');
        Route::post('/section/delete/{id}', 'App\Http\Controllers\Admin\SettingsController@privacysectiondelete')->name('admin.privacy.section.delete');
        Route::post('/section/update/{id}', 'App\Http\Controllers\Admin\SettingsController@privacysectionedit')->name('admin.privacy.section.update');
    });

    // Products 
    Route::group(['prefix' => 'products'], function () {
        Route::get('/', 'App\Http\Controllers\Admin\ProductsController@index')->name('admin.products');
        Route::get('/view/{id}', 'App\Http\Controllers\Admin\ProductsController@view')->name('admin.products.view');
        Route::post('/view/{id}/image', 'App\Http\Controllers\Admin\ProductsController@image')->name('admin.products.image');
    });

    // OAuth2 
    Route::group(['prefix' => 'oauth2'], function () {
        Route::post('/status', 'App\Http\Controllers\Admin\SettingsController@OAuth2Status')->name('admin.oauth2.status');
        Route::post('/update', 'App\Http\Controllers\Admin\SettingsController@OAuth2Update')->name('admin.oauth2.update');
    });
});

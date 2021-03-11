<?php

// Contact Us
Route::get('/contact', 'App\Http\Controllers\SupportController@Contact')->name('support.contact');

// Submit a Ticket
Route::get('/tickets', 'App\Http\Controllers\Modules\TicketsController@Tickets')->name('ticket.index');
Route::get('/tickets/new', 'App\Http\Controllers\Modules\TicketsController@NewTicket')->name('ticket.new');
Route::post('/tickets/new/create', 'App\Http\Controllers\Modules\TicketsController@Create')->name('ticket.new.create');
Route::post('/tickets/{id}/reply', 'App\Http\Controllers\Modules\TicketsController@TicketReplyCreate')->name('ticket.new.reply');
Route::get('/tickets/{id}', 'App\Http\Controllers\Modules\TicketsController@TicketView')->name('ticket.view');

// Announcements
Route::get('/announcements', 'App\Http\Controllers\Modules\AnnouncementController@Announcements')->name('announcements.index');
Route::get('/announcements/{id}', 'App\Http\Controllers\Modules\AnnouncementController@AnnounceView')->name('announcements.view');

// Knowledgebase
Route::get('/knowledgebase', 'App\Http\Controllers\Modules\KnowledgebaseController@Knowledgebase')->name('knowledgebase.index');
Route::get('/knowledgebase/category/{id}', 'App\Http\Controllers\Modules\KnowledgebaseController@KnowledgebaseCategory')->name('knowledgebase.category');
Route::get('/knowledgebase/article/{id}', 'App\Http\Controllers\Modules\KnowledgebaseController@KnowledgeView')->name('knowledgebase.article.view');

// Legal Documents
Route::get('/tos', 'App\Http\Controllers\Modules\LegalController@tos')->name('legal.tos');
Route::get('/privacy', 'App\Http\Controllers\Modules\LegalController@privacy')->name('legal.privacy');

// Discord Integration
Route::get('/discord/connect', 'App\Http\Controllers\Modules\OAuth2Controller@DiscordRedirect')->name('discord.redirect');
Route::get('/discord/callback', 'App\Http\Controllers\Modules\OAuth2Controller@DiscordCallback')->name('discord.callback');
Route::get('/discord/remove', 'App\Http\Controllers\Modules\OAuth2Controller@DiscordRemove')->name('discord.remove');

// Google Integration
Route::get('/google/connect', 'App\Http\Controllers\Modules\OAuth2Controller@GoogleRedirect')->name('google.redirect');
Route::get('/google/callback', 'App\Http\Controllers\Modules\OAuth2Controller@GoogleCallback')->name('google.callback');
Route::get('/google/remove', 'App\Http\Controllers\Modules\OAuth2Controller@GoogleRemove')->name('google.remove');

// GitHub Integration
Route::get('/github/connect', 'App\Http\Controllers\Modules\OAuth2Controller@GithubRedirect')->name('github.redirect');
Route::get('/github/callback', 'App\Http\Controllers\Modules\OAuth2Controller@GithubCallback')->name('github.callback');
Route::get('/github/remove', 'App\Http\Controllers\Modules\OAuth2Controller@GithubRemove')->name('github.remove');

// All Users
Route::get('/users', 'App\Http\Controllers\Modules\UsersController@Users')->name('users.index');
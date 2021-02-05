<?php

// Announcements
Route::get('/announcements', 'App\Http\Controllers\InfoController@Announcements')->name('announcements.index');
Route::get('/announcements/{id}', 'App\Http\Controllers\InfoController@AnnounceView')->name('announcements.view');

// Knowledgebase
Route::get('/knowledgebase', 'App\Http\Controllers\InfoController@Knowledgebase')->name('knowledgebase.index');
Route::get('/knowledgebase/{id}', 'App\Http\Controllers\InfoController@KnowledgeView')->name('knowledgebase.view');
<?php

// Contact Us
Route::get('/contact', 'App\Http\Controllers\SupportController@Contact')->name('support.contact');

// Submit a Ticket
Route::get('/tickets', 'App\Http\Controllers\SupportController@Tickets')->name('support.ticket');
Route::get('/tickets/new', 'App\Http\Controllers\SupportController@NewTicket')->name('support.ticket.new');
Route::post('/tickets/new/create', 'App\Http\Controllers\SupportController@Create')->name('support.ticket.new.create');
Route::post('/tickets/{id}/reply', 'App\Http\Controllers\SupportController@TicketReplyCreate')->name('support.ticket.new.reply');
Route::get('/tickets/{id}', 'App\Http\Controllers\SupportController@TicketView')->name('support.ticket.view');

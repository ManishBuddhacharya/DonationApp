<?php
use Illuminate\Http\Request;

Route::get('/backend/event', 'EventController@event')->middleware('verified');
Route::get('/backend/event/add', 'EventController@addEvent')->middleware('verified');
Route::POST('/backend/event/add', 'EventController@insertEvent')->middleware('verified');
Route::get('/backend/event/edit/{id}', 'EventController@editEvent')->middleware('verified');
Route::POST('/backend/event/update/{id}', 'EventController@updateEvent')->middleware('verified');
Route::get('/backend/event/delete/{event}', 'EventController@deleteEvent')->middleware('verified');
Route::get('/backend/event/detail/{id}', 'EventController@eventDetail')->middleware('verified');

/*Category*/
Route::POST('/backend/categories', 'EventController@fetchCategories')->middleware('verified');
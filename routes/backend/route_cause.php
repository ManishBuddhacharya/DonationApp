<?php

Route::get('/backend/cause', 'CauseController@cause')->middleware('verified');
Route::get('/backend/cause/add', 'CauseController@addCause')->middleware('verified');
Route::POST('/backend/cause/add', 'CauseController@insertCause')->middleware('verified');
Route::get('/backend/cause/edit/{id}', 'CauseController@editCause')->middleware('verified');
Route::POST('/backend/cause/update/{id}', 'CauseController@updateCause')->middleware('verified');
Route::get('/backend/cause/delete/{cause}', 'CauseController@deleteCause')->middleware('verified');
Route::get('/backend/cause/detail/{id}', 'CauseController@causeDetail')->middleware('verified');
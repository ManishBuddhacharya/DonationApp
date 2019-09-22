<?php
use Illuminate\Http\Request;

Route::get('/backend/news', 'NewsController@news')->middleware('verified');
Route::get('/backend/news/add', 'NewsController@addNews')->middleware('verified');
Route::POST('/backend/news/add', 'NewsController@insertNews')->middleware('verified');
Route::get('/backend/news/edit/{id}', 'NewsController@editNews')->middleware('verified');
Route::POST('/backend/news/update/{id}', 'NewsController@updateNews')->middleware('verified');
Route::get('/backend/news/delete/{story}', 'NewsController@deleteNews')->middleware('verified');
Route::get('/backend/news/detail/{id}', 'NewsController@newsDetail')->middleware('verified');

/*Category*/
Route::POST('/backend/categories', 'NewsController@fetchCategories')->middleware('verified');

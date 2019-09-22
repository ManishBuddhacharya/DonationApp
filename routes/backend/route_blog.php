<?php
use Illuminate\Http\Request;

Route::get('/backend/blog', 'BlogController@blog')->middleware('verified');
Route::get('/backend/blog/add', 'BlogController@addBlog')->middleware('verified');
Route::POST('/backend/blog/add', 'BlogController@insertBlog')->middleware('verified');
Route::get('/backend/blog/edit/{id}', 'BlogController@editBlog')->middleware('verified');
Route::POST('/backend/blog/update/{id}', 'BlogController@updateBlog')->middleware('verified');
Route::get('/backend/blog/delete/{blog}', 'BlogController@deleteBlog')->middleware('verified');
Route::get('/backend/blog/detail/{id}', 'BlogController@blogDetail')->middleware('verified');

/*Category*/
Route::POST('/backend/categories', 'BlogController@fetchCategories')->middleware('verified');

<?php
use Illuminate\Http\Request;

Route::get('/backend/gallery', 'GalleryController@gallery')->middleware('verified');
Route::get('/backend/gallery/add', 'GalleryController@addImage')->middleware('verified');
Route::POST('/backend/gallery/add', 'GalleryController@insertImage')->middleware('verified');
Route::get('/backend/gallery/edit/{image}', 'GalleryController@editImage')->middleware('verified');
Route::POST('/backend/gallery/update/{image}', 'GalleryController@updateImage')->middleware('verified');
Route::get('/backend/gallery/delete/{image}', 'GalleryController@deleteImage')->middleware('verified');
// Route::get('/backend/gallery/detail/{id}', 'GalleryController@blogDetail')->middleware('verified');


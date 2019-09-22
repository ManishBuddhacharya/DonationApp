<?php

/*
|--------------------------------------------------------------------------
| Home Routes
|--------------------------------------------------------------------------
*/

//story
Route::get('/frontend/story','HomeController@story');
Route::get('/frontend/story/detail/{id}','HomeController@storyDetail');

//blog
Route::get('/frontend/blog','HomeController@blog');
Route::get('/frontend/blog/detail/{id}','HomeController@blogDetail');

//cause
Route::get('/frontend/cause','HomeController@cause');
Route::get('/frontend/cause/detail/{id}','HomeController@causeDetail');

//event
Route::get('/frontend/event','HomeController@event');
Route::get('/frontend/event/detail','HomeController@eventDetail');

//organization Structure
Route::get('/frontend/organization','HomeController@organization');
Route::get('/frontend/organization/detail','HomeController@organizationDetail');

//profile
Route::get('/frontend/profile','HomeController@profile');

//login
Route::get('/frontend/login','HomeController@login');

//signup
Route::get('/frontend/signup','HomeController@signup');

//news
Route::get('/frontend/news','HomeController@news');
Route::get('/frontend/news/detail','HomeController@newsDetail');

//gallary
Route::get('/frontend/gallery','HomeController@gallery');
Route::get('/frontend/gallary/detail','HomeController@gallaryDetail');

//contact
Route::get('/frontend/contact','HomeController@contact');

//about
Route::get('/frontend/about','HomeController@about');
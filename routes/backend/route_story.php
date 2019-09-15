<?php
use Illuminate\Http\Request;

Route::get('/backend/story', 'StoryController@story')->middleware('verified');
Route::get('/backend/story/add', 'StoryController@addStory')->middleware('verified');
Route::POST('/backend/story/add', 'StoryController@insertStory')->middleware('verified');
Route::get('/backend/story/edit/{id}', 'StoryController@editStory')->middleware('verified');
Route::POST('/backend/story/update/{id}', 'StoryController@updateStory')->middleware('verified');
Route::get('/backend/story/delete/{story}', 'StoryController@deleteStory')->middleware('verified');
Route::get('/backend/story/detail/{id}', 'StoryController@StoryDetail')->middleware('verified');

/*Category*/
Route::POST('/backend/categories', 'StoryController@fetchCategories')->middleware('verified');

<?php
use Illuminate\Http\Request;

Route::get('/backend/setting', 'SettingController@setting')->middleware('verified');
Route::POST('/backend/setting/profile/update/{user}', 'SettingController@updateProfile')->middleware('verified');
Route::POST('/backend/setting/profile/picture/update/{user}', 'SettingController@updateProfilePicture')->middleware('verified');
Route::POST('/backend/setting/password/update/{user}', 'SettingController@updatePassword')->middleware('verified');

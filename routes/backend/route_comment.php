<?php

Route::POST('/comment/add/{id}', 'CommentController@addComment')->middleware('verified');
Route::POST('/comment/reply/{id}', 'CommentController@replyComment')->middleware('verified');
Route::get('/comment/delete/{id}', 'CommentController@deleteComment')->middleware('verified');
Route::get('/comment/approve/{id}', 'CommentController@approveComment')->middleware('verified');
Route::get('/comment/disApprove/{id}', 'CommentController@disApproveComment')->middleware('verified');
Route::get('/reply/delete/{id}', 'CommentController@deleteReply')->middleware('verified');
Route::get('/reply/approve/{id}', 'CommentController@approveReply')->middleware('verified');
Route::get('/reply/disApprove/{id}', 'CommentController@disApproveReply')->middleware('verified');
Route::get('/comment/edit/{comment}', 'CommentController@editComment')->middleware('verified');
Route::get('/reply/edit/{reply}', 'CommentController@editReply')->middleware('verified');
Route::POST('/comment/update/{comment}', 'CommentController@updateComment')->middleware('verified');
Route::POST('/reply/update/{reply}', 'CommentController@updateReply')->middleware('verified');

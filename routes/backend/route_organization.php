<?php
use Illuminate\Http\Request;

Route::get('/backend/organization', 'OrganizationController@organization')->middleware('verified');
Route::get('/backend/organization/list', 'OrganizationController@memberPositions')->middleware('verified');

Route::get('/backend/organization/allMembersPositions', 'OrganizationController@allMemberPositions')->middleware('verified');
Route::get('/backend/organization/add', 'OrganizationController@addMemberPosition')->middleware('verified');
Route::POST('/backend/organization/add', 'OrganizationController@insertMemberPosition')->middleware('verified');
Route::get('/backend/organization/edit/{id}', 'OrganizationController@editMemberPosition')->middleware('verified');
Route::POST('/backend/organization/update/{id}', 'OrganizationController@updateMemberPosition')->middleware('verified');
Route::get('/backend/organization/delete/{story}', 'OrganizationController@deleteMemberPosition')->middleware('verified');

/*Category*/
Route::POST('/backend/positions', 'OrganizationController@fetchPositions')->middleware('verified');

/*users*/
Route::POST('/backend/users', 'OrganizationController@fetchUsers')->middleware('verified');

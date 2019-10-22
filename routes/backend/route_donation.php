<?php 
Route::get('/cause/donate/{id}', 'DonationController@causeDonation')->middleware('verified');
Route::get('/getDonationInfo', 'DonationController@allDonation')->middleware('verified');
Route::get('/getDonationInfo/table', 'DonationController@allDonationTable')->middleware('verified');
Route::post ( '/cause/donate', 'DonationController@donation');
<?php 
Route::get('/cause/donate/{id}', 'DonationController@causeDonation')->middleware('verified');
Route::post ( '/cause/donate', 'DonationController@donation');
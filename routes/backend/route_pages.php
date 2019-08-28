<?php

Route::get('/backend/dashboard', 'PagesController@index')->middleware('verified');
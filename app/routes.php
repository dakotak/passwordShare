<?php


Route::get('/', function()
{
	return View::make('home');
});

// Route alias for login and out
Route::get('login', 'userController@getLogin');
Route::get('logout', 'userController@getLogout');

// Controller Routes
Route::controller('user', 'userController');
Route::controller('admin', 'adminController');
Route::controller('credentials', 'credentialsController');




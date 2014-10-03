<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('home');
});

Route::get('credential', function()
{

});

Route::controller('user', 'userController');

Route::get('users', function()
{
    $users = User::all();

	return View::make('users')->with('users', $users);
});

Route::get('crypto', function()
{
    // Test the crypto class
    echo "<h1>Symetric</h1><pre>" . base64_encode(crypto::create_symmetric_key()) . "</pre><br />";

    $keys = crypto::create_asymmetric_keypair();

    echo "<h1>Asymmetric</h1><h2>Public Key</h2><pre>" . $keys['public'] . "</pre><br />";
    echo "<h2>Private Key</h2><pre>" . $keys['private'] . "</pre><br />";

});
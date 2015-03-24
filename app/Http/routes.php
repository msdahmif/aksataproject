<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('profile', 'ProfileController@index');
Route::get('profile/edit', 'ProfileController@edit');
Route::post('profile/edit', 'ProfileController@update');
Route::get('profile/confirm', 'ProfileController@confirm');

Route::get('profile/{nim}', 'ProfileController@show');
Route::get('profile/{nim}/edit', 'ProfileController@edit');
Route::post('profile/{nim}/edit', 'ProfileController@update');
Route::get('profile/{nim}/confirm', 'ProfileController@confirm');

Route::get('search', 'SearchController@index');

Route::get('settings', 'SettingsController@index');
Route::post('settings', 'SettingsController@update');

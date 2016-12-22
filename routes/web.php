<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

// Source: Illuminate/Routing/Router

// Authentication
Route::get('auth/login', 'Auth\LoginController@showLoginForm');
Route::post('auth/login', 'Auth\LoginController@login');
Route::get('auth/logout', 'Auth\LoginController@logout');

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

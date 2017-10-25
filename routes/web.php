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

// Manajemen Divisi untuk Ketua
Route::get('management', 'ManagementController@index');
Route::get('management/create', 'ManagementController@create');
Route::post('management/create', 'ManagementController@store');
Route::get('management/{id}/edit', 'ManagementController@edit');
Route::post('management/{id}/edit', 'ManagementController@update');

// Divisi
Route::get('division/{id}/create', 'DivisionController@create');
Route::post('division/{id}/create', 'DivisionController@store');
Route::get('division/{id}/edit', 'DivisionController@edit');
Route::post('division/{id}/edit', 'DivisionController@update');
Route::delete('division/{id}/delete', 'DivisionController@destroy');

// Achievement
Route::get('achievement', 'AchievementController@index');
Route::get('achievement/create', 'AchievementController@create');
Route::post('achievement/create', 'AchievementController@store');
Route::get('achievement/{achievement}', 'AchievementController@show');
Route::get('achievement/nim/{nim}', 'AchievementController@index');

// Achievement for admin
Route::get('achievement/{achievement}/edit', 'AchievementController@edit');
Route::post('achievement/{achievement}/edit', 'AchievementController@update');
// Still not implement delete achievement
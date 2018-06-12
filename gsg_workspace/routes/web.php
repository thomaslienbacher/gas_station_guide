<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/settings',  ['as' => 'auth.settings', 'uses' => 'SettingsController@edit']);
Route::post('/settings', 'SettingsController@update');

Route::get('/mystations',  ['as' => 'auth.mystations', 'uses' => 'MyStationsController@index']);
Route::post('/mystations',  ['as' => 'auth.mystations', 'uses' => 'MyStationsController@index']);

Route::get('/search', 'SearchController@index')->name("search");

Route::post('/view', 'StationViewController@index')->name("view");

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

Route::get('/', 'PostsController@index');
Route::resource('discussions','PostsController');
Route::resource('comments','CommentsController');


Route::post('/discussions/upload','PostsController@upload');
Route::get('/user/register','UsersController@register');
Route::get('/user/login','UsersController@login');
Route::get('/verify/{confirm_code}','UsersController@confirmEmail');
Route::post('/user/register','UsersController@store');
Route::post('/user/login','UsersController@signin');
Route::get('/user/logout','UsersController@logout');
Route::get('/user/avatar','UsersController@avatar');
Route::post('avatar','UsersController@changeAvatar');
Route::post('/crop/api','UsersController@cropAvatar');


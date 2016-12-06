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

Route::get('/', [
  'as' => '/',
  'uses' => 'AuthController@index'
]);

/*Authorization of User*/
Route::get('login', [
  'as' => 'login',
  'uses' => 'AuthController@login'
]);
Route::get('register', [
  'as' => 'register',
  'uses' => 'UsersController@create'
]);
Route::post('handleLogin', [
  'as' => 'handleLogin',
  'uses' => 'AuthController@handleLogin'
]);
Route::get('dashboard', [
  'middleware' => 'auth',
  'as' => 'dashboard',
  'uses' => 'UsersController@dashboard'
]);
Route::get('settings', [
  'middleware' => 'auth',
  'as' => 'settings',
  'uses' => 'UsersController@settings'
]);
Route::get('logout', [
  'as' => 'logout',
  'uses' => 'AuthController@logout'
]);


/*Confirm Email*/
Route::get('verify', [
  'as' => 'confirm_email',
  'uses' => 'AuthController@email'
]);
Route::get('verify/sendCode', [
  'as' => 'send_verification_code',
  'uses' => 'EmailController@send_confirmation'
]);
Route::get('verify/{confirmationCode}', [
  'as' => 'confirmation_path',
  'uses' => 'AuthController@confirm'
]);


/*CRUD Resources*/
Route::resource('users', 'UsersController', [
  'only' => ['create', 'store', 'update', 'destroy']
]);
Route::resource('lists', 'ListsController', [
  'only' => ['create', 'store', 'update', 'destroy']
]);
Route::resource('tasks', 'TasksController', [
  'only' => ['create', 'store', 'update', 'destroy']
]);


/*Wild Cards*/
Route::get('list/{id}', [
  'middleware' => 'auth',
  'as' => 'viewCampaign',
  'uses' => 'CampaignsController@view'
]);
Route::get('user/{id?}', [
  'middleware' => 'auth',
  'as' => 'viewUser',
  'uses' => 'UsersController@show'
]);

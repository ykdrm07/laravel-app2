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

Route::group(['middleware' => 'guest'], function() {
  Route::get('/', 'UserController@signin')->name('user.signin');
  Route::post('/user/login', 'UserController@login')->name('user.login');
  Route::resource('user', 'UserController', ['only' => ['create', 'store']]);
});

Route::group(['middleware' => 'auth'], function() {
  Route::get('/micropost/index', 'MicropostController@index')->name('micropost.index');
  Route::post('/user/logout', 'UserController@logout')->name('user.logout');
  Route::get('/micropost/input', 'MicropostController@input')->name('micropost.input');
  Route::post('/micropost/post', 'MicropostController@post')->name('micropost.post');
  Route::resource('user', 'UserController', ['only' => ['index', 'edit', 'update', 'destroy']]);
});
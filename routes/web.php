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

Route::get('/', 'UrlController@create');
Route::resource('/product', 'UrlController',['except' => ['create']]);
Route::post('/comment/{id}', 'VoteController@store');
Route::post('/vote/{id}', 'VoteController@vote');

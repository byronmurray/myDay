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


Route::get('/', 'ActivityController@index');
Route::get('/create/', 'ActivityController@create');
Route::post('/activities', 'ActivityController@store');

Route::get('/add-to-cart/{id}', 'ActivityController@addToCart');
Route::get('/remove/{id}', 'ActivityController@getRemovedItem');
Route::get('/shopping-cart', 'ActivityController@viewCart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::get('/', 'FE\InterfaceController@home');
Route::get('/museum', 'FE\InterfaceController@museum');
Route::get('/heritage-place', 'FE\InterfaceController@heritagePlace');
Route::get('/vr-tour', 'FE\InterfaceController@vrTour');

Route::get('/dashboard', 'BE\IndexController@dashboard');

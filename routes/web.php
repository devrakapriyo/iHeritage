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

Route::get('locale/{locale}', function($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});

Route::namespace('FE')->group(function () {
    
    Route::get('/', 'InterfaceController@home');
    Route::get('/museum/{museum_name}/{id}', 'InterfaceController@museum');
    Route::get('/heritage-place', 'InterfaceController@heritagePlace');
    Route::get('/vr-tour', 'InterfaceController@vrTour');
});

Route::get('/login', 'BE\IndexController@login');
Route::post('/login', 'BE\IndexController@login_action');
Route::get('/logout', 'BE\IndexController@logout');

Route::get('/register', 'BE\IndexController@register');
Route::post('/register', 'BE\IndexController@register_post');

Route::prefix('dashboard')->namespace('BE')->group(function () {
    Route::get('/', 'IndexController@dashboard');
});

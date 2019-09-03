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

Route::get('/login', 'BE\IndexController@login')->name('login');
Route::post('/login', 'BE\IndexController@login_action');
Route::get('/logout', 'BE\IndexController@logout');

Route::get('/register', 'BE\IndexController@register');
Route::post('/register', 'BE\IndexController@register_post');

Route::prefix('dashboard')->namespace('BE')->middleware('auth')->group(function () {
    Route::get('/', 'IndexController@dashboard')->name('dashboard');

    // content pages
    Route::get('/content-pages/{category}', 'ContentController@content_pages')->name('content-pages');
    Route::get('/content-pages/{category}/get', 'ContentController@content_get')->name('content-get');
    Route::get('/content-pages/{category}/add', 'ContentController@content_add')->name('content-add');
    Route::post('/content-pages/{category}/add', 'ContentController@content_post')->name('content-post');
    Route::get('/content-pages/{category}/edit/{id}', 'ContentController@content_edit')->name('content-edit');
    Route::post('/content-pages/{category}/update/{id}', 'ContentController@content_update')->name('content-update');
    Route::get('/content-pages/{category}/delete/{id}', 'ContentController@content_delete')->name('content-delete');

    // category
    Route::get('/category-content', 'IndexController@category_content')->name('category-page');
    Route::get('/category-content/get', 'IndexController@category_get')->name('category-get');
    Route::get('/category-content/add', 'IndexController@category_add')->name('category-add');
    Route::post('/category-content/add', 'IndexController@category_post')->name('category-post');

    // vr
    Route::get('/vr', 'VrController@vr_pages')->name('vr-page');
    Route::get('/vr/get', 'VrController@vr_get')->name('vr-get');

    // event
    Route::get('/event-page', 'EventController@event_page')->name('event-page');
    Route::get('/event-page/get', 'EventController@event_get')->name('event-get');
    Route::get('/event-page/add', 'EventController@event_add')->name('event-add');
    Route::post('/event-page/add', 'EventController@event_post')->name('event-post');
    Route::get('/event-page/edit/{id}', 'EventController@event_edit')->name('event-edit');
    Route::post('/event-page/update/{id}', 'EventController@event_update')->name('event-update');
    Route::get('/event-page/delete/{id}', 'EventController@event_delete')->name('event-delete');

    // event
    Route::get('/education-program-page', 'EduController@edu_page')->name('edu-page');
    Route::get('/education-program-page/get', 'EduController@edu_get')->name('edu-get');
    Route::get('/education-program-page/add', 'EduController@edu_add')->name('edu-add');
    Route::post('/education-program-page/add', 'EduController@edu_post')->name('edu-post');
    Route::get('/education-program-page/edit/{id}', 'EduController@edu_edit')->name('edu-edit');
    Route::post('/education-program-page/update/{id}', 'EduController@edu_update')->name('edu-update');
    Route::get('/education-program-page/delete/{id}', 'EduController@edu_delete')->name('edu-delete');
});

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

    Route::get('email', 'InterfaceController@email');
    Route::post('email', 'InterfaceController@email_post');

    Route::get('/profile-visitor', 'InterfaceController@profileVisitor')->middleware('visitor');
    Route::post('/profile-visitor', 'InterfaceController@profileVisitorPost')->middleware('visitor');

    Route::get('/reset-password/{role}', 'InterfaceController@resetPassword');
    Route::post('/reset-password/{role}', 'InterfaceController@resetPasswordPost');

    Route::get('/', 'InterfaceController@home');
    Route::get('/search', 'InterfaceController@search');
    Route::get('/search-instantion/{instantion}', 'InterfaceController@searchInstantion');
    Route::get('/content/{seo}/{id}', 'InterfaceController@detailContent');
    Route::post('/content/{id}', 'InterfaceController@detailContentPost');
    Route::post('/content-{visiting_order}/{id}', 'InterfaceController@visitingOrderPost');

    Route::get('/collection', 'InterfaceController@collection');
    Route::get('/collection-search', 'InterfaceController@collectionSearch');
    Route::get('/collection/detail/{id}', 'InterfaceController@collectionDetail')->name('collection-detail');
    Route::get('/vr-tour', 'InterfaceController@vrTour');

    Route::get('/about-us', 'InterfaceController@aboutUs');

    Route::get('/our-services', 'InterfaceController@ourServices');
    Route::get('/our-services/detail/{id}', 'InterfaceController@ourServicesDetail');
    // form question
    Route::post('/form-question', 'InterfaceController@formQuestion');

    Route::get('/news', 'InterfaceController@news');
    Route::get('/news/detail/{id}', 'InterfaceController@newsDetail');

    Route::get('/event', 'InterfaceController@event');
    Route::get('/event-search', 'InterfaceController@eventSearch');
    Route::get('/event/detail/{seo}/{id}', 'InterfaceController@eventDetail');

    Route::get('/education-program', 'InterfaceController@educationProgram');
    Route::get('/education-program-search', 'InterfaceController@educationProgramSearch');
    Route::get('/education-program/detail/{seo}/{id}', 'InterfaceController@educationProgramDetail');
});

Route::get('/login', 'BE\IndexController@login')->name('login');
Route::post('/login', 'BE\IndexController@login_action');
Route::get('/login-visitor', 'BE\IndexController@login_visitor')->name('login-visitor');
Route::post('/login-visitor', 'BE\IndexController@login_visitor_action');
Route::get('/logout', 'BE\IndexController@logout');

Route::get('/register', 'BE\IndexController@register');
Route::post('/register', 'BE\IndexController@register_post');
Route::get('/register-visitor', 'BE\IndexController@register_visitor');
Route::post('/register-visitor', 'BE\IndexController@register_visitor_post');

Route::get('/dashboard/profile-admin', 'BE\IndexController@profileAdmin')->middleware('admin')->name('profile');
Route::post('/dashboard/profile-admin', 'BE\IndexController@profileAdminPost')->middleware('admin')->name('profile-post');

Route::prefix('dashboard')->namespace('Admin')->middleware('admin')->group(function () {
    // heritage
    Route::get('/heritage', 'HeritageController@heritage_pages')->name('heritage-pages');
    Route::post('/heritage/update/{id}/{page}', 'HeritageController@heritage_update')->name('heritage-update');

    // our services
    Route::get('/our-services', 'OurServicesController@our_services_pages')->name('our-services-pages');
    Route::get('/our-services/get', 'OurServicesController@our_services_get')->name('our-services-get');
    Route::get('/our-services/add', 'OurServicesController@our_services_add')->name('our-services-add');
    Route::post('/our-services/add', 'OurServicesController@our_services_post')->name('our-services-post');
    Route::get('/our-services/edit/{id}', 'OurServicesController@our_services_edit')->name('our-services-edit');
    Route::post('/our-services/update/{id}', 'OurServicesController@our_services_update')->name('our-services-update');
    Route::get('/our-services/delete/{id}', 'OurServicesController@our_services_delete')->name('our-services-delete');

    // form question
    Route::get('/form-question', 'OurServicesController@form_question')->name('form-question-pages');
    Route::get('/form-question/get', 'OurServicesController@form_question_get')->name('form-question-get');
    Route::get('/form-question/detail/{id}', 'OurServicesController@form_question_detail')->name('form-question-detail');
    Route::post('/form-question/update/{id}', 'OurServicesController@form_question_update')->name('form-question-update');

    // news
    Route::get('/news', 'NewsController@news_pages')->name('news-pages');
    Route::get('/news/get', 'NewsController@news_get')->name('news-get');
    Route::get('/news/add', 'NewsController@news_add')->name('news-add');
    Route::post('/news/add', 'NewsController@news_post')->name('news-post');
    Route::get('/news/edit/{id}', 'NewsController@news_edit')->name('news-edit');
    Route::post('/news/update/{id}', 'NewsController@news_update')->name('news-update');
    Route::get('/news/delete/{id}', 'NewsController@news_delete')->name('news-delete');
});

Route::prefix('dashboard')->namespace('BE')->middleware('admin')->group(function () {
    Route::get('/', 'IndexController@dashboard')->name('dashboard');
    Route::get('/map/{location}', 'ContentController@get_map');

    // user management
    Route::get('/users-management', 'UserController@users_pages')->name('users-pages');
    Route::get('/users-management/get', 'UserController@users_get')->name('users-get');
    Route::get('/users-management/add', 'UserController@users_add')->name('users-add');
    Route::post('/users-management/add', 'UserController@users_post')->name('users-post');
    Route::get('/users-management/edit/{id}', 'UserController@users_edit')->name('users-edit');
    Route::post('/users-management/update/{id}', 'UserController@users_update')->name('users-update');
    Route::get('/users-management/delete/{id}', 'UserController@users_delete')->name('users-delete');
    Route::get('/users-management/active/{id}', 'UserController@users_active')->name('users-active');
    Route::get('/users-management/institutional/{id}', 'UserController@users_institutional')->name('users-institutional');

    // content pages
    Route::get('/content-pages/{category}', 'ContentController@content_pages')->name('content-pages');
    Route::get('/content-pages/{category}/get', 'ContentController@content_get')->name('content-get');
    Route::get('/content-pages/{category}/add', 'ContentController@content_add')->name('content-add');
    Route::post('/content-pages/{category}/add', 'ContentController@content_post')->name('content-post');
    Route::get('/content-pages/{category}/edit/{id}', 'ContentController@content_edit')->name('content-edit');
    Route::post('/content-pages/{category}/update/{id}', 'ContentController@content_update')->name('content-update');
    Route::get('/content-pages/{category}/delete/{id}', 'ContentController@content_delete')->name('content-delete');
    Route::get('/content-pages/{category}/approve/{id}', 'ContentController@content_approve')->name('content-approve');
    Route::get('/content-visiting-page', 'ContentController@content_visiting')->name('content-visiting');
    Route::get('/content-visiting-get', 'ContentController@content_visiting_get')->name('content-visiting-get');
    Route::get('/content-visiting-detail/{id}', 'ContentController@content_visiting_detail')->name('content-visiting-detail');
    Route::post('/content-visiting-send/{id}', 'ContentController@content_visiting_send')->name('content-visiting-send');
    // gallery
    Route::get('/content-pages/{category}/gallery/{id}', 'ContentController@content_gallery')->name('content-gallery');
    Route::post('/content-pages/{category}/gallery/{id}', 'ContentController@content_gallery_upload')->name('content-gallery-upload');
    Route::get('/content-pages/{category}/gallery-delete/{id}', 'ContentController@content_gallery_delete')->name('content-gallery-delete');
    // collection
    Route::get('/content-pages/{category}/collection/{id}', 'ContentController@content_collection')->name('content-collection');
    Route::post('/content-pages/{category}/collection/{id}', 'ContentController@content_collection_upload')->name('content-collection-upload');
    Route::get('/content-pages/{category}/collection-delete/{id}', 'ContentController@content_collection_delete')->name('content-collection-delete');
    // collection personal
    Route::get('/collection-pages', 'CollectionController@collection_peges')->name('collection-pages');
    Route::get('/collection-pages/get', 'CollectionController@collection_get')->name('collection-get');
    Route::get('/collection-pages/add', 'CollectionController@collection_add')->name('collection-add');
    Route::post('/collection-pages/add', 'CollectionController@collection_post')->name('collection-post');
    Route::get('/collection/edit/{id}', 'CollectionController@collection_edit')->name('collection-edit');
    Route::post('/collection/update/{id}', 'CollectionController@collection_update')->name('collection-update');
    // gallery personal
    Route::get('/gallery-pages', 'GalleryController@gallery_pages')->name('gallery-pages');
    Route::get('/gallery-add', 'GalleryController@gallery_add')->name('gallery-add');
    Route::post('/gallery-add', 'GalleryController@gallery_upload')->name('gallery-upload');
    Route::get('/gallery-edit/{id}', 'GalleryController@gallery_edit')->name('gallery-edit');
    Route::post('/gallery-update/{id}', 'GalleryController@gallery_update')->name('gallery-update');
    Route::get('/gallery-delete/{id}', 'GalleryController@gallery_delete')->name('gallery-delete');

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
    Route::get('/event-page/approve/{id}', 'EventController@event_approve')->name('event-approve');

    // event
    Route::get('/education-program-page', 'EduController@edu_page')->name('edu-page');
    Route::get('/education-program-page/get', 'EduController@edu_get')->name('edu-get');
    Route::get('/education-program-page/add', 'EduController@edu_add')->name('edu-add');
    Route::post('/education-program-page/add', 'EduController@edu_post')->name('edu-post');
    Route::get('/education-program-page/edit/{id}', 'EduController@edu_edit')->name('edu-edit');
    Route::post('/education-program-page/update/{id}', 'EduController@edu_update')->name('edu-update');
    Route::get('/education-program-page/delete/{id}', 'EduController@edu_delete')->name('edu-delete');
    Route::get('/education-program-page/approve/{id}', 'EduController@edu_approve')->name('edu-approve');
});

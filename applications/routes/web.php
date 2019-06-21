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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
//clear cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('clear-compiled');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    return "Cache is cleared";
});

// =================================== START BACK END ====================================================================
//login
Route::get('/admin', function () {return view('backend.login.login');})->name('backend.login.index');

Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//dashboard basic
Route::get('backend.dashboard', 'DashboardController@index')->name('backend.dashboard');

//Menu Slider
Route::get('slider.index', 'SliderController@index')->name('slider.index');
Route::post('admin/store-slider', 'SliderController@store')->name('slider.store');
Route::get('admin/delete-slider/{id}/{status}', 'SliderController@destroy')->name('slider.destroy');
Route::post('admin/edit-slider', 'SliderController@update')->name('slider.update');
Route::get('admin/publish-slider/{id}', 'SliderController@show')->name('slider.show');
Route::get('admin/bind-slider/{id}', 'SliderController@edit')->name('slider.edit');

//Menu galeri
Route::get('galeri.index', 'GaleriController@index')->name('galeri.index');
Route::post('admin/store-galeri', 'GaleriController@store')->name('galeri.store');
Route::get('admin/delete-galeri/{id}/{status}', 'GaleriController@destroy')->name('galeri.destroy');
Route::post('admin/edit-galeri', 'GaleriController@update')->name('galeri.update');
Route::get('admin/publish-galeri/{id}', 'GaleriController@show')->name('galeri.show');
Route::get('admin/bind-galeri/{id}', 'GaleriController@edit')->name('galeri.edit');

//Menu Video
Route::get('video.index', 'VideoController@index')->name('video.index');
Route::post('admin/store-video', 'VideoController@store')->name('video.store');
Route::get('admin/delete-video/{id}/{status}', 'VideoController@destroy')->name('video.destroy');
Route::post('admin/edit-video', 'VideoController@update')->name('video.update');
Route::get('admin/publish-video/{id}', 'VideoController@show')->name('video.show');
Route::get('admin/bind-video/{id}', 'VideoController@edit')->name('video.edit');
Route::get('admin/edit-important-video/{id}', 'VideoController@editimportantvideo')->name('importantvideo.publish');

//Menu Sponsor
Route::get('sponsor.index', 'SponsorController@index')->name('sponsor.index');
Route::post('admin/store-sponsor', 'SponsorController@store')->name('sponsor.store');
Route::get('admin/delete-sponsor/{id}/{status}', 'SponsorController@destroy')->name('sponsor.destroy');
Route::post('admin/edit-sponsor', 'SponsorController@update')->name('sponsor.update');
Route::get('admin/publish-sponsor/{id}', 'SponsorController@show')->name('sponsor.show');
Route::get('admin/bind-sponsor/{id}', 'SponsorController@edit')->name('sponsor.edit');

//Menu Product
Route::get('product.index', 'ProductController@index')->name('product.index');
Route::post('admin/store-product', 'ProductController@store')->name('product.store');
Route::get('admin/delete-product/{id}/{status}', 'ProductController@destroy')->name('product.destroy');
Route::post('admin/edit-product', 'ProductController@update')->name('product.update');
Route::get('admin/publish-product/{id}', 'ProductController@show')->name('product.show');
Route::get('admin/bind-product/{id}', 'ProductController@edit')->name('product.edit');

//Menu Partners
Route::get('partners.index', 'PartnersController@index')->name('partners.index');
Route::post('admin/store-partners', 'PartnersController@store')->name('partners.store');
Route::get('admin/delete-partners/{id}/{status}', 'PartnersController@destroy')->name('partners.destroy');
Route::post('admin/edit-partners', 'PartnersController@update')->name('partners.update');
Route::get('admin/publish-partners/{id}', 'PartnersController@show')->name('partners.show');
Route::get('admin/bind-partners/{id}', 'PartnersController@edit')->name('partners.edit');

//Menu Medsos
Route::get('medsos.index', 'MedsosController@index')->name('medsos.index');
Route::post('admin/store-medsos', 'MedsosController@store')->name('medsos.store');
Route::get('admin/delete-medsos/{id}/{status}', 'MedsosController@destroy')->name('medsos.destroy');
Route::post('admin/edit-medsos', 'MedsosController@update')->name('medsos.update');
Route::get('admin/bind-medsos/{id}', 'MedsosController@edit')->name('medsos.edit');

//Menu SertifikatController
Route::get('sertifikat.index', 'SertifikatController@index')->name('sertifikat.index');
Route::post('admin/store-sertifikat', 'SertifikatController@store')->name('sertifikat.store');
Route::get('admin/delete-sertifikat/{id}/{status}', 'SertifikatController@destroy')->name('sertifikat.destroy');
Route::post('admin/edit-sertifikat', 'SertifikatController@update')->name('sertifikat.update');
Route::get('admin/publish-sertifikat/{id}', 'SertifikatController@show')->name('sertifikat.show');
Route::get('admin/bind-sertifikat/{id}', 'SertifikatController@edit')->name('sertifikat.edit');

//Menu Kategori
Route::get('kategori.index/{status}', 'KategoriController@index')->name('kategori.index');
Route::post('admin/store-kategori', 'KategoriController@store')->name('kategori.store');
Route::get('admin/delete-kategori/{id}/{status}/{flag}', 'KategoriController@destroy')->name('kategori.destroy');
Route::post('admin/edit-kategori', 'KategoriController@update')->name('kategori.update');
Route::get('admin/bind-kategori/{id}', 'KategoriController@edit')->name('kategori.edit');

//log Apps activity
Route::get('log.activity', 'LogActivitiesController@index')->name('log.activity');
Route::get('datatables.log.activity', ['as'=>'datatables.log.activity', 'uses'=>'LogActivitiesController@getDataForDataTable']);

//log Apps files
Route::get('log.files', 'LogFilesController@index')->name('log.files');
Route::get('log.files.show/{filename}', 'LogFilesController@show')->name('log.files.show');
Route::get('log.files.download/{filename}', 'LogFilesController@download')->name('log.files.download');

//Menu informasi
Route::get('profile.index', 'ProfileController@index')->name('profile.index');
Route::get('datatables.profile', ['as'=>'datatables.profile', 'uses'=>'ProfileController@getDataForDataTable']);
Route::get('profile.tambah', 'ProfileController@create')->name('profile.tambah');
Route::post('admin/store-profile', 'ProfileController@store')->name('profile.store');
Route::get('admin/delete-profile/{id}/{status}', 'ProfileController@destroy')->name('profile.destroy');
Route::post('admin/edit-profile', 'ProfileController@update')->name('profile.update');
Route::get('admin/headline-profile/{id}', 'ProfileController@headline')->name('profile.headline');
Route::get('admin/publish-profile/{id}', 'ProfileController@show')->name('profile.show');
Route::get('admin/profile.edit/{id}', 'ProfileController@edit')->name('profile.edit');
Route::get('admin/profile.view/{id}', 'ProfileController@view')->name('profile.view');

//Menu article
Route::get('article.index', 'ArticleController@index')->name('article.index');
Route::get('datatables.article', ['as'=>'datatables.article', 'uses'=>'ArticleController@getDataForDataTable']);
Route::get('article.tambah', 'ArticleController@create')->name('article.tambah');
Route::post('admin/store-article', 'ArticleController@store')->name('article.store');
Route::get('admin/delete-article/{id}/{status}', 'ArticleController@destroy')->name('article.destroy');
Route::post('admin/edit-article', 'ArticleController@update')->name('article.update');
Route::get('admin/headline-article/{id}', 'ArticleController@headline')->name('article.headline');
Route::get('admin/publish-article/{id}', 'ArticleController@show')->name('article.show');
Route::get('admin/article.edit/{id}', 'ArticleController@edit')->name('article.edit');
Route::get('admin/article.view/{id}', 'ArticleController@view')->name('article.view');

//Menu event
Route::get('events.index', 'EventsController@index')->name('events.index');
Route::get('datatables.events', ['as'=>'datatables.events', 'uses'=>'EventsController@getDataForDataTable']);
Route::get('events.tambah', 'EventsController@create')->name('events.tambah');
Route::post('admin/store-events', 'EventsController@store')->name('events.store');
Route::get('admin/delete-events/{id}/{status}', 'EventsController@destroy')->name('events.destroy');
Route::post('admin/edit-events', 'EventsController@update')->name('events.update');
Route::get('admin/headline-events/{id}', 'EventsController@headline')->name('events.headline');
Route::get('admin/publish-events/{id}', 'EventsController@show')->name('events.show');
Route::get('admin/events.edit/{id}', 'EventsController@edit')->name('events.edit');
Route::get('admin/events.view/{id}', 'EventsController@view')->name('events.view');

//Menu Role
Route::get('role.index', 'RoleController@index')->name('role.index');
Route::post('admin/store-role', 'RoleController@store')->name('role.store');
Route::get('admin/delete-role/{id}/{status}', 'RoleController@destroy')->name('role.destroy');
Route::post('admin/edit-role', 'RoleController@update')->name('role.update');
Route::get('admin/bind-role/{id}', 'RoleController@edit')->name('role.edit');

//Menu Menu
Route::get('menu.index', 'MenuController@index')->name('menu.index');
Route::post('admin/store-menu', 'MenuController@store')->name('menu.store');
Route::get('admin/delete-menu/{id}/{status}', 'MenuController@destroy')->name('menu.destroy');
Route::post('admin/edit-menu', 'MenuController@update')->name('menu.update');
Route::get('admin/bind-menu/{id}', 'MenuController@edit')->name('menu.edit');
Route::get('admin/get-menu-child/{id}', 'MenuController@getMenuChild')->name('get-menu-child');
Route::get('admin/get-role-checked/{id}', 'MenuController@getRoleChecked')->name('get-role-checked');

//Menu User
Route::get('user.index', 'UserController@index')->name('user.index');
Route::post('admin/store-user', 'UserController@store')->name('user.store');
Route::get('admin/delete-user/{id}/{status}', 'UserController@destroy')->name('user.destroy');
Route::post('admin/edit-user', 'UserController@update')->name('user.update');
Route::get('admin/bind-user/{id}', 'UserController@edit')->name('user.edit');
Route::post('admin/user.update.password', 'UserController@updPassword')->name('user.update.password');
Route::get('admin/user.search', 'UserController@search')->name('user.search');

//profile
Route::get('user.profile', 'UserController@profile')->name('user.profile');
Route::post('admin/user.profile.password', 'UserController@updatepasswordByUser')->name('user.profile.password');

//Menu Comment
Route::get('comment.index', 'CommentController@index')->name('comment.index');
Route::get('admin/publish-comment/{id}', 'CommentController@show')->name('comment.show');
Route::get('admin/bind-comment/{id}', 'CommentController@edit')->name('comment.edit');
Route::post('admin/storeTanggapan', 'CommentController@storeTanggapan')->name('comment.storeTanggapan');

//Menu Comment
Route::get('contact.index', 'CommentController@indexContact')->name('contact.index');
Route::get('admin/publish-contact/{id}', 'CommentController@showContact')->name('contact.show');

//Menu Registrasi Events
Route::get('registrasi.index', 'RegistrasiController@index')->name('registrasi.index');
Route::get('admin/delete-registrasi/{id}/{status}', 'RegistrasiController@destroy')->name('registrasi.destroy');
Route::post('admin/edit-registrasi', 'RegistrasiController@update')->name('registrasi.update');
Route::get('admin/registrasi.edit/{id}', 'RegistrasiController@edit')->name('registrasi.edit');
Route::get('admin/approve-registrasi/{id}', 'RegistrasiController@approve')->name('registrasi.approve');
// =================================== END BACK END ====================================================================




// =================================== START FRONT END ====================================================================
Route::get('/', 'FeHomeController@index')->name('home');
Route::post('home.store', 'FeHomeController@storeContact')->name('home.store');
Route::get('about.us/{id}', 'FeAboutController@index')->name('about.us');

Route::get('article/{id}', 'FeArticleController@index')->name('article');
Route::get('articleById/{id}/{idKategori}', 'FeArticleController@indexById')->name('articleById');
Route::post('articleById.store', 'CommentController@store')->name('articleById.store');

Route::get('events/{id}', 'FeEventsController@index')->name('events');
Route::get('eventsById/{id}/{idKategori}', 'FeEventsController@indexById')->name('eventsById');
Route::get('events.pendaftaran/{id}', 'FeEventsController@indexPendaftaran')->name('events.pendaftaran');
Route::post('registrasi.events.store', 'FeEventsController@storePendaftaran')->name('registrasi.events.store');
Route::get('download.file.registrasi', 'FeEventsController@getDownload')->name('download.file.registrasi');
Route::post('registrasi.events.storeByUpload', 'FeEventsController@storePendaftaranByUpload')->name('registrasi.events.storeByUpload');
Route::get('events.today', 'FeEventsController@eventToday')->name('events.today');

Route::get('contact', 'FeContactController@index')->name('contact');
Route::post('contact.store', 'CommentController@storeContact')->name('contact.store');

// Route::get('galeri.video/{id}', 'FeGaleriController@index')->name('galeri.video');
Route::get('video', 'FeGaleriController@showVideo')->name('galeri.video');
Route::get('photo', 'FeGaleriController@showPhoto')->name('galeri.photo');
// Route::get('video', 'FeGaleriController@indexVideo')->name('video');


Route::get('partners', 'FePartnersController@showPartners')->name('partners');

// =================================== END FRONT END ====================================================================

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['isAdmin']], function () {
    Route::get('/edit','ProfileController@edit')->name('profile.edit');
    Route::post('/change-password','ProfileController@changePassword')->name('profile.changePassword');
    Route::post('/change-name','ProfileController@changeName')->name('profile.changeName');
    Route::post('/change-email','ProfileController@changeEmail')->name('profile.changeEmail');
    Route::post('/change-photo','ProfileController@changePhoto')->name('profile.changePhoto');
    Route::post('/change-ads','ProfileController@changeAds')->name('profile.changeAds');
    Route::get('/sample', 'HomeController@sample')->name('sample');
    Route::resource('/author','AuthorController');
    Route::get('/author/ban/{id}', 'AuthorController@ban')->name('author.ban');
    Route::resource('/group','GroupController');
    Route::get('/admin-home','HomeController@admin')->name('admin.home');

    Route::get('/admin/reader','AdminController@reader')->name('admin.rindex');
    Route::get('/admin/reader/{reader}/redit','AdminController@redit')->name('admin.redit');
    Route::put('/admin/reader/{reader}','AdminController@rupdate')->name('admin.rupdate');
    Route::get('/admin/reader/{reader}','AdminController@rshow')->name('admin.rshow');
    Route::get('/admin/reader/{reader}/books','AdminController@rbook')->name('admin.rbook');

    Route::put('/book/{book}','AdminController@bupdate')->name('admin.bupdate');
    Route::get('/book/{book}/edit','AdminController@bedit')->name('admin.bedit');
    Route::get('/admin/book/{id}','AdminController@bshow')->name('admin.bshow');

    Route::get('/admin/chapter/{id}','AdminController@chindex')->name('admin.chindex');
    Route::get('/admin/see-chapter/{chapter}','AdminController@chshow')->name('admin.chshow');
    Route::delete('/admin/chapter/{chapter}','AdminController@chdestroy')->name('admin.chdestroy');

    Route::delete('/admin/category/{category}','AdminController@cdestroy')->name('admin.cdestroy');
    Route::get('/admin/category/{category}/cedit','AdminController@cedit')->name('admin.cedit');
    Route::put('/admin/category/{category}','AdminController@cupdate')->name('admin.cupdate');

    Route::get('/admin/payment','AdminController@pmindex')->name('admin.pmindex');
    Route::get('/admin/see-payment/{payment}','AdminController@pmshow')->name('admin.pmshow');
    Route::delete('/admin/payment/{payment}','AdminController@pmdestroy')->name('admin.pmdestroy');

    Route::get('/book-list','AdminController@bookList')->name('admin.bookList');
    Route::get('/popular-book', 'AdminController@popularBook');
    Route::get('/book-status', 'AdminController@bookStatus');
});

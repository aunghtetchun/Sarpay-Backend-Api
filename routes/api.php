<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => ['isReader','auth:api']], function() {
    Route::get('home', 'ApiController@home');
    Route::get('getuser', 'ApiController@getUser');
    Route::post('/book/{id}', 'ApiController@bookList');
    Route::post('/book-detail/{id}', 'ApiController@getBookDetail');
    Route::post('/read-book/{id}', 'ApiController@getChapter');
    Route::post('/add-payment','ApiController@addPayment');
     Route::post('/book-list/{id}','ApiController@getCategoryList');
    Route::post('/view','ApiController@readBook');
    Route::get('/buy','ApiController@buyBook');

    Route::get('/welcome','ApiController@forShowBooks');
    Route::get('/bought-books','ApiController@boughtBooks');
    Route::get('/popular-books','ApiController@popularBooks');
    Route::get('/ads','ApiController@getAds');
    Route::post('/search','ApiController@searchBooks');
});


Route::post('/login/reader', 'ReaderController@login');
Route::post('/register/reader', 'ReaderController@register');

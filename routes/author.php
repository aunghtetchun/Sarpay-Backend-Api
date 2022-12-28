<?php

    Route::get('/author-home', 'HomeController@author')->name('author.home');
    Route::post('/book','BookController@store')->name('book.store');
    Route::get('/book/create','BookController@create')->name('book.create');
    Route::get('/book','BookController@index')->name('book.index');


    Route::get('/category/create/{id}','CategoryController@create')->name('category.create');
    Route::get('/book-insert/{id}','CategoryController@category')->name('book-insert');
    Route::post('/category','CategoryController@store')->name('category.store');
    Route::get('/category/{id}/edit','CategoryController@edit')->name('category.edit');
    Route::put('/category/{id}','CategoryController@update')->name('category.update');
    Route::put('/category/{id}/done','CategoryController@done')->name('category.done');


    Route::get('/chapter-insert/{id}','ChapterController@chapter')->name('chapter-insert');
    Route::get('/chapter/create/{id}','ChapterController@create')->name('chapter.create');
    Route::post('/chapter','ChapterController@store')->name('chapter.store');
    Route::get('/chapter/{id}','ChapterController@show')->name('chapter.show');
    Route::put('/chapter/{id}','ChapterController@update')->name('chapter.update');
    Route::delete('/chapter/{id}','ChapterController@delete')->name('chapter.destroy');

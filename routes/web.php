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

Route::get('/', 'PagesController@index')->name('index');

Route::get('/books', 'BooksController@index')->name('books.index');
Route::get('/books/single-book', 'BooksController@show')->name('books.show');




Route::group(['prefix' =>'admin'], function(){
Route::get('/', 'Backend\PagesController@index')->name('admin.index');

Route::group(['prefix' =>'books'], function(){
Route::get('/', 'Backend\BooksController@index')->name('admin.books.index');
Route::get('/{id}', 'Backend\BooksController@show')->name('admin.books.show');

});

Route::group(['prefix' =>'authors'], function(){
Route::get('/', 'Backend\AuthorsController@index')->name('admin.authors.index');
Route::get('/store', 'Backend\AuthorsController@store')->name('admin.authors.store');
Route::get('/{id}', 'Backend\AuthorsController@show')->name('admin.authors.show');
Route::get('/update/{id}', 'Backend\AuthorsController@update')->name('admin.authors.update');
Route::get('/delete/{id}', 'Backend\AuthorsController@destroy')->name('admin.authors.delete');


});

Route::group(['prefix' =>'categories'], function(){
Route::get('/', 'Backend\CategoriesController@index')->name('admin.categories.index');
Route::get('/store', 'Backend\CategoriesController@store')->name('admin.categories.store');
Route::get('/{id}', 'Backend\CategoriesController@show')->name('admin.categories.show');
Route::get('/update/{id}', 'Backend\CategoriesController@update')->name('admin.categories.update');
Route::get('/delete/{id}', 'Backend\CategoriesController@destroy')->name('admin.categories.delete');


});

Route::group(['prefix' =>'publishers'], function(){
Route::get('/', 'Backend\PublishersController@index')->name('admin.publishers.index');
Route::get('/store', 'Backend\PublishersController@store')->name('admin.publishers.store');
Route::get('/{id}', 'Backend\PublishersController@show')->name('admin.publishers.show');
Route::get('/update/{id}', 'Backend\PublishersController@update')->name('admin.publishers.update');
Route::get('/delete/{id}', 'Backend\PublishersController@destroy')->name('admin.publishers.delete');


});


});
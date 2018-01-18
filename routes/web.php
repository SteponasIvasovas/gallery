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
    return view('/');
});

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/user/{user}/gallery', 'UserController@gallery')->name('user.gallery');
Route::get('/user/{user}', 'UserController@profile')->name('user.profile');
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/searchAdvanced', 'SearchController@searchAdvanced')->name('searchAdvanced');
Route::get('/category/{category}', 'SearchController@filterCategory')->name('filterCategory');
Route::resource('/gallery-entry', 'GalleryEntryController');

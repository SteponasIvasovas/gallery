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
//HomeController
Route::get('/', 'HomeController@index')->name('home');
//UserController
Route::get('/user/{user}/gallery', 'UserController@gallery')->name('user.gallery');
Route::get('/user/{user}/favorites', 'UserController@favorites')->name('user.favorites');
Route::get('/user/{user}', 'UserController@profile')->name('user.profile');
Route::post('/user/update', 'UserController@update')->name('user.update');
Route::post('/user/avatarUpdate', 'UserController@avatarUpdate')->name('user.avatarUpdate');
//SearchController
Route::get('/search', 'SearchController@search')->name('search');
Route::get('/searchAdvanced', 'SearchController@searchAdvanced')->name('searchAdvanced');
Route::get('/searchTag/{tag}', 'SearchController@searchTag')->name('searchTag');
Route::get('/category/{category}', 'SearchController@filterCategory')->name('filterCategory');
//CommentController
Route::post('/comment/update', 'CommentController@update')->name('comment.update');
Route::post('/comment/delete', 'CommentController@delete')->name('comment.delete');
Route::post('/comment/post', 'CommentController@post')->name('comment.post');
//FavoriteController
Route::post('/favorite/add', 'FavoriteController@add')->name('favorite.add');
Route::post('/favorite/remove', 'FavoriteController@remove')->name('favorite.remove');
//GalleryEntryController
Route::resource('/gallery-entry', 'GalleryEntryController');

//Stored image display
Route::get('{route}/{profile}/public/images/{user}/{filename}', function ($route, $profile, $user, $filename) {
  $path = storage_path('app/public/images/' . $user . '/' . $filename);
  if (!File::exists($path)) {
      abort(404);
  }
  $file = File::get($path);
  $type = File::mimeType($path);
  $response = Response::make($file, 200);
  $response->header("Content-Type", $type);
  return $response;
});
Route::get('public/images/{user}/{filename}', function ($user, $filename) {
  $path = storage_path('app/public/images/' . $user . '/' . $filename);
  if (!File::exists($path)) {
      abort(404);
  }
  $file = File::get($path);
  $type = File::mimeType($path);
  $response = Response::make($file, 200);
  $response->header("Content-Type", $type);
  return $response;
});
Route::get('{route}/public/images/{user}/{filename}', function ($route, $user, $filename) {
    $path = storage_path('app/public/images/' . $user . '/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

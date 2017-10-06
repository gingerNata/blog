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

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;


Route::get('/', 'PagesController@getIndex');

Route::get('about', 'PagesController@getAbout');




Route::get('post/{id}', 'PostsController@getPost')
  ->name('post')
  ->where('id', '[0-9]+');

Route::get('like/post/{id}', 'PostsController@likePost')->name('likePost');
Route::post('like/post/{id}', 'PostsController@likePost')->name('likePost');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function (){
  Route::get('post/{id}/edit', 'PostsController@editPost')->name('editPost')->where('id', '[0-9]+');
  Route::patch('post/{id}/update', 'PostsController@update')->name('updatePost');
  Route::match(['delete', 'get'], 'post/{id}/delete', 'PostsController@delete')->name('deletePost');
  Route::get('add/post', 'PostsController@getPostForm')->name('postForm');
  Route::post('post/save', 'PostsController@store')->name('storePost');
});

Route::get('profile', 'Profiles\UserController@profile')->name('profile');
Route::patch('profile', 'Profiles\UserController@updateAvatar')->name('updateAvatar');
Route::post('profile', 'Profiles\UserController@delete')->name('deleteProfile');
Route::get('profile/edit', 'Profiles\UserController@editProfile')->name('editProfile');
Route::post('profile/edit', 'Profiles\UserController@updateData')->name('updateData');

Route::get('profile/{pid}', 'Profiles\UserController@authorPage')->name('authorPage');
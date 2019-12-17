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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Posts
Route::redirect('posts', '/');
Route::get('/', 'PostController@index')->name('posts');
Route::get('post/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::post('posts', 'PostController@store')->name('posts.store')->middleware('auth');
Route::get('post/{id}', 'PostController@show')->name('posts.show');

// Tags
Route::get('api/tags', 'TagController@index')->name('tags.api');
Route::get('tag/{id}/posts', 'TagController@posts')->name('tag.posts');
Route::redirect('tag/{id}', 'tag/{id}/posts');
//Route::redirect('tags', 'api/tags');

// Users Profiles
Route::get('user/{id}', 'ProfileController@show')->name('profiles.show');

// Route::get('/home/{name?}', function ($name = null) {
//     return "This is $name's /home page";
// });

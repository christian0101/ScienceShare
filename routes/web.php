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
Route::delete('post/{post}/delete', 'PostController@destroy')->name('posts.destroy');
Route::get('post/{post}', 'PostController@show')->name('posts.show');

// Tags
Route::get('tag/{tag}/posts', 'TagController@posts')->name('tag.posts');
Route::redirect('tag/{tag}', 'tag/{tag}/posts');

// Users Profiles
Route::get('user/{user}', 'ProfileController@show')->name('profiles.show');

// Comments
Route::post('comments/new', 'CommentController@apiStore')->name('api.comments.create')->middleware('auth');
Route::delete('comments/{comment}', 'CommentController@apiDestroy')->name('api.comments.destroy');

// Route::get('/home/{name?}', function ($name = null) {
//     return "This is $name's /home page";
// });

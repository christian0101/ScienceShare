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
Route::get('post/{post}', 'PostController@show')->name('posts.show');
Route::delete('post/{post}', 'PostController@destroy')->name('posts.destroy');

// Tags
Route::get('tag/{tag}/posts', 'TagController@posts')->name('tag.posts');
Route::redirect('tag/{tag}', 'tag/{tag}/posts');

// Users Profiles
Route::get('user/{user}', 'ProfileController@show')->name('profiles.show');

// Comments
Route::post('comments/new', 'CommentController@apiStore')->name('new.comments')->middleware('auth');
Route::delete('comments/{comment}', 'CommentController@destroy')->name('comments.destroy')->middleware('auth');

// Route::get('/home/{name?}', function ($name = null) {
//     return "This is $name's /home page";
// });

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

//Route::get('/home', 'HomeController@index')->name('home');

// Posts
Route::redirect('posts', '/');
Route::get('/', 'PostController@index')->name('posts');
Route::get('post/create', 'PostController@create')->name('posts.create')->middleware('auth');
Route::post('posts', 'PostController@store')->name('posts.store')->middleware('auth');
Route::delete('posts/{post}/delete', 'PostController@destroy')->name('posts.destroy');
Route::get('posts/{post}', 'PostController@show')->name('posts.show');
Route::put('posts/{post}/update', 'PostController@apiUpdate')->name('api.posts.update');

// Tags
Route::get('tags/{tag}/posts', 'TagController@posts')->name('tag.posts');
Route::redirect('tags/{tag}', 'tags/{tag}/posts');

// Users Profiles
Route::get('user/{user}', 'ProfileController@show')->name('profiles.show');
Route::put('profiles/{profile}/update', 'ProfileController@apiUpdate')->name('api.profiles.update');

// Comments
Route::post('comments/new', 'CommentController@apiStore')->name('api.comments.create')->middleware('auth');
Route::delete('comments/{comment}', 'CommentController@apiDestroy')->name('api.comments.destroy');
Route::put('comments/{comment}/update', 'CommentController@apiUpdate')->name('api.comments.update');

// Votes
Route::post('votes/{post}/new', 'VoteController@apiStore')->name('api.votes.new')->middleware('auth');
Route::put('votes/{post}/update', 'VoteController@apiUpdate')->name('api.votes.update');

Route::get('/tinymce_test', function () {
    return view('mceImageUpload::example');
});

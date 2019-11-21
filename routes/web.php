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
Route::get('/', 'PostController@index');
Route::get('/post/{id}', 'PostController@show')->name('posts.show');

// Tags
Route::redirect('/tag/{id}', '/tag/{id}/posts');
Route::get('/tag/{id}/posts', 'TagController@posts')->name('posts.index');

Route::redirect('/posts', '/');

// Route::get('/home/{name?}', function ($name = null) {
//     return "This is $name's /home page";
// });

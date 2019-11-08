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

Route::redirect('/', 'blog');

Route::get('/home', function () {
    return "This is the /home page";
});

// Posts
Route::get('/blog', 'PostController@index');
Route::get('/blog/post/{id}', 'PostController@show')->name('posts.show');

// Tags
Route::redirect('/blog/tag/{id}', '/blog/tag/{id}/posts');
Route::get('/blog/tag/{id}/posts', 'TagController@posts')->name('tags.posts');

Route::redirect('/posts', '/blog');

// Route::get('/home/{name?}', function ($name = null) {
//     return "This is $name's /home page";
// });

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
    return view('welcome');
});

Route::get('/home', function () {
    return "This is the /home page";
});

Route::get('blog', 'PostController@index');
Route::get('blog/post/{id}', 'PostController@show')->name('posts.show');

Route::get('/home/{name?}', function ($name = null) {
    return "This is $name's /home page";
});
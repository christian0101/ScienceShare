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

Route::get('/blog', function () {
    return "This is the /blog page";
});

Route::get('/home/{name?}', function ($name = null) {
    return "This is $name's /home page";
});

Route::get('/enclosures/{animal?}', function ($animal = null) {
    return view('enclosure', ['animal' => $animal]);
});

Route::redirect('/here', '/home');


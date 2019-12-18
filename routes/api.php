<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Posts
Route::get('posts', 'PostController@apiIndex')->name('posts.api');

// Tags
Route::get('tags', 'TagController@apiIndex')->name('tags.api');

// Comments
Route::get('comments', 'CommentController@apiIndex')->name('comments.api');
Route::get('post/{post}/comments', 'CommentController@apiPostComments')->name('post.comments.api');

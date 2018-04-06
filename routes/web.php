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

Route::get('post.comment/block/', 'CommentController@block');

Route::resource('post', 'PostController');
Route::resource('post.comment', 'CommentController');

Route::get('/get-post/', 'PostController@apiGetPost');
Route::post('/create-post/', 'PostController@apiCreatePost');
Route::post('/update-post/', 'PostController@apiUpdatePost');

Route::get('/dashboard', 'DashboardController@index');
Route::get('/dashboard/get-comments', 'DashboardController@commentsForPost');
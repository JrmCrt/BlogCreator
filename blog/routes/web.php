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
Route::get('/', 'IndexController@home');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/blog/new', 'BlogController@index');
Route::post('/blog/new', 'BlogController@newBlog');
Route::get('/{id}', 'BlogController@blog');
Route::get('/blog/share/{id}', 'BlogController@shareBlog');
Route::get('/blog/unfollow/{id}', 'BlogController@unfollowBlog');
Route::get('/blog/{id}/article/new', 'ArticleController@index');
Route::post('/blog/{id}/article/new', 'ArticleController@_new');
Route::get('/blog/{id}/comment/manage', 'BlogController@comment');
Route::get('/comment/remove/{id}', 'BlogController@removeComment');
Route::get('/blog/{id}/article/manage', 'BlogController@article');
Route::get('/article/remove/{id}', 'BlogController@removeArticle');
Route::get('/article/edit/{id}', 'ArticleController@editArticle');
Route::post('/article/edit/{id}', 'ArticleController@doEdit');

Route::get('/profile/{id}', 'UserController@profile');
Route::post('/profile/{id}', 'UserController@updateProfile');

Route::get('/message/list', 'MessageController@getMessages');
Route::get('/message/send/{id}', 'MessageController@send');
Route::post('/message/send/{id}', 'MessageController@doSend');
Route::get('/message/remove/{id}', 'MessageController@remove');

Route::get('/friend/list', 'FriendController@getFriends');
Route::get('/friend/add/{id}', 'FriendController@add');
Route::get('/friend/remove/{id}', 'FriendController@remove');

Route::get('/blog/{id_blog}/article/share/{id}', 'ArticleController@share');
Route::post('/article/comment/{id}', 'ArticleController@addComment');
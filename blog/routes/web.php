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

Route::get('/home', 'BlogController@wall');
Route::post('/home', 'BlogController@filterWall');
Route::get('/blog/new', 'BlogController@index');
Route::post('/blog/new', 'BlogController@newBlog');
Route::get('/blog/list', 'BlogController@_list');
Route::get('/{id}', 'BlogController@blog');
Route::post('/{id}', 'BlogController@filterBlog');
Route::get('/blog/share/{id}', 'BlogController@shareBlog');
Route::get('/blog/unfollow/{id}', 'BlogController@unfollowBlog');
Route::get('/blog/{id}/article/new', 'ArticleController@index');
Route::post('/blog/{id}/article/new', 'ArticleController@_new');
Route::get('/blog/{id}/comment/manage', 'BlogController@comment');
Route::get('/blog/{id}/manage', 'BlogController@manage');
Route::post('/blog/{id}/manage', 'BlogController@edit');
Route::get('/comment/remove/{id}', 'BlogController@removeComment');
Route::get('/blog/{id}/article/manage', 'BlogController@article');
Route::get('/article/remove/{id}', 'BlogController@removeArticle');
Route::get('/article/edit/{id}', 'ArticleController@editArticle');
Route::post('/article/edit/{id}', 'ArticleController@doEdit');
Route::get('/blog/{id_blog}/read/{id}', 'ArticleController@read');

Route::get('/profile/{id}', 'UserController@profile');
Route::post('/profile/{id}', 'UserController@updateProfile');

Route::get('/message/list', 'MessageController@getMessages');
Route::get('/message/send/{id}', 'MessageController@send');
Route::post('/message/send/{id}', 'MessageController@doSend');
Route::get('/message/remove/{id}', 'MessageController@remove');
Route::get('/message/remove/{id}/sent', 'MessageController@removeSent');
Route::get('/message/list/sent', 'MessageController@getMessagesSent');

Route::get('/friend/list', 'FriendController@getFriends');
Route::get('/friend/add/{id}', 'FriendController@add');
Route::get('/friend/remove/{id}', 'FriendController@remove');

Route::get('/blog/{id_blog}/article/share/{id}', 'ArticleController@share');
Route::post('/article/comment/{id}', 'ArticleController@addComment');

Route::get('/category/manage', 'CategoryController@index');
Route::get('/category/new', 'CategoryController@_new');
Route::post('/category/new', 'CategoryController@doNew');
Route::get('/category/remove/{id}', 'CategoryController@remove');
Route::get('/category/edit/{id}', 'CategoryController@edit');
Route::post('/category/edit/{id}', 'CategoryController@doEdit');

Route::get('/image/remove/{id}', 'ArticleController@removeImg');

Route::get('/notification/clear/', 'FriendController@clearNotifications');
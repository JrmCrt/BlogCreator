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

// Route::get('/', function () {
//     return view('index');
// });

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/blog/new', 'BlogController@index');
Route::post('/blog/new', 'BlogController@newBlog');
Route::get('/{id}', 'BlogController@blog');

Route::get('/profile/{id}', 'UserController@profile');
Route::post('/profile/{id}', 'UserController@updateProfile');

Route::get('/message/list', 'MessageController@getMessages');
Route::get('/message/send/{id}', 'MessageController@send');
Route::post('/message/send/{id}', 'MessageController@doSend');
Route::get('/message/remove/{id}', 'MessageController@remove');

Route::get('/friend/list', 'FriendController@getFriends');
Route::get('/friend/add/{id}', 'FriendController@add');
Route::get('/friend/remove/{id}', 'FriendController@remove');
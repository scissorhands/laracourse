<?php

use Illuminate\Routing\RouteRegistrar;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function(){ return view('welcome'); })->name('welcome');
Route::get('/secret', 'HomeController@secret')
	->name('secret')
	->middleware('can:home.secret');
Route::get('/home', function(){ return view('home'); })->name('home');
Route::resource('posts', 'PostController');
Route::get('/posts/tag/{tag}', 'PostTagController@index')->name('posts.tags.index');

Route::resource('posts.comments', 'PostCommentController')->only(['store']);
Route::resource('users', 'UserController')->only(['show', 'edit', 'update']);

Auth::routes();


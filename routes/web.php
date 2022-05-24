<?php

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



Route::get('/users', function() {
    return 'hello';
});

Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', 'UserController@create')->name('register.create');
    Route::post('/register', 'UserController@store')->name('register.store');
    Route::get('/login', 'UserController@loginForm')->name('login.create');
    Route::post('/login', 'UserController@login')->name('login');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/home', 'MainController@users')->name('home');
    Route::get('/logout', 'UserController@logout')->name('logout')->middleware('auth');
    Route::get('/user/{id}', 'UserController@view')->name('user.view');
    Route::get('/profile', 'UserController@index')->name('user.index');
    Route::get('/edit', 'UserController@edit')->name('user.edit');
    Route::put('/edit', 'UserController@update')->name('user.update');
});

Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function() {
    Route::resource('/users', 'UserController');
    Route::put('/users/{user}/raise', 'UserController@raise')->name('users.raise');
    Route::put('/users/{user}/reduce', 'UserController@reduce')->name('users.reduce');
});

Route::get('/', 'MainController@index')->name('home');
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin'], function () {

    // nantinya ini menjadi home ketika login
    Route::get('/', 'DashboardController@index')->name('admin.dashboard');
    
    Route::resource('users', 'UserController', ['except' => ['show', 'edit']]);
    
    Route::get('/items', 'ItemController@index')->name('items.index');
    Route::post('/items', 'ItemController@index')->name('items.post');
    // Route::resource('items', 'ItemController');
});



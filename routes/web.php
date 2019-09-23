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
    
    Route::resource('users', 'UserController', ['except' => ['show', 'edit', 'create']]);
    
    // Kategori
    
    Route::post('item/category/create', 'ItemController@storeCategory')->name('category.store');
    Route::put('item/category/edit/{id}', 'ItemController@updateCategory')->name('category.update');
    Route::delete('item/category/delete/{id}', 'ItemController@deleteCategory')->name('category.delete');
    
    Route::get('ajax/categories/search', 'ItemController@ajaxSearch');
    
    Route::resource('item', 'ItemController', ['except' => ['show', 'edit', 'create']]);
});



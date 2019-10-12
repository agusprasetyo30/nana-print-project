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
    
    // Paper/kertas
    Route::get('item/paper', 'ItemController@indexPaper')->name('paper.index');
    Route::post('item/paper/create', 'ItemController@storePaper')->name('paper.store');
    Route::put('item/paper/edit/{id}', 'ItemController@updatePaper')->name('paper.update');
    Route::delete('item/paper/delete/{id}', 'ItemController@deletePaper')->name('paper.delete');

    // Tambah Stock
    Route::put('item/stock/{id}', 'ItemController@updateStock')->name('stock.update');
    // Untuk data select2 yang isinya data-data kategori
    Route::get('ajax/categories/search', 'ItemController@ajaxSearch');

    Route::resource('item', 'ItemController', ['except' => ['show', 'edit', 'create']]);

    // Transaksi ATK
    Route::get('order-atk', 'TransaksiAtkController@index')->name('order-atk.index');
    Route::put('order-atk/edit/{id}', 'TransaksiAtkController@updateStatus')->name('order-atk.update-status');

    // Transaksi Print
    Route::get('order-print', 'TransaksiPrintController@index')->name('order-print.index');
    Route::get('order-print/{id}/download', 'TransaksiPrintController@downloadFile')->name('order-print.download');


    // Laporan Keuangan
    Route::get('money-report', 'LaporanKeuanganController@index')->name('money-report.index');

});



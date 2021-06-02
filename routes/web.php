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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('standard_user')->group(function () { // url example: "/standard_user/produk"
    
    Route::get('menu', 'StandardUserController@menu');

    Route::get('/menu/produk', 'ProdukController@produk'); 
    Route::post('/menu/produk/store','ProdukController@store');
    Route::get('/menu/produk/{id}/edit','ProdukController@edit');
    Route::post('/menu/produk/{id}/update','ProdukController@update');
    Route::get('/menu/produk/{id}/delete_confirmation','ProdukController@delete_confirmation');
    Route::get('/menu/produk/{id}/destroy','ProdukController@destroy');
    
    Route::get('/menu/transaksi', 'TransaksiController@transaksi');
    Route::post('/menu/transaksi/store_transaksi','TransaksiController@store_transaksi'); 
    Route::get('/menu/transaksi/{id}/destroy_rincian','TransaksiController@destroy_rincian');
    Route::post('/menu/transaksi/buat_transaksi_baru','TransaksiController@buat_transaksi_baru');
    Route::post('/menu/transaksi/cetak_transaksi','TransaksiController@cetak_transaksi');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

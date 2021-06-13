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

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

//redirect to login page if not logged in
Route::group(['middleware' => ['auth']], function() {

    Route::prefix('standard_user/menu')->group(function () { 
        return view('home');
    });

    Route::prefix('standard_user/menu/produk')->group(function () { // url example: "/standard_user/produk"
        Route::get('', 'ProdukController@produk'); 
        Route::post('/store','ProdukController@store');
        Route::get('/{id}/edit','ProdukController@edit');
        Route::post('/{id}/update','ProdukController@update');
        Route::get('/{id}/delete_confirmation','ProdukController@delete_confirmation');
        Route::get('/{id}/destroy','ProdukController@destroy');
        Route::get('search_produk','ProdukController@search_produk');
    });

    Route::prefix('standard_user/menu/transaksi')->group(function () { 
        Route::get('', 'TransaksiController@transaksi');
        Route::post('/store_transaksi','TransaksiController@store_transaksi'); 
        Route::get('/{id}/destroy_rincian','TransaksiController@destroy_rincian');
        Route::post('/buat_transaksi_baru','TransaksiController@buat_transaksi_baru');
        Route::post('/cetak_transaksi','TransaksiController@cetak_transaksi');
    });

    Route::prefix('standard_user/menu/pengeluaran')->group(function () {
        Route::get('', 'PengeluaranController@pengeluaran'); 
        Route::post('/store','PengeluaranController@store');
        Route::get('/{id}/edit','PengeluaranController@edit');
        Route::post('/{id}/update','PengeluaranController@update');
        Route::get('/{id}/delete_confirmation','PengeluaranController@delete_confirmation');
        Route::get('/{id}/destroy','PengeluaranController@destroy');
    });

    Route::prefix('standard_user/menu/laporan/pengeluaran/pengeluaran_harian')->group(function () {
        Route::get('','PengeluaranHarianController@pengeluaran_harian');
        Route::get('/filter','PengeluaranHarianController@filter');
    });

    Route::prefix('standard_user/menu/laporan/pengeluaran/pengeluaran_bulanan')->group(function () {
        Route::get('','PengeluaranBulananController@pengeluaran_bulanan');
        Route::get('/filter','PengeluaranBulananController@filter');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

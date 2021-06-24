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

    //INPUT MENU
    Route::prefix('standard_user/menu/produk')->group(function () { // url example: "/standard_user/produk"
        $controller = 'ProdukController';

        Route::get('', $controller.'@produk'); 
        Route::post('/store', $controller.'@store');
        Route::get('/{id}/edit', $controller.'@edit');
        Route::post('/{id}/update', $controller.'@update');
        Route::get('/{id}/delete_confirmation', $controller.'@delete_confirmation');
        Route::get('/{id}/destroy', $controller.'@destroy');
        Route::get('search_produk', $controller.'@search_produk');
    });


    //PEMBAYARAN
    Route::prefix('standard_user/menu/transaksi')->group(function () { 
        $controller = 'TransaksiController';

        Route::get('', $controller.'@transaksi');
        Route::post('/store_transaksi', $controller.'@store_transaksi'); 
        Route::get('/{id}/destroy_rincian', $controller.'@destroy_rincian');
        Route::post('/buat_transaksi_baru', $controller.'@buat_transaksi_baru');
        Route::post('/cetak_transaksi', $controller.'@cetak_transaksi');
    });

    //EDIT, DELETE TRANSAKSI
    Route::prefix('standard_user/menu/transaksi/edit_delete_transaksi')->group(function () { 
        $controller = 'EditDeleteTransaksiController';

        Route::get('', '@edit_delete_transaksi');
        Route::get('/{id}/edit', $controller.'@edit');
        Route::post('/{id}/update', $controller.'@update');
        Route::get('/{id}/destroy_transaksi', $controller.'@destroy_transaksi');
        Route::get('/{id}/edit_rincian', $controller.'@edit_rincian');
        Route::get('/{id}/edit_nominal', $controller.'@edit_nominal');
        Route::post('/{id}/update_nominal', $controller.'@update_nominal');

        //DestroyRincianController
        Route::get('edit_rincian/{id}/destroy_rincian','DestroyRincianController@destroy_rincian');
    });

    //INPUT PENGELUARAN
    Route::prefix('standard_user/menu/pengeluaran')->group(function () {
        $controller = 'PengeluaranController';

        Route::get('', $controller.'@pengeluaran'); 
        Route::post('/store', $controller.'@store');
        Route::get('/{id}/edit', $controller.'@edit');
        Route::post('/{id}/update', $controller.'@update');
        Route::get('/{id}/delete_confirmation', $controller.'@delete_confirmation');
        Route::get('/{id}/destroy', $controller.'@destroy');
        Route::get('search_pengeluaran', $controller.'@search_pengeluaran');
    });

    //INPUT PENDAPATAN
    Route::prefix('standard_user/menu/pendapatan')->group(function () {
        $controller = 'PendapatanController';

        Route::get('', $controller.'@pendapatan'); 
        Route::post('/store', $controller.'@store');
        Route::get('/{id}/edit', $controller.'@edit');
        Route::post('/{id}/update', $controller.'@update');
        Route::get('/{id}/delete_confirmation', $controller.'@delete_confirmation');
        Route::get('/{id}/destroy', $controller.'@destroy');
        Route::get('search_pendapatan', $controller.'@search_pendapatan');
    });
    
//=================LAPORAN=========================
    //LAPORAN PENGELUARAN
    Route::prefix('standard_user/menu/laporan/pengeluaran/pengeluaran_harian')->group(function () {
        Route::get('','PengeluaranHarianController@pengeluaran_harian');
        Route::get('/search_tanggal','PengeluaranHarianController@search_tanggal');
    });

    Route::prefix('standard_user/menu/laporan/pengeluaran/pengeluaran_bulanan')->group(function () {
        Route::get('','PengeluaranBulananController@pengeluaran_bulanan');
        Route::get('/filter','PengeluaranBulananController@filter');
    });

    //LAPORAN PENDAPATAN
    Route::prefix('standard_user/menu/laporan/pendapatan/pendapatan_harian')->group(function () {
        Route::get('','PendapatanHarianController@pendapatan_harian');
        Route::get('/search_tanggal','PendapatanHarianController@search_tanggal');
    });

    //LAPORAN PENDAPATAN BERSIH
    Route::prefix('standard_user/menu/laporan/pendapatan/pendapatan_bersih_harian')->group(function () {
        Route::get('','PendapatanBersihHarianController@pendapatan_bersih_harian');
        Route::get('/search_tanggal','PendapatanBersihHarianController@search_tanggal');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

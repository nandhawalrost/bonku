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
    Route::get('produk', 'StandardUserController@produk'); 
    
    Route::get('transaksi', 'StandardUserController@transaksi'); 
});

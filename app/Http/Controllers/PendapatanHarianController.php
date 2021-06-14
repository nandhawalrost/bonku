<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PendapatanHarianController extends Controller
{
    public function pendapatan_harian()
    {
        $user_email = Auth::user()->email;

        //select berdasarkan method today()
        $data_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->paginate(10);

        //sum total harga table transaksi
        $data_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->sum('total_harga');

        //hitung jumlah row
        $data_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->count();

        //total pendapatan terendah hari ini
        $data_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->min('total_harga');

        //total pendapatan tertinggi hari ini
        $data_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->max('total_harga');

        dd($data_pendapatan_hari_ini);
        return view('menu.laporan.pendapatan.index', 
        compact('data_pendapatan_hari_ini'
        ));
    }

    public function search_tanggal()
    {
        $user_email = Auth::user()->email;

        $tanggal = '2021-06-07';

        //cari pendapatan berdasarkan tanggal
        $data_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->paginate(10);

        //sum total harga table transaksi
        $data_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->sum('total_harga');

        //hitung jumlah row
        $data_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->count();

        //total pendapatan terendah tanggal ini
        $data_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->min('total_harga');

        //total pendapatan tertinggi tanggal ini
        $data_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) //karena pendapatan berdasarkan kapan terakhir diupdate, bukan dibuat
        ->max('total_harga');

        dd($data_pendapatan_tanggal_ini);
    }
}

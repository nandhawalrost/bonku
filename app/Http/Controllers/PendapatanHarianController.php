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
        $sum_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->sum('total_harga');

        //hitung jumlah row
        $frekuensi_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->count();

        //total pendapatan terendah hari ini
        $min_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->min('total_harga');

        //total pendapatan tertinggi hari ini
        $max_pendapatan_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->max('total_harga');

        //rata-rata pengeluaran
        //if rata-rata = 0 tidak dihitung, else dihitung
        if($sum_pendapatan_hari_ini == 0 | $frekuensi_pendapatan_hari_ini == 0)
        {
            $rata_pendapatan_hari_ini = 0;
        }elseif(!$sum_pendapatan_hari_ini == 0 | !$frekuensi_pendapatan_hari_ini ==0)
        {
            $rata_pendapatan_hari_ini = $sum_pendapatan_hari_ini/$frekuensi_pendapatan_hari_ini;
        }

        return view('menu.laporan.pendapatan.index', 
        compact('data_pendapatan_hari_ini',
        'sum_pendapatan_hari_ini',
        'frekuensi_pendapatan_hari_ini',
        'min_pendapatan_hari_ini',
        'max_pendapatan_hari_ini',
        'rata_pendapatan_hari_ini'
        ));
    }

    public function search_tanggal(Request $request)
    {
        $user_email = Auth::user()->email;

        $tanggal = $request->get('tanggal');

        //cari pendapatan berdasarkan tanggal
        $data_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) 
        ->paginate(10);

        //sum total harga table transaksi
        $sum_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) 
        ->sum('total_harga');

        //hitung jumlah row
        $frekuensi_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) 
        ->count();

        //total pendapatan terendah tanggal ini
        $min_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) 
        ->min('total_harga');

        //total pendapatan tertinggi tanggal ini
        $max_pendapatan_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', date($tanggal)) 
        ->max('total_harga');

        //rata-rata pengeluaran
        //if rata-rata = 0 tidak dihitung, else dihitung
        if($sum_pendapatan_tanggal_ini == 0 | $frekuensi_pendapatan_tanggal_ini == 0)
        {
            $rata_pendapatan_tanggal_ini = 0;
        }elseif(!$sum_pendapatan_tanggal_ini == 0 | !$frekuensi_pendapatan_tanggal_ini ==0)
        {
            $rata_pendapatan_tanggal_ini = $sum_pendapatan_tanggal_ini/$frekuensi_pendapatan_tanggal_ini;
        }

        return view('menu.laporan.pendapatan.search_tanggal', 
        compact('data_pendapatan_tanggal_ini',
        'sum_pendapatan_tanggal_ini',
        'frekuensi_pendapatan_tanggal_ini',
        'min_pendapatan_tanggal_ini',
        'max_pendapatan_tanggal_ini',
        'rata_pendapatan_tanggal_ini'
        ));
    }
}

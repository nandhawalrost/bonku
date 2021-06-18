<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PendapatanBersihHarianController extends Controller
{
    public function pendapatan_bersih_harian()
    {
        $user_email = Auth::user()->email;

        //sum total harga table transaksi hari ini
        $sum_transaksi_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=',$user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->sum('total_harga');

        //sum total pendapatan hari ini
        $sum_pendapatan_hari_ini = DB::table('pendapatan')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->sum('total');

        //sum total pengeluaran
        $sum_pengeluaran_hari_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->sum('total');
        
        $pendapatan_bersih_hari_ini = ($sum_transaksi_hari_ini+$sum_pendapatan_hari_ini)-$sum_pengeluaran_hari_ini;
        
        return view('menu.laporan.pendapatan_bersih.index', 
        compact('sum_transaksi_hari_ini',
        'sum_pendapatan_hari_ini',
        'sum_pengeluaran_hari_ini',
        'pendapatan_bersih_hari_ini'
        ));
    }
}

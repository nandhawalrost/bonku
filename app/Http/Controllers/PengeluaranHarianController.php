<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PengeluaranHarianController extends Controller
{
    public function pengeluaran_harian()
    {
        $user_email = Auth::user()->email;

        //select berdasarkan method today()
        $data_pengeluaran_hari_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->paginate(10);

        //sum total pengeluaran
        $sum_pengeluaran_hari_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->sum('total');

        //frekuensi
        $frekuensi_pengeluaran_hari_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->count();

        //pengeluaran dengan total terendah
        $min_pengeluaran_hari_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->min('total');

        //pengeluaran dengan total tertinggi
        $max_pengeluaran_hari_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', Carbon::today())
        ->max('total');
        
        return view('menu.laporan.pengeluaran.index', 
        compact('data_pengeluaran_hari_ini',
        'sum_pengeluaran_hari_ini',
        'frekuensi_pengeluaran_hari_ini',
        'min_pengeluaran_hari_ini',
        'max_pengeluaran_hari_ini'
        ));
    }

    public function search_tanggal(Request $request)
    {
        $user_email = Auth::user()->email;

        $tanggal = $request->get('tanggal');

        $search_pengeluaran_tanggal_ini = DB::table('pengeluaran')
        ->where('user_email', $user_email)
        ->whereDate('created_at', '=', date($tanggal)) //date('2021-06-13'.'00:00:00') to add hour
        ->paginate(10);

        //sum pengeluaran
        $sum_pengeluaran_tanggal_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->sum('total');

        //frekuensi
        $frekuensi_pengeluaran_tanggal_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->count();

        //pengeluaran dengan total terendah
        $min_pengeluaran_tanggal_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->min('total');

        //pengeluaran dengan total tertinggi
        $max_pengeluaran_tanggal_ini = DB::table('pengeluaran')
        ->where('user_email','=',$user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->max('total');

        $search_pengeluaran_tanggal_ini->appends($request->all());

        return view('menu.laporan.pengeluaran.search_tanggal', 
        compact('search_pengeluaran_tanggal_ini',
        'sum_pengeluaran_tanggal_ini',
        'frekuensi_pengeluaran_tanggal_ini',
        'min_pengeluaran_tanggal_ini',
        'max_pengeluaran_tanggal_ini'
        ));
    }
}

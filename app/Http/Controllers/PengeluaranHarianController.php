<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PengeluaranHarianController extends Controller
{
    public function pengeluaran_harian()
    {
        
    }

    public function filter()
    {
        $user_email = Auth::user()->email;

        $selected_tanggal = '2021-06-04';

        $datetime = DB::table('pengeluaran')
        ->where('user_email', $user_email)
        ->where('created_at', '>=', date('2021-06-12').' 00:00:00')
        ->pluck('created_at');

        dd($datetime);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class PengeluaranBulananController extends Controller
{
    public function pengeluaran_bulanan()
    {

    }

    public function filter()
    {
        $user_email = Auth::user()->email;

        $selected_tanggal = '2021-06-04';

        $datetime = DB::table('pengeluaran')
        ->where('user_email', $user_email)
        ->whereYear('created_at', '=', '2021')
        ->whereMonth('created_at', '>=', '06')
        ->pluck('created_at');

        dd($datetime);
    }
}

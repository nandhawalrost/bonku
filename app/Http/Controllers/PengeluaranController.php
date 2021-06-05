<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $data_pengeluaran = DB::table('pengeluaran')->orderByDesc('id')->get();
        
        return view('menu.pengeluaran.index', compact('data_pengeluaran'));
    }
}

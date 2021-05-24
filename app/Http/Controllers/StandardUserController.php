<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StandardUserController extends Controller
{
    
    public function index()
    {

    }

    public function menu()
    {
        return view('menu.index');
    }

    public function produk()
    {
        $data_produk = DB::table('produk')->get();

        return view('menu.produk.index', compact('data_produk'));
    }
}

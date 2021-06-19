<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class DestroyRincianController extends Controller
{
    public function destroy_rincian($id)
    {
        $user_email = Auth::user()->email;

        DB::table('rincian_transaksi')
        ->where('id', '=', $id)
        ->where('user_email','=',$user_email)
        ->delete();

        //redirect dengan id transaksi
        $id_transaksi = DB::table('rincian_transaksi')
        ->pluck('id_transaksi');

        return redirect('http://127.0.0.1:8000/standard_user/menu/transaksi/edit_delete_transaksi');
    }
}

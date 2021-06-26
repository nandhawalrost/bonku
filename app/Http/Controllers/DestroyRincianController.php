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

        //select id transaksi untuk redirect dengan id transaksi yang sedang didelete
        $id_transaksi = DB::table('rincian_transaksi')
        ->where('id','=',$id)
        ->value('id_transaksi');

        //delete berdasar id rincian
        DB::table('rincian_transaksi')
        ->where('id', '=', $id)
        ->where('user_email','=',$user_email)
        ->delete();

        return redirect('/standard_user/menu/transaksi/edit_delete_transaksi/'.$id_transaksi.'/edit_rincian');
    }
}

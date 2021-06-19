<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class EditDeleteTransaksiController extends Controller
{
    public function edit_delete_transaksi()
    {
        $user_email = Auth::user()->email;
        
        $data_transaksi = DB::table('transaksi')
        ->where('user_email', $user_email)
        ->paginate(10);
        
        return view('menu.transaksi.edit_delete_transaksi.index', compact('data_transaksi'));
    }

    public function destroy_transaksi($id)
    {
        $user_email = Auth::user()->email;

        DB::table('transaksi')
        ->where('id', '=', $id)
        ->where('user_email','=',$user_email)
        ->delete();
        
        DB::table('rincian_transaksi')
        ->where('id_transaksi', '=', $id)
        ->where('user_email','=',$user_email)
        ->delete();

        return redirect('/standard_user/menu/transaksi/edit_delete_transaksi')->with('delete_succeed','Deleted!');
    }

    public function edit_rincian($id)
    {
        $user_email = Auth::user()->email;
        
        //select * from rincian_transaksi
        $data_rincian = DB::table('rincian_transaksi')
        ->where('user_email','=',$user_email)
        ->where('id_transaksi','=',$id)
        ->paginate(10); //or find()

        return view('menu.transaksi.edit_delete_transaksi.edit_rincian',
        ['data_rincian' => $data_rincian,
        'id_transaksi' => $id
        ]);
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class EditDeleteTransaksiController extends Controller
{
    private $user_email;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_email = Auth::user()->email;

            return $next($request);
        });
    }

    public function edit_delete_transaksi()
    {
        $data_transaksi = DB::table('transaksi')
        ->where('user_email', $this->user_email)
        ->paginate(10);
        
        return view('menu.transaksi.edit_delete_transaksi.index', compact('data_transaksi'));
    }

    public function destroy_transaksi($id)
    {
        $user_email = Auth::user()->email;

        DB::table('transaksi')
        ->where('id', '=', $id)
        ->where('user_email','=', $this->user_email)
        ->delete();
        
        DB::table('rincian_transaksi')
        ->where('id_transaksi', '=', $id)
        ->where('user_email','=', $this->user_email)
        ->delete();

        return redirect('/standard_user/menu/transaksi/edit_delete_transaksi')->with('delete_succeed','Deleted!');
    }

    public function edit_rincian($id)
    {
        $user_email = Auth::user()->email;
        
        //select * from rincian_transaksi
        $data_rincian = DB::table('rincian_transaksi')
        ->where('user_email','=', $this->user_email)
        ->where('id_transaksi','=',$id)
        ->paginate(10); //or find()

        return view('menu.transaksi.edit_delete_transaksi.edit_rincian',
        ['data_rincian' => $data_rincian,
        'id_transaksi' => $id
        ]);
    }

    public function edit_nominal($id)
    {
        $user_email = Auth::user()->email;
        
        //select * from transaksi
        $data_transaksi = DB::table('transaksi')
        ->where('user_email','=', $this->user_email)
        ->where('id',$id)
        ->first();

        return view('menu.transaksi.edit_delete_transaksi.edit_nominal',
        ['transaksi' => $data_transaksi]);
    }

    public function update_nominal(Request $request, $id) //update (reduce balance)
    {
        $user_email = Auth::user()->email;

        $validatedData = $request->validate([
            'total_harga' => 'required|max:30',
            'total_bayar' => 'max:11',
            'total_kembali' => 'max:11'
        ]);

        //request as variable
        $total_harga = $request->total_harga;
        $total_bayar = $request->total_bayar;
        $total_kembali = $request->total_kembali;
        $jumlah_maksimum = $request->jumlah_maksimum;
        $harga = $request->harga;
        $satuan = $request->satuan;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        $update_need_order = DB::table('transaksi')
        ->where('id', $request->id)->update([
            'total_harga'=>$total_harga,
            'total_bayar'=>$total_bayar,
            'total_kembali'=>$total_kembali,
            'user_email'=>$this->user_email
        ]);

        return redirect('/standard_user/menu/transaksi/edit_delete_transaksi')->with('succeed','Sent!');
    }

}

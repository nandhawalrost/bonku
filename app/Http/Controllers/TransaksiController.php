<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $id_transaksi_terakhir = DB::table('transaksi')->orderByDesc('id')->first()->id;

        $data_transaksi = DB::table('transaksi')->get();

        $sum_sub_total_terakhir = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get()->sum('sub_total');


        return view('menu.transaksi.index', compact('data_transaksi','sum_sub_total_terakhir'));
    }

    public function store_transaksi(Request $request)
    {
        $nama_pelanggan = $request->nama_pelanggan;
        $keterangan = $request->keterangan;
        $total_harga = 900000;
        $total_bayar = 100000;
        $total_kembali = 10000;
        $user_email = 'none';

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        DB::table('transaksi')->insert([
            'nama_pelanggan'=>$nama_pelanggan,
            'keterangan'=>$keterangan,
            'total_harga'=>$total_harga,
            'total_bayar'=>$total_bayar,
            'total_kembali'=>$total_kembali,
            'user_email'=>$user_email,
            "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
        ]);

        return redirect('/standard_user/menu/transaksi')->with('succeed','Sent!');
    }

    public function store_rincian_transaksi()
    {
        $id_transaksi_terakhir = DB::table('transaksi')->orderByDesc('id')->first()->id;
        
        $nama_produk = $request->nama_produk;
        $harga = $request->harga;
        $jumlah = $request->jumlah;
        $sub_total = 123;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        DB::table('rincian_transaksi')->insert([
            'id_transaksi'=>$id_transaksi_terakhir,
            'nama_produk'=>$nama_produk,
            'harga'=>$harga,
            'jumlah'=>$jumlah,
            'sub_total'=>$sub_total,
            "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransaksiController extends Controller
{
    public function transaksi()
    {
        $id_transaksi_terakhir = DB::table('transaksi')->orderByDesc('id')->first()->id;
        $data_transaksi = DB::table('transaksi')->where('id','=',$id_transaksi_terakhir)->get();
        $data_rincian = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get();
        $nama_produk = DB::table('produk')->get();
        $sum_sub_total_terakhir = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get()->sum('sub_total');

        if($sum_sub_total_terakhir == 0)
        {
            $sum_sub_total_terakhir = null;

            return view('menu.transaksi.index', compact('data_transaksi','data_rincian','nama_produk','sum_sub_total_terakhir'));
        }else
        {
            return view('menu.transaksi.index', compact('data_transaksi','data_rincian','nama_produk','sum_sub_total_terakhir'));
        }

    }

    public function store_transaksi(Request $request)
    {
        $id_transaksi_terakhir = DB::table('transaksi')->orderByDesc('id')->first()->id;
        $sum_sub_total_terakhir = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get()->sum('sub_total');

        //transaksi
        $nama_pelanggan = $request->nama_pelanggan;
        $total_harga = $sum_sub_total_terakhir;
        $total_bayar = $request->total_bayar;
        $total_kembali = $request->total_kembali;
        $user_email = 'none';
        $keterangan = $request->keterangan;

        //rincian_transaksi
        $nama_produk = $request->nama_produk;
        $jumlah = $request->jumlah;
        $satuan = DB::table('produk')->where('nama_produk','=',$nama_produk)->pluck('satuan');
        $harga = DB::table('produk')->where('nama_produk','=',$nama_produk)->sum('harga');
        $sub_total = ($jumlah * $harga);

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        //cek rincian_transaksi null atau ada value:
        $cek_isi_rincian = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get();

        //if request empty
        if(empty($nama_produk)||empty($jumlah))
        {   
            //update transaksi terakhir
            if($cek_isi_rincian->isEmpty()||empty($total_bayar))
            {
                $total_bayar=0;
                $total_kembali=0;

            }

            $update_transaksi = DB::table('transaksi')
            ->where('id',$id_transaksi_terakhir)->update([
                'nama_pelanggan'=>$nama_pelanggan,
                'total_harga'=>$total_harga,
                'total_bayar'=>$total_bayar,
                'total_kembali'=>$total_kembali,
                'user_email'=>$user_email,
                'keterangan'=>$keterangan,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/standard_user/menu/transaksi')->with('succeed','Sent!');
            
        //if request not empty
        }elseif(!empty($nama_produk)||!empty($jumlah))
        {
            //insert rincian dengan id_transaksi terakhir
            DB::table('rincian_transaksi')->insert([
                'id_transaksi'=>$id_transaksi_terakhir,
                'nama_produk'=>$nama_produk,
                'jumlah'=>$jumlah,
                'satuan'=>$satuan[0],
                'harga'=>$harga,
                'sub_total'=>$sub_total,
                "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
            ]);

            //update transaksi terakhir
            if($cek_isi_rincian->isEmpty()||empty($total_bayar))
            {
                $total_bayar=0;
                $total_kembali=0;

            }

            $update_transaksi = DB::table('transaksi')
            ->where('id',$id_transaksi_terakhir)->update([
                'nama_pelanggan'=>$nama_pelanggan,
                'total_harga'=>$total_harga,
                'total_bayar'=>$total_bayar,
                'total_kembali'=>$total_kembali,
                'user_email'=>$user_email,
                'keterangan'=>$keterangan,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/standard_user/menu/transaksi')->with('succeed','Sent!');
        }
        
    }

    public function destroy_rincian($id)
    {
        DB::table('rincian_transaksi')->where('id', '=', $id)->delete();

        return redirect('/standard_user/menu/transaksi')->with('delete_succeed','Deleted!');
    }

    public function buat_transaksi_baru(Request $request)
    {
        $total_harga = 0;
        $total_bayar = 0;
        $total_kembali = 0;
        $user_email = 'none';

        DB::table('transaksi')->insert([
            'total_harga'=>$total_harga,
            'total_bayar'=>$total_bayar,
            'total_kembali'=>$total_kembali,
            'user_email'=>$user_email
        ]);

        return redirect('/standard_user/menu/transaksi')->with('succeed','Sent!');
    }

    public function cetak_transaksi(Request $request)
    {
        $id_transaksi_terakhir = DB::table('transaksi')->where('user_email','=','none')->orderByDesc('id')->first()->id;
        $data_transaksi = DB::table('transaksi')->where('id', '=', $id_transaksi_terakhir)->first();
        $data_rincian = DB::table('rincian_transaksi')->where('id_transaksi','=',$id_transaksi_terakhir)->get();
        
        return view('menu.transaksi.cetak_transaksi', compact('data_transaksi','data_rincian'));
    }
}

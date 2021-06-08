<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{

    public function transaksi()
    {
        //users
        $user_email = Auth::user()->email;
        $user_name = Auth::user()->name;

        $cek_isi_transaksi = DB::table('transaksi')
        ->where('user_email','=',$user_email)
        ->get();

        if($cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = 0;
        }elseif(!$cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = DB::table('transaksi')
            ->where('user_email','=',$user_email)
            ->orderByDesc('id')
            ->first()
            ->id;
        }

        $data_transaksi = DB::table('transaksi')
        ->where('id','=',$id_transaksi_terakhir)
        ->where('user_email','=',$user_email)
        ->get();

        $data_rincian = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$user_email)
        ->get();

        $nama_produk = DB::table('produk')
        ->where('user_email','=',$user_email)
        ->get();

        $sum_sub_total_terakhir = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$user_email)
        ->get()
        ->sum('sub_total');

        //jika sub total terakhir dari tabel rincian_transaksi = 0
        if($sum_sub_total_terakhir == 0)
        {
            $sum_sub_total_terakhir = null;
            
            return view('menu.transaksi.index', 
            compact('data_transaksi','data_rincian','nama_produk','sum_sub_total_terakhir','user_name'));
        }elseif(!$sum_sub_total_terakhir == 0)
        {
            return view('menu.transaksi.index', 
            compact('data_transaksi','data_rincian','nama_produk','sum_sub_total_terakhir','user_name'));
        }

    }

    public function store_transaksi(Request $request)
    {
        $user_email = Auth::user()->email;

        $cek_isi_transaksi = DB::table('transaksi')
        ->where('user_email','=',$user_email)
        ->get();

        if($cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = 0;
        }elseif(!$cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = DB::table('transaksi')
            ->where('user_email','=',$user_email)
            ->orderByDesc('id')
            ->first()
            ->id;
        }

        $sum_sub_total_terakhir = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$user_email)
        ->get()
        ->sum('sub_total');

        //transaksi
        $nama_pelanggan = $request->nama_pelanggan;
        $total_harga = $sum_sub_total_terakhir;
        $total_bayar = $request->total_bayar;
        $total_kembali = $request->total_kembali;
        $keterangan = $request->keterangan;

        //rincian_transaksi
        $nama_produk = $request->nama_produk;
        $jumlah = $request->jumlah;

        $satuan = DB::table('produk')
        ->where('nama_produk','=',$nama_produk)
        ->where('user_email','=',$user_email)
        ->pluck('satuan');

        $harga = DB::table('produk')
        ->where('nama_produk','=',$nama_produk)
        ->where('user_email','=',$user_email)
        ->sum('harga');

        $sub_total = ($jumlah * $harga);

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        //cek rincian_transaksi empty atau ada value:
        $cek_isi_rincian = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$user_email)
        ->get();

        //if request empty
        if(empty($nama_produk)||empty($jumlah))
        {   
            //update transaksi terakhir
            if($cek_isi_rincian->isEmpty()||empty($total_bayar))
            {
                $total_bayar=0;
                $total_kembali=0;

            }

            //cek transaksi empty atau ada value
            $cek_isi_transaksi = DB::table('transaksi')
            ->where('user_email','=',$user_email)
            ->get();

            if($cek_isi_transaksi->isEmpty())
            {
                //buat inisiasi transaksi awal
                DB::table('transaksi')->insert([
                    'total_harga'=>0,
                    'total_bayar'=>0,
                    'total_kembali'=>0,
                    'user_email'=>$user_email,
                    "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
                ]);
            }

            //update transaksi terakhir
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
                'user_email'=>$user_email,
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
        $user_email = Auth::user()->email;

        DB::table('rincian_transaksi')
        ->where('id', '=', $id)
        ->where('user_email','=',$user_email)
        ->delete();

        $id_transaksi_terakhir = DB::table('transaksi')
        ->where('user_email','=',$user_email)
        ->orderByDesc('id')
        ->first()
        ->id;
        
        $sum_sub_total_terakhir = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$user_email)
        ->get()
        ->sum('sub_total');

        return redirect('/standard_user/menu/transaksi')->with('delete_succeed','Deleted!');
    }

    public function buat_transaksi_baru(Request $request)
    {
        $user_email = Auth::user()->email;

        $total_harga = 0;
        $total_bayar = 0;
        $total_kembali = 0;

        DB::table('transaksi')->insert([
            'total_harga'=>$total_harga,
            'total_bayar'=>$total_bayar,
            'total_kembali'=>$total_kembali,
            'user_email'=>$user_email
        ]);

        return redirect('/standard_user/menu/transaksi')
        ->with('succeed','Sent!');
    }

    public function cetak_transaksi(Request $request)
    {
        $user_email = Auth::user()->email;

        $id_transaksi_terakhir = DB::table('transaksi')
        ->where('user_email','=',$user_email)
        ->orderByDesc('id')
        ->first()
        ->id;

        $data_transaksi = DB::table('transaksi')
        ->where('id', '=', $id_transaksi_terakhir)
        ->first();

        $data_rincian = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->get();
        
        return view('menu.transaksi.cetak_transaksi', 
        compact('data_transaksi','data_rincian'));
    }
}

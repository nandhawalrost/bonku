<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    //return user nifo
    private $user_email;
    private $user_name;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_email = Auth::user()->email;
            $this->user_name = Auth::user()->name;

            return $next($request);
        });
    }

    public function transaksi()
    {
        $cek_isi_transaksi = DB::table('transaksi')
        ->where('user_email','=', $this->user_email)
        ->get();

        //if id_transaksi_terakhir isempty then id_transaksi_terakhir = 0, else  select id terakhir
        if($cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = 0;
        }elseif(!$cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = DB::table('transaksi')
            ->where('user_email','=', $this->user_email)
            ->orderByDesc('id')
            ->first()
            ->id;
        }

        //tampil table berdasar email yang login

        //tabel transaksi
        $data_transaksi = DB::table('transaksi')
        ->where('id','=',$id_transaksi_terakhir)
        ->where('user_email','=', $this->user_email)
        ->get();

        //tabel rincian_transaksi
        $data_rincian = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=', $this->user_email)
        ->get();

        //nama produk
        $nama_produk = DB::table('produk')
        ->where('user_email','=', $this->user_email)
        ->pluck('nama_produk');

        $sum_sub_total_terakhir = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=', $this->user_email)
        ->get()
        ->sum('sub_total');

        $user_name = $this->user_name;
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
        //deklarasi variabel untuk if($cek_isi_transaksi->isEmpty()
        $cek_isi_transaksi = DB::table('transaksi')
        ->where('user_email','=', $this->user_email)
        ->get();

        //if transaksi isempty then id_transaksi_terakhir = 0 else select id transaksi terakhir
        if($cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = 0;
        }elseif(!$cek_isi_transaksi->isEmpty())
        {
            $id_transaksi_terakhir = DB::table('transaksi')
            ->where('user_email','=', $this->user_email)
            ->orderByDesc('id')
            ->first()
            ->id;
        }

        //sum sub total dari rincian transaksi
        $sum_sub_total_terakhir = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=', $this->user_email)
        ->get()
        ->sum('sub_total');

        //REQUEST VARIABEL UNTUK INPUT TRANSAKSI
        $nama_pelanggan = $request->nama_pelanggan;
        $total_harga = $sum_sub_total_terakhir;
        $total_bayar = $request->total_bayar;
        $total_kembali = $request->total_kembali;
        $keterangan = $request->keterangan;

        //REQUEST VARIABEL UNTUK INPUT RINCIAN
        $nama_produk = $request->nama_produk;
        $jumlah = $request->jumlah;

        //satuan
        $satuan = DB::table('produk')
        ->where('nama_produk','=',$nama_produk)
        ->where('user_email','=', $this->user_email)
        ->value('satuan');

        //sum harga
        $harga = DB::table('produk')
        ->where('nama_produk','=',$nama_produk)
        ->where('user_email','=', $this->user_email)
        ->sum('harga');

        //sub total jumlah item dikalikan harga
        $sub_total = ($jumlah * $harga);

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        //cek rincian_transaksi empty atau ada value:
        $cek_isi_rincian = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=', $this->user_email)
        ->get();

        

        //IF ADA INPUT RINCIAN YANG KOSONG
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
            ->where('user_email','=', $this->user_email)
            ->get();

            if($cek_isi_transaksi->isEmpty())
            {
                //buat inisiasi transaksi awal
                DB::table('transaksi')->insert([
                    'total_harga'=>0,
                    'total_bayar'=>0,
                    'total_kembali'=>0,
                    'user_email'=> $this->user_email,
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
                'user_email'=>$this->user_email,
                'keterangan'=>$keterangan,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/standard_user/menu/transaksi')->with('input_succeed','Sent!');
            

        /*
        ELSE IF NAMA PRODUK TIDAK KOSONG ATAU JUMLAH TIDAK KOSONG!
        if not empty nama produk OR not empty jumlah then insert rincian, update transaksi terakhir
        */
        //INPUT RINCIAN
        }elseif(!empty($nama_produk)||!empty($jumlah))
        {
            //kurangi jumlah
            $jumlah_di_produk = DB::table('produk')
            ->where('nama_produk', '=', $nama_produk)
            ->value('jumlah');
            
            $jumlah_beli = $jumlah;
            $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

            $update_produk = DB::table('produk')
            ->where('nama_produk', $nama_produk)->update([
                'jumlah'=>($jumlah_di_produk-$jumlah_beli),
                'user_email'=>$this->user_email,
                "updated_at" =>  $carbon_now
            ]);

            //insert rincian dengan id_transaksi terakhir
            DB::table('rincian_transaksi')->insert([
                'id_transaksi'=>$id_transaksi_terakhir,
                'nama_produk'=>$nama_produk,
                'jumlah'=>$jumlah,
                'satuan'=>$satuan,
                'harga'=>$harga,
                'sub_total'=>$sub_total,
                'user_email'=>$this->user_email,
                "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
            ]);

            
            if($cek_isi_rincian->isEmpty()||empty($total_bayar))
            {
                $total_bayar=0;
                $total_kembali=0;
            }

            //update transaksi terakhir
            $update_transaksi = DB::table('transaksi')
            ->where('id',$id_transaksi_terakhir)->update([
                'nama_pelanggan'=>$nama_pelanggan,
                'total_harga'=>$total_harga,
                'total_bayar'=>$total_bayar,
                'total_kembali'=>$total_kembali,
                'user_email'=>$this->user_email,
                'keterangan'=>$keterangan,
                'updated_at'=>$carbon_now
            ]);

            return redirect('/standard_user/menu/transaksi')->with('input_succeed','Sent!');
        }
        
    }

    //hapus rincian
    public function destroy_rincian($id)
    {
        //rollback jumlah produk
        $nama_produk = DB::table('rincian_transaksi')
        ->where('id', '=', $id)
        ->value('nama_produk');

        $jumlah_beli = DB::table('rincian_transaksi')
        ->where('id', '=', $id)
        ->value('jumlah');

        $jumlah_di_produk = DB::table('produk')
        ->where('nama_produk', '=', $nama_produk)
        ->value('jumlah');
        
        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');
        
        $update_produk = DB::table('produk')
        ->where('nama_produk', $nama_produk)->update([
            'jumlah'=>($jumlah_di_produk+$jumlah_beli),
            'user_email'=>$this->user_email,
            "updated_at" =>  $carbon_now
        ]);

        //destroy
        DB::table('rincian_transaksi')
        ->where('id', '=', $id)
        ->where('user_email','=',$this->user_email)
        ->delete();

        $id_transaksi_terakhir = DB::table('transaksi')
        ->where('user_email','=',$this->user_email)
        ->orderByDesc('id')
        ->first()
        ->id;
        
        $sum_sub_total_terakhir = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$this->user_email)
        ->get()
        ->sum('sub_total');

        return redirect('/standard_user/menu/transaksi')
        ->with('destroy_succeed','Deleted!');
    }

    //button buat transaksi baru
    public function buat_transaksi_baru(Request $request)
    {
        $total_harga = 0;
        $total_bayar = 0;
        $total_kembali = 0;

        DB::table('transaksi')->insert([
            'total_harga'=>$total_harga,
            'total_bayar'=>$total_bayar,
            'total_kembali'=>$total_kembali,
            'user_email'=>$this->user_email
        ]);

        return redirect('/standard_user/menu/transaksi')
        ->with('succeed','Sent!');
    }

    //print pakai javascript
    public function cetak_transaksi(Request $request)
    {
        $id_transaksi_terakhir = DB::table('transaksi')
        ->where('user_email','=',$this->user_email)
        ->orderByDesc('id')
        ->first()
        ->id;

        $data_transaksi = DB::table('transaksi')
        ->where('id', '=', $id_transaksi_terakhir)
        ->where('user_email','=',$this->user_email)
        ->first();

        $data_rincian = DB::table('rincian_transaksi')
        ->where('id_transaksi','=',$id_transaksi_terakhir)
        ->where('user_email','=',$this->user_email)
        ->get();
        
        return view('menu.transaksi.cetak_transaksi', 
        compact('data_transaksi','data_rincian'));
    }
}

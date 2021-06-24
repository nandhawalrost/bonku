<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PendapatanHarianController extends Controller
{
    private $user_email;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_email = Auth::user()->email;

            return $next($request);
        });
    }

    public function pendapatan_harian()
    {
        //===========TABEL:TRANSAKSI=================================================

        //select transaksi berdasarkan method today()
        $data_transaksi_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('updated_at', '=', Carbon::today()) //karena transaksi berdasarkan kapan terakhir diupdate, bukan dibuat
        ->paginate(10);

        //sum total harga table transaksi hari ini
        $sum_transaksi_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->sum('total_harga');

        //hitung jumlah row transaksi hari ini
        $frekuensi_transaksi_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->count();

        //total transaksi terendah hari ini
        $min_transaksi_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->min('total_harga');

        //total transaksi tertinggi hari ini
        $max_transaksi_hari_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('updated_at', '=', Carbon::today()) 
        ->max('total_harga');

        //rata-rata pengeluaran
        //if rata-rata = 0 tidak dihitung, else dihitung
        if($sum_transaksi_hari_ini == 0 | $frekuensi_transaksi_hari_ini == 0)
        {
            $rata_transaksi_hari_ini = 0;
        }elseif(!$sum_transaksi_hari_ini == 0 | !$frekuensi_transaksi_hari_ini ==0)
        {
            $rata_transaksi_hari_ini = $sum_transaksi_hari_ini/$frekuensi_transaksi_hari_ini;
        }


        //===========TABEL:PENDAPATAN=================================================

        //data pendapatan hari ini
        $data_pendapatan_hari_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', Carbon::today())
        ->paginate(10);

        //sum total pendapatan hari ini
        $sum_pendapatan_hari_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', Carbon::today())
        ->sum('total');

        //frekuensi pendapatan hari ini
        $frekuensi_pendapatan_hari_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', Carbon::today())
        ->count();

        //pendapatan dengan total terendah hari ini
        $min_pendapatan_hari_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', Carbon::today())
        ->min('total');

        //pendapatan dengan total tertinggi hari ini
        $max_pendapatan_hari_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', Carbon::today())
        ->max('total');
        
        
        //rata-rata pendapatan
        //if rata-rata = 0 tidak dihitung, else dihitung
        if($sum_pendapatan_hari_ini == 0 | $frekuensi_pendapatan_hari_ini == 0)
        {
            $rata_pendapatan_hari_ini = 0;
        }elseif(!$sum_pendapatan_hari_ini == 0 | !$frekuensi_pendapatan_hari_ini ==0)
        {
            $rata_pendapatan_hari_ini = $sum_pendapatan_hari_ini/$frekuensi_pendapatan_hari_ini;
        }

        return view('menu.laporan.pendapatan.index', 
        compact('data_transaksi_hari_ini',
        'sum_transaksi_hari_ini',
        'frekuensi_transaksi_hari_ini',
        'min_transaksi_hari_ini',
        'max_transaksi_hari_ini',
        'rata_transaksi_hari_ini',

        'data_pendapatan_hari_ini',
        'sum_pendapatan_hari_ini',
        'frekuensi_pendapatan_hari_ini',
        'min_pendapatan_hari_ini',
        'max_pendapatan_hari_ini',
        'rata_pendapatan_hari_ini'
        ));
    }
    //->whereDate('updated_at', '=', date($tanggal))
    public function search_tanggal(Request $request)
    {
        $tanggal = $request->get('tanggal');
        
        //select transaksi berdasarkan fungsi date($tanggal)
        $data_transaksi_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal)) //karena transaksi berdasarkan kapan terakhir diupdate, bukan dibuat
        ->paginate(10);

        //sum total harga table transaksi tanggal ini
        $sum_transaksi_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->sum('total_harga');

        //hitung jumlah row transaksi tanggal ini
        $frekuensi_transaksi_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->count();

        //total transaksi terendah tanggal ini
        $min_transaksi_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->min('total_harga');

        //total transaksi tertinggi tanggal ini
        $max_transaksi_tanggal_ini = DB::table('transaksi')
        ->select(array('id','total_harga','keterangan','nama_pelanggan','created_at','updated_at'))
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->max('total_harga');

        //rata-rata pengeluaran
        //if rata-rata = 0 tidak dihitung, else dihitung
        if($sum_transaksi_tanggal_ini == 0 | $frekuensi_transaksi_tanggal_ini == 0)
        {
            $rata_transaksi_tanggal_ini = 0;
        }elseif(!$sum_transaksi_tanggal_ini == 0 | !$frekuensi_transaksi_tanggal_ini ==0)
        {
            $rata_transaksi_tanggal_ini = $sum_transaksi_tanggal_ini/$frekuensi_transaksi_tanggal_ini;
        }


        //===========TABEL:PENDAPATAN=================================================

        //data pendapatan tanggal ini
        $data_pendapatan_tanggal_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->paginate(10);

        //sum total pendapatan tanggal ini
        $sum_pendapatan_tanggal_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->sum('total');

        //frekuensi pendapatan tanggal ini
        $frekuensi_pendapatan_tanggal_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->count();

        //pendapatan dengan total terendah tanggal ini
        $min_pendapatan_tanggal_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->min('total');

        //pendapatan dengan total tertinggi tanggal ini
        $max_pendapatan_tanggal_ini = DB::table('pendapatan')
        ->where('user_email','=', $this->user_email)
        ->whereDate('created_at', '=', date($tanggal))
        ->max('total');
        
        
        //rata-rata pendapatan
        //if rata-rata = 0 tidak dihitung, else dihitung
        if($sum_pendapatan_tanggal_ini == 0 | $frekuensi_pendapatan_tanggal_ini == 0)
        {
            $rata_pendapatan_tanggal_ini = 0;
        }elseif(!$sum_pendapatan_tanggal_ini == 0 | !$frekuensi_pendapatan_tanggal_ini ==0)
        {
            $rata_pendapatan_tanggal_ini = $sum_pendapatan_tanggal_ini/$frekuensi_pendapatan_tanggal_ini;
        }

        return view('menu.laporan.pendapatan.search_tanggal', 
        compact('data_transaksi_tanggal_ini',
        'sum_transaksi_tanggal_ini',
        'frekuensi_transaksi_tanggal_ini',
        'min_transaksi_tanggal_ini',
        'max_transaksi_tanggal_ini',
        'rata_transaksi_tanggal_ini',

        'data_pendapatan_tanggal_ini',
        'sum_pendapatan_tanggal_ini',
        'frekuensi_pendapatan_tanggal_ini',
        'min_pendapatan_tanggal_ini',
        'max_pendapatan_tanggal_ini',
        'rata_pendapatan_tanggal_ini'
        ));
    }
}

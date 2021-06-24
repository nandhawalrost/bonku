<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    private $user_email;
    
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_email = Auth::user()->email;

            return $next($request);
        });
    }
    
    public function produk()
    {
        $data_produk = DB::table('produk')
        ->where('user_email', $this->user_email)
        ->paginate(10);

        return view('menu.produk.index', compact('data_produk'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nama_produk' => 'required|unique:produk|max:30',
            'jumlah' => 'max:11',
            'jumlah_minimum' => 'max:11',
            'jumlah_maksimum' => 'max:11',
            'satuan' => 'required|max:15',
            'harga' => 'max:10'
        ]);

        //request as variable
        $nama_produk = $request->nama_produk;
        $jumlah = $request->jumlah;
        $jumlah_minimum = $request->jumlah_minimum;
        $jumlah_maksimum = $request->jumlah_maksimum;
        $harga = $request->harga;
        $satuan = $request->satuan;

        if(!$request->filled('jumlah')) //if request not filled
        {
            $jumlah = '0'; //value '0'
        }

        if(!$request->filled('jumlah_minimum'))
        {
            $jumlah_minimum = '0';
        }

        if(!$request->filled('jumlah_maksimum'))
        {
            $jumlah_maksimum = '0';
        }

        if(!$request->filled('harga'))
        {
            $harga = '0';
        }

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        DB::table('produk')->insert([
            'nama_produk'=>$nama_produk,
            'jumlah'=>$jumlah,
            'jumlah_minimum'=>$jumlah_minimum,
            'jumlah_maksimum'=>$jumlah_maksimum,
            'harga'=>$harga,
            'satuan'=>$satuan,
            'user_email'=>$this->user_email,
            "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
        ]);

        return redirect('/standard_user/menu/produk')->with('succeed','Sent!');
    }

    public function edit($id)
    {
        $data_produk = DB::table('produk')
        ->where('user_email','=', $this->user_email)
        ->where('id', $id)
        ->first(); //or find()

        return view('menu.produk.edit',['produk' => $data_produk]);
    }

    public function update(Request $request, $id) //update (reduce balance)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:30',
            'jumlah' => 'max:11',
            'jumlah_minimum' => 'max:11',
            'jumlah_maksimum' => 'max:11',
            'satuan' => 'required|max:15',
            'harga' => 'max:10'
        ]);

        //request as variable
        $nama_produk = $request->nama_produk;
        $jumlah = $request->jumlah;
        $jumlah_minimum = $request->jumlah_minimum;
        $jumlah_maksimum = $request->jumlah_maksimum;
        $harga = $request->harga;
        $satuan = $request->satuan;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        $update_produk = DB::table('produk')
        ->where('id', $request->id)->update([
            'nama_produk'=>$nama_produk,
            'jumlah'=>$jumlah,
            'jumlah_minimum'=>$jumlah_minimum,
            'jumlah_maksimum'=>$jumlah_maksimum,
            'harga'=>$harga,
            'satuan'=>$satuan,
            'user_email'=>$this->user_email,
            "updated_at" =>  $carbon_now
        ]);

        return redirect('/standard_user/menu/produk')->with('succeed','Sent!');
    }

    public function delete_confirmation($id)
    {
        //select ds8 where id
        $data_produk = DB::table('produk')
        ->where('id', $id)
        ->where('user_email', $this->user_email)

        ->first(); //or find()
        return view('menu.produk.delete_confirmation',['produk' => $data_produk]);
    }

    public function destroy($id)
    {
        DB::table('produk')
        ->where('id', '=', $id)
        ->where('user_email', $this->user_email)
        ->delete();

        return redirect('/standard_user/menu/produk')->with('delete_succeed','Deleted!');
    }

    public function search_produk(Request $request)
    {
        $nama_produk = $request->get('nama_produk');
        
        $search_produk = DB::table('produk')
        ->where('nama_produk', 'like', '%' .$nama_produk. '%')
        ->where('user_email', $this->user_email)
        ->paginate(10);

        $search_produk->appends($request->all());

        return view('menu.produk.search', compact('search_produk'));
    }
}

        /*
        Di saat kesulitan cobalah memandang langit
        Kar'na s'perti biasa di sini 'ku s'lalu
        Mendengarkan cerita-ceritamu
        Kita 'tak akan pernah sendirian
        */
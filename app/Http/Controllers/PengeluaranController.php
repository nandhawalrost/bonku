<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $user_email = Auth::user()->email;

        $data_pengeluaran = DB::table('pengeluaran')->where('user_email','=',$user_email)->orderByDesc('id')->get();
        
        return view('menu.pengeluaran.index', compact('data_pengeluaran'));
    }

    public function store(Request $request)
    {
        $user_email = Auth::user()->email;

        $validatedData = $request->validate([
            'deskripsi' => 'required|unique:pengeluaran|max:255',
            'jumlah' => 'max:11',
            'keterangan' => 'max:255'
        ]);

        $deskripsi = $request->deskripsi;
        $total = $request->total;
        $keterangan = $request->keterangan;

        if(!$request->filled('total')) //if request not filled
        {
            $total = '0'; //value '0'
        }

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        DB::table('pengeluaran')->insert([
            'deskripsi'=>$deskripsi,
            'total'=>$total,
            'keterangan'=>$keterangan,
            'user_email'=>$user_email,
            "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
        ]);

        return redirect('/standard_user/menu/pengeluaran')->with('succeed','Sent!');
    }

    public function edit($id)
    {
        $user_email = Auth::user()->email;
        $data_pengeluaran = DB::table('pengeluaran')->where('user_email','=',$user_email)->where('id', $id)->first(); //or find()
        return view('menu.pengeluaran.edit',['pengeluaran' => $data_pengeluaran]);
    }

    public function update(Request $request, $id) //update (reduce balance)
    {
        $user_email = Auth::user()->email;
        
        $validatedData = $request->validate([
            'deskripsi' => 'required|unique:pengeluaran|max:255',
            'jumlah' => 'max:11',
            'keterangan' => 'max:255'
        ]);

        $deskripsi = $request->deskripsi;
        $total = $request->total;
        $keterangan = $request->keterangan;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        $update_need_order = DB::table('pengeluaran')
        ->where('id', $request->id)->update([
            'deskripsi'=>$deskripsi,
            'total'=>$total,
            'keterangan'=>$keterangan,
            'user_email'=>$user_email,
            "updated_at" =>  $carbon_now
        ]);

        return redirect('/standard_user/menu/pengeluaran')->with('succeed','Sent!');
    }
}

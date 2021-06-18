<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;

class PendapatanController extends Controller
{
    public function pendapatan()
    {
        $user_email = Auth::user()->email;

        $data_pendapatan = DB::table('pendapatan')
        ->where('user_email','=',$user_email)
        ->orderByDesc('id')
        ->paginate(10);
        
        return view('menu.pendapatan.index', compact('data_pendapatan'));
    }

    public function store(Request $request)
    {
        $user_email = Auth::user()->email;

        $validatedData = $request->validate([
            'deskripsi' => 'required|unique:pendapatan|max:255',
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

        DB::table('pendapatan')->insert([
            'deskripsi'=>$deskripsi,
            'total'=>$total,
            'keterangan'=>$keterangan,
            'user_email'=>$user_email,
            "created_at" =>  $carbon_now # new \Datetime() | get timezone from php timezone list
        ]);

        return redirect('/standard_user/menu/pendapatan')->with('succeed','Sent!');
    }

    public function edit($id)
    {
        $user_email = Auth::user()->email;
        $data_pendapatan = DB::table('pendapatan')
        ->where('user_email','=',$user_email)
        ->where('id', $id)->first(); //or find()
        
        return view('menu.pendapatan.edit',['pendapatan' => $data_pendapatan]);
    }

    public function update(Request $request, $id) //update (reduce balance)
    {
        $user_email = Auth::user()->email;
        
        $validatedData = $request->validate([
            'deskripsi' => 'required|max:255',
            'jumlah' => 'max:11',
            'keterangan' => 'max:255'
        ]);

        $deskripsi = $request->deskripsi;
        $total = $request->total;
        $keterangan = $request->keterangan;

        $carbon_now = \Carbon\Carbon::now()->setTimezone('Asia/Bangkok');

        $update_need_order = DB::table('pendapatan')
        ->where('id', $request->id)->update([
            'deskripsi'=>$deskripsi,
            'total'=>$total,
            'keterangan'=>$keterangan,
            'user_email'=>$user_email,
            "updated_at" =>  $carbon_now
        ]);

        return redirect('/standard_user/menu/pendapatan')->with('succeed','Sent!');
    }

    public function delete_confirmation($id)
    {
        $user_email = Auth::user()->email;

        $data_pendapatan = DB::table('pendapatan')
        ->where('user_email','=',$user_email)
        ->where('id', $id)
        ->first();
        
        return view('menu.pendapatan.delete_confirmation', ['pendapatan' => $data_pendapatan]);   
    }

    public function destroy($id)
    {
        $user_email = Auth::user()->email;

        DB::table('pendapatan')
        ->where('user_email','=',$user_email)
        ->where('id', '=', $id)
        ->delete();

        return redirect('/standard_user/menu/pendapatan')->with('delete_succeed','Deleted!');
    }

    public function search_pendapatan(Request $request)
    {
        $user_email = Auth::user()->email;

        $deskripsi = $request->get('deskripsi');
        
        $search_pendapatan = DB::table('pendapatan')
        ->where('deskripsi', 'like', '%' .$deskripsi. '%')
        ->where('user_email', $user_email)
        ->paginate(10);

        $search_pendapatan->appends($request->all());

        return view('menu.pendapatan.search', compact('search_pendapatan'));
    }
}

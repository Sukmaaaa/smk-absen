<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LiveSearchController extends Controller
{
    // Halaman
    public function liveSearch()
    {
        $user = User::all();

        return view('liveSearch')->with([
            'User' => $user
        ]);
    }

    // Default 
    public function hasil()
    {
        return 'hello';
    }

    // Konten hasil pencarian
    public function action(Request $request)
    {
        // nanti $name = $request->rfid;
       $id = $request->id;
       $results = DB::table('users')
       ->where('id', $id)
       ->get();
       $datas = count($results);

        // Cek Data
       if ($datas == 0) {
            return '<p class="text-muted">Data tidak terdaftar</p>';
       } else{
            return view('ajaxpage')->with([
                'data' => $results
            ]);
       }
    }
}
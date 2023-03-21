<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LiveSearchController extends Controller
{
    // HALAMAN
    public function liveSearch()
    {
        $user = User::all(); // MENGAMBIL SELURUH USER

        // ALIHKAN KE liveSearch DENGAN DATA
        return view('liveSearch')->with([
            'User' => $user
        ]);
    }

    // DEFAULT 
    public function hasil()
    {
        return 'hello';
    }

    // DATA HASIL PENCAHARIAN
    public function action(Request $request)
    {
       $rfid = $request->rfid; // MENGAMBIL INPUT RFID
       $results = DB::table('users') // MENGAMBIL DATA DARI TABEL users
       ->where('rfid', $rfid) // MENCARI RFID UNTUK DICOCOKKAN
       ->get(); // MENGAMBIL DATA
       $datas = count($results); // MENGHITUNG HASIL YANG SESUAI

        // CEK DATA
       if ($datas == 0) {
            return json_encode(['error'=>true,'msg' => 'Data tidak ditemukan!']);
       } else{
            return view('ajaxpage')->with([
                'data' => $results
            ]);
       }
    }
}
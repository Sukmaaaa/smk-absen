<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\murid;
use Illuminate\Support\Facades\DB;

class LiveSearchMuridController extends Controller
{
    // HALAMAN
    public function liveSearch()
    {
        $murid = murid::all(); // MENGAMBIL SELURUH DATA MURID

        // ALIHKAN KE liveSearchMurid DENGAN DATA
        return view('liveSearchMurid')->with([
            'Murid' => $murid
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
        $results = DB::table('murids') // MENGAMBIL DATA DARI TABEL murids
        ->where('rfid', $rfid) // MENCARI RFID UNTUK DICOCOKKAN
        ->get(); // MENGAMBIL DATA
        $datas = count($results); // MENGHITUNG HASIL YANG SESUAI

        // CEK DATA
        if ($datas == 0) {
                return json_encode(['error'=>true,'msg' => 'Data tidak ditemukan!']);
        } else{
                return view('ajaxpagemurid')->with([
                    'data' => $results
                ]);
        }
    }
}

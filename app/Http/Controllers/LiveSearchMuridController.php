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
        $murid = murid::all();

        return view('liveSearchMurid')->with([
            'Murid' => $murid
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
        $rfid = $request->rfid;
        $results = DB::table('murids')
        ->where('rfid', $rfid)
        ->get();
        $datas = count($results);

        // Cek Data
        if ($datas == 0) {
                return json_encode(['error'=>true,'msg' => 'Data tidak ditemukan!']);
        } else{
                return view('ajaxpagemurid')->with([
                    'data' => $results
                ]);
        }
    }
}

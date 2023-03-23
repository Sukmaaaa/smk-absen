<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensiMurid;
use App\Models\murid;
use Carbon\Carbon;

class AbsensiMuridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-kehadiran-murid');

        $absensi = absensiMurid::with('murid')->latest()->get();

        return view('app.absensi.murid.index', compact('absensi'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
     {
        $this->middleware('can:create-kehadiran-murid');
        $murids = murid::all();
        return view('app.absensi.murid.create', compact('murids'));
     }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->middleware('can:crate-kehadiran-murid');
        // MENGAMBIL NILAI INPUT DARI rfid_murid
        $rfid = $request->input('rfid_murid');
        
        // MENGAMBIL DATA MURID BERDASARKAN INPUT $rfid 
        $murid = murid::where('rfid', $rfid)->get()->first();

        // KALO RFID TIDAK ADA
        if (!$murid) {
            return redirect()->route('murid.create')->with(['error'=> 'RFID tidak ditemukan.']);
        }

        // MENGAMBIL NILAI INPUT inputLocalTime 
        $inputLocalTime = $request->input('inputLocalTime');

        // CHECK
        if (strlen($rfid) == 19) {
            $today = Carbon::today();
            $dataAbsen = absensiMurid::where('murid_id', $murid->id)
                ->whereDate('created_at', $today)
                ->get()
                ->first();

            if ($dataAbsen) {
                return redirect()->route('murid.create')->with(['error'=> 'Anda sudah melakukan absensi hari ini.']);
            }
            
            // MEMBUAT ABSENSI KEHADIRAN
            $dataAbsen = absensiMurid::create([
                'murid_id' => $murid->id,
                'absen_hadir' => $inputLocalTime
            ]);

            return redirect()->route('murid.create')->with(['success'=> 'Absensi berhasil disimpan.']);
        } else {
            return redirect()->route('murid.create')->with(['error'=> 'Panjang RFID harus 19 karakter.']);
        }

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // METHOD UNTUK PULANG
    public function edit()
    {
        $this->middleware('can:edit-kehadiran-murid');
        
        return view('app.absensi.murid.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        $this->middleware('can:edit-kehadiran-murid');

        $rfid = $request->input('rfid_murid');
        // MENGAMBIL DATA MURID BERDASARKAN INPUT $rfid 
        $murid = murid::where('rfid', $rfid)->get()->first();

        // MENGECEK APAKAH ADA MURID DENGAN RFID TERSEBUT
        if (!murid::where('rfid', $rfid)->exists()) {
            return redirect()->route('murid.edit')->with('error', 'RFID tidak ditemukan.');
        }

        //  MENCARI DATA MURID ABSENSI HARI INI
        $dataAbsensi = absensiMurid::where('murid_id', $murid->id)
                            ->whereDate('created_at', Carbon::today())
                            ->first();

        // MENGECEK APAKAH MURID SUDAH ABSEN HADIR HARI INI
        if (empty($dataAbsensi) || is_null($dataAbsensi->absen_hadir)) {
            return redirect()->route('murid.edit')->with('error', 'Anda belum absen hadir hari ini.');
        }

        // MEMPERBARUI DATA murid_id & absen_pulang
        $dataAbsensi->update([
            'murid_id' => $murid->id,
            'absen_pulang' => $request->input('inputLocalTimePulang')
        ]);

        return redirect()->route('murid.edit')->with('success', 'Absensi berhasil disimpan.');
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

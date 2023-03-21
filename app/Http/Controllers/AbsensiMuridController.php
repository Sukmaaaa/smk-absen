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
        $absensi = absensiMurid::with('murid')->latest()->get();

        return view('absensi.murid.index', compact('absensi'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function create()
     {
         $murids = murid::all();
         return view('absensi.murid.create', compact('murids'));
     }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $rfid = $request->input('rfid_murid');    
        $murid = murid::where('rfid', $rfid)->get()->first();

        // KALO MURID EXIST
        if (!$murid) {
            return redirect()->route('murid.create')->with(['error'=> 'RFID tidak ditemukan.']);
        }

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
    public function edit()
    {
        return view('absensi.murid.edit');
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
        $rfid = $request->input('rfid_murid');
        $murid = murid::where('rfid', $rfid)->get()->first();

        if (!murid::where('rfid', $rfid)->exists()) {
            return redirect()->route('murid.edit')->with('error', 'RFID tidak ditemukan.');
        }

        $dataAbsensi = absensiMurid::where('murid_id', $murid->id)->orderByDesc('id')->first();

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

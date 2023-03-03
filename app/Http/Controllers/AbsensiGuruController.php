<?php

namespace App\Http\Controllers;

use App\Models\absensiGuru;
use App\Models\User;
use Illuminate\Http\Request;

class AbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $absensi = absensiGuru::with('user')->latest()->get();

        return view('absensi.guru.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $users = User::all();
        return view('absensi.guru.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        $rfid = $request->input('rfid_guru');    
        $user = User::where('rfid', $rfid)->get()->first();
        
        // KALO USER EXIST
        if (!$user) {
            return redirect()->route('guru.create')->with(['error'=> 'RFID tidak ditemukan.']);
        }

        $inputLocalTime = $request->input('inputLocalTime');

        // CHECK
        if (strlen($rfid) == 19) {
            $dataAbsen = absensiGuru::create([
                'user_id' => $user->id,
                'absen_hadir' => $inputLocalTime
            ]);
            $dataAbsen->save();

            return redirect()->route('guru.create')->with(['success'=> 'Absensi berhasil disimpan.']);
        } else{
            return redirect()->route('guru.create')->with(['error'=> 'Panjang RFID harus 19 karakter.']);
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
    public function edit($id)
    {
        //
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
        $rfid = $request->input('rfid_guru');    
        $user = User::where('rfid', $rfid)->get()->first();
        
        if (!User::where('rfid', $rfid)->exists()) {
            return redirect()->route('guru.create')->with('error', 'RFID tidak ditemukan.');
        }

        $dataAbsensi = absensiGuru::where('user_id', $user->id)->orderByDesc('id')->get()->first();

        $dataAbsensi->update([
            'user_id' => $user->id,
            'absen_pulang' => $request->input('inputLocalTimePulang')
        ]);
        
        return redirect()->route('guru.create')->with('success', 'Absensi berhasil disimpan.');
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

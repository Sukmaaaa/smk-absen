<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensiGuru;
use App\Models\User;
use Carbon\Carbon;

class AbsensiGuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-kehadiran-guru');

        $absensi = absensiGuru::with('user')->latest()->get();

        return view('app.absensi.guru.index', compact('absensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $this->middleware('can:create-kehadiran-guru');

        $users = User::all(); // AMBIL SEMUA USER

        // ALIHKAN KE .. DENGAN DATA
        return view('app.absensi.guru.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->middleware('can:create-kehadiran-guru');

        // MENGAMBIL NILAI INPUT DARI rfid_guru
        $rfid = $request->input('rfid_guru'); 

        // MENGAMBIL DATA USER BERDASARKAN INPUT $rfid 
        $user = User::where('rfid', $rfid)->get()->first(); 

        // KALO USER GAADA 
        if (!$user) {
            return redirect()->route('guru.create')->with(['error'=> 'RFID tidak ditemukan.']);
        }

        // MENGAMBIL NILAI INPUT inputLocalTime
        $inputLocalTime = $request->input('inputLocalTime');

        // CHECK
        if (strlen($rfid) == 19) {
            $today = Carbon::today();
            $dataAbsen = absensiGuru::where('user_id', $user->id)
                ->whereDate('created_at', $today)
                ->get()
                ->first();

            if ($dataAbsen) {
                return redirect()->route('guru.create')->with(['error'=> 'Anda sudah melakukan absensi hari ini.']);
            }

            // MEMBUAT ABSENSI KEHADIRAN
            $dataAbsen = absensiGuru::create([
                'user_id' => $user->id,
                'absen_hadir' => $inputLocalTime
            ]);

            return redirect()->route('guru.create')->with(['success'=> 'Absensi berhasil disimpan.']);
        } else {
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
    public function edit()
    {
        $this->middleware('can:edit-kehadiran-guru');

        return view('app.absensi.guru.edit');
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
        $this->middleware('can:edit-kehadiran-guru');

        // MENGAMBIL INPUT DARI rfid_guru
        $rfid = $request->input('rfid_guru');
        
        // MENGAMBIL DATA GURU BERDASARKAN INPUT $rfid 
        $user = User::where('rfid', $rfid)->get()->first();
        
        // MENGECEK APAKAH ADA GURU DENGAN RFID TERSEBUT
        if (!User::where('rfid', $rfid)->exists()) {
            return redirect()->route('guru.edit')->with('error', 'RFID tidak ditemukan.');
        }

        // MENGAMBIL DATA ABSENSI TERAKHIR GURU BERDASARKAN ID HARI INI
        $dataAbsensi = absensiGuru::where('user_id', $user->id)
        ->whereDate('created_at', Carbon::today())
        ->first();

        // MENGECEK APAKAH GURU SUDAH ABSEN HADIR HARI INI?
        if (empty($dataAbsensi) || is_null($dataAbsensi->absen_hadir)) {
            return redirect()->route('guru.edit')->with('error', 'Anda belum absen hadir hari ini.');
        }

        // MEMPERBARUI DATA user_id & absen_pulang
        $dataAbsensi->update([
            'user_id' => $user->id,
            'absen_pulang' => $request->input('inputLocalTimePulang')
        ]);
        
        return redirect()->route('guru.edit')->with('success', 'Absensi berhasil disimpan.');
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

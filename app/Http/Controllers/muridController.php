<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\murid;
use App\Models\kabupatenKota;
use App\Models\jurusan;
use Session;
use Illuminate\Support\Facades\Storage;

class muridController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-murid');

        $murid = murid::all();

        return view('app.management.murid.index', compact('murid'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('can:create-murid');

        $kabupatenKota = kabupatenKota::all();
        $jurusan = jurusan::all();

        return view('app.management.murid.create', compact('kabupatenKota', 'jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('can:create-murid');

        // MENGAMBIL INPUT DARI JURUSAN
        $jurusan = jurusan::find($request->input('jurusan'));

        // VALIDASI
        $validatedData = $request->validate([
            'NIS' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'tempat_tinggal' => 'nullable',
            'jenis_kelamin' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'rfid' => 'required',
        ]);

        // CHECK APAKAH ADA USER DENGAN NIS YANG SAMA
        $murid = murid::where('NIS', $request->NIS)->first();
        if ($murid) {
            Session::flash('error', 'Data murid ini sudah ada');
            return redirect()->route('management.murid.index');
        } 

        // SIMPAN DATA KE DATABASE
        $murid = murid::create($validatedData);

        // SIMPAN FOTO JIKA ADA
        if($request->file('foto')){
            $file= $request->file('foto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/images'), $filename);
            $murid['foto']= $filename;
        }

        // SIMPAN FOTO
        $murid->save();

        return redirect()->route('management.murid.index')->with('success', 'Murid baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('can:view-guru');

        $murid = murid::findOrFail($id);

        return view('app.management.murid.show', compact('murid'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('can:edit-murid');

        $murid = murid::findOrFail($id);
        $kabupatenKota = kabupatenKota::all();
        $jurusan = jurusan::all();

        return view('app.management.murid.edit', compact('murid', 'kabupatenKota', 'jurusan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware('can:edit-murid');

        //  AMBIL INPUT NIS, CHECK APAKAH ADA YANG SAMA KECUALI YANG SEDANG DI UPDATE
        $murid = murid::where('NIS', $request->NIS)->where('id', '<>', $id)->first();

        // AMBIL INPUT KOMPETENSI
        $jurusan = jurusan::find($request->input('jurusan'));

        // JIKA MURID DENGAN NIS YANG DIINPUT SUDAH ADA
        if ($murid) {
            if ($murid->NIS == $request->NIS) {
                return redirect()->route('management.murid.edit', $id)->with('error', 'Data murid ini sudah ada.');
            }
        } else {
            // VALIDASI
            $validatedData = $request->validate([
                'NIS' => 'required',
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'tempat_tinggal' => 'nullable',
                'jenis_kelamin' => 'required',
                'kelas' => 'required',
                'jurusan' => 'required',
                'rfid' => 'required',
            ]);

            // UPDATE DATA KE DATABASE
            $murid = murid::findOrFail($id);
            $murid->update($validatedData);

            // SIMPAN FOTO JIKA ADA
            if($request->file('foto')){
                $file= $request->file('foto');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('public/images'), $filename);
                $murid['foto']= $filename;
            }

            // UPDATE FOTO
            $murid->save();

            return redirect()->route('management.murid.index')->with('success', 'Data murid berhasil diperbaharui.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('can:delete-murid');

        $murid = murid::findOrFail($id);
        $murid->delete();

        return redirect()->route('management.murid.index')->with('success', 'Data murid berhasil dihapus.');
    }
}

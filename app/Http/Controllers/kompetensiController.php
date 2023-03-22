<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\kompetensi;

class kompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-kompetensi');

        $kompetensi = kompetensi::all();

        return view('kompetensi.index', compact('kompetensi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('can:create-kompetensi');

        return view('kompetensi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('can:create-kompetensi');

        // VALIDASI INPUT
        $request->validate([
            'namaKompetensi' => 'required',
            'deskripsi' => 'required',
        ]);

        // CEK KOMPETENSI APAKAH SUDAH ADA ATAU BELUM
        $kompetensi = kompetensi::where('namaKompetensi', $request->namaKompetensi)->first();
        if ($kompetensi) {
            return redirect()->route('kompetensi.index')->with('Kompetensi ini sudah ada');
        }

        $kompetensi = new kompetensi();
        $kompetensi->namaKompetensi = $request->namaKompetensi;
        $kompetensi->deskripsi = $request->deskripsi;
        $kompetensi->save();

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('can:view-kompetensi');

        $kompetensi = kompetensi::findOrFail($id);

        return view('kompetensi.show', compact('kompetensi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('can:edit-kompetensi');;

        $kompetensi = kompetensi::findOrFail($id);

        return view('kompetensi.edit', compact('kompetensi'));
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
        $this->middleware('can:edit-kompetensi');

        // VALIDASI
        $request->validate([
            'namaKompetensi' => 'required',
            'deskripsi' => 'required',
        ]);

        $kompetensi = kompetensi::where('namaKompetensi', $request->namaKompetensi)->where('id', '<>', $id)->first();
        if ($kompetensi) {
            return redirect()->route('kompetensi.index')->with('Kompetensi ini sudah ada');
        }

        // UPDATE DATA
        $kompetensi = kompetensi::findOrFail($id);
        $kompetensi->namaKompetensi = $request->namaKompetensi;
        $kompetensi->deskripsi = $request->deskripsi;
        $kompetensi->save();

        return redirect()->route('kompetensi.index')->with('success', 'Kompetensi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('can:delete-kompetensi');

        $kompetensi = kompetensi::findOrFail($id);
        $kompetensi->delete();
    
        return redirect()->route('kompetensi.index')->with('success','Kompetensi berhasil dihapus');
    }
}

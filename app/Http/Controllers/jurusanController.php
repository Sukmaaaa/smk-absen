<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jurusan;

class jurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-jurusan');

        $jurusan = jurusan::all();

        return view('app.jurusan.index', compact('jurusan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('can:create-jurusan');

        return view('app.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('can:create-jurusan');

        // VALIDASI INPUT
        $validatedData =  $request->validate([
            'namaJurusan' => 'required',
            'deskripsi' => 'nullable',
        ]);

        // CEK APAKAH JURUSAN SUDAH ADA ATAU BELUM
        $jurusan = jurusan::where('namaJurusan', $request->namaJurusan)->first();
        if ($jurusan) {
            Session::flash('error', 'Data jurusan ini sudah ada');
            return redirect()->route('jurusan.index');
        }

        // SIMPAN DATA
        $jurusan = jurusan::create($validatedData);

        $jurusan->save();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('can:view-jurusan');

        $jurusan = jurusan::findOrFail($id);

        return view('app.jurusan.show', compact('jurusan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('can:edit-jurusan');

        $jurusan = jurusan::findOrFail($id);

        return view('app.jurusan.edit', compact('jurusan'));
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
        $this->middleware('can:edit-jurusan');

        // VALIDASI INPUT
        $validatedData =  $request->validate([
            'namaJurusan' => 'required',
            'deskripsi' => 'nullable',
        ]);

        // CEK APAKAH JURUSAN SUDAH ADA ATAU BELUM KECUALI YANG SEDANG DI EDIT
        $jurusan = jurusan::where('namaJurusan', $request->namaJurusan)->where('id', '<>', $id)->first();
        if ($jurusan) {
            Session::flash('error', 'Data jurusan ini sudah ada');
            return redirect()->route('jurusan.index');
        }

        // UPDATE DATA KE DATABASE
        $jurusan = jurusan::findOrFail($id);
        $jurusan->update($validatedData);

        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('can:delete-jurusan');

        $jurusan = jurusan::findOrFail($id);
        $jurusan->delete();

        return redirect()->route('jurusan.index')->with('success', 'Jurusan ini berhasil dihapus');
    }
}

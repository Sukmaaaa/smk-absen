<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;

class guruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-user');

        $user = User::all();

        return view('app.management.guru.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('can:create-user');

        return view('app.management.guru.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('can:create-user');

        $validatedData = $request->validate([
            'NUPTK' => 'required',
            'name' => 'required',
            'username' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'kompetensi' => 'required',
            'rfid' => 'required'
        ]);

        // CHECK
        $user = User::where('NUPTK', $request->NUPTK)->first();
        if ($user) {
            Session::flash('error', 'Data guru ini sudah ada');
            return redirect()->route('management.guru.index');
        }

        // MENYIMPAN DATA KE DATABASE
        $user = User::create($validatedData);

        // SIMPAN FOTO JIKA ADA
        $request->file('foto')->store('public/images');
        $user->foto = $request->file('foto')->hashName();
        $user->save();

        // TAMBAHKAN ROLE
        $user->assignRole($request->input('role'));

        return redirect()->route('management.guru.index')->with('success', 'Guru baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('can:view-user');

        $user = User::findOrFail($id);

        return view('app.management.guru.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('can:edit-user');

        $user = User::findOrFail($id);

        return view('app.management.guru.edit', compact('user'));
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
        $this->middleware('can:edit-user');

        // VALIDASI
        $validatedData = $request->validate([
            'NUPTK' => 'required',
            'name' => 'required',
            'username' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'kompetensi' => 'required',
            'rfid' => 'required'
        ]);
    
        // CHECK APAKAH DATA SUDAH ADA DI DATABASE KECUALI YANG SEDANG DI UPDATE
        $user = User::where('NUPTK', $request->NUPTK)->where('id', '<>', $id)->first();
        if ($user) {
            Session::flash('error', 'Data guru dengan NUPTK ini sudah ada');
            return redirect()->route('management.guru.edit', $id);
        }
    
        // UPDATE DATA KE DATABASE
        $user = User::findOrFail($id);
        $user->update($validatedData);
    
        // SIMPAN FOTO JIKA ADA
        if ($request->hasFile('foto')) {
            Storage::delete('public/images/'.$user->foto);
            $request->file('foto')->store('public/images');
            $user->foto = $request->file('foto')->hashName();
            $user->save();
        }
    
        // UPDATE ROLE
        $user->syncRoles($request->input('role'));
    
        return redirect()->route('management.guru.index')->with('success', 'Data guru berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('can:delete-user');

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('management.guru.index')->with('success','Kompetensi berhasil dihapus');
    }
}

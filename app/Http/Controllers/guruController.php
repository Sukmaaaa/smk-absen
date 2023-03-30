<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\kabupatenKota;
use App\Models\kompetensi;
use App\Models\userHasKompetensi;
use Session;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


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

        $kabupatenKota = kabupatenKota::all();
        $kompetensi = kompetensi::all();
        $role = Role::all();

        return view('app.management.guru.create', compact('kabupatenKota', 'kompetensi', 'role'));
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

        // MENGAMBIL INPUT DARI KOMPETENSI
        $kompetensi = kompetensi::find($request->input('kompetensi'));

        // VALIDASI
        $validatedData = $request->validate([
            'NUPTK' => 'required',
            'name' => 'required',
            'username' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'rfid' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
        ]);
        
        // MENGAMBIL INPUT PASSWORD LALU DIHASH
        $validatedData['password'] = Hash::make($request->input('password'));

        // CHECK
        $user = User::where('NUPTK', $request->NUPTK)->first();
        if ($user) {
            Session::flash('error', 'Data guru ini sudah ada');
            return redirect()->route('management.guru.index');
        } 
        // MENYIMPAN DATA KE DATABASE
        $user = User::create($validatedData);

        // SIMPAN FOTO JIKA ADA
        if($request->file('foto')){
            $file= $request->file('foto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/images'), $filename);
            $user['foto']= $filename;
        }

        $user->save();

        // TAMBAHKAN ROLE
        $user->assignRole($request->role);

        // MENAMBAH KOMPETENSI GURU
        userHasKompetensi::create([
            'user_id' => $user->id,
            'kompetensi_id' => $kompetensi->id
        ]);

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
        $role = Role::find($id);
        // $kabupatenKota = kabupatenKota::all();
        // $kompetensi = kompetensi::all();
        $userHasKompetensi = userHasKompetensi::where('kompetensi_id', $id)->first();

        return view('app.management.guru.show', compact('user', 'role', 'userHasKompetensi'));
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
        $kabupatenKota = kabupatenKota::all();
        $kompetensi = kompetensi::all();
        $role = Role::all();

        return view('app.management.guru.edit', compact('user', 'kabupatenKota', 'kompetensi', 'role'));
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

        // AMBIL INPUT NUPTK, CHECK APAKAH ADA YANG SAMA KECUALI YANG SEDANG DI UPDATE
        $user = User::where('NUPTK', $request->NUPTK)->where('id', '<>', $id)->first();

        // AMBIL INPUT KOMPETENSI
        $kompetensi = kompetensi::find($request->input('kompetensi'));

        // AMBIL KOMPETENSI DENGAN USER YANG SESUAI
        $userHasKompetensi = userHasKompetensi::where('user_id', $id)->first();

        // JIKA USER DENGAN NUPTK DIINPUT SUDAH ADA
        if ($user) {
            if ($user->NUPTK == $request->NUPTK) {
                return redirect()->route('management.guru.edit', $id)->with('error', 'Data guru dengan NUPTK ini sudah ada');
            }
        } else { 
            //USER DENGAN YANG DIINPUT BELUM ADA

            // JIKA PASSWORD KOSONG
            if (empty($request->password)) {
                 // VALIDASI
                 $validatedData = $request->validate([
                    'NUPTK' => 'required',
                    'name' => 'required',
                    'username' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'jenis_kelamin' => 'required',
                    'rfid' => 'required',
                ]); 
                    
                // UPDATE DATA KE DATABASE
                $user = User::findOrFail($id);
                $user->update($validatedData);
            
                // SIMPAN FOTO JIKA ADA
                if($request->file('foto')){
                    $file= $request->file('foto');
                    $filename= date('YmdHi').$file->getClientOriginalName();
                    $file-> move(public_path('public/images'), $filename);
                    $user['foto']= $filename;
                }

                // UPDATE FOTO
                $user->save();
            
                // UPDATE ROLE
                $user->syncRoles($request->input('role'));

                // UPDATE ROLE
                $user->save();

                // JIKA DATA KOMPETENSI GURU ADAA
                if ($userHasKompetensi) {
                    // MEMPERBARUI KOMPETENSI GURU
                    $userHasKompetensi->update([
                        'user_id' => $user->id,
                        'kompetensi_id' => $kompetensi->id
                    ]);

                    $userHasKompetensi->save();

                    return redirect()->route('management.guru.index')->with('success', 'Data guru berhasil diperbaharui');
                } else {
                    // MEMBUAT KOMPETENSI GURU
                    userHasKompetensi::create([
                        'user_id' => $user->id,
                        'kompetensi_id' => $kompetensi->id
                    ]);
    
                    return redirect()->route('management.guru.index')->with('success', 'Data guru berhasil diperbaharui');
                }
            } else {
                 // JIKA PASSWORD DIISI

                //  VALIDASI
                $validatedData = $request->validate([
                    'NUPTK' => 'required',
                    'name' => 'required',
                    'username' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'jenis_kelamin' => 'required',
                    'rfid' => 'required',
                    'password' => 'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                ]); 
                    

                if ($request->password != $request->password_baru) {
                    return redirect()->route('management.guru.edit', $id)->with('error', 'Password baru tidak cocok.');
                } else {
                    // HASH PASSWORD
                    $validatedData['password'] = Hash::make($request->password);
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

                // UPDATE ROLE
                $user->save();

                // MEMPERBAHARUI KOMPETENSI GURU
                if ($userHasKompetensi) {
                    // MEMPERBARUI KOMPETENSI GURU
                    $userHasKompetensi->update([
                        'user_id' => $user->id,
                        'kompetensi_id' => $kompetensi->id
                    ]);

                    $userHasKompetensi->save();

                    return redirect()->route('management.guru.index')->with('success', 'Data guru berhasil diperbaharui');
                } else {
                    // MEMBUAT KOMPETENSI GURU
                    userHasKompetensi::create([
                        'user_id' => $user->id,
                        'kompetensi_id' => $kompetensi->id
                    ]);
    
                    return redirect()->route('management.guru.index')->with('success', 'Data guru berhasil diperbaharui');
                }
            }
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
        $this->middleware('can:delete-user');

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('management.guru.index')->with('success','Data guru berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\kabupatenKota;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class profilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $kabupatenKota = kabupatenKota::all();

        return view('app.profil.index', compact('user', 'kabupatenKota'));
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
        if (empty($request->password)) {
            // VALIDASI
            $validatedData = $request->validate([
                'name'              =>  'required',
                'username'          =>  'required',
                'tempat_lahir'      =>  'required',
                'tanggal_lahir'     =>  'required',
                'jenis_kelamin'     =>  'required',
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

            return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbaharui.');
        } else {
            // VALIDASI
            $validatedData = $request->validate([
                'name'              =>  'required',
                'username'          =>  'required',
                'tempat_lahir'      =>  'required',
                'tanggal_lahir'     =>  'required',
                'jenis_kelamin'     =>  'required',
                'password'          =>  'nullable|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            ]);

            // CHECK APAKAH PASSWORD SESUAI ATAU TIDAK
            if ($request->password != $request->password_baru) {
                return redirect()->route('profil.index')->with('error', 'Password baru tidak cocok.');
            } else {
                // HASH PASSWORD
                $validatedData['password'] = Hash::make($request->password);
            }

            // UPDATE DATA KE DATABASE
            $user = User::findOrFail($id);
            $user->update($validatedData);

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

            return redirect()->route('profil.index')->with('success', 'Profil berhasil diperbaharui.');
        }
    }

}

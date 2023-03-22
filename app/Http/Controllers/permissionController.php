<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Session;

class permissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-permission');

        $permission = Permission::all();

        return view('app.permission.index', compact('permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('can:create-permission');

        return view('app.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('can:create-permission');

        // VALIDASI INPUT
        $request->validate([
            'name' => 'required'
        ]);

        // CEK APAKAH PERMISSION SUDAH ADA ATAU BELUM
        $permission = Permission::where('name', $request->name)->first();
        if ($permission) {
            Session::flash('error', 'Izin ini sudah ada');
            return redirect()->route('permission.index');
        }

        // SIMPAN DATA
        $permission = new permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permission.index')->with('success', 'Izin baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $this->middleware('can:view-permission');

        // $permission = Permission::findOrFail($id);

        // return view('app.permission.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware('can:edit-permission');

        $permission = Permission::findOrFail($id);

        return view('app.permission.edit', compact('permission'));
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
        $this->middleware('can:edit-permission');

        // VALIDASI
        $request->validate([
            'name' => 'required'
        ]);

        // CEK APAKAH PERMISSION SUDAH ADA ATAU BELUM KECUALI YANG SEDANG DI EDIT
        $permission = Permission::where('name', $request->name)->where('id', '<>', $id)->first();
        if ($permission) {
            Session()->flash('error', 'Izin ini sudah ada');
            return redirect()->route('permission.index');
        }

        // UPDATE DATA
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permission.index')->with('success', 'Izin berhasil diperbaharui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('can:delete-permission');

        $permission = Permission::findOrFail($id);
        $permission->delete();
    
        return redirect()->route('permission.index')->with('success','permission berhasil dihapus');
    }
}

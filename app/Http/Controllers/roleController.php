<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class roleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('can:view-role');

        $role = Role::all();

        return view('app.roles.index')->with(['role' => $role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('can:create-role');

        $permissions = Permission::all();

        return view('app.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware('can:create-role');

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        if (Role::where('name', '=', $request->name)->exists()) {
            return redirect()->route('role.index')->with('error', 'Role ini sudah ada.');
        } else{
            $role = Role::create(['name' => $request->name]);
            $role->givePermissionTo($request->permission);

        return redirect()->route('role.index')->with
        ('success', 'Role baru berhasil ditambahkan.');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->middleware('can:view-role');

        $role = Role::find($id);

        $getAllPermissions = $role->getAllPermissions()->pluck('name')->toArray();

        return view('app.roles.show')->with([
            'role' => $role,
            'permissions' => Permission::all(),
            'rolePermissions' => $getAllPermissions
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        $getAllPermissions = $role->getAllPermissions()->pluck('name')->toArray();
        
        return view('app.roles.edit')->with([
            'role' => $role,
            'permissions' => Permission::all(),
            'rolePermissions' => $getAllPermissions
        ]);
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
        $this->middleware('can:edit-role');

        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        if (Role::where('name', '=', $request->name)->exists()) {
            return redirect()->route('role.index')->with('error', 'Peran ini sudah ada.');
        } else{
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->save();
        
            $role->syncPermissions($request->input('permission'));

            return redirect()->route('role.index')->with('success', 'Peran berhasil diperbaharui');
        };
    
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('can:delete-role');

        $role = Role::find($id);
        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role berhasil dihapus');
    }
}

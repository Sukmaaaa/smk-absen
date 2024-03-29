<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // MEMBUAT PERMISSION USER
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);
        // MEMBUAT PERMISSION MURID
        Permission::create(['name' => 'view-murid']);
        Permission::create(['name' => 'create-murid']);
        Permission::create(['name' => 'edit-murid']);
        Permission::create(['name' => 'delete-murid']);
        // MEMBUAT PERMISSION KOMPETENSI (UNTUK GURU)
        Permission::create(['name' => 'view-kompetensi']);
        Permission::create(['name' => 'create-kompetensi']);
        Permission::create(['name' => 'edit-kompetensi']);
        Permission::create(['name' => 'delete-kompetensi']);
        // MEMBUAT PERMISSION JURUSAN
        Permission::create(['name' => 'view-jurusan']);
        Permission::create(['name' => 'create-jurusan']);
        Permission::create(['name' => 'edit-jurusan']);
        Permission::create(['name' => 'delete-jurusan']);
        // MEMBUAT PERMISSION KELAS YANG MENGAMBIL JURUSAN (UNTUK MURID)
        Permission::create(['name' => 'view-kelas']);
        Permission::create(['name' => 'create-kelas']);
        Permission::create(['name' => 'edit-kelas']);
        Permission::create(['name' => 'delete-kelas']);
        // MEMBUAT PERMISSION MEMBUAT IZIN
        Permission::create(['name' => 'view-permission']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'edit-permission']);
        Permission::create(['name' => 'delete-permission']);
        // MEMBUAT PERMISSION MEMBUAT ROLE
        Permission::create(['name' => 'view-role']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'edit-role']);
        Permission::create(['name' => 'delete-role']);
        // MEMBUAT PERMISSION KEHADIRAN GURU
        Permission::create(['name' => 'view-kehadiran-guru']);
        Permission::create(['name' => 'create-kehadiran-guru']);
        Permission::create(['name' => 'edit-kehadiran-guru']);
        // MEMBUAT PERMISSION KEHADIRAN MURID
        Permission::create(['name' => 'view-kehadiran-murid']);
        Permission::create(['name' => 'create-kehadiran-murid']);
        Permission::create(['name' => 'edit-kehadiran-murid']);
        // LOG
        Permission::create(['name' => 'view-audit']);

        // MEMBUAT ROLE
        $superAdmin = Role::create([
            'name' => 'super admin',
            'guard_name' => 'web'
        ]);

        $admin = Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

        $user = Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);

        // MEMBUAT PERMISSION UNTUK ROLE
        $superAdmin->givePermissionTo([
            // HALAMAN USER
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            // HALAMAN MURID
            'view-murid',
            'create-murid',
            'edit-murid',
            'delete-murid',
            // HALAMAN KOMPETENSI
            'view-kompetensi',
            'create-kompetensi',
            'edit-kompetensi',
            'delete-kompetensi',
            // HALAMAN JURUSAN
            'view-jurusan',
            'create-jurusan',
            'edit-jurusan',
            'delete-jurusan',
            // HALAMAN KELAS
            'view-kelas',
            'create-kelas',
            'edit-kelas',
            'delete-kelas',
            // HALAMAN PERMISSION
            'view-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',
            // HALAMAN ROLE
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            // HALAMAN KEHADIRAN GURU
            'view-kehadiran-guru',
            'create-kehadiran-guru',
            'edit-kehadiran-guru',
            // HALAMAN KEHADIRAN MURID
            'view-kehadiran-murid',
            'create-kehadiran-murid',
            'edit-kehadiran-murid',
            // AUDIT
            'view-audit'
        ]);
        $admin->givePermissionTo([
            // HALAMAN USER
            'view-user',
            'create-user',
            'edit-user',
            'delete-user',
            // HALAMAN MURID
            'view-murid',
            'create-murid',
            'edit-murid',
            'delete-murid',
            // HALAMAN KOMPETENSI
            'view-kompetensi',
            'create-kompetensi',
            'edit-kompetensi',
            'delete-kompetensi',
            // HALAMAN JURUSAN
            'view-jurusan',
            'create-jurusan',
            'edit-jurusan',
            'delete-jurusan',
            // HALAMAN KELAS
            'view-kelas',
            'create-kelas',
            'edit-kelas',
            'delete-kelas',
            // HALAMAN PERMISSION
            'view-permission',
            'create-permission',
            'edit-permission',
            'delete-permission',
            // HALAMAN ROLE
            'view-role',
            'create-role',
            'edit-role',
            'delete-role',
            // HALAMAN KEHADIRAN GURU
            'view-kehadiran-guru',
            'create-kehadiran-guru',
            'edit-kehadiran-guru',
            // HALAMAN KEHADIRAN MURID
            'view-kehadiran-murid',
            'create-kehadiran-murid',
            'edit-kehadiran-murid',
            'view-audit',
        ]);
        $user->givePermissionTo([
            // HALAMAN KEHADIRAN GURU
            'view-kehadiran-guru',
            // HALAMAN KEHADIRAN MURID
            'view-kehadiran-murid',
            'view-role',
            'view-permission',
        ]);
    }
}

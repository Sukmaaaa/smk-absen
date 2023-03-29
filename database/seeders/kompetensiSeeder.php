<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\kompetensi;

class kompetensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        kompetensi::create([
            'namaKompetensi'  =>  'Matematika',
            'deskripsi'  =>  'Matematika aja'
        ]);
        kompetensi::create([
            'namaKompetensi'  =>  'Indonesia',
            'deskripsi'  =>  'Indonesia dulu gak sih'
        ]);
    }
}

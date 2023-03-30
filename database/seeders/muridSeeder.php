<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\murid;
use Carbon\Carbon;

class muridSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        murid::create([
            'NIS'               =>  '12932111',
            'nama'              =>  'Anhar Raditya',
            'tempat_lahir'      =>  'Kota Bandung',
            'tanggal_lahir'     =>  '2004-11-20',
            'tempat_tinggal'    =>  'Jl. Pemudi Pemuda No.12 Kelurahan Kampung Priok RT.02 RW.05',
            'jenis_kelamin'     =>  'Laki-laki',
            'kelas'             =>  'XII',
            'jurusan'           =>  'RPL',
            'rfid'              =>  '0x2e 10wx 1921 0xqkl'
        ]);
    }
}

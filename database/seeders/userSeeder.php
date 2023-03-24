<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\murid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        // $n = 1000; // JUMLAH USER YANG AKAN DIBUAT
        // $min = pow(10, 15); // NILAI MINIMUM
        // $max = pow(10, 16) - 1; // NILAI MAKSIMUM
        // $randomIntegers = [];

        // while (count($randomIntegers) < $n) {
        //     $randomInteger = rand($min, $max);
        //     // MEMASTIKAN BELUM PERNAH DIPAKAI
        //     if (!in_array($randomInteger, $randomIntegers) && !User::where('NUPTK', $randomInteger)->exists()) {
        //         $randomIntegers[] = $randomInteger;
        //     }
        // }

        // for ($i = 0; $i < $n; $i++) {
        //     User::create([
        //         'NUPTK' => $randomIntegers[$i],
        //         'name' => 'User ' . ($i+1),
        //         'username' => 'user' . ($i+1),
        //         'tempat_lahir' => 'Bandung',
        //         'tanggal_lahir' => '2004-11-29',
        //         'jenis_kelamin' => 'laki-laki',
        //         'kompetensi' => 'Matematika',
        //         'password' => Hash::make('password'),
        //         'RFID' => '0x39 0x2e 0x6f 0x4a'
        //     ]);
        // }


        User::create([
            'NUPTK' => '0000000000',
            'name' => 'SMK BPI',
            'username' => 'SMK_BPI',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'laki-laki',
            'kompetensi' => 'Matematika',
            'password' => Hash::make('SMKBISA'),
            'RFID' => '0000 0000 0000 0000'
        ])->assignRole('super admin');

        User::create([
            'NUPTK' => '1',
            'name' => 'Sukma',
            'username' => 'sukma_ajh',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2004-11-29',
            'jenis_kelamin' => 'laki-laki',
            'kompetensi' => 'Matematika',
            'password' => Hash::make('hehe'),
            'RFID' => '0x39 0x2e 0x6f 0x4a'
        ])->assignRole('admin');

        User::create([
            'NUPTK' => '2',
            'name' => 'Alif',
            'username' => 'alif_fatur',
            'tempat_lahir' => 'Tonasa',
            'tanggal_lahir' => '2005-12-13',
            'jenis_kelamin' => 'laki-laki',
            'kompetensi' => 'WEB',
            'password' => Hash::make('hehe'),
            'RFID' => '0x39 0x2e 0x6f 0x41'
        ])->assignRole('user');

        User::create([
            'NUPTK' => '3',
            'name' => 'Naufal',
            'username' => 'naufal_firmansyah',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2004-11-23',
            'jenis_kelamin' => 'laki-laki',
            'kompetensi' => 'Basis Data',
            'password' => Hash::make('hehe'),
            'RFID' => '0x39 0x2e 0x6f 0x5a'
        ]);

        User::create([
            'NUPTK' => '4',
            'name' => 'Umar',
            'username' => 'muh_umar',
            'tempat_lahir' => 'Bandung',
            'tanggal_lahir' => '2004-11-20',
            'jenis_kelamin' => 'laki-laki',
            'kompetensi' => 'Pendidikan Agama Islam',
            'password' => Hash::make('hehe'),
            'RFID' => '0x39 0x2e 0x6f d01x'
        ]);

        murid::create([
            'name' => 'Anhar',
            'RFID' => '0x39 0x2e 0x6f xxxx',
        ]);
    }
}

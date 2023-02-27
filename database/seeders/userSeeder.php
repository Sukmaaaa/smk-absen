<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        User::create([
            'name' => 'Sukma',
            'username' => 'sukma_ajh',
            'password' => Hash::make('hehe'),
            'RFID' => '0x39 0x2e 0x6f 0x4a'
        ]);
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(kabupatenKotaSeeder::class);
        $this->call(kompetensiSeeder::class);
        $this->call(jurusanSeeder::class);
        $this->call(roleSeeder::class);
        $this->call(userSeeder::class);
        $this->call(muridSeeder::class);
        // \App\Models\User::factory(10)->create();
    }
}

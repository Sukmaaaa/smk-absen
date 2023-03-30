<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\jurusan;

class jurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        jurusan::create([
            'namaJurusan'   =>  'RPL',
            'deskripsi'     =>  'RPL adalah jurusan yang berfokus pada pengembangan perangkat lunak atau software. Dalam jurusan RPL murid akan mempelajari dasar-dasar pemrograman, analisis dan desain sistem, manajemen proyek perangkat lunak serta pengujian dan perawatan perangkat lunak.'
        ]);

        jurusan::create([
            'namaJurusan'   =>  'TKJ',
            'deskripsi'     => 'Jurusan TKJ atau Teknik Komputer dan Jaringan adalah sebuah program studi di bidang teknik yang fokus pada pengembangan dan pemanfaatan teknologi informasi dan komunikasi, khususnya dalam hal jaringan komputer dan sistem komputer. Dalam jurusan TKJ, murid akan mempelajari dasar-dasar pemrograman, jaringan komputer, administrasi sistem, pengolahan data, keamanan jaringan, dan teknologi terbaru dalam bidang teknologi informasi. Selain itu, murid TKJ juga akan diajarkan keterampilan praktis, seperti merancang, menginstal, mengelola, dan memperbaiki jaringan dan sistem komputer.'
        ]);

        jurusan::create([
            'namaJurusan'   =>  'OTKP',
            'deskripsi'     =>  'Jurusan OTKP atau Otomatisasi Tata Kelola Perkantoran adalah program studi di bidang administrasi yang fokus pada penggunaan teknologi informasi untuk meningkatkan efisiensi dan efektivitas tata kelola perkantoran. Dalam jurusan OTKP, murid akan mempelajari dasar-dasar administrasi perkantoran, penggunaan perangkat lunak perkantoran, pengolahan data, manajemen informasi, keamanan informasi, serta kemampuan berkomunikasi dan berkolaborasi dalam lingkungan perkantoran modern yang terintegrasi dengan teknologi informasi.'
        ]);
    }
}

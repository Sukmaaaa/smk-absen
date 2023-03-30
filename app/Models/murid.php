<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class murid extends Model
{
    use HasFactory;

    protected $fillable = [
        'NIS', 
        'foto', 
        'nama', 
        'tempat_lahir', 
        'tanggal_lahir', 
        'tempat_tinggal', 
        'jenis_kelamin', 
        'kelas', 
        'jurusan', 
        'rfid'
    ];
}

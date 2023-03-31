<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class murid extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

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

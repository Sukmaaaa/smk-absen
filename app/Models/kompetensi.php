<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kompetensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'namaKompetensi',
        'deskripsi',
    ];

    public function userHasKompetensi(){
        return $this->hasMany(UserHasKompetensi::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class kompetensi extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'namaKompetensi',
        'deskripsi',
    ];

    public function userHasKompetensi(){
        return $this->hasMany(UserHasKompetensi::class);
    }
}

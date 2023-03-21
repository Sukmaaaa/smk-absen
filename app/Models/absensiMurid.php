<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensiMurid extends Model
{
    use HasFactory;

    protected $fillable = [
        'murid_id',
        'absen_hadir',
        'absen_pulang'
    ];

    public function murid()
    {
        return $this->belongsTo(murid::class);
    }
}

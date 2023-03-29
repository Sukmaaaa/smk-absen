<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userHasKompetensi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kompetensi_id'
    ];

    public function user()
    {
        // $this->hasOne(User::class);
        return $this->belongsTo(User::class);
    }

    public function kompetensi()
    {
        // $this->hasMany(kompetensi::class);
        return $this->belongsTo(kompetensi::class);
    }
}

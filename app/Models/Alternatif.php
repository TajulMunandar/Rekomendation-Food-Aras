<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function NilaiAlternatif()
    {
        return $this->hasMany(NilaiAlternatif::class, 'alternatif_id', 'id');
    }
}

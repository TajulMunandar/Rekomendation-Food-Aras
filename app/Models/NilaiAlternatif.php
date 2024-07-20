<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAlternatif extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function Alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }
    public function Kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }
}

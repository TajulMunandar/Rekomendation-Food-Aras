<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $guarded = [
        'id'
    ];

    public function Pasien()
    {
        return $this->hasOne(DataPasien::class, 'aktivitas_id', 'id');
    }
}

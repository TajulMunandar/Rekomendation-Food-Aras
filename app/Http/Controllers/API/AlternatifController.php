<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index()
    {
        $data = NilaiAlternatif::with(['alternatif', 'kriteria'])
            ->latest()
            ->get(['id', 'alternatif_id', 'kriteria_id', 'nilai'])
            ->groupBy('alternatif_id') // Kelompokkan data berdasarkan alternatif_id
            ->map(function ($group) {
                $alternatif = $group->first()->alternatif; // Ambil alternatif dari grup
                $kriteria = $group->map(function ($item) {
                    return [
                        'kriteria_nama' => $item->kriteria->nama,
                        'nilai' => $item->nilai,
                    ];
                });

                return [
                    'alternatif_id' => $alternatif->id,
                    'alternatif_nama' => $alternatif->nama,
                    'kriteria' => $kriteria,
                ];
            });

        return response()->json(['foods' => $data], 200);
    }
}

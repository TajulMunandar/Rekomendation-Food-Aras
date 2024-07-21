<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\DataPasien;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class ArasController extends Controller
{
    public function index()
    {
        $title = "SPK ARAS";
        $kriteria = Kriteria::all();
        $alternatifs = Alternatif::all();
        $alternatifNilai = NilaiAlternatif::all();
        $pasien = DataPasien::first();

        // Normalisasi Matriks Keputusan
        $normalizedMatrix = [];
        foreach ($kriteria as $k) {
            $nilaiKriteria = $alternatifNilai->where('kriteria_id', $k->id)->pluck('nilai');
            $max = $nilaiKriteria->max();
            $min = $nilaiKriteria->min();

            foreach ($alternatifNilai->where('kriteria_id', $k->id) as $n) {
                if ($k->atribut == 'benefit') {
                    $normalizedMatrix[$n->alternatif_id][$n->kriteria_id] = $max != 0 ? $n->nilai / $max : 0;
                } else { // Cost
                    $normalizedMatrix[$n->alternatif_id][$n->kriteria_id] = $n->nilai != 0 ? $min / $n->nilai : 0;
                }
            }
        }

        // Pembobotan Matriks Keputusan
        $weightedMatrix = [];
        foreach ($kriteria as $k) {
            foreach ($normalizedMatrix as $altId => $nilaiKriteria) {
                $weightedMatrix[$altId][$k->id] = $nilaiKriteria[$k->id] * $k->bobot;
            }
        }

        // Menghitung Nilai Akhir
        $finalValues = [];
        foreach ($weightedMatrix as $altId => $nilaiKriteria) {
            $finalValues[$altId] = array_sum($nilaiKriteria);
        }

        // Mengurutkan Alternatif Berdasarkan Nilai Akhir
        arsort($finalValues);

        // Mengambil alternatif berdasarkan urutan nilai akhir
        $sortedAlternatifs = [];
        foreach ($finalValues as $altId => $value) {
            $sortedAlternatifs[] = $alternatifs->find($altId);
        }

        return view('aras.index', compact('sortedAlternatifs', 'finalValues', 'title', 'pasien'));
    }
}

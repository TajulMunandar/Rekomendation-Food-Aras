<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Alternatif;
use App\Models\DataPasien;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use App\Models\User;
use Illuminate\Http\Request;

class ArasMobileController extends Controller
{
    public function index(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $kriteria = Kriteria::all();
        $alternatifs = Alternatif::all();
        $alternatifNilai = NilaiAlternatif::all();
        $pasien = DataPasien::where('user_id', $user->id)->first();

        if ($pasien) {
            $tinggiBadan = $pasien->tb; // dalam cm
            $beratBadan = $pasien->bb; // dalam kg
            $umur = $pasien->umur; // dalam tahun

            if ($pasien->User->jk == 'laki-laki') {
                // Rumus untuk laki-laki
                $kalori = 66 + (13.7 * $beratBadan) + (5 * $tinggiBadan) - (6.8 * $umur);
            } else {
                // Rumus untuk perempuan
                $kalori = 655 + (9.6 * $beratBadan) + (1.8 * $tinggiBadan) - (4.7 * $umur);
            }

            $fisik = $kalori * $pasien->Aktivitas->nilai;

            // Tambahkan hasil kalori ke data pasien
            $pasien->kalori = $fisik;
        }


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

            if ($k->nama == 'Kalori') {
                // Tambahkan nilai kalori pasien ke normalizedMatrix untuk pasien
                $normalizedMatrix[$pasien->id][$k->id] = $pasien->kalori != 0 ? $min / $pasien->kalori : 0;
            }
        }

        // Pembobotan Matriks Keputusan
        $weightedMatrix = [];
        foreach ($kriteria as $k) {
            foreach ($normalizedMatrix as $altId => $nilaiKriteria) {
                // Cek jika k->id ada di nilaiKriteria
                if (isset($nilaiKriteria[$k->id])) {
                    $weightedMatrix[$altId][$k->id] = $nilaiKriteria[$k->id] * $k->bobot;
                }
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
            $alternatif = $alternatifs->find($altId);
            if ($alternatif) {
                $sortedAlternatifs[] = $alternatif;
            }
        }


        $top5Alternatifs = array_slice($sortedAlternatifs, 0, 5);
        $top5Values = array_slice($finalValues, 0, 5, true);

        $formattedValues = array_map(function ($value) {
            return number_format($value, 2);
        }, $top5Values);

        $combinedResults = [];
        foreach ($top5Alternatifs as $alternatif) {
            $combinedResults[] = [
                'alternatif' => $alternatif,
                'value' => $formattedValues[$alternatif->id],
            ];
        }

        return response()->json(['data' => $combinedResults], 200);
    }
}

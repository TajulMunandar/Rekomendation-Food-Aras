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
        $pasien = DataPasien::where('user_id', 1)->first();

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
            $kolesterolPasien = $pasien->kolesterol;
        }

        $decisionMatrix = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriteria as $k) {
                $nilaiAlternatif = $alternatifNilai->where('alternatif_id', $alternatif->id)
                    ->where('kriteria_id', $k->id)
                    ->first();
                if ($nilaiAlternatif) {
                    $decisionMatrix[$alternatif->id][$k->id] = $nilaiAlternatif->nilai;
                } else {
                    $decisionMatrix[$alternatif->id][$k->id] = 0; // Atau nilai default lainnya
                }
            }
        }

        // Tambahkan alternatif dengan ID 0
        $alternatifZero = [
            'id' => 0,
            'nama' => 'Alternatif 0',
        ];

        // Tambahkan alternatif baru ke koleksi alternatif
        $alternatifs->prepend($alternatifZero);

        // Tetapkan nilai maksimum atau minimum untuk setiap kriteria
        foreach ($kriteria as $k) {
            $nilaiKriteria = $alternatifNilai->where('kriteria_id', $k->id)->pluck('nilai');
            $max = $nilaiKriteria->max();
            $min = $nilaiKriteria->min();

            if ($k->atribut == 'benefit') {
                $decisionMatrix[0][$k->id] = $max; // Nilai maksimum untuk kriteria tipe benefit
            } else {
                $decisionMatrix[0][$k->id] = $min; // Nilai minimum untuk kriteria tipe cost
            }
        }

        ksort($decisionMatrix);


        // Normalisasi Matriks Keputusan
        $normalizedMatrix = [];
        $inverseCostValues = [];
        foreach ($kriteria as $k) {
            $sumBenefit = 0;
            $sumCost = 0;

            foreach ($decisionMatrix as $altId => $nilaiKriteria) {
                if (isset($nilaiKriteria[$k->id])) {
                    if ($k->atribut == 'benefit') {
                        $sumBenefit += $nilaiKriteria[$k->id];
                    } else {
                        $inverseValue = $nilaiKriteria[$k->id] != 0
                            ? 1 / $nilaiKriteria[$k->id]
                            : 0; // Jika nilai kriteria 0, simpan 0
                        $inverseCostValues[$altId][$k->id] = $inverseValue; // Simpan invers ke array
                    }
                }
            }


            if ($k->atribut == 'cost') {
                $sumCost = array_sum(array_column($inverseCostValues, $k->id));
            }

            foreach ($decisionMatrix as $altId => $nilaiKriteria) {
                if (isset($nilaiKriteria[$k->id])) {
                    if ($k->atribut == 'benefit') {
                        $normalizedMatrix[$altId][$k->id] = $nilaiKriteria[$k->id] / $sumBenefit;
                    } else {
                        $normalizedMatrix[$altId][$k->id] = $sumCost != 0 ? $inverseCostValues[$altId][$k->id] / $sumCost : 0;
                    }
                }
            }
        }

        // Debug output untuk memastikan data benar
        if (!empty($normalizedMatrix)) {
            // Pastikan pasien tidak kosong dan memiliki nilai kalori
            if (isset($kalori)) {
                // Iterasi melalui setiap elemen di normalizedMatrix
                foreach ($normalizedMatrix as $key => $element) {
                    // Ambil key dari elemen pertama
                    $firstKey = array_key_first($element);
                    // Ambil nilai pertama dan bagi dengan kalori pasien
                    $normalizedMatrix[$key][$firstKey] = $element[$firstKey] / $kalori;
                }

                // Tampilkan hasilnya
                // dd($normalizedMatrix);
            } else {
                echo "Kalori pasien tidak ditemukan.";
            }
        } else {
            echo "normalizedMatrix kosong.";
        }

        if (!empty($normalizedMatrix)) {
            // Pastikan pasien tidak kosong dan memiliki nilai kalori
            // Iterasi melalui setiap elemen di normalizedMatrix
            foreach ($normalizedMatrix as $key => $element) {
                // Periksa apakah indeks ke-2 ada dalam elemen
                $values = array_values($element);

                if (isset($values[1])) {
                    // Ambil nilai kolesterol alternatif
                    $cholesterolAlternatif = $values[1];
                    $elementKeys = array_keys($element); // Dapatkan key asli dari elemen
                    $originalKey = $elementKeys[1];
                    // Bagi nilai kolesterol alternatif dengan kolesterol pasien
                    $normalizedMatrix[$key][$originalKey] = $cholesterolAlternatif != 0
                        ? $cholesterolAlternatif / $kolesterolPasien
                        : 0;
                }
            }
        } else {
            echo "normalizedMatrix kosong.";
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

        $utilityRelatif = [];
        $alternatifZeroValue = $finalValues[0];



        foreach ($finalValues as $altId => $value) {
            if ($altId != 0) { // Mengabaikan alternatif 0
                $utilityRelatif[$altId] = $alternatifZeroValue != 0 ? $value / $alternatifZeroValue : 0;
            }
        }

        // Mengurutkan Alternatif Berdasarkan Nilai Akhir
        arsort($utilityRelatif);

        // Mengambil alternatif berdasarkan urutan utility relatif
        $sortedAlternatifs = [];
        foreach ($utilityRelatif as $altId => $value) {
            $alternatif = $alternatifs->where('id', $altId)->first();
            if ($alternatif) {
                $sortedAlternatifs[] = $alternatif;
            }
        }

        return view('aras.index', compact('sortedAlternatifs', 'finalValues', 'title', 'pasien'));
    }
}

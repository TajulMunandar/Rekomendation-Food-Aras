<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alternatif = [
            ['kode' => 'A1', 'nama' => 'Alternatif 1'],
            ['kode' => 'A2', 'nama' => 'Alternatif 2'],
            ['kode' => 'A3', 'nama' => 'Alternatif 3'],
            ['kode' => 'A4', 'nama' => 'Alternatif 4'],
            ['kode' => 'A5', 'nama' => 'Alternatif 5'],
            ['kode' => 'A6', 'nama' => 'Alternatif 6'],
            ['kode' => 'A7', 'nama' => 'Alternatif 7'],
            ['kode' => 'A8', 'nama' => 'Alternatif 8'],
            ['kode' => 'A9', 'nama' => 'Alternatif 9'],
            ['kode' => 'A10', 'nama' => 'Alternatif 10'],
        ];

        foreach ($alternatif as $alt) {
            Alternatif::create($alt);
        }

        $nilai = [
            ['alternatif_id' => 1, 'kriteria_id' => 1, 'nilai' => 3],
            ['alternatif_id' => 1, 'kriteria_id' => 2, 'nilai' => 4],
            ['alternatif_id' => 1, 'kriteria_id' => 3, 'nilai' => 3],
            ['alternatif_id' => 1, 'kriteria_id' => 4, 'nilai' => 4],
            ['alternatif_id' => 1, 'kriteria_id' => 5, 'nilai' => 3],
            ['alternatif_id' => 1, 'kriteria_id' => 6, 'nilai' => 4],
            ['alternatif_id' => 1, 'kriteria_id' => 7, 'nilai' => 1],
            ['alternatif_id' => 2, 'kriteria_id' => 1, 'nilai' => 4],
            ['alternatif_id' => 2, 'kriteria_id' => 2, 'nilai' => 3],
            ['alternatif_id' => 2, 'kriteria_id' => 3, 'nilai' => 4],
            ['alternatif_id' => 2, 'kriteria_id' => 4, 'nilai' => 3],
            ['alternatif_id' => 2, 'kriteria_id' => 5, 'nilai' => 4],
            ['alternatif_id' => 2, 'kriteria_id' => 6, 'nilai' => 3],
            ['alternatif_id' => 2, 'kriteria_id' => 7, 'nilai' => 0],
        ];

        foreach ($nilai as $n) {
            DB::table('nilai_alternatifs')->insert($n);
        }
    }
}

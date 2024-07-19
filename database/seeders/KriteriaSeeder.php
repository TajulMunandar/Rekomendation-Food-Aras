<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kriteria;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteria::create([
            'kode' => 'C1',
            'nama' => 'Lemak Tak Jenuh',
            'bobot' => 0.5,
            'atribut' => 'benefit',
        ]);

        Kriteria::create([
            'kode' => 'C2',
            'nama' => 'Serat',
            'bobot' => 0.4,
            'atribut' => 'benefit',
        ]);

        Kriteria::create([
            'kode' => 'C3',
            'nama' => 'Kalori',
            'bobot' => 0.3,
            'atribut' => 'benefit',
        ]);

        Kriteria::create([
            'kode' => 'C4',
            'nama' => 'Protein',
            'bobot' => 0.2,
            'atribut' => 'benefit',
        ]);

        Kriteria::create([
            'kode' => 'C5',
            'nama' => 'Seng',
            'bobot' => 0.15,
            'atribut' => 'benefit',
        ]);

        Kriteria::create([
            'kode' => 'C6',
            'nama' => 'Vitamin C',
            'bobot' => 0.1,
            'atribut' => 'benefit',
        ]);

        Kriteria::create([
            'kode' => 'C7',
            'nama' => 'Harga',
            'bobot' => 0.05,
            'atribut' => 'cost',
        ]);
    }
}

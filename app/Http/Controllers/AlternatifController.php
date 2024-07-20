<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Alternatif";
        $alternatifs = Alternatif::with('NilaiAlternatif.Kriteria')->get();
        foreach ($alternatifs as $alternatif) {
            $nilaiString = $alternatif->NilaiAlternatif->map(function ($nilaiAlternatif) {
                return $nilaiAlternatif->kriteria->nama . ': ' . $nilaiAlternatif->nilai;
            })->implode(', ');

            $alternatif->nilaiString = $nilaiString;
        }
        $kriteria = Kriteria::all();

        return view('alternatif.index')->with(compact('title', 'alternatifs', 'kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'kode' => ['required', 'unique:alternatifs'],
                'nama' => 'required|max:255',
                'nilai_alternatif' => 'required|array',
                'nilai_alternatif.*' => 'required|numeric',
            ]);

            // Buat alternatif baru
            $alternatif = Alternatif::create([
                'kode' => $validatedData['kode'],
                'nama' => $validatedData['nama'],
            ]);

            // Simpan nilai alternatif terkait
            foreach ($request->nilai_alternatif as $kriteriaId => $nilai) {
                NilaiAlternatif::create([
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $kriteriaId,
                    'nilai' => $nilai,
                ]);
            }

            return redirect('/dashboard/alternatif')->with('success', 'Alternatif baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect('/dashboard/alternatif')->with('error', 'Terjadi kesalahan saat membuat alternatif: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Alternatif $alternatif)
    {
        try {
            $validatedData = $request->validate([
                'kode' => ['required', 'unique:alternatifs,kode,' . $alternatif->id],
                'nama' => 'required|max:255',
                'nilai.*' => 'required|numeric'
            ]);

            $alternatif->update([
                'kode' => $validatedData['kode'],
                'nama' => $validatedData['nama']
            ]);

            foreach ($request->nilai as $kriteriaId => $nilai) {
                $nilaiAlternatif = NilaiAlternatif::where('alternatif_id', $alternatif->id)
                    ->where('kriteria_id', $kriteriaId)
                    ->first();

                if ($nilaiAlternatif) {
                    $nilaiAlternatif->update(['nilai' => $nilai]);
                }
            }

            return redirect('/dashboard/alternatif')->with('success', 'Data alternatif berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect('/dashboard/alternatif')->with('error', 'Terjadi kesalahan saat mengupdate data alternatif: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        try {
            // Hapus semua nilai alternatif yang terkait dengan alternatif ini
            $alternatif->NilaiAlternatif()->delete();

            // Hapus alternatif itu sendiri
            $alternatif->delete();

            return redirect('/dashboard/alternatif')->with('success', "Alternatif $alternatif->nama berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/alternatif')->with('failed', "Alternatif $alternatif->nama tidak bisa dihapus karena sedang digunakan!");
        }
    }
}

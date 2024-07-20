<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class NilaiAlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Nilai Alternatif";
        $nilais = NilaiAlternatif::all();
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        return view('nilai-alternatif.index')->with(compact('title', 'nilais', 'alternatifs', 'kriterias'));
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
                'alternatif_id' => 'required',
                'kriteria_id' => 'required',
                'nilai' => 'required|numeric',
            ]);

            NilaiAlternatif::create($validatedData);

            return redirect('/dashboard/nilai-alternatif')->with('success', 'Nilai Alternatif baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect('/dashboard/nilai-alternatif')->with('error', 'Terjadi kesalahan saat membuat Nilai Alternatif: ' . $e->getMessage());
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
    public function update(Request $request, NilaiAlternatif $nilai_alternatif)
    {
        try {
            $rules = [
                'alternatif_id' => 'required',
                'kriteria_id' => 'required',
                'nilai' => 'required|numeric',
            ];

            $validatedData = $request->validate($rules);

            NilaiAlternatif::where('id', $nilai_alternatif->id)->update($validatedData);

            return redirect('/dashboard/nilai-alternatif')->with('success', 'Nilai Alternatif berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect('/dashboard/nilai-alternatif')->with('error', 'Terjadi kesalahan saat memperbaharui Nilai Alternatif: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NilaiAlternatif $nilai_alternatif)
    {
        try {
            NilaiAlternatif::destroy($nilai_alternatif->id);
            return redirect('/dashboard/nilai-alternatif')->with('success', "Nilai Alternatif" . $nilai_alternatif->Alternatif->nama . "berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/nilai-alternatif')->with('failed', "Nilai Alternatif" . $nilai_alternatif->Alternatif->nama . "tidak bisa dihapus karena sedang digunakan!");
        }
    }
}

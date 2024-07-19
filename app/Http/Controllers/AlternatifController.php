<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Alternatif";
        $alternatifs = Alternatif::all();
        return view('alternatif.index')->with(compact('title', 'alternatifs'));
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
            ]);

            Alternatif::create($validatedData);

            return redirect('/dashboard/alternatif')->with('success', 'alternatif baru berhasil dibuat!');
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
            $rules = [
                'nama' => 'required|max:255',
            ];

            if ($request->kode != $alternatif->kode) {
                $rules['kode'] = ['required', 'unique:alternatifs'];
            }

            $validatedData = $request->validate($rules);

            Alternatif::where('id', $alternatif->id)->update($validatedData);

            return redirect('/dashboard/alternatif')->with('success', 'alternatif berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect('/dashboard/alternatif')->with('error', 'Terjadi kesalahan saat memperbaharui alternatif: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Alternatif $alternatif)
    {
        try {
            Alternatif::destroy($alternatif->id);
            return redirect('/dashboard/alternatif')->with('success', "alternatif $alternatif->nama berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/alternatif')->with('failed', "alternatif $alternatif->nama tidak bisa dihapus karena sedang digunakan!");
        }
    }
}

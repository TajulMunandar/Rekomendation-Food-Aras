<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Kriteria";
        $kriterias = Kriteria::all();
        return view('kriteria.index')->with(compact('title', 'kriterias'));
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
                'kode' => ['required', 'unique:kriterias'],
                'nama' => 'required|max:255',
                'bobot' => 'required|numeric',
                'atribut' => 'required',
            ]);

            Kriteria::create($validatedData);

            return redirect('/dashboard/kriteria')->with('success', 'kriteria baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect('/dashboard/kriteria')->with('error', 'Terjadi kesalahan saat membuat kriteria: ' . $e->getMessage());
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
    public function update(Request $request, Kriteria $kriterium)
    {
        try {
            $rules = [
                'nama' => 'required|max:255',
                'bobot' => 'required|numeric',
                'atribut' => 'required',
            ];

            if ($request->kode != $kriterium->kode) {
                $rules['kode'] = ['required', 'unique:kriterias'];
            }

            $validatedData = $request->validate($rules);

            Kriteria::where('id', $kriterium->id)->update($validatedData);

            return redirect('/dashboard/kriteria')->with('success', 'kriteria berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect('/dashboard/kriteria')->with('error', 'Terjadi kesalahan saat memperbaharui kriteria: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriterium)
    {
        try {
            Kriteria::destroy($kriterium->id);
            return redirect('/dashboard/kriteria')->with('success', "kriteria $kriterium->nama berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/kriteria')->with('failed', "kriteria $kriterium->nama tidak bisa dihapus karena sedang digunakan!");
        }
    }
}

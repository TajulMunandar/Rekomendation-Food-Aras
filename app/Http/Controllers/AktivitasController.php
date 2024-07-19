<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Aktivitas";
        $aktivitases = Aktivitas::all();
        return view('aktivitas.index')->with(compact('title', 'aktivitases'));
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
                'nama' => 'required|max:255',
                'nilai' => 'required',
            ]);

            Aktivitas::create($validatedData);

            return redirect('/dashboard/aktivitas')->with('success', 'Aktivitas baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect('/dashboard/aktivitas')->with('error', 'Terjadi kesalahan saat membuat Aktivitas: ' . $e->getMessage());
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
    public function update(Request $request, Aktivitas $aktivita)
    {
        try {
            $rules = [
                'nama' => 'required|max:255',
                'nilai' => 'required',
            ];

            $validatedData = $request->validate($rules);

            Aktivitas::where('id', $aktivita->id)->update($validatedData);

            return redirect('/dashboard/aktivitas')->with('success', 'Aktivitas berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect('/dashboard/aktivitas')->with('error', 'Terjadi kesalahan saat memperbaharui aktivitas: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aktivitas $aktivita)
    {
        try {
            Aktivitas::destroy($aktivita->id);
            return redirect('/dashboard/aktivitas')->with('success', "Aktivitas $aktivita->nama berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/aktivitas')->with('failed', "Aktivitas $aktivita->nama tidak bisa dihapus karena sedang digunakan!");
        }
    }
}

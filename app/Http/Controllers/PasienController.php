<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\DataPasien;
use App\Models\User;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Data Pasien";
        $pasiens = DataPasien::all();
        $aktivitases = Aktivitas::all();
        $users = User::doesntHave('Pasien')->get();

        return view('pasien.index')->with(compact('title', 'pasiens', 'users', 'aktivitases'));
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
                'user_id' => 'required',
                'aktivitas_id' => 'required',
                'tb' => 'required|numeric',
                'bb' => 'required|numeric',
                'kolesterol' => 'required|numeric',
                'lemak' => 'required|numeric',
                'serat' => 'required|numeric',
                'protein' => 'required|numeric',
            ]);

            DataPasien::create($validatedData);

            return redirect('/dashboard/pasien')->with('success', 'pasien baru berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect('/dashboard/pasien')->with('error', 'Terjadi kesalahan saat membuat pasien: ' . $e->getMessage());
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
    public function update(Request $request, DataPasien $pasien)
    {
        try {
            $rules = [
                'user_id' => 'required',
                'aktivitas_id' => 'required',
                'tb' => 'required|numeric',
                'bb' => 'required|numeric',
                'kolesterol' => 'required|numeric',
                'lemak' => 'required|numeric',
                'serat' => 'required|numeric',
                'protein' => 'required|numeric',
            ];

            $validatedData = $request->validate($rules);

            DataPasien::where('id', $pasien->id)->update($validatedData);

            return redirect('/dashboard/pasien')->with('success', 'pasien berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect('/dashboard/pasien')->with('error', 'Terjadi kesalahan saat memperbaharui pasien: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DataPasien $pasien)
    {
        try {
            DataPasien::destroy($pasien->id);
            return redirect('/dashboard/pasien')->with('success', "kriteria" . $pasien->User->name . "berhasil dihapus!");
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/dashboard/pasien')->with('failed', "kriteria" . $pasien->User->name . "tidak bisa dihapus karena sedang digunakan!");
        }
    }
}

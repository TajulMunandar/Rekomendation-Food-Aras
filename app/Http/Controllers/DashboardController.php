<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard()
    {
        $aktivitas = Aktivitas::count();
        $kriteria = Kriteria::count();
        $alternatif = Alternatif::count();
        $nilai = NilaiAlternatif::count();
        $title = "Dashboard ";
        return view('dashboard')->with(compact('title', 'aktivitas', 'kriteria', 'alternatif', 'nilai'));
    }
}

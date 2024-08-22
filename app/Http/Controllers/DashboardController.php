<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Log;
use App\Models\NilaiAlternatif;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show the dashboard page.
     *
     * @return \Illuminate\View\View
     */
    public function dashboard(Request $request)
    {
        $check = Log::where('visitor_ip', $request->ip())->whereDate('created_at', '=', (new \DateTime())->format('Y-m-d'))->first();

        if (!isset($check)) {
            Log::create(['visitor_ip' => $request->ip()]);
        }

        $chartData = [];
        $chartLabels = [];
        $data = $this->grafis();

        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        foreach ($data as $record) {
            $formattedDate = date('d M Y', strtotime($record->visit_date));
            if ($record->visit_date == $today) {
                $chartLabels[] = "Hari Ini";
            } else if ($record->visit_date == $yesterday) {
                $chartLabels[] = "Kemarin";
            } else {
                $chartLabels[] = $formattedDate;
            }
            $chartData[] = $record->record_count;
        }


        $aktivitas = Aktivitas::count();
        $kriteria = Kriteria::count();
        $alternatif = Alternatif::count();
        $nilai = NilaiAlternatif::count();
        $title = "Dashboard ";
        return view('dashboard')->with(compact('title', 'aktivitas', 'kriteria', 'alternatif', 'nilai', 'chartLabels', 'chartData'));
    }

    public function grafis()
    {
        $startDate = Carbon::now()->subWeek(); // Tanggal mulai satu minggu yang lalu
        $endDate = Carbon::now(); // Tanggal sekarang
        $grafis = DB::table('logs')
            ->select(DB::raw('DATE(created_at) as visit_date'), DB::raw('COUNT(*) as record_count'))
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->whereTime('created_at', '>=', '00:00:00')
            ->whereTime('created_at', '<=', '23:59:59')
            ->groupBy('visit_date')
            ->orderBy('visit_date', 'asc')
            ->get();
        return $grafis;
    }
}

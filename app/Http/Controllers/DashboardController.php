<?php

namespace App\Http\Controllers;

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
        $title = "Dashboard ";
        return view('dashboard')->with(compact('title'));
    }
}

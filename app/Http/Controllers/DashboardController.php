<?php

namespace App\Http\Controllers;

use App\Models\MasterTicketing;
use App\Models\ProjectHeader;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProject   = ProjectHeader::count();
        $totalTicketing = MasterTicketing::count();
        $totalTesting   = ProjectHeader::whereNotNull('test_date')->count();
        $totalUsers     = User::count();
        $recentProjects = ProjectHeader::with('developer')->latest()->take(5)->get();

        return view('dashboard.index', compact(
            'totalProject',
            'totalTicketing',
            'totalTesting',
            'totalUsers',
            'recentProjects'
        ));
    }
}

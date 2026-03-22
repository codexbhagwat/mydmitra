<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total'       => $user->applications()->count(),
            'completed'   => $user->applications()->where('status', 'completed')->count(),
            'in_progress' => $user->applications()->where('status', 'in_progress')->count(),
            'pending'     => $user->applications()->where('status', 'pending')->count(),
        ];

        $recentApplications = $user->applications()
            ->with('service')
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'recentApplications'));
    }

    public function applications()
    {
        $applications = auth()->user()->applications()->with('service')->latest()->paginate(10);
        return view('user.applications', compact('applications'));
    }
}

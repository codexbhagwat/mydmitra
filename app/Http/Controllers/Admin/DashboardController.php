<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users'        => User::where('role', 'user')->count(),
            'total_services'     => Service::count(),
            'total_applications' => Application::count(),
            'completed'          => Application::where('status', 'completed')->count(),
            'in_progress'        => Application::where('status', 'in_progress')->count(),
            'pending'            => Application::where('status', 'pending')->count(),
        ];

        $recentApplications = Application::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentApplications'));
    }
}

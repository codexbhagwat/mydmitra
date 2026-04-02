<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Service;
use App\Models\User;
use App\Models\ContactEnquiry; // <-- ADD THIS

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
            'total_enquiries'    => ContactEnquiry::count(), // <-- ADD THIS
        ];

        $recentApplications = Application::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();
        $recentEnquiries = ContactEnquiry::latest()->take(5)->get(); // <-- ADD THIS

        return view('admin.dashboard', compact('stats', 'recentApplications' ,
            'recentEnquiries'));
    }
}

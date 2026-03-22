<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = Application::with(['user', 'service'])->latest()->paginate(15);
        return view('admin.applications.index', compact('applications'));
    }

    public function updateStatus(Request $request, Application $application)
    {
        $request->validate(['status' => 'required|in:pending,in_progress,completed']);
        $application->update(['status' => $request->status]);
        return back()->with('success', 'Status updated successfully.');
    }
}

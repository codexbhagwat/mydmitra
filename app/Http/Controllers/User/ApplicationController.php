<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Service;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Service $service)
    {
        $existing = Application::where('user_id', auth()->id())
            ->where('service_id', $service->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->first();

        if ($existing) {
            return redirect()->route('user.dashboard')
                ->with('error', 'You already have an active application for this service.');
        }

        return view('user.apply', compact('service'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'notes'      => 'nullable|string|max:500',
        ]);

        $application = Application::create([
            'user_id'    => auth()->id(),
            'service_id' => $request->service_id,
            'notes'      => $request->notes,
            'status'     => 'pending',
        ]);

        return redirect()->route('payment', $application->id);
    }
}

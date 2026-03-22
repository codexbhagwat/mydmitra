<?php

namespace App\Http\Controllers;

use App\Models\Application;

class PaymentController extends Controller
{
    public function show(Application $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.payment', compact('application'));
    }

    public function process(Application $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        $application->update(['status' => 'in_progress']);

        return redirect()->route('user.dashboard')
            ->with('success', 'Payment successful! Your application is now being processed.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function show(Application $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.payment', compact('application'));
    }

    public function process(Request $request, Application $application)
    {
        if ($application->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'transaction_id' => 'required|string|min:6|unique:payments,transaction_id',
        ], [
            'transaction_id.required' => 'Transaction ID daalna zaroori hai.',
            'transaction_id.unique'   => 'Ye Transaction ID pehle se use ho chuki hai.',
            'transaction_id.min'      => 'Transaction ID kam se kam 6 characters ki honi chahiye.',
        ]);

        // Payment record save karein
        Payment::create([
            'user_id'        => auth()->id(),
            'application_id' => $application->id,
            'transaction_id' => $request->transaction_id,
            'amount'         => $application->service->price,
            'payment_method' => 'upi_qr',
            'status'         => 'paid',
        ]);

        // Application status update karein
        $application->update(['status' => 'in_progress']);

        return redirect()->route('user.dashboard')
            ->with('success', 'Payment successful! Your application is now being processed.');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:15',
            'email'   => 'nullable|email|max:100',
            'service' => 'nullable|string|max:150',
            'message' => 'nullable|string|max:1000',
        ]);

        DB::table('contact_enquiries')->insert([
            'name'       => $validated['name'],
            'phone'      => $validated['phone'],
            'email'      => $validated['email'] ?? null,
            'service'    => $validated['service'] ?? null,
            'message'    => $validated['message'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('contact')
            ->with('success', 'Thank you! Your enquiry has been received.');
    }
}
<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ContactEnquiry;

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
        'phone'   => 'required|string|max:20',
        'email'   => 'nullable|email|max:150',
        'service' => 'nullable|string|max:150',
        'type'    => 'required|in:enquiry,complaint,feedback',
        'message' => 'nullable|string|max:2000',
    ]);

    // ✅ Sirf yeh rakho
    ContactEnquiry::create($validated);

    return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
}
}

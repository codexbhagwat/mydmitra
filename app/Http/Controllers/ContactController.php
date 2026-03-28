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
            'created_at' => now(),
            'updated_at' => now(),
        ]);

          DB::table('contact_enquiries')->insert([
             'name'       => $validated['name'],
             'phone'      => $validated['phone'],
             'email'      => $validated['email'] ?? null,
             'service'    => $validated['service'] ?? null,
             'type'       => $validated['type'] ?? null,
             'message'    => $validated['message'] ?? null,
             'created_at' => now(),
             'updated_at' => now(),
         ]);


        ContactEnquiry::create($validated);

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully! We will get back to you soon.');
    }
}

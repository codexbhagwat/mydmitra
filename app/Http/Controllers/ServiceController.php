<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    // ── Frontend: list active services ────────────────────────
    //
    //  Passes two extra variables to the view:
    //  $appliedMap   — [service_id => count] so the card can show "Applied 2×"
    //  $pendingCount — badge number on the "My Applications" button

    public function index()
    {
        $services = Service::active()->orderBy('name')->get();

        // Build a map of how many times the current user applied per service
        $appliedMap = ServiceApplication::where('user_id', Auth::id())
            ->selectRaw('service_id, count(*) as total')
            ->groupBy('service_id')
            ->pluck('total', 'service_id');

        // Count pending applications for the header badge
        $pendingCount = ServiceApplication::where('user_id', Auth::id())
            ->where('status', 'pending')
            ->count();

        return view('services.index', compact('services', 'appliedMap', 'pendingCount'));
    }

    // ── Frontend: show application form for one service ───────

    public function show(Service $service)
    {
        if (!$service->is_active) {
            return redirect()
                ->route('services.index')
                ->with('error', 'This service is not currently available.');
        }

        return view('services.apply', compact('service'));
    }

    // ── Frontend: handle submitted application ─────────────────

    public function submit(Request $request, Service $service)
    {
        if (!$service->is_active) {
            abort(403, 'Service unavailable.');
        }

        // ── 1. Build validation rules dynamically ──────────────
        $rules = [];

        foreach ($service->fields ?? [] as $index => $field) {
            $fieldRules = [!empty($field['required']) ? 'required' : 'nullable'];

            switch ($field['type'] ?? 'text') {
                case 'email':   $fieldRules[] = 'email';   break;
                case 'number':  $fieldRules[] = 'numeric'; break;
                case 'date':    $fieldRules[] = 'date';    break;
                case 'file':
                    $fieldRules[] = 'file';
                    $fieldRules[] = 'max:10240'; // 10 MB
                    break;
            }

            $rules["fields.{$index}"] = $fieldRules;
        }

        foreach ($service->required_documents ?? [] as $di => $doc) {
            $rules["documents.{$di}"] = ['required', 'file', 'max:20480']; // 20 MB
        }

        $request->validate($rules);

        // ── 2. Handle file uploads inside dynamic fields ───────
        $fieldValues = [];
        foreach ($service->fields ?? [] as $index => $field) {
            if (($field['type'] ?? 'text') === 'file' && $request->hasFile("fields.{$index}")) {
                $fieldValues[$index] = $request->file("fields.{$index}")
                    ->store('service-fields', 'private');
            } else {
                $fieldValues[$index] = $request->input("fields.{$index}");
            }
        }

        // ── 3. Handle required document uploads ───────────────
        $documentPaths = [];
        foreach ($service->required_documents ?? [] as $di => $doc) {
            if ($request->hasFile("documents.{$di}")) {
                $path = $request->file("documents.{$di}")
                    ->store('service-documents/' . $service->id, 'private');

                $documentPaths[$di] = [
                    'name'    => $doc['name'],
                    'doctype' => $doc['doctype'],
                    'path'    => $path,
                ];
            }
        }

        // ── 4. Persist ─────────────────────────────────────────
        $app = ServiceApplication::create([
            'service_id' => $service->id,
            'user_id'    => Auth::id(),
            'field_data' => $fieldValues,
            'documents'  => $documentPaths,
            'status'     => 'pending',
        ]);

        return redirect()
            ->route('services.application', $app)
            ->with('success', 'Your application has been submitted! We will update you on the status.');
    }

    // ── Frontend: list current user's applications ─────────────

    public function myApplications(Request $request)
    {
        $query = ServiceApplication::with('service')
            ->where('user_id', Auth::id())
            ->latest();

        // Optional status filter from tab
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->paginate(10);

        // Counts per status for the filter tabs
        $counts = ServiceApplication::where('user_id', Auth::id())
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('services.my-applications', compact('applications', 'counts'));
    }

    // ── Frontend: single application detail ───────────────────

    public function applicationDetail(ServiceApplication $app)
    {
        // Ensure users can only see their own applications
        if ($app->user_id !== Auth::id()) {
            abort(403);
        }

        $app->load('service');

        return view('services.application', compact('app'));
    }
}

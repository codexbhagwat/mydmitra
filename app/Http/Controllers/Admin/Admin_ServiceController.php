<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // ── Admin: list all services ───────────────────────────────

    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    // ── Admin: show create form ────────────────────────────────

    public function create()
    {
        return view('admin.services.create');
    }

    // ── Admin: store new service ───────────────────────────────
    //
    //  The create/edit blades do NOT use standard array inputs for
    //  fields & documents — they collect data via JS into two hidden
    //  inputs (fields_json / documents_json) and POST plain JSON strings.
    //  We decode those here before saving.

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'form_title'     => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'icon'           => 'nullable|string|max:100',
            'is_active'      => 'nullable|boolean',
            'fields_json'    => 'nullable|string',   // raw JSON from hidden input
            'documents_json' => 'nullable|string',   // raw JSON from hidden input
        ]);

        Service::create([
            'name'               => $data['name'],
            'form_title'         => $data['form_title'] ?? null,
            'description'        => $data['description'] ?? null,
            'price'              => $data['price'] ?? 0,
            'icon'               => $data['icon'] ?? 'bi-gear',
            'is_active'          => $request->boolean('is_active'),
            // Decode the JSON strings the JS layer built; fall back to []
            'fields'             => $this->decodeJson($data['fields_json'] ?? null),
            'required_documents' => $this->decodeJson($data['documents_json'] ?? null),
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    // ── Admin: show edit form ──────────────────────────────────

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // ── Admin: update existing service ────────────────────────

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'form_title'     => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'icon'           => 'nullable|string|max:100',
            'is_active'      => 'nullable|boolean',
            'fields_json'    => 'nullable|string',
            'documents_json' => 'nullable|string',
        ]);

        $service->update([
            'name'               => $data['name'],
            'form_title'         => $data['form_title'] ?? null,
            'description'        => $data['description'] ?? null,
            'price'              => $data['price'] ?? 0,
            'icon'               => $data['icon'] ?? 'bi-gear',
            'is_active'          => $request->boolean('is_active'),
            'fields'             => $this->decodeJson($data['fields_json'] ?? null),
            'required_documents' => $this->decodeJson($data['documents_json'] ?? null),
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    // ── Admin: delete service ──────────────────────────────────

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted.');
    }

    // ── Admin: quick toggle active status (AJAX-friendly) ─────

    public function toggle(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return redirect()
            ->back()
            ->with('success', 'Service status updated.');
    }

    // ── Helper ────────────────────────────────────────────────

    /**
     * Safely decode a JSON string into a PHP array.
     * Returns [] on null / invalid JSON — never null — so that
     * the model cast stores a valid JSON array instead of NULL.
     */
    private function decodeJson(?string $json): array
    {
        if (blank($json)) {
            return [];
        }

        $decoded = json_decode($json, true);

        return is_array($decoded) ? $decoded : [];
    }
}

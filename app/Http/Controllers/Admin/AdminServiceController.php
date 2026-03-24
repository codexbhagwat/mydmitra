<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // List all services
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    // Show create form
    public function create()
    {
        return view('admin.services.create');
    }

    // Store new service
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'form_title'     => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'icon'           => 'nullable|string|max:100',
            'fields_json'    => 'nullable|string',
            'documents_json' => 'nullable|string',
        ]);

        Service::create([
            'name'               => $request->name,
            'form_title'         => $request->form_title,
            'description'        => $request->description,
            'price'              => $request->price ?? 0,
            'icon'               => $request->icon ?? 'bi-gear',
            'is_active'          => $request->boolean('is_active'),
            'fields'             => $this->decodeJson($request->fields_json),
            'required_documents' => $this->decodeJson($request->documents_json),
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service "' . $request->name . '" created successfully.');
    }

    // Preview a service (admin sees exactly what users will see + edit/delete controls)
    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    // Show edit form
    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    // Update service
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'form_title'     => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'price'          => 'nullable|numeric|min:0',
            'icon'           => 'nullable|string|max:100',
            'fields_json'    => 'nullable|string',
            'documents_json' => 'nullable|string',
        ]);

        $service->update([
            'name'               => $request->name,
            'form_title'         => $request->form_title,
            'description'        => $request->description,
            'price'              => $request->price ?? 0,
            'icon'               => $request->icon ?? 'bi-gear',
            'is_active'          => $request->boolean('is_active'),
            'fields'             => $this->decodeJson($request->fields_json),
            'required_documents' => $this->decodeJson($request->documents_json),
        ]);

        return redirect()
            ->route('admin.services.show', $service)
            ->with('success', 'Service updated successfully.');
    }

    // Delete service
    public function destroy(Service $service)
    {
        $name = $service->name;
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', '"' . $name . '" has been deleted.');
    }

    // Quick toggle active/inactive
    public function toggle(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        $status = $service->is_active ? 'activated' : 'deactivated';

        return redirect()
            ->back()
            ->with('success', '"' . $service->name . '" has been ' . $status . '.');
    }

    // Decode JSON string from hidden input safely
    private function decodeJson(?string $json): array
    {
        if (blank($json)) return [];
        $decoded = json_decode($json, true);
        return is_array($decoded) ? $decoded : [];
    }
}

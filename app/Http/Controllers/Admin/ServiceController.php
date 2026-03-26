<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'icon'        => 'nullable|string|max:100',  // ✅ add validation
        ]);

    Service::create([
        'name'           => $request->name,
        // 'form_title'     => $request->form_title ?: $request->name,
        'description'    => $request->description,
        'price'          => $request->price ?? 0,
        'icon'           => $request->icon ?: null,   // ✅ YE LINE ADD KARO
        'is_active'      => $request->has('is_active') ? 1 : 0,
        'fields_json'    => $request->fields,
        'documents_json' => $request->required_documents,
    ]);

        return redirect()->route('admin.services.index')
                        ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'icon'        => 'nullable|string|max:100',  // ✅ add validation
        ]);

    $service->update([
        'name'           => $request->name,
        // 'form_title'     => $request->form_title ?: $request->name,
        'description'    => $request->description,
        'price'          => $request->price ?? 0,
        'icon'           => $request->icon ?: null,   // ✅ YE LINE ADD KARO
        'is_active'      => $request->has('is_active') ? 1 : 0,
        'fields_json'    => $request->fields,
        'documents_json' => $request->required_documents,
    ]);

        return redirect()->route('admin.services.index')
                        ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
                         ->with('success', 'Service deleted.');
    }
}
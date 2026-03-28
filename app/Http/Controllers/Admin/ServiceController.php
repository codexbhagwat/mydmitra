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
            'icon'        => 'nullable|string|max:100',
        ]);

        Service::create([
            'name'           => $request->name,
            'description'    => $request->description,
            'price'          => $request->price ?? 0,
            'icon'           => $request->icon ?: null,
            'is_active'      => $request->has('is_active') ? 1 : 0,
            'fields_json'    => $request->input('fields_json'),    // ✅ SAHI NAME
            'documents_json' => $request->input('documents_json'), // ✅ SAHI NAME
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
            'icon'        => 'nullable|string|max:100',
        ]);

        $service->update([
            'name'           => $request->name,
            'description'    => $request->description,
            'price'          => $request->price ?? 0,
            'icon'           => $request->icon ?: null,
            'is_active'      => $request->has('is_active') ? 1 : 0,
            'fields_json'    => $request->input('fields_json'),    // ✅ SAHI NAME
            'documents_json' => $request->input('documents_json'), // ✅ SAHI NAME
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
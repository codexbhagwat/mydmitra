<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Service;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function apply(Service $service)
    {
        $existing = Application::where('user_id', auth()->id())
            ->where('service_id', $service->id)
            ->whereIn('status', ['pending', 'in_progress'])
            ->first();

        if ($existing) {
            return redirect()->route('user.dashboard')
                ->with('error', 'You already have an active application for this service.');
        }

        return view('user.apply', compact('service'));
    }

    public function store(Request $request)
    {
        $service = Service::findOrFail($request->service_id);

        // ── Base validation ──
        $rules = [
            'service_id' => 'required|exists:services,id',
            'notes'      => 'nullable|string|max:500',
        ];

        // ── Dynamic fields validation ──
        $fields = json_decode($service->fields_json, true) ?? [];
        foreach ($fields as $i => $field) {
            if (!empty($field['required'])) {
                $type = $field['type'] ?? 'text';
                $rules["fields.$i"] = ($type === 'file')
                    ? 'required|file|max:5120'
                    : 'required|string|max:1000';
            }
        }

        // ── Dynamic documents validation ──
        $documents = json_decode($service->documents_json, true) ?? [];
        $mimeMap = [
            'PDF'             => 'mimes:pdf',
            'Image (JPG/PNG)' => 'mimes:jpg,jpeg,png',
            'PDF or Image'    => 'mimes:pdf,jpg,jpeg,png',
            'Any File'        => 'file',
        ];
        foreach ($documents as $d => $doc) {
            $mimeRule = $mimeMap[$doc['doctype'] ?? 'Any File'] ?? 'file';
            $rules["documents.$d"] = "required|file|{$mimeRule}|max:10240";
        }

        $request->validate($rules);

        // ── Build fields_data array ──
        $fieldData = [];
        foreach ($fields as $i => $field) {
            $fieldData[] = [
                'label' => $field['label'] ?? "Field $i",
                'type'  => $field['type']  ?? 'text',
                'value' => $request->input("fields.$i"),
            ];
        }

        // ── Upload documents & build documents_data array ──
        $uploadedDocs = [];
        foreach ($documents as $d => $doc) {
            if ($request->hasFile("documents.$d")) {
                $file     = $request->file("documents.$d");
                $filename = time() . '_' . $d . '_' . $file->getClientOriginalName();
                $path     = $file->storeAs("applications/docs", $filename, 'local');

                $uploadedDocs[] = [
                    'name'          => $doc['name']    ?? "Document $d",
                    'doctype'       => $doc['doctype'] ?? 'Any File',
                    'original_name' => $file->getClientOriginalName(),
                    'path'          => $path,
                ];
            }
        }

        // ── Create application ──
        $application = Application::create([
            'user_id'        => auth()->id(),
            'service_id'     => $request->service_id,
            'notes'          => $request->notes,
            'status'         => 'pending',
            'fields_data'    => $fieldData,    // auto JSON encode (cast)
            'documents_data' => $uploadedDocs, // auto JSON encode (cast)
        ]);

        return redirect()->route('payment', $application->id);
    }
}
{{--
    resources/views/services/apply.blade.php
    Rendered when a user clicks "Apply" for a service on the frontend.
    $service is an App\Models\Service instance.
--}}
@extends('layouts.app')
@section('title', $service->form_title ?: $service->name)

@section('content')
<div class="container" style="max-width:640px;margin:40px auto;padding:0 16px 60px;">

    {{-- Header --}}
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;">
        <div style="width:48px;height:48px;border-radius:12px;background:var(--orange-soft);
                    display:flex;align-items:center;justify-content:center;
                    color:var(--orange);font-size:22px;flex-shrink:0;">
            <i class="bi {{ $service->icon }}"></i>
        </div>
        <div>
            <h1 style="font-size:20px;font-weight:800;margin:0;">
                {{ $service->form_title ?: $service->name }}
            </h1>
            @if($service->description)
                <p style="font-size:13px;color:var(--grey);margin:3px 0 0;">{{ $service->description }}</p>
            @endif
        </div>
    </div>

    {{-- Back link --}}
    <div style="margin-bottom:18px;">
        <a href="{{ route('services.index') }}"
           style="color:var(--grey);font-size:13px;display:inline-flex;align-items:center;gap:5px;">
            <i class="bi bi-arrow-left"></i> Back to Services
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            Please fix the errors below and resubmit.
        </div>
    @endif

    <div class="card">
        <div class="card-body-custom">
            <form method="POST" action="{{ route('services.submit', $service) }}"
                  enctype="multipart/form-data">
                @csrf

                {{-- ── Dynamic Fields ──────────────────────────── --}}
                @if(!empty($service->fields))
                    @foreach($service->fields as $index => $field)
                        @php
                            $name     = 'fields[' . $index . ']';
                            $id       = 'field_' . $index;
                            $required = !empty($field['required']);
                            $ph       = $field['placeholder'] ?? '';
                            $label    = $field['label'];
                            $type     = $field['type'] ?? 'text';
                            $oldVal   = old("fields.{$index}");
                        @endphp

                        <div class="form-group">
                            <label class="form-label" for="{{ $id }}">
                                {{ $label }}
                                @if($required)
                                    <span style="color:#e53e3e;margin-left:2px;">*</span>
                                @endif
                            </label>

                            @if($type === 'textarea')
                                <textarea name="{{ $name }}" id="{{ $id }}" rows="3"
                                          class="form-control @error("fields.{$index}") is-invalid @enderror"
                                          placeholder="{{ $ph }}"
                                          {{ $required ? 'required' : '' }}>{{ $oldVal }}</textarea>

                            @elseif($type === 'select')
                                <select name="{{ $name }}" id="{{ $id }}"
                                        class="form-control @error("fields.{$index}") is-invalid @enderror"
                                        {{ $required ? 'required' : '' }}>
                                    <option value="">-- Select --</option>
                                    @foreach($field['options'] ?? [] as $opt)
                                        <option value="{{ $opt }}" {{ $oldVal == $opt ? 'selected' : '' }}>
                                            {{ $opt }}
                                        </option>
                                    @endforeach
                                </select>

                            @elseif($type === 'radio')
                                <div style="display:flex;flex-wrap:wrap;gap:14px;margin-top:6px;">
                                    @foreach($field['options'] ?? [] as $opt)
                                        <label style="display:flex;align-items:center;gap:6px;font-size:13.5px;cursor:pointer;">
                                            <input type="radio" name="{{ $name }}" value="{{ $opt }}"
                                                   {{ $oldVal == $opt ? 'checked' : '' }}
                                                   {{ $required ? 'required' : '' }}>
                                            {{ $opt }}
                                        </label>
                                    @endforeach
                                </div>

                            @elseif($type === 'checkbox')
                                <label style="display:flex;align-items:center;gap:8px;cursor:pointer;font-size:13.5px;">
                                    <input type="checkbox" name="{{ $name }}" value="1"
                                           {{ $oldVal ? 'checked' : '' }}>
                                    {{ $ph ?: $label }}
                                </label>

                            @elseif($type === 'file')
                                <input type="file" name="{{ $name }}" id="{{ $id }}"
                                       class="form-control @error("fields.{$index}") is-invalid @enderror"
                                       {{ $required ? 'required' : '' }}>

                            @else
                                {{-- text / number / email / phone / date --}}
                                <input type="{{ $type === 'phone' ? 'tel' : $type }}"
                                       name="{{ $name }}" id="{{ $id }}"
                                       value="{{ $oldVal }}"
                                       class="form-control @error("fields.{$index}") is-invalid @enderror"
                                       placeholder="{{ $ph }}"
                                       {{ $required ? 'required' : '' }}>
                            @endif

                            @error("fields.{$index}")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                @else
                    {{-- No dynamic fields defined for this service --}}
                    <p style="color:var(--grey);font-size:13.5px;margin-bottom:16px;">
                        No additional information required for this service.
                    </p>
                @endif

                {{-- ── Document Uploads ────────────────────────── --}}
                @if(!empty($service->required_documents))
                    <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                                letter-spacing:.08em;color:var(--grey);
                                margin:20px 0 10px;display:flex;align-items:center;gap:8px;">
                        <i class="bi bi-file-earmark-lock2"></i> Upload Documents
                        <span style="flex:1;height:1px;background:var(--grey-light);display:block;"></span>
                    </div>
                    <p style="font-size:12px;color:var(--grey);margin:-4px 0 12px;">
                        <i class="bi bi-shield-lock-fill" style="color:#059669;"></i>
                        All documents are encrypted before storage.
                    </p>

                    @foreach($service->required_documents as $di => $doc)
                        <div class="form-group">
                            <label class="form-label" for="doc_{{ $di }}">
                                {{ $doc['name'] }}
                                <span style="font-size:11.5px;color:var(--grey);font-weight:400;margin-left:4px;">
                                    ({{ $doc['doctype'] }})
                                </span>
                                <span style="color:#e53e3e;margin-left:2px;">*</span>
                            </label>
                            <input type="file" name="documents[{{ $di }}]" id="doc_{{ $di }}"
                                   class="form-control @error("documents.{$di}") is-invalid @enderror"
                                   required>
                            @error("documents.{$di}")
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                @endif

                {{-- ── Price & Submit ──────────────────────────── --}}
                @if($service->price > 0)
                    <div style="background:var(--orange-soft);border-radius:10px;
                                padding:12px 16px;margin:20px 0 4px;
                                display:flex;justify-content:space-between;align-items:center;">
                        <span style="font-size:13.5px;font-weight:600;">Service Fee</span>
                        <span style="font-family:'Syne',sans-serif;font-weight:800;font-size:17px;color:var(--orange);">
                            ₹{{ number_format($service->price, 0) }}
                        </span>
                    </div>
                @endif

                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn-orange">
                        <i class="bi bi-send"></i> Submit Application
                    </button>
                    <a href="{{ route('services.index') }}" class="btn-dark">Cancel</a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

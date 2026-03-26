@extends('layouts.user')
@section('title', 'Apply')
@section('page-title', 'Apply for Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('services.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card" style="max-width:560px;">
    <div class="card-header-custom">
        <div>
            <h5>Apply for Service</h5>
            <p>Review and submit your application</p>
        </div>
    </div>
    <div class="card-body-custom">

        {{-- ── Service Summary ── --}}
        <div style="background:var(--orange-soft);border-radius:12px;padding:18px;display:flex;gap:14px;align-items:center;margin-bottom:24px;">
            <div style="width:50px;height:50px;border-radius:12px;background:var(--white);display:flex;align-items:center;justify-content:center;font-size:22px;color:var(--orange);flex-shrink:0;">
                <i class="bi {{ $service->icon ?? 'bi-gear' }}"></i>
            </div>
            <div style="flex:1;">
                <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:16px;">{{ $service->name }}</div>
                <div style="font-size:13px;color:var(--grey-dark);margin-top:2px;">{{ $service->description }}</div>
            </div>
            <div style="font-weight:700;font-size:22px;color:var(--orange);flex-shrink:0;">
                ₹{{ number_format($service->price, 0) }}
            </div>
        </div>

        <form method="POST" action="{{ route('user.apply.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">

            {{-- ════════════════════════════════════════
                 SECTION 1 — Dynamic Form Fields (fields_json)
            ════════════════════════════════════════ --}}
            @php
                $fields = json_decode($service->fields_json, true) ?? [];
            @endphp

            @if(count($fields) > 0)
                <div style="margin-bottom:22px;">
                    <div style="font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--grey);margin-bottom:14px;display:flex;align-items:center;gap:6px;">
                        <i class="bi bi-ui-checks-grid" style="color:var(--orange);font-size:14px;"></i>
                        Application Details
                    </div>

                    @foreach($fields as $i => $field)
                        @php
                            $name        = "fields[$i]";
                            $label       = $field['label']       ?? 'Field';
                            $type        = $field['type']        ?? 'text';
                            $placeholder = $field['placeholder'] ?? '';
                            $required    = !empty($field['required']);
                            $oldVal      = old("fields.$i");
                        @endphp

                        <div style="margin-bottom:16px;">
                            <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:7px;">
                                {{ $label }}
                                @if($required)<span style="color:#ef4444;margin-left:2px;">*</span>@endif
                            </label>

                            @if($type === 'textarea')
                                <textarea name="{{ $name }}"
                                          class="form-control"
                                          placeholder="{{ $placeholder }}"
                                          rows="3"
                                          {{ $required ? 'required' : '' }}>{{ $oldVal }}</textarea>

                            @elseif($type === 'select')
                                <select name="{{ $name }}" class="form-control" {{ $required ? 'required' : '' }}>
                                    <option value="">-- Select --</option>
                                    @foreach(explode(',', $field['options'] ?? '') as $opt)
                                        <option value="{{ trim($opt) }}" {{ $oldVal == trim($opt) ? 'selected' : '' }}>
                                            {{ trim($opt) }}
                                        </option>
                                    @endforeach
                                </select>

                            @elseif($type === 'radio')
                                @foreach(explode(',', $field['options'] ?? '') as $opt)
                                    <label style="display:flex;align-items:center;gap:8px;font-size:13.5px;cursor:pointer;margin-bottom:7px;">
                                        <input type="radio" name="{{ $name }}" value="{{ trim($opt) }}"
                                               {{ $required ? 'required' : '' }}
                                               {{ $oldVal == trim($opt) ? 'checked' : '' }}
                                               style="accent-color:var(--orange);width:15px;height:15px;flex-shrink:0;">
                                        {{ trim($opt) }}
                                    </label>
                                @endforeach

                            @elseif($type === 'checkbox')
                                <label style="display:flex;align-items:center;gap:8px;font-size:13.5px;cursor:pointer;">
                                    <input type="checkbox" name="{{ $name }}" value="1"
                                           {{ $oldVal ? 'checked' : '' }}
                                           style="accent-color:var(--orange);width:15px;height:15px;flex-shrink:0;">
                                    {{ $placeholder ?: $label }}
                                </label>

                            @elseif($type === 'file')
                                <input type="file" name="{{ $name }}" class="form-control"
                                       {{ $required ? 'required' : '' }}>

                            @elseif($type === 'date')
                                <input type="date" name="{{ $name }}" class="form-control"
                                       value="{{ $oldVal }}"
                                       {{ $required ? 'required' : '' }}>

                            @elseif($type === 'number')
                                <input type="number" name="{{ $name }}" class="form-control"
                                       placeholder="{{ $placeholder }}"
                                       value="{{ $oldVal }}"
                                       {{ $required ? 'required' : '' }}>

                            @elseif($type === 'email')
                                <input type="email" name="{{ $name }}" class="form-control"
                                       placeholder="{{ $placeholder }}"
                                       value="{{ $oldVal }}"
                                       {{ $required ? 'required' : '' }}>

                            @elseif($type === 'phone')
                                <input type="tel" name="{{ $name }}" class="form-control"
                                       placeholder="{{ $placeholder }}"
                                       value="{{ $oldVal }}"
                                       {{ $required ? 'required' : '' }}>

                            @else
                                <input type="text" name="{{ $name }}" class="form-control"
                                       placeholder="{{ $placeholder }}"
                                       value="{{ $oldVal }}"
                                       {{ $required ? 'required' : '' }}>
                            @endif

                            @error("fields.$i")
                                <div style="font-size:12px;color:#ef4444;margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- ════════════════════════════════════════
                 SECTION 2 — Dynamic Documents (documents_json)
            ════════════════════════════════════════ --}}
            @php
                $documents = json_decode($service->documents_json, true) ?? [];
                $acceptMap = [
                    'PDF'             => '.pdf',
                    'Image (JPG/PNG)' => '.jpg,.jpeg,.png',
                    'PDF or Image'    => '.pdf,.jpg,.jpeg,.png',
                    'Any File'        => '*',
                ];
            @endphp

            @if(count($documents) > 0)
                <div style="margin-bottom:22px;">
                    <div style="font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:var(--grey);margin-bottom:14px;display:flex;align-items:center;gap:6px;">
                        <i class="bi bi-file-earmark-lock2-fill" style="color:var(--orange);font-size:14px;"></i>
                        Required Documents
                    </div>

                    @foreach($documents as $d => $doc)
                        @php
                            $docName = $doc['name']    ?? 'Document';
                            $docType = $doc['doctype'] ?? 'PDF';
                            $accept  = $acceptMap[$docType] ?? '*';
                        @endphp

                        <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:10px;padding:14px 16px;margin-bottom:12px;">

                            {{-- Doc header --}}
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:11px;">
                                <i class="bi bi-file-earmark-text" style="color:#ea580c;font-size:15px;"></i>
                                <span style="font-size:13px;font-weight:700;color:#111827;">{{ $docName }}</span>
                                <span style="margin-left:auto;font-size:11px;background:#fff7ed;border:1px solid #fed7aa;color:#ea580c;padding:2px 9px;border-radius:20px;font-weight:600;">
                                    {{ $docType }}
                                </span>
                            </div>

                            {{-- File input --}}
                            <input type="file"
                                   name="documents[{{ $d }}]"
                                   class="form-control"
                                   accept="{{ $accept }}"
                                   required
                                   style="font-size:13px;">

                            {{-- Encrypted note --}}
                            <div style="display:flex;align-items:center;gap:5px;font-size:11px;color:#16a34a;margin-top:8px;">
                                <i class="bi bi-shield-lock-fill"></i> AES-256 encrypted on upload
                            </div>

                            @error("documents.$d")
                                <div style="font-size:12px;color:#ef4444;margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- ── Additional Notes ── --}}
            <div class="form-group" style="margin-bottom:20px;">
                <label class="form-label">
                    Additional Notes
                    <span style="color:var(--grey);font-weight:400;">(optional)</span>
                </label>
                <textarea name="notes" rows="3" class="form-control"
                          placeholder="Any specific requirements or information...">{{ old('notes') }}</textarea>
            </div>

            <div style="background:var(--grey-bg);border-radius:10px;padding:14px 16px;margin-bottom:20px;">
                <div style="font-size:12.5px;color:var(--grey);">
                    <i class="bi bi-info-circle" style="color:var(--orange);"></i>
                    After submission, you'll be redirected to the payment page to complete your application.
                </div>
            </div>

            <button type="submit" class="btn-orange w-100" style="justify-content:center;padding:12px;">
                <i class="bi bi-send"></i> Submit Application
            </button>
        </form>

    </div>
</div>
@endsection
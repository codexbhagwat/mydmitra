{{--
    resources/views/admin/services/show.blade.php
    Admin preview — shows the form exactly as users will see it,
    plus admin controls (Edit / Delete / Toggle) at the top.
--}}
@extends('layouts.admin')
@section('title', 'Preview: ' . $service->name)
@section('page-title', 'Service Preview')

@section('content')

{{-- ── Admin action bar ────────────────────────────────────── --}}
<div style="display:flex;align-items:center;justify-content:space-between;
            flex-wrap:wrap;gap:12px;margin-bottom:24px;">
    <a href="{{ route('admin.services.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">

        {{-- Toggle active --}}
        <form method="POST" action="{{ route('admin.services.toggle', $service) }}" style="margin:0;">
            @csrf
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:6px;
                           font-size:13px;font-weight:600;padding:8px 16px;
                           border-radius:9px;cursor:pointer;border:none;
                           {{ $service->is_active
                               ? 'background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;'
                               : 'background:#fef2f2;color:#dc2626;border:1px solid #fecaca;' }}">
                <i class="bi {{ $service->is_active ? 'bi-eye-slash' : 'bi-eye' }}"></i>
                {{ $service->is_active ? 'Deactivate' : 'Activate' }}
            </button>
        </form>

        {{-- Edit --}}
        <a href="{{ route('admin.services.edit', $service) }}" class="btn-dark"
           style="display:inline-flex;align-items:center;gap:6px;">
            <i class="bi bi-pencil"></i> Edit Service
        </a>

        {{-- Delete --}}
        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" style="margin:0;"
              onsubmit="return confirm('Delete \'{{ addslashes($service->name) }}\'? This cannot be undone.')">
            @csrf @method('DELETE')
            <button type="submit"
                    style="display:inline-flex;align-items:center;gap:6px;
                           font-size:13px;font-weight:600;padding:8px 16px;
                           border-radius:9px;cursor:pointer;border:none;
                           background:#fef2f2;color:#dc2626;border:1px solid #fecaca;">
                <i class="bi bi-trash3"></i> Delete
            </button>
        </form>
    </div>
</div>

{{-- Status banner --}}
@if(!$service->is_active)
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;
                padding:12px 18px;margin-bottom:20px;font-size:13.5px;
                color:#dc2626;display:flex;align-items:center;gap:8px;">
        <i class="bi bi-eye-slash-fill"></i>
        <strong>This service is currently inactive</strong> — it is hidden from users on the frontend.
    </div>
@else
    <div style="background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;
                padding:12px 18px;margin-bottom:20px;font-size:13.5px;
                color:#059669;display:flex;align-items:center;gap:8px;">
        <i class="bi bi-check-circle-fill"></i>
        <strong>This service is active</strong> — users can see and apply on the frontend.
    </div>
@endif

{{-- ── Service summary card ─────────────────────────────────── --}}
<div class="card" style="max-width:680px;padding:0;margin-bottom:20px;">
    <div class="card-body-custom">
        <div style="display:flex;align-items:center;gap:16px;margin-bottom:18px;">
            <div style="width:52px;height:52px;border-radius:13px;
                        background:var(--orange-soft);color:var(--orange);
                        display:flex;align-items:center;justify-content:center;
                        font-size:24px;flex-shrink:0;">
                <i class="bi {{ $service->icon }}"></i>
            </div>
            <div>
                <div style="font-size:19px;font-weight:800;">{{ $service->name }}</div>
                @if($service->form_title && $service->form_title !== $service->name)
                    <div style="font-size:13px;color:var(--grey);">
                        Form title: <em>{{ $service->form_title }}</em>
                    </div>
                @endif
                @if($service->description)
                    <div style="font-size:13px;color:var(--grey);margin-top:2px;">
                        {{ $service->description }}
                    </div>
                @endif
            </div>
        </div>

        <div style="display:flex;gap:20px;flex-wrap:wrap;font-size:13px;">
            <div>
                <span style="color:var(--grey);">Price</span><br>
                @if($service->price > 0)
                    <strong style="font-size:16px;color:var(--orange);font-family:'Syne',sans-serif;">
                        ₹{{ number_format($service->price, 0) }}
                    </strong>
                @else
                    <strong style="color:#059669;">Free</strong>
                @endif
            </div>
            <div>
                <span style="color:var(--grey);">Form Fields</span><br>
                <strong>{{ count($service->fields ?? []) }}</strong>
            </div>
            <div>
                <span style="color:var(--grey);">Required Documents</span><br>
                <strong>{{ count($service->required_documents ?? []) }}</strong>
            </div>
            <div>
                <span style="color:var(--grey);">Created</span><br>
                <strong>{{ $service->created_at->format('d M Y') }}</strong>
            </div>
        </div>
    </div>
</div>

{{-- ── Form preview — exactly what users see ───────────────── --}}
<div style="max-width:640px;">
    <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                letter-spacing:.08em;color:var(--grey);
                margin-bottom:14px;display:flex;align-items:center;gap:8px;">
        <i class="bi bi-eye"></i> User-facing Application Form Preview
        <span style="flex:1;height:1px;background:var(--grey-light);display:block;"></span>
    </div>

    <div class="card" style="padding:0;">
        <div class="card-body-custom">

            {{-- Header as user sees it --}}
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px;">
                <div style="width:46px;height:46px;border-radius:12px;
                            background:var(--orange-soft);color:var(--orange);
                            display:flex;align-items:center;justify-content:center;
                            font-size:21px;flex-shrink:0;">
                    <i class="bi {{ $service->icon }}"></i>
                </div>
                <div>
                    <div style="font-size:18px;font-weight:800;">
                        {{ $service->form_title ?: $service->name }}
                    </div>
                    @if($service->description)
                        <div style="font-size:12.5px;color:var(--grey);margin-top:2px;">
                            {{ $service->description }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Dynamic form fields --}}
            @if(!empty($service->fields))
                @foreach($service->fields as $index => $field)
                    @php
                        $required = !empty($field['required']);
                        $type     = $field['type'] ?? 'text';
                        $ph       = $field['placeholder'] ?? '';
                        $label    = $field['label'] ?? '';
                    @endphp
                    <div class="form-group">
                        <label class="form-label">
                            {{ $label }}
                            @if($required)
                                <span style="color:#e53e3e;margin-left:2px;">*</span>
                            @endif
                            <span style="font-size:10.5px;background:#f3f4f6;color:#6b7280;
                                         border-radius:4px;padding:1px 6px;margin-left:6px;
                                         font-weight:500;font-style:normal;">
                                {{ $type }}
                            </span>
                        </label>

                        @if($type === 'textarea')
                            <textarea class="form-control" rows="3" placeholder="{{ $ph }}" disabled
                                      style="background:#f9fafb;cursor:not-allowed;"></textarea>

                        @elseif($type === 'select')
                            <select class="form-control" disabled style="background:#f9fafb;cursor:not-allowed;">
                                <option>-- Select --</option>
                                @foreach($field['options'] ?? [] as $opt)
                                    <option>{{ $opt }}</option>
                                @endforeach
                            </select>

                        @elseif($type === 'radio')
                            <div style="display:flex;flex-wrap:wrap;gap:14px;margin-top:6px;">
                                @foreach($field['options'] ?? [] as $opt)
                                    <label style="display:flex;align-items:center;gap:6px;
                                                  font-size:13.5px;opacity:.7;cursor:not-allowed;">
                                        <input type="radio" disabled> {{ $opt }}
                                    </label>
                                @endforeach
                            </div>

                        @elseif($type === 'checkbox')
                            <label style="display:flex;align-items:center;gap:8px;
                                          cursor:not-allowed;font-size:13.5px;opacity:.7;">
                                <input type="checkbox" disabled>
                                {{ $ph ?: $label }}
                            </label>

                        @elseif($type === 'file')
                            <input type="file" class="form-control" disabled
                                   style="background:#f9fafb;cursor:not-allowed;">

                        @else
                            <input type="{{ $type === 'phone' ? 'tel' : $type }}"
                                   class="form-control" placeholder="{{ $ph }}" disabled
                                   style="background:#f9fafb;cursor:not-allowed;">
                        @endif
                    </div>
                @endforeach
            @else
                <div style="padding:16px;background:var(--bg-soft);border-radius:9px;
                            text-align:center;color:var(--grey);font-size:13px;margin-bottom:16px;">
                    <i class="bi bi-info-circle"></i> No form fields defined yet.
                    <a href="{{ route('admin.services.edit', $service) }}" style="color:var(--orange);">Add fields →</a>
                </div>
            @endif

            {{-- Document upload fields --}}
            @if(!empty($service->required_documents))
                <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                            letter-spacing:.08em;color:var(--grey);
                            margin:20px 0 8px;display:flex;align-items:center;gap:8px;">
                    <i class="bi bi-file-earmark-lock2"></i> Upload Documents
                    <span style="flex:1;height:1px;background:var(--grey-light);display:block;"></span>
                </div>
                <p style="font-size:12px;color:var(--grey);margin:-2px 0 12px;">
                    <i class="bi bi-shield-lock-fill" style="color:#059669;"></i>
                    All documents are encrypted before storage.
                </p>
                @foreach($service->required_documents as $di => $doc)
                    <div class="form-group">
                        <label class="form-label">
                            {{ $doc['name'] }}
                            <span style="font-size:11.5px;color:var(--grey);font-weight:400;margin-left:4px;">
                                ({{ $doc['doctype'] }})
                            </span>
                            <span style="color:#e53e3e;margin-left:2px;">*</span>
                        </label>
                        <input type="file" class="form-control" disabled
                               style="background:#f9fafb;cursor:not-allowed;">
                    </div>
                @endforeach
            @endif

            {{-- Price bar --}}
            @if($service->price > 0)
                <div style="background:var(--orange-soft);border-radius:10px;
                            padding:12px 16px;margin:20px 0 4px;
                            display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13.5px;font-weight:600;">Service Fee</span>
                    <span style="font-family:'Syne',sans-serif;font-weight:800;
                                 font-size:17px;color:var(--orange);">
                        ₹{{ number_format($service->price, 0) }}
                    </span>
                </div>
            @endif

            {{-- Disabled submit --}}
            <div class="d-flex gap-2 mt-3" style="opacity:.5;pointer-events:none;">
                <button class="btn-orange" disabled>
                    <i class="bi bi-send"></i> Submit Application
                </button>
                <button class="btn-dark" disabled>Cancel</button>
            </div>
            <p style="font-size:11.5px;color:var(--grey);margin-top:8px;">
                <i class="bi bi-info-circle"></i> This is a preview — the form is not submittable here.
            </p>
        </div>
    </div>
</div>

@endsection

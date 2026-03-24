{{--
    resources/views/services/application.blade.php
    Full detail view of one submitted application — visible to the submitting user.
    $app is a ServiceApplication instance, eager-loaded with service.
--}}
@extends('layouts.app')
@section('title', 'Application #' . str_pad($app->id, 6, '0', STR_PAD_LEFT))

@section('content')
<div class="container" style="max-width:680px;margin:40px auto;padding:0 16px 60px;">

    {{-- Back --}}
    <div style="margin-bottom:22px;">
        <a href="{{ route('services.my-applications') }}"
           style="color:var(--grey);font-size:13px;display:inline-flex;align-items:center;gap:5px;">
            <i class="bi bi-arrow-left"></i> My Applications
        </a>
    </div>

    @php
        $statusStyles = [
            'pending'    => ['bg'=>'#fffbeb','color'=>'#d97706','border'=>'#fde68a','icon'=>'bi-hourglass-split',  'label'=>'Pending'],
            'processing' => ['bg'=>'#eff6ff','color'=>'#2563eb','border'=>'#bfdbfe','icon'=>'bi-arrow-repeat',     'label'=>'Processing'],
            'completed'  => ['bg'=>'#ecfdf5','color'=>'#059669','border'=>'#a7f3d0','icon'=>'bi-check2-circle',    'label'=>'Completed'],
            'rejected'   => ['bg'=>'#fef2f2','color'=>'#dc2626','border'=>'#fecaca','icon'=>'bi-x-circle',         'label'=>'Rejected'],
        ];
        $st = $statusStyles[$app->status] ?? $statusStyles['pending'];
    @endphp

    {{-- ── Application header card ─────────────────────────── --}}
    <div class="card" style="padding:0;margin-bottom:16px;">
        <div class="card-body-custom">
            <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;">
                <div style="width:50px;height:50px;border-radius:13px;
                            background:var(--orange-soft);color:var(--orange);
                            display:flex;align-items:center;justify-content:center;
                            font-size:22px;flex-shrink:0;">
                    <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:18px;font-weight:800;">
                        {{ $app->service->name ?? 'Service' }}
                    </div>
                    <div style="font-size:12.5px;color:var(--grey);margin-top:2px;">
                        Reference #{{ str_pad($app->id, 6, '0', STR_PAD_LEFT) }}
                        · Submitted {{ $app->created_at->format('d M Y, h:i A') }}
                    </div>
                </div>
                <span style="background:{{ $st['bg'] }};color:{{ $st['color'] }};
                             border:1px solid {{ $st['border'] }};
                             border-radius:20px;padding:5px 14px;
                             font-size:13px;font-weight:700;white-space:nowrap;">
                    <i class="bi {{ $st['icon'] }}" style="margin-right:4px;"></i>
                    {{ $st['label'] }}
                </span>
            </div>

            @if($app->service && $app->service->price > 0)
                <div style="margin-top:14px;background:var(--orange-soft);border-radius:9px;
                            padding:10px 14px;display:flex;justify-content:space-between;align-items:center;">
                    <span style="font-size:13.5px;font-weight:600;">Service Fee</span>
                    <span style="font-family:'Syne',sans-serif;font-weight:800;
                                 font-size:17px;color:var(--orange);">
                        ₹{{ number_format($app->service->price, 0) }}
                    </span>
                </div>
            @endif
        </div>
    </div>

    {{-- ── Progress stepper ────────────────────────────────── --}}
    @php
        $steps = ['pending' => 0, 'processing' => 1, 'completed' => 2, 'rejected' => 2];
        $currentStep = $steps[$app->status] ?? 0;
        $isRejected  = $app->status === 'rejected';
    @endphp
    <div class="card" style="padding:0;margin-bottom:16px;">
        <div class="card-body-custom">
            <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                        letter-spacing:.08em;color:var(--grey);margin-bottom:16px;">
                Application Progress
            </div>
            <div style="display:flex;align-items:center;gap:0;">
                @foreach(['Submitted', 'In Review', $isRejected ? 'Rejected' : 'Completed'] as $si => $stepLabel)
                    @php
                        $done   = $si < $currentStep || ($si === $currentStep && in_array($app->status, ['completed','rejected']));
                        $active = $si === $currentStep && !in_array($app->status, ['completed','rejected']);
                        $color  = $isRejected && $si === 2 ? '#dc2626' : 'var(--orange)';
                    @endphp
                    <div style="display:flex;flex-direction:column;align-items:center;flex:1;position:relative;">
                        <div style="width:30px;height:30px;border-radius:50%;
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:13px;font-weight:700;z-index:1;
                                    {{ $done || $active
                                        ? 'background:' . $color . ';color:#fff;'
                                        : 'background:var(--bg-soft);color:var(--grey);border:2px solid var(--grey-light);' }}">
                            @if($done)
                                <i class="bi {{ $isRejected && $si === 2 ? 'bi-x' : 'bi-check' }}"></i>
                            @else
                                {{ $si + 1 }}
                            @endif
                        </div>
                        <div style="font-size:11.5px;font-weight:600;margin-top:6px;
                                    color:{{ $done || $active ? ($isRejected && $si === 2 ? '#dc2626' : 'var(--orange)') : 'var(--grey)' }}">
                            {{ $stepLabel }}
                        </div>
                    </div>
                    @if($si < 2)
                        <div style="flex:1;height:2px;margin-bottom:18px;
                                    background:{{ $si < $currentStep ? 'var(--orange)' : 'var(--grey-light)' }};"></div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── Submitted field values ───────────────────────────── --}}
    @if(!empty($app->field_data))
    <div class="card" style="padding:0;margin-bottom:16px;">
        <div class="card-body-custom">
            <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                        letter-spacing:.08em;color:var(--grey);margin-bottom:14px;
                        display:flex;align-items:center;gap:8px;">
                <i class="bi bi-ui-checks"></i> Submitted Information
                <span style="flex:1;height:1px;background:var(--grey-light);display:block;"></span>
            </div>

            <div style="display:flex;flex-direction:column;gap:12px;">
                @foreach($app->field_data as $index => $value)
                    @php
                        $fieldDef   = $app->service->fields[$index] ?? null;
                        $fieldLabel = $fieldDef['label'] ?? 'Field ' . ($index + 1);
                        $fieldType  = $fieldDef['type']  ?? 'text';
                    @endphp
                    @if(!is_null($value) && $value !== '')
                    <div style="display:flex;flex-direction:column;gap:3px;">
                        <div style="font-size:11.5px;font-weight:700;color:var(--grey);">
                            {{ $fieldLabel }}
                        </div>
                        <div style="font-size:13.5px;font-weight:500;">
                            @if($fieldType === 'file')
                                <span style="color:var(--grey);font-style:italic;">
                                    <i class="bi bi-paperclip"></i> File uploaded (stored securely)
                                </span>
                            @elseif($fieldType === 'checkbox')
                                {{ $value ? '✅ Yes' : '❌ No' }}
                            @else
                                {{ $value }}
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- ── Uploaded documents ───────────────────────────────── --}}
    @if(!empty($app->documents))
    <div class="card" style="padding:0;margin-bottom:16px;">
        <div class="card-body-custom">
            <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                        letter-spacing:.08em;color:var(--grey);margin-bottom:14px;
                        display:flex;align-items:center;gap:8px;">
                <i class="bi bi-file-earmark-lock2"></i> Uploaded Documents
                <span style="flex:1;height:1px;background:var(--grey-light);display:block;"></span>
            </div>
            <p style="font-size:12px;color:var(--grey);margin:-4px 0 12px;">
                <i class="bi bi-shield-lock-fill" style="color:#059669;"></i>
                All documents are encrypted (AES-256) and stored securely.
            </p>
            <div style="display:flex;flex-direction:column;gap:8px;">
                @foreach($app->documents as $doc)
                <div style="display:flex;align-items:center;gap:10px;
                            background:var(--bg-soft);border:1px solid var(--grey-light);
                            border-radius:9px;padding:10px 14px;">
                    <i class="bi bi-file-earmark-text"
                       style="font-size:20px;color:var(--grey);flex-shrink:0;"></i>
                    <div style="flex:1;min-width:0;">
                        <div style="font-weight:600;font-size:13.5px;">{{ $doc['name'] ?? 'Document' }}</div>
                        <div style="font-size:12px;color:var(--grey);">{{ $doc['doctype'] ?? '' }}</div>
                    </div>
                    <span style="background:#ecfdf5;color:#059669;border:1px solid #a7f3d0;
                                 border-radius:6px;padding:3px 10px;font-size:11.5px;font-weight:600;">
                        <i class="bi bi-shield-check"></i> Encrypted
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    {{-- ── Need help? ───────────────────────────────────────── --}}
    <div style="text-align:center;padding:20px;color:var(--grey);font-size:13px;">
        Questions about this application?
        <a href="mailto:support@example.com" style="color:var(--orange);font-weight:600;">
            Contact Support
        </a>
    </div>

</div>
@endsection

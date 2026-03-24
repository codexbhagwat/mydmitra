{{--
    resources/views/services/my-applications.blade.php
    Shows the logged-in user's submitted service applications with status tracking.
--}}
@extends('layouts.app')
@section('title', 'My Applications')

@section('content')
<div class="container" style="max-width:860px;margin:40px auto;padding:0 16px 60px;">

    {{-- ── Header ─────────────────────────────────────────────── --}}
    <div style="display:flex;align-items:center;gap:14px;margin-bottom:28px;flex-wrap:wrap;">
        <a href="{{ route('services.index') }}"
           style="color:var(--grey);font-size:13px;display:inline-flex;align-items:center;gap:5px;">
            <i class="bi bi-arrow-left"></i> Back to Services
        </a>
        <div style="flex:1;min-width:200px;">
            <h1 style="font-size:22px;font-weight:800;margin:0;">My Applications</h1>
            <p style="color:var(--grey);font-size:13.5px;margin-top:4px;">
                Track the status of all your submitted service applications.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    {{-- ── Status filter tabs ──────────────────────────────────── --}}
    @php
        $statuses = ['all' => 'All', 'pending' => 'Pending', 'processing' => 'Processing',
                     'completed' => 'Completed', 'rejected' => 'Rejected'];
        $current  = request('status', 'all');
    @endphp
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:20px;">
        @foreach($statuses as $val => $label)
            <a href="{{ route('services.my-applications', $val === 'all' ? [] : ['status' => $val]) }}"
               style="font-size:12.5px;font-weight:600;padding:6px 14px;border-radius:20px;
                      text-decoration:none;transition:all .15s;
                      {{ $current === $val
                          ? 'background:var(--orange);color:#fff;'
                          : 'background:var(--bg-soft);color:var(--grey);border:1px solid var(--grey-light);' }}">
                {{ $label }}
                @if($val !== 'all' && isset($counts[$val]))
                    <span style="opacity:.8;">({{ $counts[$val] }})</span>
                @elseif($val === 'all')
                    <span style="opacity:.8;">({{ $applications->total() }})</span>
                @endif
            </a>
        @endforeach
    </div>

    {{-- ── Applications list ──────────────────────────────────── --}}
    @if($applications->isEmpty())
        <div class="card">
            <div class="card-body-custom" style="text-align:center;padding:60px 20px;color:var(--grey);">
                <i class="bi bi-folder2-open" style="font-size:36px;display:block;margin-bottom:12px;"></i>
                <p style="margin:0 0 16px;">
                    @if($current !== 'all')
                        No {{ $current }} applications.
                    @else
                        You haven't submitted any applications yet.
                    @endif
                </p>
                <a href="{{ route('services.index') }}" class="btn-orange"
                   style="display:inline-flex;align-items:center;gap:6px;">
                    <i class="bi bi-grid"></i> Browse Services
                </a>
            </div>
        </div>
    @else
        <div style="display:flex;flex-direction:column;gap:14px;">
            @foreach($applications as $app)
            @php
                $statusStyles = [
                    'pending'    => ['bg'=>'#fffbeb','color'=>'#d97706','border'=>'#fde68a','icon'=>'bi-hourglass-split'],
                    'processing' => ['bg'=>'#eff6ff','color'=>'#2563eb','border'=>'#bfdbfe','icon'=>'bi-arrow-repeat'],
                    'completed'  => ['bg'=>'#ecfdf5','color'=>'#059669','border'=>'#a7f3d0','icon'=>'bi-check2-circle'],
                    'rejected'   => ['bg'=>'#fef2f2','color'=>'#dc2626','border'=>'#fecaca','icon'=>'bi-x-circle'],
                ];
                $st = $statusStyles[$app->status] ?? $statusStyles['pending'];
            @endphp

            <div class="card" style="padding:0;">
                <div class="card-body-custom">
                    <div style="display:flex;align-items:flex-start;gap:14px;flex-wrap:wrap;">

                        {{-- Service icon --}}
                        <div style="width:44px;height:44px;border-radius:11px;
                                    background:var(--orange-soft);color:var(--orange);
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:20px;flex-shrink:0;">
                            <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
                        </div>

                        {{-- Main content --}}
                        <div style="flex:1;min-width:0;">
                            <div style="display:flex;align-items:center;gap:10px;flex-wrap:wrap;">
                                <span style="font-weight:700;font-size:15px;">
                                    {{ $app->service->name ?? 'Service Removed' }}
                                </span>
                                {{-- Status badge --}}
                                <span style="background:{{ $st['bg'] }};color:{{ $st['color'] }};
                                             border:1px solid {{ $st['border'] }};
                                             border-radius:20px;padding:2px 10px;
                                             font-size:11.5px;font-weight:700;">
                                    <i class="bi {{ $st['icon'] }}" style="margin-right:3px;"></i>
                                    {{ ucfirst($app->status) }}
                                </span>
                            </div>

                            <div style="font-size:12px;color:var(--grey);margin-top:4px;">
                                Submitted {{ $app->created_at->diffForHumans() }}
                                · Ref #{{ str_pad($app->id, 6, '0', STR_PAD_LEFT) }}
                                @if($app->service && $app->service->price > 0)
                                    · Fee: <strong style="color:var(--orange);">₹{{ number_format($app->service->price, 0) }}</strong>
                                @endif
                            </div>

                            {{-- Submitted field values summary --}}
                            @if(!empty($app->field_data))
                                <div style="margin-top:12px;background:var(--bg-soft);border:1px solid var(--grey-light);
                                            border-radius:9px;padding:12px 14px;">
                                    <div style="font-size:11px;font-weight:700;text-transform:uppercase;
                                                letter-spacing:.07em;color:var(--grey);margin-bottom:8px;">
                                        Submitted Details
                                    </div>
                                    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:8px;">
                                        @foreach($app->field_data as $index => $value)
                                            @php
                                                $fieldDef = $app->service->fields[$index] ?? null;
                                                $fieldLabel = $fieldDef['label'] ?? 'Field ' . ($index + 1);
                                                $fieldType  = $fieldDef['type']  ?? 'text';
                                            @endphp
                                            @if(!empty($value))
                                            <div>
                                                <div style="font-size:11px;color:var(--grey);font-weight:600;">
                                                    {{ $fieldLabel }}
                                                </div>
                                                <div style="font-size:13px;font-weight:500;
                                                            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                                    @if($fieldType === 'file')
                                                        <i class="bi bi-paperclip"></i> File uploaded
                                                    @elseif($fieldType === 'checkbox')
                                                        {{ $value ? 'Yes' : 'No' }}
                                                    @else
                                                        {{ $value }}
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            {{-- Documents uploaded --}}
                            @if(!empty($app->documents))
                                <div style="margin-top:10px;display:flex;flex-wrap:wrap;gap:7px;">
                                    @foreach($app->documents as $doc)
                                        <span style="display:inline-flex;align-items:center;gap:5px;
                                                     background:#ecfdf5;color:#059669;
                                                     border:1px solid #a7f3d0;border-radius:6px;
                                                     padding:3px 10px;font-size:12px;font-weight:600;">
                                            <i class="bi bi-shield-lock-fill"></i>
                                            {{ $doc['name'] ?? 'Document' }}
                                            <span style="font-weight:400;opacity:.75;">({{ $doc['doctype'] ?? '' }})</span>
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- View detail link --}}
                        <div style="flex-shrink:0;align-self:center;">
                            <a href="{{ route('services.application', $app) }}"
                               style="font-size:12.5px;font-weight:600;color:var(--orange);
                                      text-decoration:none;display:inline-flex;align-items:center;gap:5px;">
                                View <i class="bi bi-chevron-right"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($applications->hasPages())
            <div style="margin-top:24px;">
                {{ $applications->appends(request()->query())->links() }}
            </div>
        @endif
    @endif

</div>
@endsection

{{--
    resources/views/services/index.blade.php
    Shows all active services + a "My Applications" button.
--}}
@extends('layouts.app')
@section('title', 'Our Services')

@section('content')
<div class="container" style="max-width:900px;margin:40px auto;padding:0 16px 60px;">

    {{-- ── Header ─────────────────────────────────────────────── --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;
                flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:22px;font-weight:800;margin:0;">Our Services</h1>
            <p style="color:var(--grey);font-size:13.5px;margin-top:4px;">
                Choose a service below to submit your application.
            </p>
        </div>
        <a href="{{ route('services.my-applications') }}" class="btn-dark"
           style="display:inline-flex;align-items:center;gap:7px;white-space:nowrap;">
            <i class="bi bi-clock-history"></i> My Applications
            @if(isset($pendingCount) && $pendingCount > 0)
                <span style="background:var(--orange);color:#fff;border-radius:20px;
                             padding:1px 8px;font-size:11px;font-weight:700;">
                    {{ $pendingCount }}
                </span>
            @endif
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    {{-- ── Services Grid ───────────────────────────────────────── --}}
    @if($services->isEmpty())
        <div style="text-align:center;padding:60px 20px;color:var(--grey);">
            <i class="bi bi-inbox" style="font-size:36px;display:block;margin-bottom:12px;"></i>
            No services available at the moment.
        </div>
    @else
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:18px;">
            @foreach($services as $service)
            <div class="card" style="padding:0;">
                <div class="card-body-custom">
                    <div style="display:flex;align-items:flex-start;gap:14px;">
                        <div style="width:44px;height:44px;border-radius:11px;
                                    background:var(--orange-soft);color:var(--orange);
                                    display:flex;align-items:center;justify-content:center;
                                    font-size:20px;flex-shrink:0;">
                            <i class="bi {{ $service->icon }}"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-weight:700;font-size:14.5px;">{{ $service->name }}</div>
                            @if($service->description)
                                <div style="font-size:12.5px;color:var(--grey);margin-top:3px;
                                            white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                    {{ $service->description }}
                                </div>
                            @endif

                            {{-- Show how many times user already applied --}}
                            @if(isset($appliedMap[$service->id]) && $appliedMap[$service->id] > 0)
                                <div style="margin-top:6px;">
                                    <span style="font-size:11.5px;background:#eff6ff;color:#2563eb;
                                                 border:1px solid #bfdbfe;border-radius:6px;
                                                 padding:2px 8px;font-weight:600;">
                                        <i class="bi bi-check2"></i>
                                        Applied {{ $appliedMap[$service->id] }}×
                                    </span>
                                </div>
                            @endif

                            <div style="margin-top:10px;display:flex;align-items:center;
                                        justify-content:space-between;gap:8px;">
                                @if($service->price > 0)
                                    <span style="font-family:'Syne',sans-serif;font-weight:800;
                                                 font-size:15px;color:var(--orange);">
                                        ₹{{ number_format($service->price, 0) }}
                                    </span>
                                @else
                                    <span style="font-size:12px;color:#059669;font-weight:600;">Free</span>
                                @endif
                                <a href="{{ route('services.show', $service) }}" class="btn-orange"
                                   style="font-size:12.5px;padding:6px 14px;">
                                    Apply <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

</div>
@endsection

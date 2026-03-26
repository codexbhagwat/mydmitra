{{--
    resources/views/admin/services/index.blade.php
--}}
@extends('layouts.admin')
@section('title', 'Manage Services')
@section('page-title', 'Services')

@section('content')

<div style="display:flex;justify-content:space-between;align-items:center;
            flex-wrap:wrap;gap:12px;margin-bottom:24px;">
    <div>
        <h5 style="margin:0;font-weight:800;">All Services</h5>
        <p style="color:var(--grey);font-size:13px;margin:2px 0 0;">
            {{ $services->count() }} service{{ $services->count() !== 1 ? 's' : '' }} total
            · {{ $services->where('is_active', true)->count() }} active
        </p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn-orange">
        <i class="bi bi-plus-lg"></i> New Service
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger mb-4">{{ session('error') }}</div>
@endif

@if($services->isEmpty())
    <div class="card">
        <div class="card-body-custom" style="text-align:center;padding:60px 20px;color:var(--grey);">
            <i class="bi bi-inbox" style="font-size:40px;display:block;margin-bottom:14px;"></i>
            <p style="margin:0 0 18px;font-size:15px;">No services created yet.</p>
            <a href="{{ route('admin.services.create') }}" class="btn-orange">
                <i class="bi bi-plus-lg"></i> Create First Service
            </a>
        </div>
    </div>
@else
    <div class="card" style="padding:0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;font-size:13.5px;">
            <thead>
                <tr style="background:var(--bg-soft);border-bottom:2px solid var(--grey-light);">
                    <th style="padding:13px 18px;text-align:left;font-weight:700;color:var(--grey);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;">Service</th>
                    <th style="padding:13px 12px;text-align:left;font-weight:700;color:var(--grey);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;">Price</th>
                    <th style="padding:13px 12px;text-align:center;font-weight:700;color:var(--grey);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;">Fields</th>
                    <th style="padding:13px 12px;text-align:center;font-weight:700;color:var(--grey);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;">Docs</th>
                    <th style="padding:13px 12px;text-align:center;font-weight:700;color:var(--grey);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;">Status</th>
                    <th style="padding:13px 18px;text-align:right;font-weight:700;color:var(--grey);font-size:11.5px;text-transform:uppercase;letter-spacing:.05em;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                <tr style="border-bottom:1px solid var(--grey-light);transition:background .1s;"
                    onmouseover="this.style.background='var(--bg-soft)'"
                    onmouseout="this.style.background=''">

                    {{-- Service name + icon --}}
                    <td style="padding:14px 18px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:40px;height:40px;border-radius:10px;
                                        background:var(--orange-soft);color:var(--orange);
                                        display:flex;align-items:center;justify-content:center;
                                        font-size:18px;flex-shrink:0;">
                                <i class="bi {{ $service->icon }}"></i>
                            </div>
                            <div>
                                <div style="font-weight:700;">{{ $service->name }}</div>
                                @if($service->description)
                                    <div style="font-size:12px;color:var(--grey);
                                                max-width:240px;white-space:nowrap;
                                                overflow:hidden;text-overflow:ellipsis;">
                                        {{ $service->description }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Price --}}
                    <td style="padding:14px 12px;">
                        @if($service->price > 0)
                            <span style="font-weight:700;
                                         color:var(--orange);font-size:14px;">
                                ₹{{ number_format($service->price, 0) }}
                            </span>
                        @else
                            <span style="color:#059669;font-weight:600;font-size:12px;">Free</span>
                        @endif
                    </td>

                    {{-- Fields count --}}
                    <td style="padding:14px 12px;text-align:center;">
                        <span style="background:var(--bg-soft);border:1px solid var(--grey-light);
                                     border-radius:6px;padding:2px 10px;font-size:12px;font-weight:600;">
                            {{ count($service->fields ?? []) }}
                        </span>
                    </td>

                    {{-- Docs count --}}
                    <td style="padding:14px 12px;text-align:center;">
                        <span style="background:var(--bg-soft);border:1px solid var(--grey-light);
                                     border-radius:6px;padding:2px 10px;font-size:12px;font-weight:600;">
                            {{ count($service->required_documents ?? []) }}
                        </span>
                    </td>

                    {{-- Active toggle --}}
                    <td style="padding:14px 12px;text-align:center;">
                        <form method="POST" action="{{ route('admin.services.toggle', $service) }}"
                              style="display:inline;">
                            @csrf
                            <button type="submit" style="border:none;background:none;
                                                         cursor:pointer;padding:0;"
                                    title="Click to toggle">
                                @if($service->is_active)
                                    <span style="background:#ecfdf5;color:#059669;
                                                 border:1px solid #a7f3d0;border-radius:20px;
                                                 padding:3px 12px;font-size:12px;font-weight:600;
                                                 display:inline-flex;align-items:center;gap:5px;">
                                        <i class="bi bi-circle-fill" style="font-size:7px;"></i> Active
                                    </span>
                                @else
                                    <span style="background:#fef2f2;color:#dc2626;
                                                 border:1px solid #fecaca;border-radius:20px;
                                                 padding:3px 12px;font-size:12px;font-weight:600;
                                                 display:inline-flex;align-items:center;gap:5px;">
                                        <i class="bi bi-circle" style="font-size:7px;"></i> Inactive
                                    </span>
                                @endif
                            </button>
                        </form>
                    </td>

                    {{-- Actions --}}
                    <td style="padding:14px 18px;text-align:right;">
                        <div style="display:flex;gap:7px;justify-content:flex-end;align-items:center;">

                            {{-- Preview --}}
                            <a href="{{ route('admin.services.show', $service) }}"
                               style="display:inline-flex;align-items:center;gap:5px;
                                      font-size:12px;font-weight:600;padding:6px 12px;
                                      border-radius:8px;text-decoration:none;
                                      background:var(--bg-soft);color:var(--grey);
                                      border:1px solid var(--grey-light);"
                               title="Preview form">
                                <i class="bi bi-eye"></i> Preview
                            </a>

                            {{-- Edit --}}
                            <a href="{{ route('admin.services.edit', $service) }}"
                               class="btn-dark"
                               style="font-size:12px;padding:6px 12px;">
                                <i class="bi bi-pencil"></i> Edit
                            </a>

                            {{-- Delete --}}
                            <form method="POST"
                                  action="{{ route('admin.services.destroy', $service) }}"
                                  onsubmit="return confirm('Delete \'{{ addslashes($service->name) }}\'? This cannot be undone.')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        style="display:inline-flex;align-items:center;gap:5px;
                                               background:#fef2f2;color:#dc2626;
                                               border:1px solid #fecaca;border-radius:8px;
                                               padding:6px 12px;font-size:12px;
                                               font-weight:600;cursor:pointer;">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

@endsection

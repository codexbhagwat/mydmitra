@extends('layouts.admin')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-3">
    <h4 style="font-size:20px;font-weight:800;margin:0;">Welcome back, {{ auth()->user()->first_name }}! 👋</h4>
    <p style="color:var(--grey);font-size:13.5px;margin-top:3px;">Here's an overview of your applications and services.</p>
</div>

{{-- Stat Cards Row 1 --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="bi bi-file-earmark-text"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_applications'] }}</div>
                <div class="stat-label">Total Applications</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-check-circle"></i></div>
            <div>
                <div class="stat-value">{{ $stats['completed'] }}</div>
                <div class="stat-label">Completed</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon yellow"><i class="bi bi-clock-history"></i></div>
            <div>
                <div class="stat-value">{{ $stats['in_progress'] }}</div>
                <div class="stat-label">In Progress</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-hourglass-split"></i></div>
            <div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Pending</div>
            </div>
        </div>
    </div>
</div>

{{-- Stat Cards Row 2 --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon blue"><i class="bi bi-people"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="bi bi-grid"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_services'] }}</div>
                <div class="stat-label">Total Services</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon green"><i class="bi bi-envelope"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total_enquiries'] }}</div>
                <div class="stat-label">Total Enquiries</div>
            </div>
        </div>
    </div>
</div>

{{-- Recent Applications --}}
<div class="card mb-4">
    <div class="card-header-custom">
        <div>
            <h5>Recent Applications</h5>
            <p>Latest service applications across all users</p>
        </div>
        <a href="{{ route('admin.applications.index') }}" class="btn-sm-orange">
            <i class="bi bi-arrow-right"></i> View All
        </a>
    </div>
    <div class="card-body-custom">
        @forelse($recentApplications as $app)
            <div class="app-row">
                <div class="app-icon">
                    <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
                </div>
                <div class="app-row-info">
                    <div class="title">{{ $app->service->name }}</div>
                    <div class="meta">{{ $app->user->full_name }} &middot; Applied {{ $app->created_at->format('Y-m-d') }}</div>
                </div>
                <span class="{{ $app->status_badge }}">{{ $app->status_label }}</span>
            </div>
        @empty
            <p style="color:var(--grey);text-align:center;padding:30px 0;font-size:13.5px;">No applications yet.</p>
        @endforelse
    </div>
</div>

{{-- Recent Contact Enquiries --}}
<div class="card">
    <div class="card-header-custom">
        <div>
            <h5>Recent Contact Enquiries</h5>
            <p>Latest messages submitted by users</p>
        </div>
    </div>
    <div class="card-body-custom">
        @forelse($recentEnquiries as $enquiry)
            <div class="app-row">
                <div class="app-icon">
                    <i class="bi bi-person-lines-fill"></i>
                </div>
                <div class="app-row-info">
                    <div class="title" style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                        {{ $enquiry->name }}
                        @if($enquiry->service)
                            <span style="
                                display: inline-flex;
                                align-items: center;
                                gap: 5px;
                                font-size: 11.5px;
                                font-weight: 500;
                                padding: 3px 10px;
                                border-radius: 20px;
                                background: #E6F1FB;
                                color: #0C447C;
                                border: 0.5px solid #B5D4F4;
                                white-space: nowrap;
                            ">
                                <span style="width:6px;height:6px;border-radius:50%;background:#378ADD;display:inline-block;flex-shrink:0;"></span>
                                {{ $enquiry->service }}
                            </span>
                        @endif
                    </div>
                    <div class="meta">
                        {{ $enquiry->phone }} &middot; {{ $enquiry->email }}
                        &middot; {{ $enquiry->created_at->format('Y-m-d') }}
                    </div>
                    <div style="font-size:12.5px;color:#444;margin-top:2px;">
                        {{ Str::limit($enquiry->message, 80) }}
                    </div>
                </div>
                <span style="
                    font-size:11px;
                    padding:3px 10px;
                    border-radius:20px;
                    background:#e8f5e9;
                    color:#2e7d32;
                    white-space:nowrap;
                ">{{ ucfirst($enquiry->type ?? 'enquiry') }}</span>
            </div>
        @empty
            <p style="color:var(--grey);text-align:center;padding:30px 0;font-size:13.5px;">No enquiries yet.</p>
        @endforelse
    </div>
</div>

@endsection
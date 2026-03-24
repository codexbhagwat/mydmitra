@extends('layouts.user')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="mb-3">
    <h4 style="font-size:20px;font-weight:800;margin:0;">Welcome back, {{ auth()->user()->first_name }}! 👋</h4>
    <p style="color:var(--grey);font-size:13.5px;margin-top:3px;">Here's an overview of your applications and services.</p>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-icon orange"><i class="bi bi-file-earmark-text"></i></div>
            <div>
                <div class="stat-value">{{ $stats['total'] }}</div>
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

{{-- Recent Applications --}}
<div class="card">
    <div class="card-header-custom">
        <div>
            <h5>Recent Applications</h5>
            <p>Your latest service applications</p>
        </div>
        <a href="{{ route('user.applications') }}" class="btn-sm-orange">
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
                    <div class="meta">Applied on {{ $app->created_at->format('Y-m-d') }}</div>
                </div>
                <span class="{{ $app->status_badge }}">{{ $app->status_label }}</span>
            </div>
        @empty
            <div style="text-align:center;padding:40px 20px;">
                <div style="font-size:40px;margin-bottom:12px;">📋</div>
                <p style="color:var(--grey);font-size:14px;margin-bottom:16px;">You haven't applied for any services yet.</p>
                <a href="{{ route('services.index') }}" class="btn-orange">
                    <i class="bi bi-grid"></i> Browse Services
                </a>
            </div>
        @endforelse

        @if($recentApplications->count())
        <div style="border-top:1px solid var(--grey-light);margin-top:8px;padding-top:16px;">
            <a href="{{ route('services.index') }}" class="btn-outline-orange w-100" style="justify-content:center;">
                <i class="bi bi-plus-lg"></i> Apply for a New Service
            </a>
        </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.user')
@section('title', 'My Applications')
@section('page-title', 'My Applications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 style="font-size:18px;font-weight:800;margin:0;">My Applications</h4>
        <p style="#1a3a6b;font-size:13px;margin-top:2px;">Track all your service applications</p>
    </div>
    <a href="{{ route('services.index') }}" class="btn-orange">
        <i class="bi bi-plus-lg"></i> New Application
    </a>
</div>

<div class="card">
    <div class="card-body-custom p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Applied On</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:var(--orange-soft);display:flex;align-items:center;justify-content:center;color:var(--orange);font-size:16px;flex-shrink:0;">
                                    <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:13.5px;">{{ $app->service->name }}</div>
                                    <div style="font-size:12px;color:var(--grey);">₹{{ number_format($app->service->price, 0) }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;color:var(--grey);">{{ $app->created_at->format('d M Y') }}</td>
                        <td><span class="{{ $app->status_badge }}">{{ $app->status_label }}</span></td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="text-align:center;padding:50px;color:var(--grey);">
                            <div style="font-size:36px;margin-bottom:10px;">📭</div>
                            <p style="margin-bottom:14px;">No applications yet.</p>
                            <a href="{{ route('services.index') }}" class="btn-orange">Browse Services</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($applications->hasPages())
            <div style="padding:16px 22px;border-top:1px solid var(--grey-light);">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.admin')
@section('title', 'Services')
@section('page-title', 'Services')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 style="font-size:18px;font-weight:800;margin:0;">Services</h4>
        <p style="color:var(--grey);font-size:13px;margin-top:2px;">Manage services displayed on the website</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn-orange">
        <i class="bi bi-plus-lg"></i> Add Service
    </a>
</div>

<div class="card">
    <div class="card-body-custom p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Price</th>
                        <th>Applications</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                    <tr>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:36px;height:36px;border-radius:9px;background:var(--orange-soft);display:flex;align-items:center;justify-content:center;color:var(--orange);font-size:16px;flex-shrink:0;">
                                    <i class="bi {{ $service->icon }}"></i>
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:13.5px;">{{ $service->name }}</div>
                                    <div style="font-size:12px;color:var(--grey);">{{ Str::limit($service->description, 60) }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-family:'Syne',sans-serif;font-weight:700;font-size:14px;">₹{{ number_format($service->price, 0) }}</td>
                        <td style="font-size:13px;">{{ $service->applications->count() }}</td>
                        <td>
                            @if($service->is_active)
                                <span class="badge-completed">Active</span>
                            @else
                                <span class="badge-pending">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}" class="btn-sm-grey">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Delete this service?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align:center;padding:40px;color:var(--grey);">No services yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($services->hasPages())
            <div style="padding:16px 22px;border-top:1px solid var(--grey-light);">
                {{ $services->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

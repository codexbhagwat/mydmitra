@extends('layouts.admin')
@section('title', 'Applications')
@section('page-title', 'Applications')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 style="font-size:18px;font-weight:800;margin:0;">All Applications</h4>
        <p style="color:var(--grey);font-size:13px;margin-top:2px;">Manage and update application statuses</p>
    </div>
</div>

<div class="card">
    <div class="card-body-custom p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Service</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($applications as $app)
                    <tr>
                        <td style="color:var(--grey);font-size:12.5px;">{{ $app->id }}</td>
                        <td>
                            <div style="font-weight:600;font-size:13.5px;">{{ $app->user->full_name }}</div>
                            <div style="font-size:12px;color:var(--grey);">{{ $app->user->email }}</div>
                        </td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div style="width:30px;height:30px;border-radius:8px;background:var(--orange-soft);display:flex;align-items:center;justify-content:center;color:var(--orange);font-size:14px;">
                                    <i class="bi {{ $app->service->icon ?? 'bi-gear' }}"></i>
                                </div>
                                <span style="font-weight:600;font-size:13.5px;">{{ $app->service->name }}</span>
                            </div>
                        </td>
                        <td style="font-size:13px;color:var(--grey);">{{ $app->created_at->format('d M Y') }}</td>
                        <td><span class="{{ $app->status_badge }}">{{ $app->status_label }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('admin.applications.status', $app) }}" class="d-flex gap-2 align-items-center">
                                @csrf @method('PATCH')
                                <select name="status" class="form-control" style="width:140px;padding:5px 10px;font-size:12.5px;">
                                    <option value="pending"     {{ $app->status === 'pending'     ? 'selected' : '' }}>Pending</option>
                                    <option value="in_progress" {{ $app->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="completed"   {{ $app->status === 'completed'   ? 'selected' : '' }}>Completed</option>
                                </select>
                                <button type="submit" class="btn-sm-orange">Update</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align:center;padding:40px;color:var(--grey);">No applications found.</td>
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

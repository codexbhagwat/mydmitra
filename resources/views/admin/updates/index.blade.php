@extends('layouts.admin')

@section('title', 'Updates')
@section('page-title', 'Updates')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h5 class="mb-0 fw-semibold">All Updates</h5>
        <span style="font-size:13px;color:var(--grey);">Manage site updates &amp; announcements</span>
    </div>
    <a href="{{ route('admin.updates.create') }}" class="btn-orange">
        <i class="bi bi-plus-lg"></i> New Update
    </a>
</div>

@if($updates->count())
<div class="card-box">
    <table class="table table-hover align-middle mb-0">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Published</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($updates as $update)
            <tr>
                <td style="color:var(--grey);font-size:13px;">{{ $loop->iteration }}</td>
                <td>
                    <span class="fw-medium">{{ $update->title }}</span>
                </td>
                <td>
                    @if($update->is_active)
                        <span class="badge-status badge-completed">Active</span>
                    @else
                        <span class="badge-status badge-pending">Inactive</span>
                    @endif
                </td>
                <td style="font-size:13px;color:var(--grey);">
                    {{ $update->created_at->format('d M Y') }}
                </td>
                <td class="text-end">
                    <a href="{{ route('admin.updates.edit', $update) }}"
                       class="btn btn-sm btn-outline-secondary me-1">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('admin.updates.destroy', $update) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Delete this update?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $updates->links() }}
</div>

@else
<div class="card-box text-center py-5" style="color:var(--grey);">
    <i class="bi bi-megaphone" style="font-size:40px;opacity:.4;"></i>
    <p class="mt-3 mb-0">No updates published yet.</p>
    <a href="{{ route('admin.updates.create') }}" class="btn-orange mt-3 d-inline-block">
        Publish First Update
    </a>
</div>
@endif
@endsection
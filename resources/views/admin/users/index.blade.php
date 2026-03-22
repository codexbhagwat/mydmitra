@extends('layouts.admin')
@section('title', 'Users')
@section('page-title', 'Users')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 style="font-size:18px;font-weight:800;margin:0;">All Users</h4>
        <p style="color:var(--grey);font-size:13px;margin-top:2px;">Manage registered users</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="btn-orange">
        <i class="bi bi-plus-lg"></i> Add User
    </a>
</div>

<div class="card">
    <div class="card-body-custom p-0">
        <div class="table-responsive">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Applications</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td style="color:var(--grey);font-size:12.5px;">{{ $user->id }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div style="width:34px;height:34px;border-radius:50%;background:var(--orange);display:flex;align-items:center;justify-content:center;font-family:'Syne',sans-serif;font-weight:800;font-size:13px;color:#fff;overflow:hidden;flex-shrink:0;">
                                    @if($user->avatar)<img src="{{ $user->avatar }}" style="width:34px;height:34px;object-fit:cover;" alt="">
                                    @else{{ strtoupper(substr($user->first_name,0,1)) }}@endif
                                </div>
                                <div>
                                    <div style="font-weight:600;font-size:13.5px;">{{ $user->full_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td style="font-size:13px;">{{ $user->email }}</td>
                        <td style="font-size:13px;color:var(--grey);">{{ $user->phone ?? '—' }}</td>
                        <td>
                            <span style="font-family:'Syne',sans-serif;font-weight:700;font-size:14px;">{{ $user->applications->count() }}</span>
                        </td>
                        <td style="font-size:13px;color:var(--grey);">{{ $user->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn-sm-grey">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                      onsubmit="return confirm('Delete this user?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-sm-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:40px;color:var(--grey);">No users found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div style="padding:16px 22px;border-top:1px solid var(--grey-light);">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

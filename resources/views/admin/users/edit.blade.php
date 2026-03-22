@extends('layouts.admin')
@section('title', 'Edit User')
@section('page-title', 'Edit User')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Users
    </a>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header-custom">
        <div>
            <h5>Edit User — {{ $user->full_name }}</h5>
            <p>Update user account details</p>
        </div>
    </div>
    <div class="card-body-custom">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf @method('PUT')
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                               class="form-control @error('first_name') is-invalid @enderror">
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                               class="form-control @error('last_name') is-invalid @enderror">
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                               class="form-control @error('email') is-invalid @enderror">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                               class="form-control @error('phone') is-invalid @enderror">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-dark">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

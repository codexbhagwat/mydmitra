@extends('layouts.admin')
@section('title', 'Add User')
@section('page-title', 'Add User')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Users
    </a>
</div>

<div class="card" style="max-width:600px;">
    <div class="card-header-custom">
        <div>
            <h5>Create New User</h5>
            <p>Fill in the details to create a new user account</p>
        </div>
    </div>
    <div class="card-body-custom">
        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf
            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                               class="form-control @error('first_name') is-invalid @enderror" placeholder="First name">
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                               class="form-control @error('last_name') is-invalid @enderror" placeholder="Last name">
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror" placeholder="email@example.com">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                               class="form-control @error('phone') is-invalid @enderror" placeholder="+91 99999 99999">
                        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 characters">
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-person-plus"></i> Create User
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-dark">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

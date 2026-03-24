@extends('layouts.admin')
@section('title', 'Add Service')
@section('page-title', 'Add Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card" style="max-width:640px;">
    <div class="card-header-custom">
        <div>
            <h5>Create New Service</h5>
            <p>Add a new service that users can apply for</p>
        </div>
    </div>
    <div class="card-body-custom">
        <form method="POST" action="{{ route('admin.services.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label">Service Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror" placeholder="e.g. PAN Card Application">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Brief description of what this service covers...">{{ old('description') }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" name="price" value="{{ old('price', 0) }}" min="0" step="0.01"
                               class="form-control @error('price') is-invalid @enderror">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Bootstrap Icon Class</label>
                        <input type="text" name="icon" value="{{ old('icon', 'bi-gear') }}"
                               class="form-control @error('icon') is-invalid @enderror" placeholder="e.g. bi-credit-card">
                        <div style="font-size:11.5px;color:var(--grey);margin-top:4px;">
                            Browse at <a href="https://icons.getbootstrap.com" target="_blank" style="color:var(--orange);">icons.getbootstrap.com</a>
                        </div>
                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="is_active" checked style="width:16px;height:16px;accent-color:var(--orange);">
                    <span class="form-label" style="margin:0;">Active (visible on website)</span>
                </label>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-plus-lg"></i> Create Service
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn-dark">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

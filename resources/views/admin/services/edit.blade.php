@extends('layouts.admin')
@section('title', 'Edit Service')
@section('page-title', 'Edit Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.services.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card" style="max-width:640px;">
    <div class="card-header-custom">
        <div>
            <h5>Edit Service</h5>
            <p>Update service details</p>
        </div>
    </div>
    <div class="card-body-custom">
        <form method="POST" action="{{ route('admin.services.update', $service) }}">
            @csrf @method('PUT')

            <div class="form-group">
                <label class="form-label">Service Name</label>
                <input type="text" name="name" value="{{ old('name', $service->name) }}"
                       class="form-control @error('name') is-invalid @enderror">
                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea name="description" rows="3"
                          class="form-control @error('description') is-invalid @enderror">{{ old('description', $service->description) }}</textarea>
                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Price (₹)</label>
                        <input type="number" name="price" value="{{ old('price', $service->price) }}" min="0" step="0.01"
                               class="form-control @error('price') is-invalid @enderror">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="form-label">Bootstrap Icon Class</label>
                        <input type="text" name="icon" value="{{ old('icon', $service->icon) }}"
                               class="form-control @error('icon') is-invalid @enderror">
                        @error('icon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label style="display:flex;align-items:center;gap:10px;cursor:pointer;">
                    <input type="checkbox" name="is_active" {{ $service->is_active ? 'checked' : '' }}
                           style="width:16px;height:16px;accent-color:var(--orange);">
                    <span class="form-label" style="margin:0;">Active</span>
                </label>
            </div>

            <div class="d-flex gap-2 mt-2">
                <button type="submit" class="btn-orange">
                    <i class="bi bi-check-lg"></i> Save Changes
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn-dark">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

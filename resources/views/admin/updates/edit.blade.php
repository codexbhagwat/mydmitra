@extends('layouts.admin')

@section('title', 'Edit Update')
@section('page-title', 'Edit Update')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.updates.index') }}" style="color:var(--orange);font-size:13.5px;">
        <i class="bi bi-arrow-left"></i> Back to Updates
    </a>
</div>

<div class="card-box" style="max-width:820px;">
    <h6 class="fw-semibold mb-4" style="color:var(--dark);">
        <i class="bi bi-pencil-fill" style="color:var(--orange);"></i>
        Edit Update
    </h6>

    <form action="{{ route('admin.updates.update', $update) }}" method="POST">
        @csrf @method('PUT')

        {{-- TITLE --}}
        <div class="mb-4">
            <label class="form-label fw-medium" style="font-size:13.5px;">
                Update Title <span style="color:var(--orange);">*</span>
            </label>
            <input
                type="text"
                name="title"
                value="{{ old('title', $update->title) }}"
                class="form-control @error('title') is-invalid @enderror"
                placeholder="e.g. New service added"
                style="border-radius:8px;font-size:14px;"
            >
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- DESCRIPTION (CKEditor) --}}
        <div class="mb-4">
            <label class="form-label fw-medium" style="font-size:13.5px;">
                Description <span style="color:var(--orange);">*</span>
            </label>
            <textarea
                name="description"
                id="ck-description"
                class="form-control @error('description') is-invalid @enderror"
                rows="8"
                style="border-radius:8px;font-size:14px;"
            >{{ old('description', $update->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        {{-- STATUS --}}
        <div class="mb-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox"
                       id="is_active" name="is_active"
                       {{ old('is_active', $update->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active" style="font-size:13.5px;">
                    Active (visible on site)
                </label>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn-orange">
                <i class="bi bi-check-lg"></i> Save Changes
            </button>
            <a href="{{ route('admin.updates.index') }}"
               class="btn btn-outline-secondary" style="border-radius:8px;font-size:13.5px;">
                Cancel
            </a>
        </div>
    </form>
</div>

{{-- CKEditor 5 CDN --}}
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#ck-description'), {
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough', '|',
                    'bulletedList', 'numberedList', '|',
                    'link', 'blockQuote', '|',
                    'undo', 'redo'
                ]
            }
        })
        .then(editor => {
            editor.ui.view.element.closest('form').addEventListener('submit', () => {
                document.querySelector('#ck-description').value = editor.getData();
            });
        })
        .catch(error => {
            console.error('CKEditor error:', error);
        });
</script>
@endsection
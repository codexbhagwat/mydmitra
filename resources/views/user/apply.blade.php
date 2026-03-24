@extends('layouts.user')
@section('title', 'Apply')
@section('page-title', 'Apply for Service')

@section('content')
<div class="mb-4">
    <a href="{{ route('services.index') }}" style="color:var(--grey);font-size:13px;">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card" style="max-width:560px;">
    <div class="card-header-custom">
        <div>
            <h5>Apply for Service</h5>
            <p>Review and submit your application</p>
        </div>
    </div>
    <div class="card-body-custom">
        {{-- Service Summary --}}
        <div style="background:var(--orange-soft);border-radius:12px;padding:18px;display:flex;gap:14px;align-items:center;margin-bottom:24px;">
            <div style="width:50px;height:50px;border-radius:12px;background:var(--white);display:flex;align-items:center;justify-content:center;font-size:22px;color:var(--orange);flex-shrink:0;">
                <i class="bi {{ $service->icon }}"></i>
            </div>
            <div style="flex:1;">
                <div style="font-family:'Syne',sans-serif;font-weight:700;font-size:16px;">{{ $service->name }}</div>
                <div style="font-size:13px;color:var(--grey-dark);margin-top:2px;">{{ $service->description }}</div>
            </div>
            <div style="font-family:'Syne',sans-serif;font-weight:800;font-size:22px;color:var(--orange);flex-shrink:0;">
                ₹{{ number_format($service->price, 0) }}
            </div>
        </div>

        <form method="POST" action="{{ route('user.apply.store') }}">
            @csrf
            <input type="hidden" name="service_id" value="{{ $service->id }}">

            <div class="form-group">
                <label class="form-label">Additional Notes <span style="color:var(--grey);font-weight:400;">(optional)</span></label>
                <textarea name="notes" rows="3" class="form-control" placeholder="Any specific requirements or information...">{{ old('notes') }}</textarea>
            </div>

            <div style="background:var(--grey-bg);border-radius:10px;padding:14px 16px;margin-bottom:20px;">
                <div style="font-size:12.5px;color:var(--grey);">
                    <i class="bi bi-info-circle" style="color:var(--orange);"></i>
                    After submission, you'll be redirected to the payment page to complete your application.
                </div>
            </div>

            <button type="submit" class="btn-orange w-100" style="justify-content:center;padding:12px;">
                <i class="bi bi-send"></i> Submit Application
            </button>
        </form>
    </div>
</div>
@endsection

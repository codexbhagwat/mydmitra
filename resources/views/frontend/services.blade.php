@extends('layouts.app')
@section('title', 'Services')

@section('content')

<div style="background:var(--dark);padding:50px 0 40px;">
    <div class="container">
        <div style="display:inline-block;background:rgba(255,122,0,0.15);color:var(--orange);padding:5px 14px;border-radius:20px;font-size:12.5px;font-weight:700;margin-bottom:14px;">
            All Services
        </div>
        <h1 style="font-family:'Syne',sans-serif;font-size:clamp(28px,4vw,44px);font-weight:800;color:#fff;margin-bottom:8px;">
            Browse Our Services
        </h1>
        <p style="color:rgba(255,255,255,0.55);font-size:15px;">Apply online, pay securely, and track your application in real time.</p>
    </div>
</div>

<section style="padding:56px 0;">
    <div class="container">
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-sm-6 col-lg-4">
                <div class="service-card">
                    <div class="service-card-icon">
                        <i class="bi {{ $service->icon }}"></i>
                    </div>
                    <h5>{{ $service->name }}</h5>
                    <p>{{ $service->description }}</p>
                    <div class="service-price">₹{{ number_format($service->price, 0) }}</div>
                    @auth
                        <a href="{{ route('user.apply', $service) }}" class="btn-orange w-100" style="justify-content:center;">
                            Apply Now <i class="bi bi-arrow-right"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-orange w-100" style="justify-content:center;">
                            Login to Apply <i class="bi bi-arrow-right"></i>
                        </a>
                    @endauth
                </div>
            </div>
            @empty
            <div class="col-12 text-center" style="padding:60px 0;">
                <div style="font-size:42px;margin-bottom:14px;">🔧</div>
                <p style="color:var(--grey);font-size:15px;">No services available right now. Check back soon.</p>
            </div>
            @endforelse
        </div>

        @if($services->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $services->links() }}
        </div>
        @endif
    </div>
</section>

@endsection

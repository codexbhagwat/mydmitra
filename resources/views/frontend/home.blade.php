@extends('layouts.app')
@section('title', 'Home')

@section('content')

{{-- HERO --}}
<section class="hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-badge">
                    <i class="bi bi-lightning-charge-fill"></i> Fast. Reliable. Digital.
                </div>
                <h1>Your Gateway to <span>Digital</span> Government Services</h1>
                <p>Apply for certificates, cards, and official documents online. Track every application — all from one simple dashboard.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('services') }}" class="btn-orange" style="font-size:15px;padding:12px 28px;">
                        <i class="bi bi-grid"></i> Browse Services
                    </a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-outline-orange" style="font-size:15px;padding:12px 28px;border-color:rgba(255,255,255,0.25);color:rgba(255,255,255,0.8);">
                            Create Free Account
                        </a>
                    @endguest
                </div>

                <div class="d-flex gap-4 mt-5 flex-wrap">
                    <div>
                        <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:#1a3a6b;">500+</div>
                        <div style="font-size:12.5px;">Services Available</div>
                    </div>
                    <div>
                        <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:green;">10K+</div>
                        <div style="font-size:12.5px;">Happy Customers</div>
                    </div>
                    <div>
                        <div style="font-family:'Syne',sans-serif;font-size:26px;font-weight:800;color:var(--orange);">100%</div>
                        <div style="font-size:12.5px;">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- SERVICES SECTION --}}
<section style="padding:70px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <div style="display:inline-block;background:var(--orange-soft);color:var(--orange);padding:5px 14px;border-radius:20px;font-size:12.5px;font-weight:700;margin-bottom:14px;">
                Our Services
            </div>
            <h2 style="font-size:clamp(26px,4vw,38px);font-weight:800;margin-bottom:10px;">Everything You Need, Online</h2>
            <p style="color:#1a3a6b;font-size:15px;max-width:500px;margin:0 auto;">
                From identity documents to financial services — apply, pay, and track in minutes.
            </p>
        </div>

        <div class="row g-4">
            @foreach($services as $service)
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
            @endforeach
        </div>

        @if($services->count() >= 6)
        <div class="text-center mt-5">
            <a href="{{ route('services') }}" class="btn-outline-orange">
                View All Services <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        @endif
    </div>
</section>

{{-- HOW IT WORKS --}}
<section style="padding:70px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size:clamp(24px,3vw,36px);font-weight:800;color:#fff;">How It Works</h2>
            <p style="color:#1a3a6b;font-size:15px;margin-top:8px;">Three simple steps to complete your application</p>
        </div>
        <div class="row g-4 justify-content-center">
            @foreach([
                ['bi-grid', '01', 'Choose a Service', 'Browse our catalogue and select the service you need.'],
                ['bi-send', '02', 'Submit Application', 'Fill out the quick form and submit your application.'],
                ['bi-check2-circle', '03', 'Track & Complete', 'Pay online and track your application in real time.'],
            ] as $step)
            <div class="col-sm-6 col-md-4 text-center">
                <div style="width:60px;height:60px;border-radius:16px;background:rgba(255,122,0,0.12);display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--orange);margin:0 auto 16px;">
                    <i class="bi {{ $step[0] }}"></i>
                </div>
                <div style="font-family:'Syne',sans-serif;font-size:11px;font-weight:700;letter-spacing:1.5px;color:var(--orange);margin-bottom:6px;">STEP {{ $step[1] }}</div>
                <h5 style="font-size:16px;#1a3a6b;font-weight:700;margin-bottom:8px;">{{ $step[2] }}</h5>
                <p style="font-size:13.5px;color:#1a3a6b;">{{ $step[3] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@extends('layouts.app')
@section('title', 'Home')

@push('styles')
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  html { scroll-behavior: smooth; }

  /* ── HERO ── */
  .hero-section {
    background: #dcd7c957;
    padding: 48px 0 44px;
    overflow: hidden;
  }
  .hero-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: #e8f5e9; color: #2e7d32;
    border: 1.5px solid #a5d6a7;
    border-radius: 50px;
    padding: 5px 14px 5px 10px;
    font-size: 13px; font-weight: 500;
    margin-bottom: 22px;
  }
  .badge-dot {
    width: 18px; height: 18px;
    background: #e8f5e9; border: 1.5px solid #4caf50;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
  }
  .badge-dot i { font-size: 10px; color: #2e7d32; }

  .hero-title {
    font-size: 65px; font-weight: 600;
    line-height: 1.08; color: #111827;
    margin-bottom: 18px;
    letter-spacing: -1.5px;
  }
  .hero-subtitle {
    font-size: 15px; color: #6b7280;
    line-height: 1.7; max-width: 440px;
    margin-bottom: 28px; font-weight: 400;
  }

  .btn-view-all {
    background: #1a3a6b; color: #fff;
    border: none; padding: 11px 22px;
    border-radius: 8px; font-size: 14.5px; font-weight: 600;
    display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: background .2s;
    text-decoration: none;
  }
  .btn-view-all:hover { background: #122d56; color: #fff; }
  .btn-track {
    background: #fff; color: #374151;
    border: 1.5px solid #d1d5db;
    padding: 11px 22px; border-radius: 8px;
    font-size: 14.5px; font-weight: 600;
    cursor: pointer; transition: all .2s;
    text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
  }
  .btn-track:hover { border-color: #1a3a6b; color: #1a3a6b; }

  .hero-stats { display: flex; gap: 36px; margin-top: 40px; flex-wrap: wrap; }
  .stat-num { font-size: 32px; font-weight: 700; line-height: 1; letter-spacing: -1px; }
  .stat-num.blue   { color: #1a3a6b; }
  .stat-num.green  { color: #16a34a; }
  .stat-num.orange { color: #ea580c; }
  .stat-lbl { font-size: 13px; color: #9ca3af; margin-top: 4px; font-weight: 400; }

  /* Quick Card */
  .quick-card-wrapper {
    position: relative;
    display: inline-block;
  }
  .quick-card {
    position: relative; z-index: 2;
    background: #fff; border-radius: 18px;
    box-shadow: 0 4px 32px rgba(0,0,0,0.09), 0 1px 4px rgba(0,0,0,0.05);
    padding: 28px 28px 24px; width: 80%;
    border: 1px solid #a5a12a99;
  }
  .quick-card-wrapper::before {
    content: "";
    position: absolute;
    top: 30px; left: 28px;
    width: 78%; height: 85%;
    background: #fff;
    border-radius: 20px;
    transform: rotate(-7deg);
    z-index: 1;
  }
  .quick-card-title {
    font-size: 18px; font-weight: 700;
    color: #111827; margin-bottom: 20px; letter-spacing: -0.3px;
  }
  .qs-item {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 16px; background: #f8f9fc;
    border-radius: 10px; margin-bottom: 10px;
    border: 1px solid #f0f2f5; transition: all .18s; cursor: pointer;
  }
  .qs-item:hover { background: #eef2ff; border-color: #c7d2fe; }
  .qs-item-left {
    display: flex; align-items: center; gap: 12px;
    font-size: 14.5px; font-weight: 600; color: #111827;
  }
  .qs-icon {
    width: 36px; height: 36px; background: #e8eef8;
    border-radius: 9px; display: flex; align-items: center;
    justify-content: center; color: #1a3a6b; font-size: 16px; flex-shrink: 0;
  }
  .qs-days { font-size: 13px; color: #9ca3af; font-weight: 500; white-space: nowrap; }
  .btn-view-all-card {
    background: #1a3a6b; color: #fff; width: 100%; padding: 10px;
    border: none; border-radius: 10px; font-size: 14.5px; font-weight: 700;
    cursor: pointer; margin-top: 10px; transition: background .2s;
    display: block; text-align: center; text-decoration: none;
  }
  .btn-view-all-card:hover { background: #122d56; color: #fff; }

  /* ── SERVICES SECTION ── */
  .services-section { background: #dcd7c957; padding: 48px 0 64px; }
  .service-card {
    background: #fff; border-radius: 14px;
    padding: 24px 22px 22px; border: 1px solid #e5e7eb;
    height: 100%; transition: box-shadow .22s, transform .22s;
  }
  .service-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.09); transform: translateY(-3px); }
  .svc-icon {
    width: 42px; height: 42px; background: #e8eef8; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #1a3a6b; font-size: 19px; margin-bottom: 14px;
  }
  .service-card h6 { font-weight: 700; font-size: 15.5px; margin-bottom: 6px; color: #111827; }
  .service-card p  { font-size: 13px; color: #6b7280; margin-bottom: 18px; line-height: 1.6; }
  .service-price { font-size: 18px; font-weight: 700; color: #1a3a6b; margin-bottom: 14px; }
  .btn-apply {
    background: #1a3a6b; color: #fff; width: 100%; padding: 10px;
    border: none; border-radius: 8px; font-size: 13.5px; font-weight: 600;
    cursor: pointer; transition: background .2s; display: block;
    text-align: center; text-decoration: none;
  }
  .btn-apply:hover { background: #122d56; color: #fff; }

  /* ── WHY CHOOSE US ── */
  .why-section { background: #fff; padding: 64px 0; }
  .feature-card {
    background: #dcd7c957; border-radius: 14px;
    padding: 32px 24px; text-align: center; height: 100%;
    border: 1px solid #e5e7eb; transition: box-shadow .22s, transform .22s;
  }
  .feature-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.08); transform: translateY(-3px); }
  .feat-icon {
    width: 56px; height: 56px; background: #e8eef8; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #1a3a6b; font-size: 24px; margin: 0 auto 18px;
  }
  .feature-card h6 { font-weight: 700; font-size: 15.5px; margin-bottom: 10px; color: #111827; }
  .feature-card p  { font-size: 13.5px; color: #6b7280; line-height: 1.65; }

  /* ── STEP NUM ── */
  .step-num {
    font-size: 15px; font-weight: 700; letter-spacing: 1.5px;
    color: #ea580c; margin-bottom: 6px; text-transform: uppercase;
  }

  /* ── CTA BANNER ── */
  .cta-section {
    background: #1a3a6b;
    padding: 70px 0;
    position: relative;
    overflow: hidden;
  }
  .cta-section::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 280px; height: 280px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
  }
  .cta-section::after {
    content: '';
    position: absolute;
    bottom: -80px; left: -40px;
    width: 220px; height: 220px;
    background: rgba(255,255,255,0.04);
    border-radius: 50%;
  }
  .cta-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(255,255,255,0.12);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 50px;
    padding: 5px 14px 5px 10px;
    font-size: 13px; font-weight: 500;
    margin-bottom: 20px;
  }
  .cta-title {
    font-size: clamp(26px, 4vw, 40px);
    font-weight: 700;
    color: #fff;
    line-height: 1.15;
    letter-spacing: -0.5px;
    margin-bottom: 14px;
  }
  .cta-sub {
    font-size: 15px;
    color: rgba(255,255,255,0.72);
    line-height: 1.7;
    max-width: 500px;
    margin-bottom: 32px;
  }
  .btn-cta-white {
    background: #fff; color: #1a3a6b;
    border: none; padding: 12px 26px;
    border-radius: 8px; font-size: 14.5px; font-weight: 700;
    display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: all .2s;
    text-decoration: none;
  }
  .btn-cta-white:hover { background: #f0f4ff; color: #122d56; }
  .btn-cta-outline {
    background: transparent; color: #fff;
    border: 1.5px solid rgba(255,255,255,0.45);
    padding: 12px 26px; border-radius: 8px;
    font-size: 14.5px; font-weight: 600;
    display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: all .2s;
    text-decoration: none;
  }
  .btn-cta-outline:hover { border-color: #fff; background: rgba(255,255,255,0.08); color: #fff; }

  .cta-info-item {
    display: flex; align-items: center; gap: 12px;
    color: rgba(255,255,255,0.85);
    font-size: 14px; font-weight: 500;
    margin-bottom: 18px;
  }
  .cta-info-icon {
    width: 42px; height: 42px; flex-shrink: 0;
    background: rgba(255,255,255,0.12);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px; color: #fff;
  }
  .cta-info-label { font-size: 12px; color: rgba(255,255,255,0.5); display: block; }
  .cta-info-value { font-size: 14px; font-weight: 600; color: #fff; display: block; }

  /* ── CTA STATS GRID ── */
  .cta-stats-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }
  .cta-stat-card {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.14);
    border-radius: 14px;
    padding: 22px 18px;
    text-align: center;
    transition: background .2s;
  }
  .cta-stat-card:hover { background: rgba(255,255,255,0.13); }
  .cta-stat-icon {
    font-size: 22px; color: rgba(255,255,255,0.75);
    margin-bottom: 10px;
  }
  .cta-stat-num {
    font-size: 28px; font-weight: 800;
    color: #fff; line-height: 1;
    letter-spacing: -1px; margin-bottom: 6px;
  }
  .cta-stat-label {
    font-size: 12.5px; color: rgba(255,255,255,0.55);
    font-weight: 500; line-height: 1.4;
  }

  /* ── SCROLL REVEAL ── */
  .reveal { opacity: 0; transform: translateY(22px); transition: opacity .6s ease, transform .6s ease; }
  .reveal.in { opacity: 1; transform: none; }
  .rd1 { transition-delay: .08s; }
  .rd2 { transition-delay: .16s; }
  .rd3 { transition-delay: .24s; }

  /* ── RESPONSIVE ── */
  @media (max-width: 991px) {
    .hero-title { font-size: 44px; letter-spacing: -1px; }
    .hero-subtitle { max-width: 100%; }
    .hero-stats { gap: 24px; }
    .stat-num { font-size: 26px; }
    .quick-card { width: 100%; }
    .quick-card-wrapper { padding: 16px 0; }
  }
  @media (max-width: 767px) {
    .hero-title { font-size: 34px; letter-spacing: -0.5px; }
    .hero-subtitle { font-size: 14px; }
    .hero-stats { flex-wrap: wrap; gap: 20px; margin-top: 28px; }
    .stat-num { font-size: 24px; }
    .quick-card { width: 100%; padding: 20px 16px 18px; }
    .qs-item { padding: 12px; }
    .cta-sub { font-size: 14px; }
  }
  @media (max-width: 480px) {
    .hero-title { font-size: 28px; }
    .hero-badge { font-size: 12px; }
    .stat-num { font-size: 22px; }
    .quick-card-title { font-size: 16px; }
    .cta-section { padding: 52px 0; }
  }
</style>
@endpush

@section('content')

{{-- ═══════════════ HERO ═══════════════ --}}
<section class="hero-section">
  <div class="container">
    <div class="row align-items-center g-4">

      {{-- LEFT --}}
      <div class="col-lg-5">
        <div class="hero-badge">
          <div class="badge-dot"><i class="bi bi-check2"></i></div>
          Authorized Government Service Center
        </div>
        <h1 class="hero-title">
          All Government<br>
          Services Under<br>
          One Roof
        </h1>
        <p class="hero-subtitle">
          Your trusted D-Mitra service center for all government services,
          banking solutions, and document processing. Fast, reliable, and
          hassle-free services for citizens.
        </p>
        <div class="d-flex gap-3 flex-wrap">
          <a href="{{ route('services.index') }}" class="btn-view-all">
            View All Services <i class="bi bi-arrow-right"></i>
          </a>
          @auth
            <a href="{{ route('user.dashboard') }}" class="btn-track">
              <i class="bi bi-speedometer2"></i> My Dashboard
            </a>
          @else
            <a href="{{ route('register') }}" class="btn-track">
              Track Application
            </a>
          @endauth
        </div>
        <div class="hero-stats">
          <div>
            <div class="stat-num blue">500+</div>
            <div class="stat-lbl">Services Available</div>
          </div>
          <div>
            <div class="stat-num green">10K+</div>
            <div class="stat-lbl">Happy Customers</div>
          </div>
          <div>
            <div class="stat-num orange">5+</div>
            <div class="stat-lbl">Years Experience</div>
          </div>
        </div>
      </div>

      {{-- RIGHT — Quick Services Card --}}
      <div class="col-lg-7 d-flex align-items-center justify-content-end">
        <div class="quick-card-wrapper">
          <div class="quick-card">
            <div class="quick-card-title">Quick Services</div>

            <div class="qs-item">
              <div class="qs-item-left">
                <div class="qs-icon"><i class="bi bi-file-earmark-text"></i></div>
                Birth/Death Certificate
              </div>
              <span class="qs-days">2-3 Days</span>
            </div>

            <div class="qs-item">
              <div class="qs-item-left">
                <div class="qs-icon"><i class="bi bi-building"></i></div>
                Property Documents
              </div>
              <span class="qs-days">5-7 Days</span>
            </div>

            <div class="qs-item">
              <div class="qs-item-left">
                <div class="qs-icon"><i class="bi bi-shield-check"></i></div>
                Aadhaar Services
              </div>
              <span class="qs-days">Same Day</span>
            </div>

            <a href="{{ route('services.index') }}" class="btn-view-all-card">
              View All Services
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

{{-- ═══════════════ SERVICES ═══════════════ --}}
<section class="services-section" id="services">
  <div class="container">
    <div class="text-center mb-5">
      <div style="display:inline-block;background:#e8eef8;color:#1a3a6b;padding:5px 14px;border-radius:20px;font-size:14.5px;font-weight:700;margin-bottom:14px;">
        Our Services
      </div>
      <h2 style="font-size:clamp(26px,4vw,34px);font-weight:700;margin-bottom:10px;color:#111827;">Everything You Need, Online</h2>
      <p style="color:#6b7280;font-size:15px;margin:0 auto;white-space:nowrap;">
        From identity documents to financial services — apply, pay, and track in minutes.
      </p>
    </div>

    <div class="row g-4">
      @foreach($services as $service)
      <div class="col-sm-6 col-lg-4 reveal">
        <div class="service-card">
          <div class="svc-icon">
            <i class="bi {{ $service->icon }}"></i>
          </div>
          <h6>{{ $service->name }}</h6>
          <p>{{ $service->description }}</p>
          <div class="service-price">₹{{ number_format($service->price, 0) }}</div>
          @auth
            <a href="{{ route('user.apply', $service) }}" class="btn-apply">
              Apply Now <i class="bi bi-arrow-right"></i>
            </a>
          @else
            <a href="{{ route('login') }}" class="btn-apply">
              Login to Apply <i class="bi bi-arrow-right"></i>
            </a>
          @endauth
        </div>
      </div>
      @endforeach
    </div>

    @if($services->count() >= 6)
    <div class="text-center mt-5">
      <a href="{{ route('services.index') }}" class="btn-view-all" style="margin: 0 auto;">
        View All Services <i class="bi bi-arrow-right"></i>
      </a>
    </div>
    @endif
  </div>
</section>

{{-- ═══════════════ WHY CHOOSE US ═══════════════ --}}
<section class="why-section">
  <div class="container">
    <h2 style="font-weight:700;font-size:34px;text-align:center;color:#111827;letter-spacing:-0.5px;">Why Choose Us?</h2>
    <p style="text-align:center;color:#6b7280;font-size:15px;margin-top:8px;margin-bottom:44px;">We provide reliable and efficient services with complete transparency</p>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3 reveal rd1">
        <div class="feature-card">
          <div class="feat-icon"><i class="bi bi-clock"></i></div>
          <h6>Quick Processing</h6>
          <p>Fast and efficient service with minimal waiting time. Most documents processed within 24-48 hours.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 reveal rd2">
        <div class="feature-card">
          <div class="feat-icon"><i class="bi bi-shield-check"></i></div>
          <h6>Authorized Center</h6>
          <p>Government authorized e-Mitra service center with all necessary certifications and approvals.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 reveal rd3">
        <div class="feature-card">
          <div class="feat-icon"><i class="bi bi-people"></i></div>
          <h6>Expert Staff</h6>
          <p>Trained and experienced staff to assist you with all your documentation needs.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3 reveal rd1">
        <div class="feature-card">
          <div class="feat-icon"><i class="bi bi-headset"></i></div>
          <h6>Customer Support</h6>
          <p>Dedicated customer support for tracking applications and resolving queries.</p>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- ═══════════════ HOW IT WORKS ═══════════════ --}}
<section style="background:#fff;padding:64px 0;">
  <div class="container">
    <div class="text-center mb-5">
      <h2 style="font-size:clamp(24px,3vw,34px);font-weight:700;color:#111827;">How It Works</h2>
      <p style="color:#6b7280;font-size:15px;margin-top:8px;">Three simple steps to complete your application</p>
    </div>
    <div class="row g-4 justify-content-center">
      @foreach([
        ['bi-grid', '01', 'Choose a Service', 'Browse our catalogue and select the service you need.'],
        ['bi-send', '02', 'Submit Application', 'Fill out the quick form and submit your application.'],
        ['bi-check2-circle', '03', 'Track & Complete', 'Pay online and track your application in real time.'],
      ] as $step)
      <div class="col-sm-6 col-md-4 text-center reveal rd{{ $loop->index + 1 }}">
        <div class="step-icon">
          <i class="bi {{ $step[0] }}"></i>
        </div>
        <div class="step-num">STEP {{ $step[1] }}</div>
        <h5 style="font-size:16px;font-weight:700;margin-bottom:8px;color:#111827;">{{ $step[2] }}</h5>
        <p style="font-size:13.5px;color:#6b7280;">{{ $step[3] }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

{{-- ═══════════════ CTA BANNER ═══════════════ --}}
<section class="cta-section">
  <div class="container" style="position:relative;z-index:2;">
    <div class="row align-items-center g-5">

      {{-- LEFT: Text + Buttons --}}
      <div class="col-lg-7 reveal rd1">
        <div class="cta-badge">
          <i class="bi bi-lightning-charge-fill"></i>
          Get Started Today
        </div>
        <h2 class="cta-title">
          Ready to Apply for<br>Your Government Service?
        </h2>
        <p class="cta-sub">
          Join thousands of satisfied citizens who trust D-Mitra for fast,
          transparent, and hassle-free government document processing.
          Register now and get started in minutes.
        </p>
        <div class="d-flex gap-3 flex-wrap">
          @auth
            <a href="{{ route('services.index') }}" class="btn-cta-white">
              Browse Services <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('user.dashboard') }}" class="btn-cta-outline">
              <i class="bi bi-speedometer2"></i> My Dashboard
            </a>
          @else
            <a href="{{ route('register') }}" class="btn-cta-white">
              Register Free <i class="bi bi-arrow-right"></i>
            </a>
            <a href="{{ route('login') }}" class="btn-cta-outline">
              <i class="bi bi-box-arrow-in-right"></i> Login
            </a>
          @endauth
        </div>
      </div>

      {{-- RIGHT: Trust Stats --}}
      <div class="col-lg-5 reveal rd2">
        <div class="cta-stats-grid">
          <div class="cta-stat-card">
            <div class="cta-stat-icon"><i class="bi bi-file-earmark-check"></i></div>
            <div class="cta-stat-num">50K+</div>
            <div class="cta-stat-label">Applications Processed</div>
          </div>
          <div class="cta-stat-card">
            <div class="cta-stat-icon"><i class="bi bi-patch-check"></i></div>
            <div class="cta-stat-num">100%</div>
            <div class="cta-stat-label">Government Authorized</div>
          </div>
          <div class="cta-stat-card">
            <div class="cta-stat-icon"><i class="bi bi-emoji-smile"></i></div>
            <div class="cta-stat-num">10K+</div>
            <div class="cta-stat-label">Happy Customers</div>
          </div>
          <div class="cta-stat-card">
            <div class="cta-stat-icon"><i class="bi bi-lightning-charge"></i></div>
            <div class="cta-stat-num">24hr</div>
            <div class="cta-stat-label">Average Processing</div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

{{-- ═══════════════ FOOTER ═══════════════ --}}
@section('footer')
<footer style="background:#111827;color:#9ca3af;padding:52px 0 0;">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-3 col-md-6">
        <div style="display:flex;align-items:center;gap:10px;margin-bottom:14px;">
          <div style="width:40px;height:40px;background:#1a3a6b;border-radius:10px;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:800;font-size:13px;">DM</div>
          <div>
            <span style="font-weight:800;color:#fff;font-size:17px;display:block;line-height:1.1;">D-Mitra</span>
            <span style="font-size:11.5px;color:#6b7280;">Service Center</span>
          </div>
        </div>
        <p style="font-size:13px;color:#6b7280;line-height:1.75;max-width:230px;">Your trusted D-Mitra partner for all government services, banking solutions, and document processing needs.</p>
      </div>

      <div class="col-lg-2 col-md-6 col-6">
        <h6 style="color:#fff;font-weight:700;font-size:13px;letter-spacing:0.07em;text-transform:uppercase;margin-bottom:18px;">Quick Links</h6>
        <ul style="list-style:none;padding:0;">
          <li style="margin-bottom:10px;"><a href="{{ route('home') }}" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Home</a></li>
          <li style="margin-bottom:10px;"><a href="{{ route('services.index') }}" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Services</a></li>
          <li style="margin-bottom:10px;"><a href="{{ route('contact') }}" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Contact</a></li>
          @guest
          <li style="margin-bottom:10px;"><a href="{{ route('login') }}" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Login444444444</a></li>
          <li style="margin-bottom:10px;"><a href="{{ route('register') }}" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Register</a></li>
          @endguest
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 col-6">
        <h6 style="color:#fff;font-weight:700;font-size:13px;letter-spacing:0.07em;text-transform:uppercase;margin-bottom:18px;">Services</h6>
        <ul style="list-style:none;padding:0;">
          <li style="margin-bottom:10px;"><a href="#" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Birth Certificate</a></li>
          <li style="margin-bottom:10px;"><a href="#" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Bank Account</a></li>
          <li style="margin-bottom:10px;"><a href="#" style="color:#6b7280;text-decoration:none;font-size:13.5px;">PAN Card</a></li>
          <li style="margin-bottom:10px;"><a href="#" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Aadhaar Services</a></li>
          <li style="margin-bottom:10px;"><a href="#" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Driving License</a></li>
          <li style="margin-bottom:10px;"><a href="#" style="color:#6b7280;text-decoration:none;font-size:13.5px;">Passport Help</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6">
        <h6 style="color:#fff;font-weight:700;font-size:13px;letter-spacing:0.07em;text-transform:uppercase;margin-bottom:18px;">Contact Info</h6>
        <div style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#6b7280;margin-bottom:10px;">
          <i class="bi bi-geo-alt-fill" style="color:#4b6cb7;margin-top:2px;"></i> Bhilwara, Rajasthan, India
        </div>
        <div style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#6b7280;margin-bottom:10px;">
          <i class="bi bi-telephone-fill" style="color:#4b6cb7;margin-top:2px;"></i> +91 7568359165
        </div>
        <div style="display:flex;align-items:flex-start;gap:8px;font-size:13px;color:#6b7280;margin-bottom:10px;">
          <i class="bi bi-envelope-fill" style="color:#4b6cb7;margin-top:2px;"></i> superamitt3107@gmail.com
        </div>
      </div>

    </div>
    <hr style="border-color:#1f2937;margin:36px 0 0;"/>
    <div style="padding:16px 0;display:flex;justify-content:space-between;flex-wrap:wrap;gap:8px;font-size:12.5px;color:#4b5563;">
      <span>© {{ date('Y') }} D-Mitra Service Center. All rights reserved.</span>
      <div class="d-flex gap-3">
        <a href="#" style="color:#6b7280;text-decoration:none;">Privacy Policy</a>
        <a href="#" style="color:#6b7280;text-decoration:none;">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>
@endsection

@push('scripts')
<script>
  // Scroll reveal
  const els = document.querySelectorAll('.reveal');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('in'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.1 });
  els.forEach(el => obs.observe(el));
</script>
@endpush
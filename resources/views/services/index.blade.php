{{--
    resources/views/services/index.blade.php
    Shows all active services + a "My Applications" button.
--}}
@extends('layouts.app')
@section('title', 'Our Services')

@push('styles')
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }

  .services-page-section { background: #dcd7c957; padding: 48px 0 64px; }

  .service-card {
    background: #fff;
    border-radius: 14px;
    padding: 24px 22px 22px;
    border: 1px solid #e5e7eb;
    height: 100%;
    transition: box-shadow .22s, transform .22s;
    display: flex;
    flex-direction: column;
  }
  .service-card:hover { box-shadow: 0 8px 28px rgba(0,0,0,0.09); transform: translateY(-3px); }

  .svc-icon {
    width: 42px; height: 42px; background: #e8eef8; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    color: #1a3a6b; font-size: 19px; margin-bottom: 14px;
    flex-shrink: 0;
  }
  .service-card h6 { font-weight: 700; font-size: 15.5px; margin-bottom: 6px; color: #111827; }
  .service-card p  { font-size: 13px; color: #6b7280; margin-bottom: 18px; line-height: 1.6; flex: 1; }
  .service-price { font-size: 18px; font-weight: 700; color: #1a3a6b; margin-bottom: 14px; }

  .applied-badge {
    display: inline-block;
    font-size: 11.5px; background: #eff6ff; color: #2563eb;
    border: 1px solid #bfdbfe; border-radius: 6px;
    padding: 2px 8px; font-weight: 600;
    margin-bottom: 10px;
  }

  .btn-apply {
    background: #1a3a6b; color: #fff; width: 100%; padding: 10px;
    border: none; border-radius: 8px; font-size: 13.5px; font-weight: 600;
    cursor: pointer; transition: background .2s; display: flex;
    align-items: center; justify-content: center; gap: 7px;
    text-decoration: none; margin-top: auto;
  }
  .btn-apply:hover { background: #122d56; color: #fff; }

  .btn-dark {
    background: #1a3a6b; color: #fff;
    border: none; padding: 10px 20px;
    border-radius: 8px; font-size: 14px; font-weight: 600;
    display: inline-flex; align-items: center; gap: 8px;
    cursor: pointer; transition: background .2s;
    text-decoration: none;
  }
  .btn-dark:hover { background: #122d56; color: #fff; }

  .badge-orange {
    background: #ea580c; color: #fff;
    border-radius: 20px; padding: 1px 8px;
    font-size: 11px; font-weight: 700;
  }

  /* Scroll reveal */
  .reveal { opacity: 0; transform: translateY(22px); transition: opacity .6s ease, transform .6s ease; }
  .reveal.in { opacity: 1; transform: none; }
  .rd1 { transition-delay: .08s; }
  .rd2 { transition-delay: .16s; }
  .rd3 { transition-delay: .24s; }

  @media (max-width: 767px) {
    .services-page-section { padding: 32px 0 48px; }
    .service-card { padding: 20px 16px 18px; }
  }
</style>
@endpush

@section('content')
<section class="services-page-section">
  <div class="container">

    {{-- ── Header ── --}}
    {{-- ── Header ─────────────────────────────────────────────── --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;
                flex-wrap:wrap;gap:12px;margin-bottom:28px;">
        <div>
            <h1 style="font-size:22px;font-weight:800;margin:0;">Our Services</h1>
            <p style="color:var(--grey);font-size:13.5px;margin-top:4px;">
                Choose a service below to submit your application.
            </p>
        </div>
        <a href="{{ route('services.my-applications') }}" class="btn-dark"
           style="display:inline-flex;align-items:center;gap:7px;white-space:nowrap;">
            <i class="bi bi-clock-history"></i> My Applications
            @if(isset($pendingCount) && $pendingCount > 0)
                <span style="background:var(--orange);color:#fff;border-radius:20px;
                             padding:1px 8px;font-size:11px;font-weight:700;">
                    {{ $pendingCount }}
                </span>
            @endif
        </a>
    </div>

    @if(session('success'))
      <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
      <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    {{-- ── Services Grid ── --}}
    @if($services->isEmpty())
      <div style="text-align:center;padding:60px 20px;color:#6b7280;">
        <i class="bi bi-inbox" style="font-size:36px;display:block;margin-bottom:12px;"></i>
        No services available at the moment.
      </div>
    @else
      <div class="row g-4">
        @foreach($services as $service)
        <div class="col-sm-6 col-lg-4 reveal rd{{ ($loop->index % 3) + 1 }}">
          <div class="service-card">
            <div class="svc-icon">
              <i class="bi {{ $service->icon }}"></i>
            </div>
            <h6>{{ $service->name }}</h6>
            @if($service->description)
              <p>{{ $service->description }}</p>
            @endif

            @if(isset($appliedMap[$service->id]) && $appliedMap[$service->id] > 0)
              <div>
                <span class="applied-badge">
                  <i class="bi bi-check2"></i> Applied {{ $appliedMap[$service->id] }}×
                </span>
              </div>
            @endif

            <div class="service-price">
              @if($service->price > 0)
                ₹{{ number_format($service->price, 0) }}
              @else
                <span style="font-size:14px;color:#16a34a;">Free</span>
              @endif
            </div>

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
    @endif

  </div>
</section>
@endsection

@push('scripts')
<script>
  const els = document.querySelectorAll('.reveal');
  const obs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) { e.target.classList.add('in'); obs.unobserve(e.target); }
    });
  }, { threshold: 0.1 });
  els.forEach(el => obs.observe(el));
</script>
@endpush
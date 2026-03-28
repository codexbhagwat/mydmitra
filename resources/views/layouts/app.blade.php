<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Home') — Mydmitra</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    /* ── TOP BAR ── */
    .topbar {

      background: #1a3a6b;
      color: #fff;
      font-size: 13px;
      padding: 7px 0;
    }
    .topbar i { font-size: 13px; }
    .topbar .sep { margin: 0 14px; opacity: 0.45; }

    /* ── NAVBAR ── */
    .site-navbar {
      background: #fff;
      border-bottom: 1px solid #e5e7eb;
      padding: 0;
      min-height: 68px;
      box-shadow: 0 1px 4px rgba(0,0,0,0.06);
    }
    .site-navbar .container {
      min-height: 68px;
      display: flex;
      align-items: center;
    }
    .navbar-brand-text {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
    }
    .brand-icon {
      width: 42px; height: 42px;
      background: #1a3a6b;
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-weight: 800; font-size: 14px;
      letter-spacing: -0.5px; flex-shrink: 0;
    }
    .brand-name { font-weight: 700; font-size: 20px; color: #1a1a2e; line-height: 1.1; }
    .brand-sub  { font-size: 11.5px; color: #9ca3af; font-weight: 500; }

    .nav-link {
      color: #374151 !important;
      font-size: 14.5px; font-weight: 500;
      padding: 8px 16px !important;
      transition: color .18s;
      text-decoration: none;
    }
    .nav-link:hover { color: #1a3a6b !important; }

    /* Navbar Buttons */
    .btn-nav-login {
      background: #fff; color: #374151;
      border: 1.5px solid #d1d5db;
      font-size: 14px; font-weight: 600;
      padding: 8px 22px; border-radius: 8px;
      cursor: pointer; transition: all .2s;
      text-decoration: none; display: inline-flex;
      align-items: center; gap: 6px;
    }
    .btn-nav-login:hover { border-color: #1a3a6b; color: #1a3a6b; }

    .btn-nav-dashboard {
      background: #1a3a6b; color: #fff;
      border: none; font-size: 14px; font-weight: 600;
      padding: 8px 22px; border-radius: 8px;
      cursor: pointer; transition: background .2s;
      text-decoration: none; display: inline-flex;
      align-items: center; gap: 6px;
    }
    .btn-nav-dashboard:hover { background: #122d56; color: #fff; }

    .btn-nav-logout {
      background: #fff; color: #374151;
      border: 1.5px solid #d1d5db;
      font-size: 14px; font-weight: 600;
      padding: 8px 14px; border-radius: 8px;
      cursor: pointer; transition: all .2s;
      display: inline-flex; align-items: center;
    }
    .btn-nav-logout:hover { border-color: #ef4444; color: #ef4444; }

    /* User Pill */
    .user-pill {
      display: flex; align-items: center; gap: 8px;
      background: #f3f4f6; border-radius: 50px;
      padding: 5px 14px 5px 6px;
      font-size: 13.5px; font-weight: 600; color: #111827;
    }
    .user-pill-avatar {
      width: 30px; height: 30px;
      background: #1a3a6b; border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      color: #fff; font-size: 12px; font-weight: 700; flex-shrink: 0;
    }

    /* Mobile toggler */
    .navbar-toggler-custom {
      background: none; border: 1.5px solid #d1d5db;
      border-radius: 8px; padding: 6px 10px; cursor: pointer;
      display: none;
    }
    .navbar-toggler-custom i { font-size: 18px; color: #374151; }

    /* ── FOOTER ── */
    .site-footer { background: #111827; color: #9ca3af; padding: 52px 0 0; margin-top: 0; }
    .footer-logo-icon {
      width: 40px; height: 40px; background: #1a3a6b;
      border-radius: 10px; display: inline-flex; align-items: center;
      justify-content: center; color: #fff; font-weight: 800; font-size: 13px;
    }
    .site-footer h6 {
      color: #fff; font-weight: 700; font-size: 13px;
      letter-spacing: 0.07em; text-transform: uppercase; margin-bottom: 18px;
    }
    .site-footer ul { list-style: none; padding: 0; margin: 0; }
    .site-footer ul li { margin-bottom: 10px; }
    .site-footer ul li a {
      color: #a0acc5; text-decoration: none;
      font-size: 13.5px; transition: color .18s;
    }
    .site-footer ul li a:hover { color: #fff; }
    .footer-ci {
      display: flex; align-items: flex-start; gap: 8px;
      font-size: 13px; color: #a0acc5; margin-bottom: 10px;
    }
    .footer-ci i { color: #4b6cb7; margin-top: 2px; flex-shrink: 0; }
    .footer-hr { border-color: #1f2937; margin: 36px 0 0; }
    .footer-bottom {
      padding: 16px 0; display: flex;
      justify-content: space-between; flex-wrap: wrap; gap: 8px;
      font-size: 12.5px; color: #4b5563;
    }
    .footer-bottom a { color: #6b7280; text-decoration: none; transition: color .18s; }
    .footer-bottom a:hover { color: #fff; }

    /* ── RESPONSIVE ── */
    @media (max-width: 991px) {
      .nav-links-group { display: none; }
      .navbar-toggler-custom { display: block; }
      .nav-collapse { display: none; flex-direction: column; gap: 8px; }
      .nav-collapse.show { display: flex; }
      .topbar .sep { display: none; }
    }
    @media (max-width: 767px) {
      .topbar { font-size: 12px; }
      .topbar .d-flex.justify-content-between { flex-direction: column; gap: 2px; text-align: center; }
      .site-footer { padding: 36px 0 0; }
      .footer-bottom { flex-direction: column; align-items: center; text-align: center; }
    }
  </style>
  @stack('styles')
</head>
<body style="background:#f0f2f0;">

{{-- ── STICKY WRAPPER (Topbar + Navbar dono sticky) ── --}}
<div style="position: sticky; top: 0; z-index: 999;">

  {{-- ── TOP BAR ── --}}
  <div class="topbar">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-1">
      <div class="d-flex align-items-center flex-wrap gap-1">
        <i class="bi bi-telephone-fill me-1"></i> +91 7568359165
        <span class="sep">|</span>
        <i class="bi bi-envelope-fill me-1"></i> superamitt3107@gmail.com
      </div>
      <div class="d-flex align-items-center gap-1">
        <i class="bi bi-clock"></i> Mon-Sat: 9:00 AM - 7:00 PM
      </div>
    </div>
  </div>

  {{-- ── NAVBAR ── --}}
  <nav class="site-navbar">
    <div class="container d-flex align-items-center justify-content-between w-100">

      {{-- Brand --}}
      <a href="{{ route('home') }}" class="navbar-brand-text">
        <div class="brand-icon">DM</div>
        <div>
          <div class="brand-name">D-Mitra</div>
          <div class="brand-sub">Service Center</div>
        </div>
      </a>

      {{-- Desktop Nav Links --}}
<div class="d-none d-lg-flex align-items-center gap-1">
    <a href="{{ route('services.index') }}" class="nav-link">Services</a>
    <a href="{{ route('government.index') }}" class="nav-link">Government</a>        
    <a href="{{ route('banking.index') }}" class="nav-link">Banking</a>
    <a href="{{ route('document.index') }}" class="nav-link">Document</a>
    <a href="{{ route('contact') }}" class="nav-link">Contact</a>
</div>

      {{-- Desktop Auth Buttons --}}
      <div class="d-none d-lg-flex align-items-center gap-2">
        @auth
          <div class="user-pill">
            <div class="user-pill-avatar">
              @if(auth()->user()->avatar)
                <img src="{{ auth()->user()->avatar }}" style="width:30px;height:30px;border-radius:50%;object-fit:cover;" alt="">
              @else
                {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
              @endif
            </div>
            <span>{{ auth()->user()->first_name }}</span>
          </div>
          <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
             class="btn-nav-dashboard">
            <i class="bi bi-grid-1x2"></i> Dashboard
          </a>
          <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn-nav-logout" title="Logout">
              <i class="bi bi-box-arrow-right"></i>
            </button>
          </form>
        @else
          <a href="{{ route('login') }}" class="btn-nav-login">
            <i class="bi bi-person"></i> Login
          </a>
          <a href="{{ route('register') }}" class="btn-nav-dashboard">
            Register
          </a>
        @endauth
      </div>

      {{-- Mobile Toggler --}}
      <button class="navbar-toggler-custom d-lg-none" onclick="toggleMobileNav()" aria-label="Toggle navigation">
        <i class="bi bi-list" id="nav-icon"></i>
      </button>
    </div>

    {{--  Nav Collapse --}}
    <div class="nav-collapse d-lg-none" id="mobileNav" style="background:#fff;border-top:1px solid #e5e7eb;padding:12px 16px;">
      <a href="{{ route('home') }}" class="nav-link">Home</a>
      <a href="{{ route('services.index') }}" class="nav-link">Services</a>
      <a href="#contact" class="nav-link">Contact</a>
      <hr style="border-color:#e5e7eb;margin:8px 0;">
      @auth
        <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
           class="btn-nav-dashboard w-100 justify-content-center mb-2">
          <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="btn-nav-login w-100 justify-content-center">
            <i class="bi bi-box-arrow-right"></i> Logout
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn-nav-login w-100 justify-content-center mb-2">
          <i class="bi bi-person"></i> Login
        </a>
        <a href="{{ route('register') }}" class="btn-nav-dashboard w-100 justify-content-center">
          Register
        </a>
      @endauth
    </div>
  </nav>

</div>
{{-- ── END STICKY WRAPPER ── --}}

{{-- Flash Messages --}}
@if(session('success'))
  <div class="container mt-3">
    <div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
  </div>
@endif
@if(session('error'))
  <div class="container mt-3">
    <div class="flash flash-error"><i class="bi bi-x-circle-fill"></i> {{ session('error') }}</div>
  </div>
@endif

{{-- ── PAGE CONTENT ── --}}
@yield('content')

{{-- ── FOOTER ── --}}
<footer class="site-footer">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-3 col-md-6">
        <div class="d-flex align-items-center gap-2 mb-3">
          <div class="footer-logo-icon">DM</div>
          <div>
            <span style="font-weight:700;color:#fff;font-size:17px;display:block;line-height:1.1;">D-Mitra</span>
            <span style="font-size:11.5px;color:#c4cde0;">Service Center</span>
          </div>
        </div>
        <p style="font-size:13px;color:#c4cde0;line-height:1.75;max-width:230px;">
          Your trusted D-Mitra partner for all government services, banking solutions, and document processing needs.
        </p>
      </div>

      <div class="col-lg-2 col-md-6 col-6">
        <h6>Quick Links</h6>
        <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('services.index') }}">Services</a></li>
          <li><a href="{{ route('contact') }}">Contact</a></li>
          @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
          @endguest
          @auth
            <li><a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}">Dashboard</a></li>
          @endauth
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 col-6">
        <h6>Services</h6>
        <ul>
          <li><a href="#">Birth Certificate</a></li>
          <li><a href="#">Bank Account</a></li>
          <li><a href="#">PAN Card</a></li>
          <li><a href="#">Aadhaar Services</a></li>
          <li><a href="#">Driving License</a></li>
          <li><a href="#">Passport Help</a></li>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6">
        <h6>Contact Info</h6>
        <div class="footer-ci"><i class="bi bi-geo-alt-fill"></i> Bhilwara, Rajasthan, India</div>
        <div class="footer-ci"><i class="bi bi-telephone-fill"></i> +91 7568359165</div>
        <div class="footer-ci"><i class="bi bi-envelope-fill"></i> superamitt3107@gmail.com</div>
        <div class="footer-ci"><i class="bi bi-clock-fill"></i> Mon–Sat: 9:00 AM – 7:00 PM</div>
      </div>

    </div>
    <hr class="footer-hr"/>
    <div class="footer-bottom" style="
    color: #c4cde0;
">
      <span>© {{ date('Y') }} D-Mitra Service Center. All rights reserved.</span>
      <div class="d-flex gap-3">
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
      </div>
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  function toggleMobileNav() {
    const nav = document.getElementById('mobileNav');
    const icon = document.getElementById('nav-icon');
    nav.classList.toggle('show');
    icon.className = nav.classList.contains('show') ? 'bi bi-x-lg' : 'bi bi-list';
  }
</script>
@stack('scripts')
</body>
</html>

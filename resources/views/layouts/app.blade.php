<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Home') — Mydmitra</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="background:var(--white);">

<nav class="site-navbar">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="navbar-brand-text">My<span>d</span>mitra</a>

            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
                <a href="{{ route('services') }}" class="nav-link">Services</a>

                @auth
                    <div class="user-pill ms-2">
                        <div class="user-pill-avatar">
                            @if(auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" style="width:28px;height:28px;border-radius:50%;object-fit:cover;" alt="">
                            @else
                                {{ strtoupper(substr(auth()->user()->first_name,0,1)) }}
                            @endif
                        </div>
                        <span class="name">{{ auth()->user()->first_name }}</span>
                    </div>
                    <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}"
                       class="btn-orange ms-1" style="font-size:12.5px;padding:7px 16px;">
                        <i class="bi bi-grid-1x2"></i> Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="ms-1">
                        @csrf
                        <button type="submit" class="btn-outline-orange" style="font-size:12.5px;padding:7px 16px;border-color:rgba(255,255,255,0.25);color:rgba(255,255,255,0.75);">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-orange ms-2" style="font-size:13px;padding:8px 20px;">
                        <i class="bi bi-person"></i> Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mt-3">
        <div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
    </div>
@endif

@yield('content')

<footer style="background:#1a3a6b;;color:rgba(255,255,255,0.5);padding:28px 0;margin-top:60px;">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span style="font-family:'Syne',sans-serif;font-weight:800;color:#fff;font-size:17px;">
                My<span style="color:#ff7a00;">d</span>mitra
            </span>
            <p style="font-size:12.5px;margin-top:4px;">Your trusted digital services partner.</p>
        </div>
        <p style="font-size:12.5px;margin:0;">© {{ date('Y') }} Mydmitra. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

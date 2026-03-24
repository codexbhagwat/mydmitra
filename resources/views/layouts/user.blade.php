<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'Dashboard') — Mydmitra</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/css/app.css">
</head>
<body>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-name">My<span>d</span>mitra</div>
        <span class="brand-sub">My Portal</span>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>
        <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>
        <a href="{{ route('user.applications') }}" class="nav-link {{ request()->routeIs('user.applications') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> My Applications
        </a>
        <a href="{{ route('services.index') }}" class="nav-link">
            <i class="bi bi-grid"></i> Services
        </a>

        <div class="nav-section-label" style="margin-top:10px">Site</div>
        <a href="{{ route('home') }}" class="nav-link">
            <i class="bi bi-house"></i> Homepage
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" alt="">
                @else
                    {{ strtoupper(substr(auth()->user()->first_name, 0, 1)) }}
                @endif
            </div>
            <div class="sidebar-user-info">
                <span class="name">{{ auth()->user()->full_name }}</span>
                <span class="email">{{ Str::limit(auth()->user()->email, 22) }}</span>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn-outline-orange w-100" style="font-size:12.5px;padding:7px 14px;">
                <i class="bi bi-box-arrow-right"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<div class="main-content">
    <header class="topbar">
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-sm d-md-none" onclick="document.getElementById('sidebar').classList.toggle('open')">
                <i class="bi bi-list" style="font-size:20px;"></i>
            </button>
            <span class="topbar-title">@yield('page-title', 'Dashboard')</span>
        </div>
        <div class="topbar-right">
            <span style="font-size:13px; color:var(--grey);">
                Welcome, <strong style="color:var(--dark);">{{ auth()->user()->first_name }}</strong>
            </span>
        </div>
    </header>

    <div class="page-body">
        @if(session('success'))
            <div class="flash flash-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="flash flash-error"><i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

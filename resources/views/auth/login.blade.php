<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login — Mydmitra</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --orange: #ea580c;
    --orange-light: #fff7f3;
    --navy: #1a3a6b;
    --navy-dark: #122d56;
    --grey: #6b7280;
    --border: #e5e7eb;
    --text: #111827;
    --white: #ffffff;
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Sora', sans-serif;
    background: #f3f4f6;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
    position: relative;
    overflow-x: hidden;
  }

  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background:
      radial-gradient(circle at 15% 20%, rgba(26,58,107,0.07) 0%, transparent 50%),
      radial-gradient(circle at 85% 80%, rgba(234,88,12,0.06) 0%, transparent 50%);
    pointer-events: none;
    z-index: 0;
  }

  .page-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    max-width: 900px;
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12), 0 4px 16px rgba(0,0,0,0.07);
    position: relative;
    z-index: 1;
  }

  /* ── LEFT PANEL ── */
  .left-panel {
    background: var(--navy);
    padding: 52px 44px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: relative;
    overflow: hidden;
    min-height: 560px;
  }

  .left-panel::before {
    content: '';
    position: absolute;
    width: 320px; height: 320px;
    border-radius: 50%;
    border: 60px solid rgba(255,255,255,0.04);
    bottom: -80px; right: -80px;
    pointer-events: none;
  }
  .left-panel::after {
    content: '';
    position: absolute;
    width: 180px; height: 180px;
    border-radius: 50%;
    border: 40px solid rgba(234,88,12,0.12);
    top: -40px; left: -40px;
    pointer-events: none;
  }

  .brand-logo {
    font-size: 26px;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
    position: relative;
    z-index: 1;
  }
  .brand-logo span { color: var(--orange); }
  .brand-tagline {
    font-size: 11px;
    color: rgba(255,255,255,0.4);
    letter-spacing: 1.5px;
    text-transform: uppercase;
    margin-top: 4px;
    font-weight: 400;
  }

  .left-content { position: relative; z-index: 1; }

  .left-heading {
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    line-height: 1.25;
    letter-spacing: -0.5px;
    margin-bottom: 14px;
  }
  .left-heading em { font-style: normal; color: var(--orange); }

  .left-desc {
    font-size: 13px;
    color: rgba(255,255,255,0.5);
    line-height: 1.75;
    max-width: 260px;
    font-weight: 300;
  }

  /* Stats strip */
  .left-stats {
    display: flex;
    gap: 28px;
    margin-top: 36px;
  }
  .stat-item {}
  .stat-num {
    font-size: 22px;
    font-weight: 700;
    color: #fff;
    letter-spacing: -0.5px;
    line-height: 1;
  }
  .stat-num span { color: var(--orange); }
  .stat-lbl {
    font-size: 11px;
    color: rgba(255,255,255,0.35);
    margin-top: 3px;
    font-weight: 300;
    text-transform: uppercase;
    letter-spacing: 0.8px;
  }

  .left-divider {
    width: 40px; height: 1px;
    background: rgba(255,255,255,0.12);
    margin: 28px 0;
  }

  .trust-badge {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 50px;
    padding: 6px 13px;
    font-size: 12px;
    color: rgba(255,255,255,0.55);
    font-weight: 400;
    position: relative;
    z-index: 1;
  }
  .trust-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #4caf50;
    box-shadow: 0 0 6px rgba(76,175,80,0.6);
    flex-shrink: 0;
  }

  .left-bottom {
    position: relative;
    z-index: 1;
    font-size: 12px;
    color: rgba(255,255,255,0.2);
    font-weight: 300;
  }

  /* ── RIGHT PANEL ── */
  .right-panel {
    background: var(--white);
    padding: 52px 44px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .right-header { margin-bottom: 28px; }
  .right-header h2 {
    font-size: 22px;
    font-weight: 700;
    color: var(--text);
    letter-spacing: -0.4px;
    margin-bottom: 4px;
  }
  .right-header p {
    font-size: 13px;
    color: var(--grey);
    font-weight: 400;
  }

  .flash-error {
    background: #fff5f5;
    border: 1px solid #fecaca;
    border-left: 3px solid #ef4444;
    border-radius: 8px;
    padding: 10px 14px;
    font-size: 13px;
    color: #b91c1c;
    margin-bottom: 18px;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .btn-google {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    padding: 10px 16px;
    border: 1.5px solid var(--border);
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text);
    background: var(--white);
    text-decoration: none;
    cursor: pointer;
    transition: border-color .18s, background .18s, box-shadow .18s;
    margin-bottom: 20px;
    font-family: 'Sora', sans-serif;
  }
  .btn-google:hover {
    border-color: #9ca3af;
    background: #fafafa;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    color: var(--text);
  }

  .divider {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 11.5px;
    color: #c0c7d0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-bottom: 20px;
    font-weight: 500;
  }
  .divider::before, .divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--border);
  }

  .form-group { margin-bottom: 14px; }

  .form-label {
    display: block;
    font-size: 12.5px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
    letter-spacing: 0.1px;
  }

  /* Password wrapper */
  .input-wrap { position: relative; }
  .input-wrap .form-control { padding-right: 40px; }
  .toggle-pw {
    position: absolute;
    right: 12px; top: 50%;
    transform: translateY(-50%);
    background: none; border: none;
    cursor: pointer; color: #9ca3af;
    font-size: 15px; padding: 0;
    transition: color .18s;
  }
  .toggle-pw:hover { color: var(--navy); }

  .form-control {
    width: 100%;
    padding: 9px 13px;
    border: 1.5px solid var(--border);
    border-radius: 8px;
    font-size: 13.5px;
    color: var(--text);
    background: var(--white);
    font-family: 'Sora', sans-serif;
    transition: border-color .18s, box-shadow .18s;
    outline: none;
    -webkit-appearance: none;
  }
  .form-control::placeholder { color: #c0c7d0; font-size: 13px; }
  .form-control:focus {
    border-color: var(--navy);
    box-shadow: 0 0 0 3px rgba(26,58,107,0.08);
  }
  .form-control.is-invalid {
    border-color: #ef4444;
    box-shadow: 0 0 0 3px rgba(239,68,68,0.08);
  }
  .invalid-feedback {
    font-size: 12px;
    color: #ef4444;
    margin-top: 4px;
    display: block;
  }

  .form-bottom {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    margin-top: 4px;
  }
  .remember-label {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12.5px;
    color: var(--grey);
    cursor: pointer;
    user-select: none;
  }
  .remember-label input[type="checkbox"] {
    accent-color: var(--orange);
    width: 14px; height: 14px;
    cursor: pointer;
  }

  .btn-orange {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 11px 16px;
    background: var(--orange);
    color: #fff;
    border: none;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    font-family: 'Sora', sans-serif;
    letter-spacing: 0.1px;
    transition: background .2s, transform .15s, box-shadow .2s;
    box-shadow: 0 4px 14px rgba(234,88,12,0.25);
  }
  .btn-orange:hover {
    background: #d14e09;
    box-shadow: 0 6px 20px rgba(234,88,12,0.35);
    transform: translateY(-1px);
  }
  .btn-orange:active { transform: translateY(0); }

  .signup-link {
    text-align: center;
    font-size: 12.5px;
    color: var(--grey);
    margin-top: 18px;
  }
  .signup-link a {
    color: var(--orange);
    font-weight: 600;
    text-decoration: none;
  }
  .signup-link a:hover { text-decoration: underline; }

  /* ── RESPONSIVE ── */
  @media (max-width: 768px) {
    body { padding: 16px; background: var(--white); }
    body::before { display: none; }

    .page-grid {
      grid-template-columns: 1fr;
      box-shadow: none;
      border-radius: 0;
    }

    .left-panel {
      padding: 24px 20px;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      border-radius: 14px;
      margin-bottom: 24px;
      min-height: unset;
      gap: 12px;
    }
    .left-panel::before, .left-panel::after { display: none; }
    .left-content, .left-bottom, .left-stats, .left-divider { display: none; }
    .brand-tagline { display: none; }

    .right-panel { padding: 0; }
  }
</style>
</head>
<body>

<div class="page-grid">

  <!-- LEFT PANEL -->
  <div class="left-panel">
    <div>
      <div class="brand-logo">My<span>d</span>mitra</div>
      <div class="brand-tagline">Service Center</div>
    </div>

    <div class="left-content">
      <h2 class="left-heading">
        Welcome<br>back to<br><em>Mydmitra.</em>
      </h2>
      <p class="left-desc">
        Access your applications, track document status, and manage all your services.
      </p>

      <div class="left-stats">
        <div class="stat-item">
          <div class="stat-num">10K<span>+</span></div>
          <div class="stat-lbl">Citizens</div>
        </div>
        <div class="stat-item">
          <div class="stat-num">500<span>+</span></div>
          <div class="stat-lbl">Services</div>
        </div>
        <div class="stat-item">
          <div class="stat-num">5<span>+</span></div>
          <div class="stat-lbl">Years</div>
        </div>
      </div>

      <div class="left-divider"></div>

      <div class="trust-badge">
        <div class="trust-dot"></div>
        Authorized Government Center
      </div>
    </div>

    <div class="left-bottom">© 2025 D-Mitra. All rights reserved.</div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="right-panel">
    <div class="right-header">
      <h2>Sign In</h2>
      <p>Enter your credentials to continue</p>
    </div>

    {{-- @if($errors->any())
      <div class="flash-error">
        <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
      </div>
    @endif --}}

    <a href="{{ route('google.redirect') }}" class="btn-google">
      <svg width="16" height="16" viewBox="0 0 24 24">
        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
      </svg>
      Continue with Google
    </a>

    <div class="divider">or sign in with email</div>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="you@example.com" autofocus>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="form-group">
        <label class="form-label">Password</label>
        <div class="input-wrap">
          <input type="password" name="password" id="passwordField"
                 class="form-control @error('password') is-invalid @enderror"
                 placeholder="Your password">
          <button type="button" class="toggle-pw" onclick="togglePassword()">
            <i class="bi bi-eye" id="pwIcon"></i>
          </button>
        </div>
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
      </div>

      <div class="form-bottom">
        <label class="remember-label">
          <input type="checkbox" name="remember"> Remember me
        </label>
      </div>

      <button type="submit" class="btn-orange">
        <i class="bi bi-box-arrow-in-right"></i> Sign In
      </button>
    </form>

    <p class="signup-link">
      Don't have an account? <a href="{{ route('register') }}">Create one</a>
    </p>
  </div>

</div>

<script>
  function togglePassword() {
    const field = document.getElementById('passwordField');
    const icon  = document.getElementById('pwIcon');
    if (field.type === 'password') {
      field.type = 'text';
      icon.className = 'bi bi-eye-slash';
    } else {
      field.type = 'password';
      icon.className = 'bi bi-eye';
    }
  }
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — Mydmitra</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
  :root {
    --orange: #ea580c;
    --orange-light: #fff7f3;
    --orange-mid: #fed7aa;
    --navy: #1a3a6b;
    --navy-dark: #122d56;
    --grey: #6b7280;
    --grey-light: #f9fafb;
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

  /* Background pattern */
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
    max-width: 960px;
    width: 100%;
    min-height: 600px;
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

  .left-content {
    position: relative;
    z-index: 1;
  }

  .left-heading {
    font-size: 28px;
    font-weight: 700;
    color: #fff;
    line-height: 1.25;
    letter-spacing: -0.5px;
    margin-bottom: 14px;
  }
  .left-heading em {
    font-style: normal;
    color: var(--orange);
  }

  .left-desc {
    font-size: 13px;
    color: rgba(255,255,255,0.5);
    line-height: 1.75;
    max-width: 260px;
    font-weight: 300;
  }

  .left-features {
    list-style: none;
    margin-top: 28px;
    display: flex;
    flex-direction: column;
    gap: 12px;
  }
  .left-features li {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: rgba(255,255,255,0.65);
    font-weight: 400;
  }
  .feat-dot {
    width: 24px; height: 24px;
    background: rgba(234,88,12,0.18);
    border: 1px solid rgba(234,88,12,0.35);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    color: var(--orange);
    font-size: 12px;
  }

  .left-bottom {
    position: relative;
    z-index: 1;
    font-size: 12px;
    color: rgba(255,255,255,0.25);
    font-weight: 300;
  }

  /* ── RIGHT PANEL ── */
  .right-panel {
    background: var(--white);
    padding: 44px 40px;
    overflow-y: auto;
  }

  .right-header {
    margin-bottom: 28px;
  }
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

  /* Flash error */
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

  /* Google button */
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

  /* Divider */
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

  /* Form */
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
  }

  .form-group {
    margin-bottom: 14px;
  }

  .form-label {
    display: block;
    font-size: 12.5px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 5px;
    letter-spacing: 0.1px;
  }

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

  /* Submit button */
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
    margin-top: 4px;
    box-shadow: 0 4px 14px rgba(234,88,12,0.25);
  }
  .btn-orange:hover {
    background: #d14e09;
    box-shadow: 0 6px 20px rgba(234,88,12,0.35);
    transform: translateY(-1px);
  }
  .btn-orange:active { transform: translateY(0); }

  .signin-link {
    text-align: center;
    font-size: 12.5px;
    color: var(--grey);
    margin-top: 16px;
  }
  .signin-link a {
    color: var(--orange);
    font-weight: 600;
    text-decoration: none;
  }
  .signin-link a:hover { text-decoration: underline; }

  /* ── RESPONSIVE ── */
  @media (max-width: 768px) {
    body { padding: 16px; background: var(--white); }
    body::before { display: none; }

    .page-grid {
      grid-template-columns: 1fr;
      box-shadow: none;
      border-radius: 0;
      min-height: unset;
    }

    .left-panel {
      padding: 28px 24px 24px;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      border-radius: 14px;
      margin-bottom: 20px;
      gap: 12px;
    }
    .left-panel::before, .left-panel::after { display: none; }
    .left-content, .left-bottom, .left-features { display: none; }

    .brand-tagline { display: none; }

    .right-panel { padding: 0; }
    .right-header h2 { font-size: 20px; }
  }

  @media (max-width: 420px) {
    .form-row { grid-template-columns: 1fr; gap: 0; }
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
        Government Services,<br><em>Simplified.</em>
      </h2>
      <p class="left-desc">
        Apply for documents, track applications, and get expert assistance — all in one place.
      </p>
      <ul class="left-features">
        <li>
          <div class="feat-dot"><i class="bi bi-lightning-charge-fill"></i></div>
          Fast processing, same-day results
        </li>
        <li>
          <div class="feat-dot"><i class="bi bi-shield-check"></i></div>
          Government authorized center
        </li>
        <li>
          <div class="feat-dot"><i class="bi bi-bell"></i></div>
          Real-time status tracking
        </li>
      </ul>
    </div>

    <div class="left-bottom">© 2025 D-Mitra. All rights reserved.</div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="right-panel">
    <div class="right-header">
      <h2>Create Account</h2>
      <p>Fill in your details to get started</p>
    </div>

    {{-- @if($errors->any())
      <div class="flash-error">
        <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
      </div>
    @endif --}}

    <!-- Demo error for preview -->
    <!-- <div class="flash-error">
      <i class="bi bi-exclamation-circle-fill"></i> The email has already been taken.
    </div> -->

    <a href="#" class="btn-google">
      <svg width="16" height="16" viewBox="0 0 24 24">
        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/>
        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
      </svg>
      Continue with Google
    </a>

    <div class="divider">or register with email</div>

<!-- Yeh hona chahiye -->
<form method="POST" action="{{ route('register') }}">    
   @csrf  
  <div class="form-row">
        <div class="form-group">
          <label class="form-label">First Name</label>
          <input type="text" name="first_name" class="form-control" placeholder="First">
        </div>
        <div class="form-group">
          <label class="form-label">Last Name</label>
          <input type="text" name="last_name" class="form-control" placeholder="Last">
        </div>
      </div>

      <div class="form-group">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control" placeholder="you@example.com">
      </div>

      <div class="form-group">
        <label class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" placeholder="+91 99999 99999">
      </div>

      <div class="form-group">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Min. 8 characters">
      </div>

      <div class="form-group">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password">
      </div>

      <button type="submit" class="btn-orange">
        <i class="bi bi-person-plus"></i> Create Account
      </button>
    </form>

    <p class="signin-link">
      Already have an account? <a href="login">Sign in</a>
    </p>
  </div>

</div>
</body>
</html>
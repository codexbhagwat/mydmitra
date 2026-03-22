<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register — Mydmitra</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="/css/app.css">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-logo">My<span>d</span>mitra</div>
        <p class="auth-subtitle">Create your account to get started</p>

        @if($errors->any())
            <div class="flash flash-error">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first() }}
            </div>
        @endif

        <a href="{{ route('google.redirect') }}" class="btn-google">
            <svg width="18" height="18" viewBox="0 0 24 24"><path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/><path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/><path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z"/><path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/></svg>
            Sign up with Google
        </a>

        <div class="divider">or register with email</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row" style="gap:0;">
                <div class="col-6 pe-2">
                    <div class="form-group">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" value="{{ old('first_name') }}"
                               class="form-control @error('first_name') is-invalid @enderror" placeholder="First">
                        @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-6 ps-2">
                    <div class="form-group">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name" value="{{ old('last_name') }}"
                               class="form-control @error('last_name') is-invalid @enderror" placeholder="Last">
                        @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror" placeholder="you@example.com">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                       class="form-control @error('phone') is-invalid @enderror" placeholder="+91 99999 99999">
                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror" placeholder="Min. 8 characters">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="password_confirmation"
                       class="form-control" placeholder="Repeat password">
            </div>

            <button type="submit" class="btn-orange w-100" style="justify-content:center;padding:12px;font-size:14.5px;">
                <i class="bi bi-person-plus"></i> Create Account
            </button>
        </form>

        <p style="text-align:center;font-size:13px;color:var(--grey);margin-top:20px;">
            Already have an account?
            <a href="{{ route('login') }}" style="color:var(--orange);font-weight:600;">Sign in</a>
        </p>
    </div>
</div>
</body>
</html>

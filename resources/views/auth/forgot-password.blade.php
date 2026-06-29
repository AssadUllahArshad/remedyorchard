<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password | HealthyLife Remedy</title>
<link rel="icon" type="image/svg+xml" href="{{ asset('logo/icon-mark.svg') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>

<div class="admin-login-shell">
  <div class="admin-login-card">
    <div class="text-center mb-4">
      <a href="{{ route('home') }}" aria-label="HealthyLife Remedy Home">
        <svg width="160" height="40" viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg" style="display:block; margin:0 auto 1rem;">
          <circle cx="20" cy="20" r="18" fill="#28623A"/>
          <path d="M10 21 L14.5 21 L17 14 L21 27 L24 17 L26.5 21 L30 21" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <text x="46" y="18" font-family="Inter, Arial, sans-serif" font-size="15.5" font-weight="700" fill="#FFFFFF" letter-spacing="0.2">HealthyLife</text>
          <text x="46" y="32" font-family="Inter, Arial, sans-serif" font-size="10" font-weight="600" fill="#3DAA62" letter-spacing="2.5">REMEDY</text>
        </svg>
      </a>
      <span class="eyebrow d-flex justify-content-center">Password Reset</span>
      <h1 style="font-size:1.5rem; color:#fff;">Forgot your password?</h1>
      <p style="color:var(--text-on-dark-faint); font-size:0.88rem; margin-top:0.5rem;">
        Enter your email and we'll send you a link to reset it.
      </p>
    </div>

    @if(session('status'))
      <div class="admin-alert admin-alert-success mb-4">
        <i class="bi bi-check-circle me-1"></i> {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="admin-alert admin-alert-danger mb-4">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <label for="email" style="display:block; margin-bottom:0.4rem; font-size:0.85rem; font-weight:600; color:var(--text-on-dark-faint);">Email Address</label>
      <input type="email" id="email" name="email" class="admin-input" style="margin-bottom:1.25rem;"
             placeholder="you@example.com" value="{{ old('email') }}" required autofocus>

      <button type="submit" class="btn-pill-primary w-100" style="border:none; padding:0.85rem;">
        <i class="bi bi-envelope me-1"></i> Send Reset Link
      </button>
    </form>

    <p class="text-center mt-4" style="color:var(--text-on-dark-faint); font-size:0.85rem;">
      <a href="{{ route('login') }}" style="color:var(--emerald-bright); font-weight:600;">
        <i class="bi bi-arrow-left me-1"></i> Back to sign in
      </a>
    </p>
  </div>
</div>

</body>
</html>

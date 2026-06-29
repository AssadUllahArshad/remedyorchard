<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Set New Password | HealthyLife Remedy</title>
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
      <h1 style="font-size:1.5rem; color:#fff;">Set a new password</h1>
    </div>

    @if($errors->any())
      <div class="admin-alert admin-alert-danger mb-4">
        <ul class="mb-0">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
      @csrf

      {{-- Fortify requires both token and email in the reset form --}}
      <input type="hidden" name="token" value="{{ $request->route('token') }}">

      <label for="email" style="display:block; margin-bottom:0.4rem; font-size:0.85rem; font-weight:600; color:var(--text-on-dark-faint);">Email Address</label>
      <input type="email" id="email" name="email" class="admin-input" style="margin-bottom:1.25rem;"
             value="{{ old('email', $request->email) }}" required autofocus>

      <label for="password" style="display:block; margin-bottom:0.4rem; font-size:0.85rem; font-weight:600; color:var(--text-on-dark-faint);">New Password</label>
      <input type="password" id="password" name="password" class="admin-input" style="margin-bottom:1.25rem;"
             placeholder="At least 8 characters" required autocomplete="new-password">

      <label for="password_confirmation" style="display:block; margin-bottom:0.4rem; font-size:0.85rem; font-weight:600; color:var(--text-on-dark-faint);">Confirm New Password</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="admin-input" style="margin-bottom:1.5rem;"
             placeholder="Repeat your new password" required autocomplete="new-password">

      <button type="submit" class="btn-pill-primary w-100" style="border:none; padding:0.85rem;">
        <i class="bi bi-key me-1"></i> Reset Password
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

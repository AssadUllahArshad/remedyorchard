<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | HealthyLife Remedy</title>
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
      <svg width="160" height="40" viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3" style="display:block; margin:0 auto 1rem;">
        <g><circle cx="20" cy="20" r="18" fill="#28623A"/>
        <path d="M10 21 L14.5 21 L17 14 L21 27 L24 17 L26.5 21 L30 21" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g>
        <text x="46" y="18" font-family="Inter, Arial, sans-serif" font-size="15.5" font-weight="700" fill="#FFFFFF" letter-spacing="0.2">HealthyLife</text>
        <text x="46" y="32" font-family="Inter, Arial, sans-serif" font-size="10" font-weight="600" fill="#3DAA62" letter-spacing="2.5">REMEDY</text>
      </svg>
      <span class="eyebrow d-flex justify-content-center">Admin Panel</span>
      <h1 style="font-size:1.5rem; color:#fff;">Sign in to manage your site</h1>
    </div>

    {{--
        NOTE: This form is wired to Laravel Fortify login at route('login').
        The route redirects to /login and the login view is served by Fortify.
    --}}
    <form method="POST" action="{{ route('login') }}">
      @csrf
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" class="admin-input" placeholder="you@healthyliferemedy.com" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="admin-input" placeholder="••••••••" required>

      <div class="d-flex justify-content-between align-items-center mb-4" style="margin-top:-0.4rem;">
        <label class="d-flex align-items-center gap-2" style="color:var(--text-on-dark-faint); font-size:0.85rem; font-weight:500;">
          <input type="checkbox" name="remember"> Remember me
        </label>
        <a href="#" style="color:var(--emerald-bright); font-size:0.85rem; font-weight:600;">Forgot password?</a>
      </div>

      <button type="submit" class="btn-pill-primary w-100" style="border:none; padding:0.85rem;">Sign In</button>
    </form>

    <p class="text-center mt-4" style="color:var(--text-on-dark-faint); font-size:0.82rem;">
      Protected admin area. Contact your site owner for access.
    </p>
  </div>
</div>

</body>
</html>

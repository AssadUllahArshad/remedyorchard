<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login | Healthy Habits Hub</title>
<link rel="icon" type="image/jpeg" href="{{ asset('logo/logo.jpg') }}">

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
      <span class="brand-link mb-3" style="justify-content:center; margin:0 auto 1rem;">
        <img src="{{ asset('logo/logo.jpg') }}" alt="Healthy Habits Hub" class="brand-logo-icon">
        <span class="brand-logo-text">
          <span class="logo-text-main">Healthy Habits</span>
          <span class="logo-text-sub">HUB</span>
        </span>
      </span>
      <span class="eyebrow d-flex justify-content-center">Admin Panel</span>
      <h1 style="font-size:1.5rem; color:#fff;">Sign in to manage your site</h1>
    </div>

    <form method="POST" action="{{ route('login') }}">
      @csrf

      @if(session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger mb-3">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" class="admin-input" placeholder="you@healthyhabitshub.com" value="{{ old('email') }}" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="admin-input" placeholder="••••••••" required>

      <div class="d-flex justify-content-between align-items-center mb-4" style="margin-top:-0.4rem;">
        <label class="d-flex align-items-center gap-2" style="color:var(--text-on-dark-faint); font-size:0.85rem; font-weight:500;">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
        </label>
        <a href="{{ route('password.request') }}" style="color:var(--emerald-bright); font-size:0.85rem; font-weight:600;">Forgot password?</a>
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

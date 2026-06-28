<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'HealthyLife Remedy — Evidence-Based Natural Health & Wellness')</title>
<meta name="description" content="@yield('meta_description', 'Your trusted guide to natural health, evidence-based nutrition, and holistic wellness.')">
<link rel="icon" type="image/svg+xml" href="{{ asset('logo/icon-mark.svg') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

{{-- Apply saved theme before paint to avoid flash --}}
<script>
  (function(){
    var t = localStorage.getItem('hlr-theme') || 'light';
    document.documentElement.setAttribute('data-theme', t);
  })();
</script>

@stack('styles')
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Theme toggle
  function toggleTheme() {
    var html = document.documentElement;
    var current = html.getAttribute('data-theme');
    var next = current === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('hlr-theme', next);
  }

  // Wire all .theme-toggle buttons
  document.querySelectorAll('[data-toggle-theme]').forEach(function(btn) {
    btn.addEventListener('click', toggleTheme);
  });

  // Mobile menu toggle
  var mobileMenu = document.getElementById('mobileMenu');
  document.querySelectorAll('[data-toggle-menu]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      if (mobileMenu) mobileMenu.classList.toggle('open');
    });
  });
</script>

@stack('scripts')
</body>
</html>

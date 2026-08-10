<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Dashboard') | Healthy Habits Hub Admin</title>
<link rel="icon" type="image/jpeg" href="{{ asset('logo/logo.jpg') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@stack('styles')
</head>
<body class="admin-body">

<div class="admin-shell">

  {{-- ============== SIDEBAR ============== --}}
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="admin-sidebar-brand">
      <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('logo/logo.jpg') }}" alt="Healthy Habits Hub" class="brand-logo-icon">
        <span class="brand-logo-text">
          <span class="logo-text-main">Healthy Habits</span>
          <span class="logo-text-sub">HUB</span>
        </span>
      </a>
    </div>

    <nav class="admin-nav">
      <div class="admin-nav-label">Overview</div>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
      </a>

      <div class="admin-nav-label">Content</div>
      <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
        <i class="bi bi-journal-richtext"></i> Articles <span class="badge-count">{{ $articleCount ?? 5 }}</span>
      </a>
      <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <i class="bi bi-tags-fill"></i> Categories <span class="badge-count">{{ $categoryCount ?? 6 }}</span>
      </a>

      <div class="admin-nav-label">Audience</div>
      <a href="{{ route('admin.subscribers.index') }}" class="{{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
        <i class="bi bi-envelope-paper-fill"></i> Subscribers <span class="badge-count">{{ $subscriberCount ?? '42K' }}</span>
      </a>
      <a href="{{ route('admin.messages.index') }}" class="{{ request()->routeIs('admin.messages.*') ? 'active' : '' }}">
        <i class="bi bi-chat-left-text-fill"></i> Messages <span class="badge-count">{{ $unreadMessageCount ?? 3 }}</span>
      </a>

      <div class="admin-nav-label">Configuration</div>
      <a href="{{ route('admin.settings.index') }}" class="{{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
        <i class="bi bi-gear-fill"></i> Settings
      </a>
      <a href="{{ route('admin.artisan.index') }}" class="{{ request()->routeIs('admin.artisan.*') ? 'active' : '' }}">
        <i class="bi bi-terminal-fill"></i> Artisan Console
      </a>
      <a href="{{ route('home') }}" target="_blank">
        <i class="bi bi-box-arrow-up-right"></i> View Live Site
      </a>
    </nav>

    <div class="admin-sidebar-footer">
      <span class="admin-user-avatar">{{ $authUserInitials ?? 'AD' }}</span>
      <div>
        <div class="user-name">{{ $authUserName ?? 'Admin User' }}</div>
        <div class="user-role">{{ $authUserRole ?? 'Editor' }}</div>
      </div>
    </div>
  </aside>

  {{-- ============== MAIN COLUMN ============== --}}
  <div class="admin-main">
    <div class="admin-topbar">
      <div class="d-flex align-items-center gap-3">
        <button class="sidebar-toggle-btn" onclick="document.getElementById('adminSidebar').classList.toggle('open')">
          <i class="bi bi-list"></i>
        </button>
        <div>
          <h1>@yield('page-title', 'Dashboard')</h1>
          @hasSection('page-subtitle')
            <p class="subtitle">@yield('page-subtitle')</p>
          @endif
        </div>
      </div>

      <div class="d-flex align-items-center gap-3">
        <form method="GET" action="{{ route('admin.articles.index') }}" style="margin:0;">
          <input type="search" name="search" class="admin-search-box"
                 placeholder="Search articles..."
                 value="{{ request()->routeIs('admin.articles.*') ? request('search') : '' }}"
                 onkeydown="if(event.key==='Enter'){this.form.submit();}">
        </form>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="row-action-btn" title="Log out"><i class="bi bi-box-arrow-right"></i></button>
        </form>
      </div>
    </div>

    <div class="admin-content">
      @if(session('status'))
        <div class="admin-alert admin-alert-success mb-4">{{ session('status') }}</div>
      @endif
      @if(session('error'))
        <div class="admin-alert admin-alert-danger mb-4">{{ session('error') }}</div>
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
      @yield('content')
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>

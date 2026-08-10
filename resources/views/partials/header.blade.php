<header class="site-header">
  <div class="container">
    <div class="navbar-inner">

      {{-- Logo --}}
      <a class="brand-link" href="{{ route('home') }}" aria-label="Healthy Habits Hub Home">
        <img src="{{ asset('logo/logo.jpg') }}" alt="Healthy Habits Hub" class="brand-logo-icon">
        <span class="brand-logo-text">
          <span class="logo-text-main">Healthy Habits</span>
          <span class="logo-text-sub">HUB</span>
        </span>
      </a>

      {{-- Nav links + theme toggle + CTAs, merged into one capsule --}}
      <div class="nav-capsule">
        <nav class="pill-nav" aria-label="Main navigation" data-sliding-nav>
          <span class="pill-nav-indicator" data-nav-indicator></span>
          <a href="{{ route('home') }}"           class="{{ request()->routeIs('home') ? 'active' : '' }}" data-nav-link>Home</a>
          <a href="{{ route('about') }}"          class="{{ request()->routeIs('about') ? 'active' : '' }}" data-nav-link>About</a>
          <a href="{{ route('contact') }}"        class="{{ request()->routeIs('contact') ? 'active' : '' }}" data-nav-link>Contact</a>
        </nav>

        {{-- Theme toggle --}}
        <button class="theme-toggle" data-toggle-theme aria-label="Toggle dark / light mode" title="Toggle theme">
          <i class="bi bi-sun-fill icon-sun"></i>
          <i class="bi bi-moon-fill icon-moon"></i>
        </button>

        <a href="{{ route('calorie-calculator') }}" class="btn-pill-outline nav-cta-desktop d-none d-md-inline-flex" data-magnetic>
          Calories calculator
        </a>
        <a href="{{ route('remedies.index') }}" class="btn-pill-primary d-none d-md-inline-flex" data-magnetic>
          Explore Remedies
        </a>

        {{-- Mobile hamburger --}}
        <button class="navbar-toggler-custom" data-toggle-menu aria-label="Open menu" aria-expanded="false">
          <i class="bi bi-list fs-5"></i>
        </button>
      </div>
    </div>

    {{-- Mobile menu --}}
    <div class="mobile-menu" id="mobileMenu">
      <a href="{{ route('home') }}"           class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
      <a href="{{ route('remedies.index') }}" class="{{ request()->routeIs('remedies.*') ? 'active' : '' }}">Remedies</a>
      <a href="{{ route('about') }}"          class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
      <a href="{{ route('contact') }}"        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
      <a href="{{ route('remedies.index') }}" class="btn-pill-primary text-center justify-content-center" style="margin-top:0.3rem;">Explore Remedies</a>
      <button class="theme-toggle-mobile" data-toggle-theme>
        <i class="bi bi-sun-fill icon-sun"></i>
        <i class="bi bi-moon-fill icon-moon"></i>
        <span style="margin-left:0.4rem;">Switch Theme</span>
      </button>
    </div>
  </div>
</header>

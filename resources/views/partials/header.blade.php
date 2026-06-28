<header class="site-header">
  <div class="container">
    <div class="navbar-inner">

      {{-- Logo --}}
      <a class="brand-link" href="{{ route('home') }}" aria-label="HealthyLife Remedy Home">
        <svg width="158" height="38" viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg">
          <circle cx="20" cy="20" r="18" fill="#28623A"/>
          <path d="M10 21 L14.5 21 L17 14 L21 27 L24 17 L26.5 21 L30 21"
                fill="none" stroke="#FFFFFF" stroke-width="2.2"
                stroke-linecap="round" stroke-linejoin="round"/>
          <text x="46" y="17" font-family="Inter,Arial,sans-serif" font-size="15"
                font-weight="800" fill="#FFFFFF" letter-spacing="0.3" class="logo-text-main">HealthyLife</text>
          <text x="46" y="31" font-family="Inter,Arial,sans-serif" font-size="9.5"
                font-weight="700" fill="#3DAA62" letter-spacing="3" class="logo-text-sub">REMEDY</text>
        </svg>
      </a>

      {{-- Desktop nav --}}
      <nav class="pill-nav" aria-label="Main navigation">
        <a href="{{ route('home') }}"           class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('remedies.index') }}" class="{{ request()->routeIs('remedies.*','articles.*','categories.*') ? 'active' : '' }}">Remedies</a>
        <a href="{{ route('about') }}"          class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('contact') }}"        class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
      </nav>

      {{-- Right-side actions --}}
      <div class="d-flex align-items-center gap-2">
        {{-- Theme toggle --}}
        <button class="theme-toggle" data-toggle-theme aria-label="Toggle dark / light mode" title="Toggle theme">
          <i class="bi bi-sun-fill icon-sun"></i>
          <i class="bi bi-moon-fill icon-moon"></i>
        </button>

        <a href="{{ route('contact') }}" class="btn-pill-outline nav-cta-desktop d-none d-md-inline-flex">
          Get in touch
        </a>
        <a href="{{ route('remedies.index') }}" class="btn-pill-primary d-none d-md-inline-flex">
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

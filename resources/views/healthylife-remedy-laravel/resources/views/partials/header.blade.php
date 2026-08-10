<header class="site-header">
  <div class="container">
    <div class="navbar-inner">
      <a class="brand-link" href="{{ route('home') }}">
        <svg width="150" height="38" viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg">
          <g><circle cx="20" cy="20" r="18" fill="#28623A"/>
          <!-- <g><circle cx="20" cy="20" r="18" fill="#1E3A5F"/> -->
          <path d="M10 21 L14.5 21 L17 14 L21 27 L24 17 L26.5 21 L30 21" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g>
          <text x="46" y="18" font-family="Inter, Arial, sans-serif" font-size="15.5" font-weight="700" fill="#FFFFFF" letter-spacing="0.2">HealthyLife</text>
          <text x="46" y="32" font-family="Inter, Arial, sans-serif" font-size="10" font-weight="600" fill="#3DAA62" letter-spacing="2.5">REMEDY</text>
        </svg>
      </a>

      <nav class="pill-nav">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('remedies.index') }}" class="{{ request()->routeIs('remedies.*') || request()->routeIs('articles.*') || request()->routeIs('categories.*') ? 'active' : '' }}">Remedies</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
      </nav>

      <div class="d-flex align-items-center gap-2">
        <a href="{{ route('contact') }}" class="btn-pill-outline nav-cta-desktop d-none d-md-inline-block">Get in touch</a>
        <a href="{{ route('remedies.index') }}" class="btn-pill-primary">Explore Remedies</a>
        <button class="navbar-toggler-custom" onclick="document.getElementById('mobileMenu').classList.toggle('open')" aria-label="Toggle menu">
          <i class="bi bi-list fs-4"></i>
        </button>
      </div>
    </div>

    <div class="mobile-menu" id="mobileMenu">
      <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
      <a href="{{ route('remedies.index') }}" class="{{ request()->routeIs('remedies.*') ? 'active' : '' }}">Remedies</a>
      <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a>
      <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
    </div>
  </div>
</header>

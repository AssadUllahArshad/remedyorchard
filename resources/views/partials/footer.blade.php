<footer class="site-footer-v2">
  <div class="container">
    <div class="row g-4">

      {{-- Brand column --}}
      <div class="col-lg-4 col-md-6">
        <a href="{{ route('home') }}" class="d-inline-block mb-3" aria-label="HealthyLife Remedy Home">
          <svg width="150" height="38" viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg">
            <circle cx="20" cy="20" r="18" fill="#28623A"/>
            <path d="M10 21 L14.5 21 L17 14 L21 27 L24 17 L26.5 21 L30 21"
                  fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
            <text x="46" y="18" font-family="Inter,Arial,sans-serif" font-size="15.5" font-weight="700" fill="#FFFFFF" letter-spacing="0.2">HealthyLife</text>
            <text x="46" y="32" font-family="Inter,Arial,sans-serif" font-size="10" font-weight="600" fill="#3DAA62" letter-spacing="2.5">REMEDY</text>
          </svg>
        </a>
        <p class="footer-desc-v2">Clinician-reviewed guides on nutrition, natural remedies, fitness, sleep, and heart health — published since 2018 with a single standard: the evidence has to actually support it.</p>
        <div class="mb-2">
          <a href="https://facebook.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://x.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="X / Twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="https://instagram.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://youtube.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
        </div>
        <div class="footer-disclaimer-v2">
          <strong>Medical Disclaimer:</strong> Content on this site is for informational and educational purposes only. It is not a substitute for professional medical advice, diagnosis, or treatment.
        </div>
      </div>

      {{-- Topics --}}
      <div class="col-lg-2 col-md-6 col-6">
        <h5>Topics</h5>
        @foreach($footerCategories ?? [
            ['name' => 'Nutrition',     'slug' => 'nutrition'],
            ['name' => 'Home Remedies', 'slug' => 'home-remedies'],
            ['name' => 'Mental Health', 'slug' => 'mental-health'],
            ['name' => 'Fitness',       'slug' => 'fitness'],
            ['name' => 'Sleep',         'slug' => 'sleep'],
            ['name' => 'Heart Health',  'slug' => 'heart-health'],
        ] as $cat)
        <a href="{{ route('categories.show', $cat['slug']) }}" class="footer-link-v2">{{ $cat['name'] }}</a>
        @endforeach
      </div>

      {{-- Company --}}
      <div class="col-lg-2 col-md-6 col-6">
        <h5>Company</h5>
        <a href="{{ route('about') }}"   class="footer-link-v2">About Us</a>
        <a href="{{ route('contact') }}" class="footer-link-v2">Contact</a>
        <a href="{{ route('advertise') }}" class="footer-link-v2">Advertise</a>
        <a href="{{ route('remedies.index') }}" class="footer-link-v2">Article Library</a>
        <h5 class="mt-4">Legal</h5>
        <a href="{{ route('privacy') }}"            class="footer-link-v2">Privacy Policy</a>
        <a href="{{ route('terms') }}"              class="footer-link-v2">Terms of Use</a>
        <a href="{{ route('cookie-policy') }}"      class="footer-link-v2">Cookie Policy</a>
        <a href="{{ route('medical-disclaimer') }}" class="footer-link-v2">Medical Disclaimer</a>
      </div>

      {{-- Newsletter --}}
      <div class="col-lg-4 col-md-6">
        <h5>Weekly Newsletter</h5>
        <p class="footer-desc-v2">One research-backed health insight, delivered every Tuesday. Free, and easy to leave.</p>
        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="mb-1">
          @csrf
          <input type="email" name="email" class="footer-input-v2" placeholder="your@email.com" required>
          <button type="submit" class="btn-pill-primary w-100 mt-1" style="border:none; padding:0.75rem;">
            <i class="bi bi-envelope me-1"></i> Subscribe Free
          </button>
        </form>
        <p style="font-size:0.79rem; color:rgba(155,180,165,0.5); margin-top:0.6rem;">
          No spam. Unsubscribe with one click at any time.
        </p>
      </div>

    </div>

    <div class="footer-bottom-v2">
      <span>&copy; {{ date('Y') }} HealthyLife Remedy &mdash; All rights reserved.</span>
      <span>Evidence first. Readers always.</span>
    </div>
  </div>
</footer>

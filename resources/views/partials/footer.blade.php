<footer class="site-footer-v2">

  {{-- Billboard newsletter band --}}
  <div class="footer-billboard">
    <div class="container">
      <div class="footer-billboard-inner">
        <div>
          <span class="eyebrow" style="color:rgba(200,225,240,0.75);">Weekly newsletter</span>
          <h2 class="footer-billboard-heading">One research-backed health insight, delivered every Tuesday.</h2>
        </div>
        <form method="POST" action="{{ route('newsletter.subscribe') }}" class="footer-billboard-form d-flex flex-column flex-sm-row gap-2">
          @csrf
          <input type="hidden" name="source" value="footer">
          <input type="email" name="email" class="footer-input-v2 flex-grow-1" placeholder="your@email.com" required autocomplete="email">
          <button type="submit" class="btn-pill-primary" style="border:none;">
            <i class="bi bi-envelope me-1"></i> Subscribe Free
          </button>
        </form>
      </div>
      <p class="footer-billboard-note">No spam. Unsubscribe with one click at any time.</p>
    </div>
  </div>

  <div class="container">

    {{-- Slim horizontal link index --}}
    <div class="footer-index">
      <div class="footer-index-group">
        <span class="footer-index-label">Topics</span>
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

      <div class="footer-index-group">
        <span class="footer-index-label">Company</span>
        <a href="{{ route('about') }}"          class="footer-link-v2">About Us</a>
        <a href="{{ route('contact') }}"        class="footer-link-v2">Contact</a>
        <a href="{{ route('advertise') }}"      class="footer-link-v2">Advertise</a>
        <a href="{{ route('remedies.index') }}" class="footer-link-v2">Article Library</a>
      </div>

      <div class="footer-index-group">
        <span class="footer-index-label">Legal</span>
        <a href="{{ route('privacy') }}"            class="footer-link-v2">Privacy Policy</a>
        <a href="{{ route('terms') }}"              class="footer-link-v2">Terms of Use</a>
        <a href="{{ route('cookie-policy') }}"      class="footer-link-v2">Cookie Policy</a>
        <a href="{{ route('medical-disclaimer') }}" class="footer-link-v2">Medical Disclaimer</a>
      </div>
    </div>

    {{-- Closing bar: brand, social, disclaimer --}}
    <div class="footer-closing">
      <div class="footer-closing-brand">
        <a href="{{ route('home') }}" class="brand-link" aria-label="Healthy Habits Hub Home">
          <img src="{{ asset('logo/logo.jpg') }}" alt="Healthy Habits Hub" class="brand-logo-icon" style="width:32px; height:32px;">
          <span class="brand-logo-text">
            <span class="logo-text-main">Healthy Habits</span>
            <span class="logo-text-sub">HUB</span>
          </span>
        </a>
        <p class="footer-closing-tagline">Clinician-reviewed guides since 2018 — nutrition, remedies, fitness, sleep &amp; heart health.</p>
      </div>

      <div class="footer-closing-social">
        <a href="https://facebook.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
        <a href="https://x.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="X / Twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="https://instagram.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
        <a href="https://youtube.com" target="_blank" rel="noopener" class="social-icon-v2" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
      </div>

      <p class="footer-closing-disclaimer">
        <strong>Medical Disclaimer:</strong> Content on this site is for informational and educational purposes only. It is not a substitute for professional medical advice, diagnosis, or treatment.
      </p>
    </div>

    <div class="footer-bottom-v2">
      <span>&copy; {{ date('Y') }} Healthy Habits Hub &mdash; All rights reserved.</span>
      <span>Evidence first. Readers always.</span>
    </div>
  </div>
</footer>

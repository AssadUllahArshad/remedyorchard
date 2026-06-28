<footer class="site-footer-v2">
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 mb-4">
        <a href="{{ route('home') }}" class="d-inline-block mb-2">
          <svg width="150" height="38" viewBox="0 0 160 40" xmlns="http://www.w3.org/2000/svg">
            <g><circle cx="20" cy="20" r="18" fill="#28623A"/>
            <path d="M10 21 L14.5 21 L17 14 L21 27 L24 17 L26.5 21 L30 21" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></g>
            <text x="46" y="18" font-family="Inter, Arial, sans-serif" font-size="15.5" font-weight="700" fill="#FFFFFF" letter-spacing="0.2">HealthyLife</text>
            <text x="46" y="32" font-family="Inter, Arial, sans-serif" font-size="10" font-weight="600" fill="#3DAA62" letter-spacing="2.5">REMEDY</text>
          </svg>
        </a>
        <p class="footer-desc-v2">Your trusted guide to natural health, evidence-based nutrition, and holistic wellness since 2018.</p>
        <div>
          <a href="#" class="social-icon-v2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-icon-v2"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="social-icon-v2"><i class="bi bi-instagram"></i></a>
          <a href="#" class="social-icon-v2"><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 mb-4">
        <h5>Topics</h5>
        @foreach($footerCategories ?? [
            ['name' => 'Nutrition', 'slug' => 'nutrition'],
            ['name' => 'Home Remedies', 'slug' => 'home-remedies'],
            ['name' => 'Mental Health', 'slug' => 'mental-health'],
            ['name' => 'Fitness', 'slug' => 'fitness'],
            ['name' => 'Sleep', 'slug' => 'sleep'],
            ['name' => 'Heart Health', 'slug' => 'heart-health'],
        ] as $cat)
        <a href="{{ route('categories.show', $cat['slug']) }}" class="footer-link-v2">{{ $cat['name'] }}</a>
        @endforeach
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <h5>Newsletter</h5>
        <p class="footer-desc-v2 mb-3">Weekly health tips in your inbox.</p>
        <form method="POST" action="{{ route('newsletter.subscribe') }}">
          @csrf
          <input type="email" name="email" class="form-control mb-2" placeholder="your@email.com" required
                 style="background:var(--emerald-pill); border:1px solid var(--emerald-line); color:#fff; border-radius:10px; padding:0.65rem 0.9rem; font-size:0.9rem;">
          <button type="submit" class="btn-pill-primary w-100" style="border:none;">Subscribe Free</button>
        </form>
      </div>

      <div class="col-lg-3 col-md-6 mb-4">
        <h5>Legal</h5>
        <a href="{{ route('privacy') }}" class="footer-link-v2">Privacy Policy</a>
        <a href="{{ route('terms') }}" class="footer-link-v2">Terms of Use</a>
        <a href="{{ route('cookie-policy') }}" class="footer-link-v2">Cookie Policy</a>
        <a href="{{ route('medical-disclaimer') }}" class="footer-link-v2">Medical Disclaimer</a>
        <a href="{{ route('advertise') }}" class="footer-link-v2">Advertise With Us</a>

        <div class="footer-disclaimer-v2">
          <strong>Medical Disclaimer:</strong> Content is for informational purposes only. Consult a qualified healthcare provider.
        </div>
      </div>
    </div>

    <div class="footer-bottom-v2">
      <span>&copy; {{ date('Y') }} healthyliferemedy.com — All rights reserved.</span>
      <span>Made with care for your health journey.</span>
    </div>
  </div>
</footer>

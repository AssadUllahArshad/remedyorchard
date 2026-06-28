@extends('layouts.app')

@section('title', 'HealthyLife Remedy — Evidence-Based Natural Health & Wellness')
@section('meta_description', 'Your trusted guide to natural health, evidence-based nutrition, and holistic wellness. Doctor-reviewed articles on home remedies, nutrition, mental health, fitness, sleep, and heart health.')

@section('content')

{{--
    NOTE FOR BACKEND INTEGRATION:
    $latestArticles  -> expects a collection of Article models (e.g. Article::latest()->take(4)->get())
                        each with: title, slug, excerpt, thumbnail_url, read_time, category (relation: name, slug, color_class),
                        author (relation: name)
    $categories      -> expects Category::all() with: name, slug, icon (bootstrap icon class)
    $stats           -> simple array/object of homepage counters (article_count, newsletter_count, etc.)
    Example fallback data below lets this view render standalone before the backend is wired up.
--}}

@php
    $latestArticles = $latestArticles ?? [
        (object)[
            'title' => '12 Proven Home Remedies to Lower Blood Pressure',
            'slug' => 'blood-pressure-remedies',
            'excerpt' => 'Science-backed approaches that can make a meaningful difference, before or alongside medication.',
            'thumb_class' => 'img-ph-1',
            'read_time' => '8 min',
            'category' => (object)['name' => 'Heart Health', 'slug' => 'heart-health'],
            'author' => (object)['name' => 'Dr. Sarah Mitchell'],
        ],
        (object)[
            'title' => 'The Anti-Inflammatory Diet: A 30-Day Plan',
            'slug' => 'anti-inflammatory-diet',
            'excerpt' => 'A structured plan to identify trigger foods and lower chronic inflammation.',
            'thumb_class' => 'img-ph-2',
            'read_time' => '12 min',
            'category' => (object)['name' => 'Nutrition', 'slug' => 'nutrition'],
            'author' => (object)['name' => 'Emma Rhodes, RD'],
        ],
        (object)[
            'title' => '7 Adaptogenic Herbs That Actually Work',
            'slug' => 'adaptogenic-herbs',
            'excerpt' => 'Ashwagandha, rhodiola, holy basil — what the research really supports.',
            'thumb_class' => 'img-ph-3',
            'read_time' => '7 min',
            'category' => (object)['name' => 'Home Remedies', 'slug' => 'home-remedies'],
            'author' => (object)['name' => 'James Okafor, ND'],
        ],
        (object)[
            'title' => 'Zone 2 Cardio: The Most Underrated Habit',
            'slug' => 'zone-2-cardio',
            'excerpt' => 'Why low-intensity training may be the highest-leverage fitness habit.',
            'thumb_class' => 'img-ph-4',
            'read_time' => '10 min',
            'category' => (object)['name' => 'Fitness', 'slug' => 'fitness'],
            'author' => (object)['name' => 'Carlos Mendez, CSCS'],
        ],
    ];

    $categories = $categories ?? [
        (object)['name' => 'Nutrition', 'slug' => 'nutrition', 'icon' => 'bi-apple'],
        (object)['name' => 'Home Remedies', 'slug' => 'home-remedies', 'icon' => 'bi-flower2'],
        (object)['name' => 'Mental Health', 'slug' => 'mental-health', 'icon' => 'bi-cloud-fill'],
        (object)['name' => 'Fitness', 'slug' => 'fitness', 'icon' => 'bi-lightning-charge-fill'],
        (object)['name' => 'Sleep', 'slug' => 'sleep', 'icon' => 'bi-moon-stars-fill'],
        (object)['name' => 'Heart Health', 'slug' => 'heart-health', 'icon' => 'bi-heart-fill'],
    ];
@endphp

<!-- ============== HERO ============== -->
<section class="hero-v2">
  <div class="container">
    <div class="hero-v2-content">
      <span class="eyebrow">The most trusted name in natural health</span>
      <h1>See how your habits really affect your health.</h1>
      <p class="hero-sub">HealthyLife Remedy helps you understand how nutrition, sleep, movement, and natural remedies affect your body — backed by research, written by clinicians, never by guesswork.</p>
      <a href="{{ route('remedies.index') }}" class="btn-pill-primary" style="font-size:1rem; padding:0.9rem 1.9rem;">Explore evidence-based remedies</a>
    </div>

    <div class="hero-stat-strip">
      <div>
        <span class="stat-num">{{ $stats['article_count'] ?? '340+' }}</span>
        <span class="stat-label">Research-backed articles</span>
      </div>
      <div>
        <span class="stat-num">{{ $stats['newsletter_count'] ?? '42K+' }}</span>
        <span class="stat-label">Weekly newsletter readers</span>
      </div>
      <div>
        <span class="stat-num">{{ $stats['clinician_count'] ?? '18' }}</span>
        <span class="stat-label">Doctors &amp; clinicians on staff</span>
      </div>
      <div>
        <span class="stat-num">2018</span>
        <span class="stat-label">Publishing since</span>
      </div>
    </div>
  </div>
</section>

<!-- ============== STOP GUESSING ============== -->
<section class="section-dark py-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <span class="eyebrow">Stop guessing</span>
        <h2 style="font-size:2.2rem; color:#fff; margin-bottom:1.2rem;">Health advice is generic. Your body isn't.</h2>
        <p style="color:var(--text-on-dark-dim); font-size:1.05rem; margin-bottom:1.6rem;">Most people know diet, sleep, and stress matter. What they don't have is a clear way to tell whether the advice they're following actually holds up. We pair the latest clinical research with real-world context, so the guidance you read here is something you can actually act on.</p>
        <a href="{{ route('about') }}" class="btn-pill-outline">How we review every article</a>
      </div>
      <div class="col-lg-6">
        <div class="capsule capsule-dark mb-3">
          <span class="capsule-code">#0F2027</span>
          <span class="capsule-code">#28623A</span>
        </div>
        <div class="capsule capsule-brand mb-3">
          <span class="capsule-label">EVIDENCE FIRST</span>
        </div>
        <div class="capsule capsule-dark">
          <span class="capsule-code">#28623A</span>
          <span class="capsule-code">#0F2027</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== WHAT YOU GET — Feature rows ============== -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">What you'll find here</span>
      <h2 style="font-size:2.2rem; color:#fff;">Your system for better everyday health.</h2>
    </div>

    <div class="feature-row mb-5">
      <div class="feature-media img-ph img-ph-1"></div>
      <div class="feature-text">
        <h3>Start with nutrition that actually fits your body.</h3>
        <p class="lead-text">No fad diets. Our nutrition coverage breaks down what the research actually shows about inflammation, blood sugar, and long-term eating patterns.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Step-by-step dietary plans reviewed by registered dietitians</li>
          <li><i class="bi bi-check-circle-fill"></i> Plain-language breakdowns of nutrition research</li>
          <li><i class="bi bi-check-circle-fill"></i> Practical meal structures, not just theory</li>
        </ul>
        <a href="{{ route('categories.show', 'nutrition') }}" class="btn-pill-outline">Browse nutrition articles</a>
      </div>
    </div>

    <div class="feature-row reverse mb-5">
      <div class="feature-media img-ph img-ph-2"></div>
      <div class="feature-text">
        <h3>Go deeper with natural remedies that hold up.</h3>
        <p class="lead-text">Traditional remedies and herbal approaches, checked against the clinical evidence that actually exists — not against marketing claims.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Herb-by-herb breakdowns of real trial data</li>
          <li><i class="bi bi-check-circle-fill"></i> Honest callouts when evidence is thin</li>
          <li><i class="bi bi-check-circle-fill"></i> Safety notes and interaction warnings</li>
        </ul>
        <a href="{{ route('categories.show', 'home-remedies') }}" class="btn-pill-outline">Browse home remedies</a>
      </div>
    </div>

    <div class="feature-row">
      <div class="feature-media img-ph img-ph-3"></div>
      <div class="feature-text">
        <h3>Build the habits that move the numbers that matter.</h3>
        <p class="lead-text">Sleep, movement, and stress are where most lasting change happens. We cover the daily systems that compound over months, not overnight fixes.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Sleep science adapted for real, busy lives</li>
          <li><i class="bi bi-check-circle-fill"></i> Training approaches backed by sports science</li>
          <li><i class="bi bi-check-circle-fill"></i> Heart-health habits that compound over time</li>
        </ul>
        <a href="{{ route('categories.show', 'fitness') }}" class="btn-pill-outline">Browse fitness &amp; habits</a>
      </div>
    </div>
  </div>
</section>

<!-- ============== LATEST ARTICLES ============== -->
<section class="section-dark py-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
      <div>
        <span class="eyebrow">Inside the library</span>
        <h2 style="font-size:2rem; color:#fff; margin-bottom:0;">Latest articles</h2>
      </div>
      <a href="{{ route('remedies.index') }}" class="btn-pill-outline">View all articles <i class="bi bi-arrow-right"></i></a>
    </div>

    <div class="category-filters-v2 mb-4">
      <a href="{{ route('remedies.index') }}" class="pill-filter active">All</a>
      @foreach($categories as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}" class="pill-filter">{{ $cat->name }}</a>
      @endforeach
    </div>

    <div class="row g-4">
      @foreach($latestArticles as $article)
      <div class="col-md-6 col-lg-3">
        <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none">
          <div class="card-dark">
            <div class="card-thumb img-ph {{ $article->thumb_class ?? 'img-ph-1' }}"
                 @isset($article->thumbnail_url) style="background-image:url('{{ $article->thumbnail_url }}')" @endisset></div>
            <div class="card-body">
              <span class="tag-chip">{{ $article->category->name }}</span>
              <h3>{{ $article->title }}</h3>
              <p class="excerpt">{{ $article->excerpt }}</p>
              <div class="card-meta"><span>{{ $article->author->name }}</span><span>{{ $article->read_time }}</span></div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============== BROWSE BY CATEGORY ============== -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Find your topic</span>
      <h2 style="font-size:2.2rem; color:#fff;">Browse by category.</h2>
    </div>

    <div class="row g-3">
      @foreach($categories as $cat)
      <div class="col-md-4">
        <a href="{{ route('categories.show', $cat->slug) }}" class="category-tile text-decoration-none">
          <span class="cat-left">
            <span class="cat-icon"><i class="bi {{ $cat->icon }}"></i></span>
            <span class="cat-name">{{ $cat->name }}</span>
          </span>
          <i class="bi bi-chevron-right chevron"></i>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============== STATS — Real results ============== -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Real results</span>
      <h2 style="font-size:2.2rem; color:#fff;">Not just more articles. Measurable habits.</h2>
      <p style="color:var(--text-on-dark-dim); max-width:600px; margin:0 auto;">Readers who follow our structured plans report changes in the habits that matter most for long-term health.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="stat-block">
          <span class="stat-num">81%</span>
          <h4>followed a full 30-day plan</h4>
          <p>Readers who started our Anti-Inflammatory Diet plan reported completing the full reset.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-block">
          <span class="stat-num">76%</span>
          <h4>reported better sleep</h4>
          <p>Of readers who applied our circadian-based sleep hygiene guidance for 3+ weeks.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-block">
          <span class="stat-num">68%</span>
          <h4>kept up Zone 2 training</h4>
          <p>Readers who adopted a weekly low-intensity cardio habit after reading our guide.</p>
        </div>
      </div>
    </div>
    <p style="color:var(--text-on-dark-faint); font-size:0.8rem; margin-top:2rem;">Based on a 2026 reader survey of 1,400 newsletter subscribers. Self-reported; individual results vary.</p>
  </div>
</section>

<!-- ============== TESTIMONIALS ============== -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">From our readers</span>
      <h2 style="font-size:2.2rem; color:#fff;">What change can look like.</h2>
    </div>

    <div class="row g-4">
      @foreach([
          ['initials' => 'MR', 'quote' => 'My blood pressure dropped 14 points in two months without changing my medication.', 'name' => 'Maria R., reader since 2023'],
          ['initials' => 'DK', 'quote' => 'The 30-day anti-inflammatory plan was the first one I actually finished.', 'name' => 'David K., reader since 2024'],
          ['initials' => 'SP', 'quote' => 'I finally understand why my sleep changed after 40 instead of just fighting it.', 'name' => 'Sandra P., reader since 2022'],
          ['initials' => 'TH', 'quote' => 'Zone 2 training sounded too easy to work. Three months in, my resting heart rate tells a different story.', 'name' => 'Tom H., reader since 2025'],
      ] as $t)
      <div class="col-md-6 col-lg-3">
        <div class="testimonial-card">
          <span class="quote-mark">&rdquo;</span>
          <p class="quote-text">{{ $t['quote'] }}</p>
          <div class="author-row">
            <span class="testimonial-avatar">{{ $t['initials'] }}</span>
            <span class="author-name">{{ $t['name'] }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============== THREE WAYS TO ENGAGE (tier cards) ============== -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Three ways to start</span>
      <h2 style="font-size:2.2rem; color:#fff;">One library. Three ways to use it.</h2>
      <p style="color:var(--text-on-dark-dim); max-width:600px; margin:0 auto;">However deep you want to go, start where it makes sense for you.</p>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="tier-card">
          <span class="tier-eyebrow">Casual reader</span>
          <h3>Browse Free</h3>
          <p class="tier-desc">Read any article, anytime, at no cost. No account required.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> Full access to all {{ $stats['article_count'] ?? '340+' }} articles</li>
            <li><i class="bi bi-check-circle-fill"></i> Category browsing &amp; search</li>
            <li><i class="bi bi-check-circle-fill"></i> No paywall, ever</li>
          </ul>
          <a href="{{ route('remedies.index') }}" class="btn-pill-outline text-center">Start reading</a>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="tier-card featured">
          <span class="tier-eyebrow">Recommended</span>
          <h3>Weekly Newsletter</h3>
          <p class="tier-desc">Get our best research-backed tips delivered every Tuesday, free.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> One curated tip per week</li>
            <li><i class="bi bi-check-circle-fill"></i> Early access to new guides</li>
            <li><i class="bi bi-check-circle-fill"></i> Joined by {{ $stats['newsletter_count'] ?? '42,000+' }} readers</li>
          </ul>
          <a href="{{ route('contact') }}" class="btn-pill-primary text-center" style="background:#fff; color:var(--emerald-brand);">Subscribe free</a>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="tier-card">
          <span class="tier-eyebrow">Going deeper</span>
          <h3>Work With a Pro</h3>
          <p class="tier-desc">Some topics deserve a real conversation. We'll point you to a qualified professional.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> Curated directory of clinicians</li>
            <li><i class="bi bi-check-circle-fill"></i> Questions to bring to your appointment</li>
            <li><i class="bi bi-check-circle-fill"></i> No referral fees, no bias</li>
          </ul>
          <a href="{{ route('about') }}" class="btn-pill-outline text-center">Learn how we vet experts</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============== TRUST ROW ============== -->
<section class="section-dark py-section" style="padding-top:2.5rem; padding-bottom:2.5rem;">
  <div class="container">
    <div class="trust-badge-row justify-content-center">
      <span class="trust-badge"><i class="bi bi-shield-check"></i> Evidence-based</span>
      <span class="trust-badge"><i class="bi bi-mortarboard-fill"></i> Clinician-reviewed</span>
      <span class="trust-badge"><i class="bi bi-eye-slash-fill"></i> No hidden agendas</span>
      <span class="trust-badge"><i class="bi bi-heart-fill"></i> Reader-first since 2018</span>
    </div>
  </div>
</section>

<!-- ============== NEWSLETTER BAND ============== -->
<section class="section-dark" style="padding-bottom:5.5rem;">
  <div class="container">
    <div class="newsletter-band">
      <h2>Stop guessing. Start reading what holds up.</h2>
      <p>Join {{ $stats['newsletter_count'] ?? '42,000+' }} readers getting one research-backed health tip every Tuesday — free, no spam.</p>
      <form class="newsletter-band-form" method="POST" action="{{ route('newsletter.subscribe') }}">
        @csrf
        <input type="email" name="email" placeholder="your@email.com" required>
        <button type="submit">Subscribe Free</button>
      </form>
    </div>
  </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'HealthyLife Remedy — Evidence-Based Natural Health & Wellness')
@section('meta_description', 'Your trusted guide to natural health, evidence-based nutrition, and holistic wellness. Doctor-reviewed articles on home remedies, nutrition, mental health, fitness, sleep, and heart health.')
@section('og_title', 'HealthyLife Remedy — Evidence-Based Natural Health & Wellness')
@section('og_description', 'Doctor-reviewed articles on natural health, home remedies, nutrition, mental health, fitness, sleep, and heart health.')
@section('preload_hints')
<link rel="preconnect" href="https://images.unsplash.com">
<link rel="dns-prefetch" href="https://images.unsplash.com">
<link rel="preload" as="image" href="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=1600&q=85&auto=format&fit=crop&fm=webp" fetchpriority="high">
@endsection

@section('content')

@php
    $imageAssets = [
        'nutrition' => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=800&q=80&auto=format&fit=crop',
        'herbs'     => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&q=80&auto=format&fit=crop',
        'fitness'   => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&q=80&auto=format&fit=crop',
        'sleep'     => 'https://images.unsplash.com/photo-1631558432963-2c7eb7fdc5e2?w=800&q=80&auto=format&fit=crop',
        'heart'     => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=800&q=80&auto=format&fit=crop',
        'stress'    => 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
    ];

    $latestArticles = $latestArticles ?? [
        (object)[
            'title'         => '12 Home Remedies to Lower Blood Pressure Naturally',
            'slug'          => 'blood-pressure-remedies',
            'excerpt'       => 'Science-backed approaches to blood pressure management — before or alongside medication.',
            'thumb_class'   => 'img-ph-1',
            'thumbnail_url' => $imageAssets['heart'],
            'read_time'     => '8 min read',
            'category'      => (object)['name' => 'Heart Health', 'slug' => 'heart-health'],
            'author'        => (object)['name' => 'Dr. Sarah Mitchell'],
        ],
        (object)[
            'title'         => 'The Anti-Inflammatory Diet: A 30-Day Reset Plan',
            'slug'          => 'anti-inflammatory-diet',
            'excerpt'       => 'A structured, week-by-week plan to cut inflammatory foods and understand what replaces them.',
            'thumb_class'   => 'img-ph-2',
            'thumbnail_url' => $imageAssets['nutrition'],
            'read_time'     => '12 min read',
            'category'      => (object)['name' => 'Nutrition', 'slug' => 'nutrition'],
            'author'        => (object)['name' => 'Emma Rhodes, RD'],
        ],
        (object)[
            'title'         => '7 Adaptogenic Herbs — What the Research Actually Shows',
            'slug'          => 'adaptogenic-herbs',
            'excerpt'       => 'Ashwagandha, rhodiola, holy basil: separating trial data from marketing claims.',
            'thumb_class'   => 'img-ph-3',
            'thumbnail_url' => $imageAssets['herbs'],
            'read_time'     => '7 min read',
            'category'      => (object)['name' => 'Home Remedies', 'slug' => 'home-remedies'],
            'author'        => (object)['name' => 'James Okafor, ND'],
        ],
        (object)[
            'title'         => 'Zone 2 Cardio: The Most Underrated Health Investment',
            'slug'          => 'zone-2-cardio',
            'excerpt'       => 'Why elite athletes do 80% of training at low intensity — and why it works for everyone.',
            'thumb_class'   => 'img-ph-4',
            'thumbnail_url' => $imageAssets['fitness'],
            'read_time'     => '10 min read',
            'category'      => (object)['name' => 'Fitness', 'slug' => 'fitness'],
            'author'        => (object)['name' => 'Carlos Mendez, CSCS'],
        ],
    ];

    $categories = $categories ?? [
        (object)['name' => 'Nutrition',     'slug' => 'nutrition',     'icon' => 'bi-apple',                'desc' => 'Eating patterns, nutrients & meal planning'],
        (object)['name' => 'Home Remedies', 'slug' => 'home-remedies', 'icon' => 'bi-flower2',              'desc' => 'Herbs, natural approaches & traditional medicine'],
        (object)['name' => 'Mental Health', 'slug' => 'mental-health', 'icon' => 'bi-cloud-fill',           'desc' => 'Stress, anxiety, mood & cognitive wellness'],
        (object)['name' => 'Fitness',       'slug' => 'fitness',       'icon' => 'bi-lightning-charge-fill','desc' => 'Movement, strength & cardiovascular health'],
        (object)['name' => 'Sleep',         'slug' => 'sleep',         'icon' => 'bi-moon-stars-fill',      'desc' => 'Sleep quality, circadian rhythm & restoration'],
        (object)['name' => 'Heart Health',  'slug' => 'heart-health',  'icon' => 'bi-heart-fill',           'desc' => 'Blood pressure, cholesterol & cardiovascular risk'],
    ];
@endphp

<!-- ============================================================
     HERO
============================================================ -->
<section class="hero-v2"
  style="background-image:url('https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=1600&q=85&auto=format&fit=crop');">
  <div class="container">
    <div class="hero-v2-content">
      <span class="eyebrow">Trusted natural health guidance since 2018</span>
      <h1>Health information<br>you can actually use.</h1>
      <p class="hero-sub">HealthyLife Remedy publishes evidence-based guides on nutrition, natural remedies, fitness, sleep, and heart health — every article written and reviewed by qualified clinicians, not content mills.</p>
      <div class="d-flex flex-wrap gap-3 align-items-center">
        @isset($featuredArticle)
        <a href="{{ route('articles.show', $featuredArticle->slug) }}" class="btn-pill-primary btn-pill-primary--lg">
          <i class="bi bi-star-fill me-1"></i> Read: {{ \Illuminate\Support\Str::limit($featuredArticle->title, 50) }}
        </a>
        @else
        <a href="{{ route('remedies.index') }}" class="btn-pill-primary btn-pill-primary--lg">
          <i class="bi bi-journals me-1"></i> Explore the library
        </a>
        @endisset
        <a href="{{ route('about') }}" class="btn-pill-outline btn-pill-primary--lg">
          How we vet every article
        </a>
      </div>
    </div>

    <div class="hero-stat-strip">
      <div>
        <span class="stat-num">{{ $stats['article_count'] ?? '300+' }}</span>
        <span class="stat-label">Clinician-reviewed articles</span>
      </div>
      <div>
        <span class="stat-num">6</span>
        <span class="stat-label">Health topics covered</span>
      </div>
      <div>
        <span class="stat-num">{{ $stats['clinician_count'] ?? '6' }}</span>
        <span class="stat-label">Expert contributors</span>
      </div>
      <div>
        <span class="stat-num">2018</span>
        <span class="stat-label">Publishing since</span>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     TRUST STRIP
============================================================ -->
<section class="section-pill py-4" style="border-bottom:1px solid var(--emerald-line);">
  <div class="container">
    <div class="trust-badge-row justify-content-center">
      <span class="trust-badge"><i class="bi bi-shield-check fs-5"></i> Evidence-based</span>
      <span class="trust-badge"><i class="bi bi-mortarboard-fill fs-5"></i> Clinician-reviewed</span>
      <span class="trust-badge"><i class="bi bi-eye-slash-fill fs-5"></i> No hidden agendas</span>
      <span class="trust-badge"><i class="bi bi-heart-fill fs-5"></i> Reader-first since 2018</span>
      <span class="trust-badge"><i class="bi bi-lock-fill fs-5"></i> No paywalls, ever</span>
    </div>
  </div>
</section>

<!-- ============================================================
     WHAT YOU'LL FIND — Feature rows
============================================================ -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">What you'll find here</span>
      <h2>Three areas where good information makes a real difference.</h2>
    </div>

    <div class="feature-row mb-5">
      <div class="feature-media img-ph img-ph-1"
           style="background-image:url('{{ $imageAssets['nutrition'] }}')"></div>
      <div class="feature-text">
        <span class="eyebrow" style="margin-bottom:0.6rem;">Nutrition</span>
        <h3>Eating patterns that hold up under scrutiny.</h3>
        <p class="lead-text">Most nutrition advice online is either too vague to act on or too rigid to sustain. Our registered dietitians translate current research into practical, realistic eating changes.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Step-by-step guides reviewed by registered dietitians</li>
          <li><i class="bi bi-check-circle-fill"></i> Plain-language breakdowns of peer-reviewed research</li>
          <li><i class="bi bi-check-circle-fill"></i> Anti-inflammatory, blood sugar &amp; gut health focus</li>
        </ul>
        <a href="{{ route('categories.show', 'nutrition') }}" class="btn-pill-outline">Browse nutrition articles</a>
      </div>
    </div>

    <div class="feature-row reverse mb-5">
      <div class="feature-media img-ph img-ph-2"
           style="background-image:url('{{ $imageAssets['herbs'] }}')"></div>
      <div class="feature-text">
        <span class="eyebrow" style="margin-bottom:0.6rem;">Natural Remedies</span>
        <h3>Traditional approaches, checked against real trials.</h3>
        <p class="lead-text">Home remedies and herbal medicine have genuine research behind some of them — and very little behind others. We tell you which is which, honestly.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Herb-by-herb breakdowns of clinical trial evidence</li>
          <li><i class="bi bi-check-circle-fill"></i> Transparent callouts when evidence is limited</li>
          <li><i class="bi bi-check-circle-fill"></i> Drug interaction and safety warnings included</li>
        </ul>
        <a href="{{ route('categories.show', 'home-remedies') }}" class="btn-pill-outline">Browse home remedies</a>
      </div>
    </div>

    <div class="feature-row">
      <div class="feature-media img-ph img-ph-4"
           style="background-image:url('{{ $imageAssets['fitness'] }}')"></div>
      <div class="feature-text">
        <span class="eyebrow" style="margin-bottom:0.6rem;">Fitness, Sleep & Heart Health</span>
        <h3>The daily habits that compound over months.</h3>
        <p class="lead-text">Sleep, movement, and cardiovascular health are where most lasting change happens. Our sports scientists, sleep medicine physicians, and cardiologists cover the systems that actually work long-term.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Sleep science adapted for real, busy lives</li>
          <li><i class="bi bi-check-circle-fill"></i> Training approaches grounded in sports science</li>
          <li><i class="bi bi-check-circle-fill"></i> Blood pressure &amp; heart-health habits that compound</li>
        </ul>
        <a href="{{ route('categories.show', 'fitness') }}" class="btn-pill-outline">Browse fitness &amp; lifestyle</a>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     LATEST ARTICLES
============================================================ -->
<section class="section-pill py-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-end mb-4 flex-wrap gap-3">
      <div>
        <span class="eyebrow">Fresh from the library</span>
        <h2 style="margin-bottom:0;">Latest articles</h2>
      </div>
      <a href="{{ route('remedies.index') }}" class="btn-pill-outline">
        View all articles <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>

    <div class="category-filters-v2 mb-4">
      <a href="{{ route('remedies.index') }}" class="pill-filter active">All topics</a>
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
              <div class="card-meta">
                <span>{{ $article->author->name }}</span>
                <span>{{ $article->read_time }}</span>
              </div>
            </div>
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============================================================
     BROWSE BY CATEGORY
============================================================ -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Find your topic</span>
      <h2>Every major area of natural health, in one place.</h2>
    </div>

    <div class="row g-3">
      @foreach($categories as $cat)
      <div class="col-md-4 col-lg-4">
        <a href="{{ route('categories.show', $cat->slug) }}" class="text-decoration-none d-block h-100">
          <div class="category-tile" style="flex-direction:column; align-items:flex-start; gap:0.75rem; padding:1.5rem;">
            <div class="d-flex align-items-center gap-3 w-100 justify-content-between">
              <span class="cat-left">
                <span class="cat-icon"><i class="bi {{ $cat->icon }}"></i></span>
                <span class="cat-name">{{ $cat->name }}</span>
              </span>
              <i class="bi bi-arrow-right-short fs-5 text-emerald"></i>
            </div>
            @isset($cat->desc)
            <p class="category-tile-desc">{{ $cat->desc }}</p>
            @endisset
          </div>
        </a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============================================================
     EDITORIAL STANDARDS
============================================================ -->
<section class="section-pill py-section">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-5">
        <span class="eyebrow">Our editorial standard</span>
        <h2>Why you can trust what you read here.</h2>
        <p class="section-lead-text">
          Every article on HealthyLife Remedy goes through the same checklist before publication — the same standards a peer-reviewed journal would use, adapted for a general readership.
        </p>
        <a href="{{ route('about') }}" class="btn-pill-primary">Meet our review team</a>
      </div>
      <div class="col-lg-7">
        <div class="row g-3">
          @foreach([
            ['icon' => 'bi-file-text', 'title' => 'Primary sources only',    'desc' => 'We cite peer-reviewed journals, clinical trials, and institutional health bodies — not other health blogs.'],
            ['icon' => 'bi-person-check-fill', 'title' => 'Clinician review', 'desc' => 'Every article is reviewed by a physician, dietitian, or credentialed specialist before it\'s published.'],
            ['icon' => 'bi-arrow-repeat', 'title' => 'Regular updates',       'desc' => 'Health science evolves. We flag articles when new evidence warrants an update and revise accordingly.'],
            ['icon' => 'bi-cash-coin', 'title' => 'No paid influence',         'desc' => 'We don\'t accept payment for coverage, and our editorial team is separate from any commercial relationships.'],
          ] as $pillar)
          <div class="col-sm-6">
            <div class="value-pillar">
              <div class="pillar-icon"><i class="bi {{ $pillar['icon'] }}"></i></div>
              <h3>{{ $pillar['title'] }}</h3>
              <p>{{ $pillar['desc'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     TESTIMONIALS
============================================================ -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">From our readers</span>
      <h2>What it feels like when information actually helps.</h2>
    </div>

    <div class="row g-4">
      @foreach([
        ['initials'=>'MR', 'quote'=>'I\'d been reading about blood pressure for years. HealthyLife was the first source that explained the mechanisms clearly enough that I understood why the lifestyle changes actually work.', 'name'=>'Maria R.', 'detail'=>'Reader since 2023'],
        ['initials'=>'DK', 'quote'=>'The 30-day anti-inflammatory plan was the first structured guide I actually followed from start to finish. The weekly structure made it manageable.', 'name'=>'David K.', 'detail'=>'Reader since 2024'],
        ['initials'=>'SP', 'quote'=>'After reading the sleep guide, I stopped fighting my 4am wake-ups and started understanding them. The circadian science section was genuinely eye-opening.', 'name'=>'Sandra P.', 'detail'=>'Reader since 2022'],
        ['initials'=>'TH', 'quote'=>'Zone 2 training seemed too simple to be worth doing. Three months later it\'s the habit I\'ve kept longest. The way the article explained the physiology made it stick.', 'name'=>'Tom H.', 'detail'=>'Reader since 2025'],
      ] as $t)
      <div class="col-md-6 col-lg-3">
        <div class="testimonial-card-v2">
          <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
          <p>"{{ $t['quote'] }}"</p>
          <div class="testi-author">
            <strong>{{ $t['name'] }}</strong>
            {{ $t['detail'] }}
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ============================================================
     THREE WAYS TO START
============================================================ -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">How to get started</span>
      <h2>Start wherever makes sense for you.</h2>
      <p class="section-subhead">No account needed. No paywall. Just well-researched information, free to read.</p>
    </div>

    <div class="row g-4">
      <div class="col-lg-4">
        <div class="tier-card">
          <span class="tier-eyebrow">Browse freely</span>
          <h3>Read any article, free</h3>
          <p class="tier-desc">Every guide on HealthyLife Remedy is open access — no signup, no paywall, no tricks.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> Full access to the complete article library</li>
            <li><i class="bi bi-check-circle-fill"></i> Browse by topic or search by keyword</li>
            <li><i class="bi bi-check-circle-fill"></i> All content free, permanently</li>
          </ul>
          <a href="{{ route('remedies.index') }}" class="btn-pill-outline d-block text-center">Browse the library</a>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="tier-card featured">
          <span class="tier-eyebrow">Most popular</span>
          <h3>Join the weekly newsletter</h3>
          <p class="tier-desc">One research-backed health insight delivered every Tuesday — short, practical, and worth reading.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> One focused tip per week, nothing more</li>
            <li><i class="bi bi-check-circle-fill"></i> Early access to new long-form guides</li>
            <li><i class="bi bi-check-circle-fill"></i> Unsubscribe anytime, one click</li>
          </ul>
          <a href="#newsletter" class="btn-pill-primary d-block text-center tier-card-cta-featured">Subscribe free</a>
        </div>
      </div>

      <div class="col-lg-4">
        <div class="tier-card">
          <span class="tier-eyebrow">Go deeper</span>
          <h3>Talk to a professional</h3>
          <p class="tier-desc">Some health topics need a personal conversation. We help you know what to ask and who to trust.</p>
          <ul>
            <li><i class="bi bi-check-circle-fill"></i> Questions to bring to your next appointment</li>
            <li><i class="bi bi-check-circle-fill"></i> How to evaluate practitioner credentials</li>
            <li><i class="bi bi-check-circle-fill"></i> No referral fees or sponsored directories</li>
          </ul>
          <a href="{{ route('about') }}" class="btn-pill-outline d-block text-center">Our approach to expertise</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============================================================
     NEWSLETTER BAND
============================================================ -->
<section class="section-dark" style="padding-bottom:5.5rem;" id="newsletter">
  <div class="container">
    <div class="newsletter-band">
      <h2>One insight per week. No noise.</h2>
      <p>Join our newsletter for a single, well-researched health tip every Tuesday — free, and easy to unsubscribe from.</p>
      <form class="newsletter-band-form" method="POST" action="{{ route('newsletter.subscribe') }}">
        @csrf
        <input type="hidden" name="source" value="home-newsletter-band">
        <input type="email" name="email" placeholder="your@email.com" required>
        <button type="submit">Subscribe Free</button>
      </form>
    </div>
  </div>
</section>

@endsection

@extends('layouts.app')

@section('title', 'Natural Health Remedies & Wellness Tips | Healthy Habits Hub')
@section('meta_description', 'Clinician-reviewed natural remedies, nutrition guides and wellness tips backed by science. Trusted, evidence-based health advice you can rely on.')
@section('og_title', 'Natural Health Remedies & Wellness Tips | Healthy Habits Hub')
@section('og_description', 'Clinician-reviewed guides on natural remedies, nutrition, fitness, sleep and heart health evidence-based advice you can trust.')
@section('content')

@php
    $imageAssets = [
        'nutrition' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
        'meal_planning' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
        'herbs'     => 'https://images.unsplash.com/photo-1508595165502-3e2652e5a405?w=800&q=80&auto=format&fit=crop',
        'fitness'   => 'https://images.unsplash.com/photo-1728209229705-b54381185d28?w=800&q=80&auto=format&fit=crop',
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
<section class="hero-v2 hero-v2--canvas">
  <div class="hero-canvas-host"
       data-kinetic-grid
       data-dot-color="#FFFFFF"
       data-line-color="#80ACFF"
       data-trail-color="#2664EB"
       data-spacing="30"
       data-radius="400"
       data-strength="4"
       aria-hidden="true">
    <canvas></canvas>
  </div>
  <div class="container">
    <div class="hero-v2-content">
      <span class="eyebrow">Evidence-Based Health & Wellness Since 2020</span>
      <h1>Natural Health Remedies<br>you can actually use.</h1>
      <p class="hero-sub">HealthyHabbits hub delivers clinician-reviewed guides on natural remedies, nutrition, fitness, sleep and heart health every article grounded in peer-reviewed research, not guesswork or content mills.</p>
      <div class="d-flex flex-wrap gap-3 align-items-center hero-cta-row">
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
      <span class="eyebrow d-flex justify-content-center">YOUR PATH TO BETTER HEALTH</span>
      <h2>Three areas that make the biggest difference in your wellbeing.</h2>
    </div>

    <div class="feature-row mb-5">
      <div class="feature-media img-ph img-ph-1"
           style="background-image:url('{{ $imageAssets['meal_planning'] }}')"></div>
      <div class="feature-text">
        <span class="eyebrow" style="margin-bottom:0.6rem;">MEAL PLANNING</span>
        <h3>Simple meal plans that fit your real schedule.</h3>
        <p class="lead-text">Knowing what to eat is only half the battle. We turn nutrition science into ready-to-use weekly meal structures that built for people with jobs, families and limited time to cook.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i>7-day meal plans built around whole foods</li>
          <li><i class="bi bi-check-circle-fill"></i>Grocery lists that cut decision fatigue</li>
          <li><i class="bi bi-check-circle-fill"></i>Batch-cooking strategies for busy weeks &amp; gut health focus</li>
        </ul>
        <a href="{{ route('categories.show', 'nutrition') }}" class="btn-pill-outline">Browse meal plans</a>
      </div>
    </div>

    <div class="feature-row reverse mb-5">
      <div class="feature-media img-ph img-ph-2"
           style="background-image:url('{{ $imageAssets['herbs'] }}')"></div>
      <div class="feature-text">
        <span class="eyebrow" style="margin-bottom:0.6rem;">Natural Remedies</span>
        <h3>Natural remedies that actually work, backed by science.</h3>
        <p class="lead-text">From turmeric to elderberry, herbal remedies are everywhere online, but few sources tell you which ones have real clinical backing. We separate proven natural remedies from folklore, so you can make informed choices about your health.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i>Herb-by-herb reviews of clinical trial evidence</li>
          <li><i class="bi bi-check-circle-fill"></i>Honest ratings when scientific research is limited</li>
          <li><i class="bi bi-check-circle-fill"></i>Safety warnings and drug interaction alerts included</li>
        </ul>
        <a href="{{ route('categories.show', 'home-remedies') }}" class="btn-pill-outline">Browse home remedies</a>
      </div>
    </div>

    <div class="feature-row">
      <div class="feature-media img-ph img-ph-4"
           style="background-image:url('{{ $imageAssets['fitness'] }}')"></div>
      <div class="feature-text">
        <span class="eyebrow" style="margin-bottom:0.6rem;">Fitness, Sleep & Heart Health</span>
        <h3>Build the daily habits that actually improve your health.</h3>
        <p class="lead-text">Better sleep, consistent exercise and a healthy heart don't come from quick fixes, they come from small daily habits that compound over time. Our sports scientists, sleep medicine physicians and cardiologists show you exactly what to focus on and why it works.</p>
        <ul>
          <li><i class="bi bi-check-circle-fill"></i> Sleep hygiene tips backed by circadian science</li>
          <li><i class="bi bi-check-circle-fill"></i> Exercise routines designed for real, busy schedules</li>
          <li><i class="bi bi-check-circle-fill"></i> Heart-healthy habits that lower blood pressure naturally &amp; health </li>
        </ul>
        <a href="{{ route('categories.show', 'fitness') }}" class="btn-pill-outline">See what actually works</a>
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

    <div class="coverflow" data-coverflow tabindex="0" aria-roledescription="carousel" aria-label="Latest articles">
      <div class="coverflow-stage" data-coverflow-stage>
        @foreach($latestArticles as $i => $article)
        <div class="coverflow-card" data-coverflow-card data-index="{{ $i }}">
          <div class="coverflow-card-inner">
            <div class="coverflow-card-img img-ph {{ $article->thumb_class ?? 'img-ph-1' }}"
                 @isset($article->thumbnail_url) style="background-image:url('{{ $article->thumbnail_url }}')" @endisset></div>
            <div class="coverflow-card-info">
              <span class="tag-chip">{{ $article->category->name }}</span>
              <h3>{{ $article->title }}</h3>
              <p class="excerpt">{{ $article->excerpt }}</p>
              <div class="card-meta">
                <span>{{ $article->author->name }}</span>
                <span>{{ $article->read_time }}</span>
              </div>
              <a href="{{ route('articles.show', $article->slug) }}" class="btn-pill-primary coverflow-cta">Read article</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <button type="button" class="coverflow-arrow coverflow-arrow-prev" data-coverflow-prev aria-label="Previous article">
        <i class="bi bi-chevron-left"></i>
      </button>
      <button type="button" class="coverflow-arrow coverflow-arrow-next" data-coverflow-next aria-label="Next article">
        <i class="bi bi-chevron-right"></i>
      </button>
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
      <h2>Explore expert's health guides on nutrition, fitness and more.</h2>
    </div>

    @php
      $categoryImages = [
        'nutrition'     => 'nutrition.jpg',
        'home-remedies' => 'home-remedies.jpg',
        'mental-health' => 'mental-health.jpg',
        'fitness'       => 'fitness.jpg',
        'sleep'         => 'sleep.jpg',
        'heart-health'  => 'heart.jpg',
        'healthy-diet'  => 'healthy-diet.jpg',
        'wellness'      => 'wellness.jpg',
      ];
    @endphp

    <div class="category-masonry">
      @foreach($categories as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}"
         class="category-masonry-tile"
         style="background-image:url('{{ asset('images/' . ($categoryImages[$cat->slug] ?? 'nutrition.jpg')) }}');">
        <div class="category-masonry-content">
          <span class="category-masonry-name">{{ $cat->name }}</span>
          <span class="category-masonry-arrow"><i class="bi bi-arrow-right"></i></span>
        </div>
      </a>
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
        <span class="eyebrow">EVIDENCE-BASED HEALTH CONTENT</span>
        <h2>Health advice you can actually trust.</h2>
        <p class="section-lead-text">
          Every article on Healthy Habbits Hub follows a strict editorial process before publication, the same evidence standards used in peer-reviewed medical journals, made accessible for everyday readers.
        </p>
        <a href="{{ route('about') }}" class="btn-pill-primary">Meet Our Medical Review Team</a>
      </div>
      <div class="col-lg-7">
        <div class="row g-3">
          @foreach([
            ['icon' => 'bi-file-text', 'title' => 'Peer-Reviewed Research Only',    'desc' => 'Every claim is backed by peer-reviewed journals, clinical trials and recognized health institutions, never other blogs or unverified sources.'],
            ['icon' => 'bi-person-check-fill', 'title' => 'Reviewed by Licensed Clinicians', 'desc' => 'Every article is reviewed by a licensed physician, registered dietitian or credentialed health specialist before publication..'],
            ['icon' => 'bi-arrow-repeat', 'title' => 'Continuously Updated Content',       'desc' => 'Medical research evolves constantly. We monitor new studies and revise our articles whenever the evidence changes.'],
            ['icon' => 'bi-cash-coin', 'title' => '100% Editorial Independence',         'desc' => 'We never accept payment for coverage. Our editorial team operates completely independent from advertisers and sponsors.'],
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

    @php
      $testimonials = [
        ['quote'=>'I\'d been reading about blood pressure for years. Healthy Habits was the first source that explained the mechanisms clearly enough that I understood why the lifestyle changes actually work.', 'name'=>'Maria R.', 'detail'=>'Reader since 2023'],
        ['quote'=>'The 30-day anti-inflammatory plan was the first structured guide I actually followed from start to finish. The weekly structure made it manageable.', 'name'=>'David K.', 'detail'=>'Reader since 2024'],
        ['quote'=>'After reading the sleep guide, I stopped fighting my 4am wake-ups and started understanding them. The circadian science section was genuinely eye-opening.', 'name'=>'Sandra P.', 'detail'=>'Reader since 2022'],
        ['quote'=>'Zone 2 training seemed too simple to be worth doing. Three months later it\'s the habit I\'ve kept longest. The way the article explained the physiology made it stick.', 'name'=>'Tom H.', 'detail'=>'Reader since 2025'],
        ['quote'=>'Struggling with bloating for years and just being told to eat more fiber everywhere I looked. The gut health article was the first one that actually explained why leaky gut happens instead of just listing supplements to buy.', 'name'=>'Rachel B.', 'detail'=>'Reader since 2023'],
        ['quote'=>'I came for the sleep articles and stayed for the mental health section. The piece on chronic stress and cortisol finally made me understand why my anxiety spiked every afternoon, not just at bedtime.', 'name'=>'Ahmed K.', 'detail'=>'Reader since 2024'],
        ['quote'=>'The meal planning guides are the only ones I\'ve found that account for actually having a job and kids. Grocery lists that don\'t assume I have three hours to cook every night.', 'name'=>'Linda M.', 'detail'=>'Reader since 2022'],
        ['quote'=>'What sold me was the editorial standards page. Every claim in the heart health articles links back to an actual study, not just \'experts say.\' Rare to find that anymore.', 'name'=>'Kevin O.', 'detail'=>'Reader since 2025'],
        ['quote'=>'I was skeptical about herbal remedies until the adaptogens article laid out exactly which ones have real clinical trials behind them and which ones are just folklore. Appreciated the honesty.', 'name'=>'Nadia S.', 'detail'=>'Reader since 2024'],
      ];
    @endphp
    <div class="round-carousel" data-round-carousel>
      <div class="round-carousel-tilt" data-round-carousel-tilt>
        <div class="round-carousel-ring" data-round-carousel-ring>
          @foreach($testimonials as $t)
          <div class="round-carousel-item" data-round-carousel-item>
            <div class="round-carousel-face round-carousel-face-front">
              <div class="testimonial-card-v2">
                <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                <p>"{{ $t['quote'] }}"</p>
                <div class="testi-author">
                  <strong>{{ $t['name'] }}</strong>
                  {{ $t['detail'] }}
                </div>
              </div>
            </div>
            <div class="round-carousel-face round-carousel-face-back">
              <div class="testimonial-card-v2">
                <span class="stars">&#9733;&#9733;&#9733;&#9733;&#9733;</span>
                <p>"{{ $t['quote'] }}"</p>
                <div class="testi-author">
                  <strong>{{ $t['name'] }}</strong>
                  {{ $t['detail'] }}
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

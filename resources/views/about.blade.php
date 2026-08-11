@extends('layouts.app')

@section('title', 'About Us | Healthy Habits Hub')
@section('meta_description', "Learn about Healthy Habits Hub's mission to provide evidence-based natural health information, and meet the doctors, dietitians, and certified experts behind our content.")
@section('og_title', 'About Healthy Habits Hub — Our Mission & Expert Team')
@section('og_description', "Meet the doctors, dietitians, and certified experts who write and review every article on Healthy Habits Hub.")

@section('content')

@php
    $contributors = $contributors ?? [
        (object)['initials' => 'SM', 'name' => 'Dr. Affan Qaiser', 'role' => 'Cardiologist, MD', 'bio' => 'Board-certified cardiologist with 14 years of clinical practice. Leads our heart health and cardiovascular risk-reduction coverage. Trained at Johns Hopkins.'],
        (object)['initials' => 'ER', 'name' => 'Amjad Razaq, RD',    'role' => 'Registered Dietitian', 'bio' => 'Specialises in anti-inflammatory diets, gut health, and sustainable weight management. Works with both clinical and general populations.'],
        (object)['initials' => 'JO', 'name' => 'Iftakhar Abdullah, ND',   'role' => 'Naturopathic Doctor', 'bio' => 'Reviews our herbal remedy and adaptogen coverage against primary clinical literature. Strong background in evidence-based integrative medicine.'],
        (object)['initials' => 'PN', 'name' => 'Dr. Priya Nair',     'role' => 'Sleep Medicine Physician', 'bio' => 'Pulmonologist and sleep medicine specialist covering circadian biology, insomnia, and sleep-related cardiovascular risk.'],
        (object)['initials' => 'CM', 'name' => 'Ali Razzaq, CSCS','role' => 'Certified Strength & Conditioning Specialist', 'bio' => 'Fifteen years in applied sports science and performance coaching. Covers Zone 2 training, longevity fitness, and exercise physiology.'],
        (object)['initials' => 'MC', 'name' => 'Dr. Maya',      'role' => 'Integrative Medicine Physician', 'bio' => 'MD with fellowship training in integrative medicine. Bridges conventional and evidence-based complementary approaches in our mental health and stress coverage.'],
    ];
@endphp

<!-- HERO -->
<section class="hero-v2"
  style="padding:6rem 0 4rem; background-image:url('https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=1600&q=85&auto=format&fit=crop');">
  <div class="container">
    <span class="eyebrow">Our story</span>
    <h1 class="hero-h1">Eight years of asking: does the evidence actually support this?</h1>
    <p class="hero-sub hero-sub--wide">Health information is everywhere. Reliable health information is harder to find. Healthy Habits Hub was built to look beyond trends and popular claims, examine the evidence and make trustworthy health information easier to understand.</p>

    <div class="hero-stat-strip">
      <div>
        <span class="stat-num">8</span>
        <span class="stat-label">Years of asking better questions</span>
      </div>
      <div>
        <span class="stat-num">{{ count($contributors) }}</span>
        <span class="stat-label">Credentialed contributors</span>
      </div>
      <div>
        <span class="stat-num">{{ $stats['article_count'] ?? '300+' }}</span>
        <span class="stat-label">Clinician-reviewed articles</span>
      </div>
      <div>
        <span class="stat-num">0</span>
        <span class="stat-label">Sponsored placements, ever</span>
      </div>
    </div>
  </div>
</section>

<!-- HOW WE STARTED — timeline -->
<section class="section-dark py-section">
  <div class="container">
    <div class="row g-5 align-items-start">
      <div class="col-lg-4">
        <span class="eyebrow">How we started</span>
        <h3>A small newsletter that refused to lower its standards.</h3>
        <p class="lead-text" style="margin-bottom:0;">Today Healthy Habits Hub is a multi-author publication with physicians, registered dietitians, certified trainers, and naturopathic doctors — all of whom review content against peer-reviewed literature before anything reaches you.</p>
      </div>
      <div class="col-lg-8">
        <div class="timeline">
          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-year">2018</span>
            <h3>A fortnightly newsletter, one dietitian, zero compromises</h3>
            <p>Launched by a registered dietitian tired of watching unsupported health claims go viral — "detoxes" no physician would endorse, supplements marketed on testimonials instead of trials.</p>
          </div>
          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-year">2020</span>
            <h3>Readers noticed the difference</h3>
            <p>The newsletter grew because every claim came with a source, and every recommendation came with caveats where appropriate. Nothing was published just because it sounded compelling.</p>
          </div>
          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-year">2022</span>
            <h3>A formal editorial process</h3>
            <p>As the team grew, so did the standards: every article now requires sign-off from a credentialed reviewer before it reaches a reader.</p>
          </div>
          <div class="timeline-item">
            <span class="timeline-dot"></span>
            <span class="timeline-year">Today</span>
            <h3>A full clinical review team</h3>
            <p>Physicians, registered dietitians, certified trainers, and naturopathic doctors all review content against peer-reviewed literature before anything is published.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- EDITORIAL STANDARDS — connected stepper -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">How we work</span>
      <h2>The process most health blogs skip entirely.</h2>
      <p class="section-subhead">
        Most health content goes straight from idea to published post. Ours doesn't — here's every checkpoint a claim has to survive before it reaches you.
      </p>
    </div>

    <div class="process-stepper">
      @foreach([
        ['step'=>'01','icon'=>'bi-chat-square-quote-fill','title'=>'Where the idea comes from', 'desc'=>'Topics start as real questions — reader emails, search trends, gaps we notice in other coverage. We assign a subject because people are actively asking, not because it\'s easy to write.'],
        ['step'=>'02','icon'=>'bi-journal-bookmark-fill','title'=>'Building the evidence base', 'desc'=>'Before a sentence is drafted, we pull the primary research — randomised trials, systematic reviews, guidance from bodies like the NIH, NICE, and the American Heart Association. Other health blogs don\'t count as sources.'],
        ['step'=>'03','icon'=>'bi-person-check-fill','title'=>'A clinician reads it line by line', 'desc'=>'A physician, dietitian, or specialist matched to the topic checks every claim against the cited research, tightens anything that overstates certainty, and adds nuance where the evidence is mixed.'],
        ['step'=>'04','icon'=>'bi-arrow-repeat','title'=>'Nothing is ever "finished"', 'desc'=>'Medical consensus shifts. We track new studies on topics we\'ve already covered and revise articles when the evidence changes, instead of leaving outdated advice online indefinitely.'],
      ] as $step)
      <div class="process-step">
        <div class="process-step-circle"><i class="bi {{ $step['icon'] }}"></i></div>
        <div class="process-step-text">
          <span class="eyebrow" style="justify-content:center; font-size:0.68rem;">Step {{ $step['step'] }}</span>
          <h3>{{ $step['title'] }}</h3>
          <p>{{ $step['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- TEAM — round carousel -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">The team</span>
      <h2>Meet the clinicians behind the content.</h2>
      <p class="section-subhead">
        Every article on Healthy Habits Hub has a credentialed author or reviewer. These are the people responsible for the content you read — drag to spin, or let it rotate on its own.
      </p>
    </div>

    <div class="round-carousel round-carousel--team" data-round-carousel>
      <div class="round-carousel-tilt" data-round-carousel-tilt>
        <div class="round-carousel-ring" data-round-carousel-ring>
          @foreach($contributors as $person)
          <div class="round-carousel-item" data-round-carousel-item>
            <div class="round-carousel-face round-carousel-face-front">
              <div class="author-card-v2">
                <div class="author-avatar-lg">{{ $person->initials }}</div>
                <h3>{{ $person->name }}</h3>
                <span class="author-role">{{ $person->role }}</span>
                <p>{{ $person->bio }}</p>
              </div>
            </div>
            <div class="round-carousel-face round-carousel-face-back">
              <div class="author-card-v2">
                <div class="author-avatar-lg">{{ $person->initials }}</div>
                <h3>{{ $person->name }}</h3>
                <span class="author-role">{{ $person->role }}</span>
                <p>{{ $person->bio }}</p>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- WHAT WE DON'T DO -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Where we differ</span>
      <h2>What most health sites do. What we do instead.</h2>
      <p class="section-subhead">
        Being useful starts with being honest about the tricks we won't use — even the ones every other health site relies on.
      </p>
    </div>

    <div class="compare-ledger">
      <div class="compare-row compare-row-head">
        <span class="compare-label compare-label-them">What you'll find elsewhere</span>
        <span class="compare-label compare-label-us">What you'll find here</span>
      </div>

      @foreach([
        ['them'=>'Personalised medical advice with no diagnosis behind it', 'us'=>'Health education that always points you to a licensed clinician for anything specific to you'],
        ['them'=>'Supplement picks that quietly link to an affiliate store', 'us'=>'Zero product sales — when we cover a supplement, we\'re only reporting what the trials found'],
        ['them'=>'"10 Foods That Cure Cancer Doctors Don\'t Want You to Know About"', 'us'=>'Headlines that describe exactly what\'s inside the article, nothing more'],
        ['them'=>'False certainty dressed up as a miracle fix', 'us'=>'An honest "the evidence is mixed" when that\'s actually the case'],
      ] as $row)
      <div class="compare-row">
        <div class="compare-cell compare-cell-them">
          <i class="bi bi-x-circle"></i>
          <p>{{ $row['them'] }}</p>
        </div>
        <div class="compare-cell compare-cell-us">
          <i class="bi bi-check-circle-fill"></i>
          <p>{{ $row['us'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section-dark" style="padding-bottom:5.5rem;">
  <div class="container">
    <div class="newsletter-band">
      <h2>Start Exploring. Find What Matters to You.</h2>
      <p>Discover our library of clinician-reviewed guides on nutrition, natural remedies, fitness, sleep and heart health thoughtfully researched and always free.</p>
      <a href="{{ route('remedies.index') }}" class="btn-pill-primary btn-pill-primary--lg">
        Explore the library
      </a>
    </div>
  </div>
</section>

@endsection

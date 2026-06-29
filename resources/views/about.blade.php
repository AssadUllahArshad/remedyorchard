@extends('layouts.app')

@section('title', 'About Us | HealthyLife Remedy')
@section('meta_description', "Learn about HealthyLife Remedy's mission to provide evidence-based natural health information, and meet the doctors, dietitians, and certified experts behind our content.")
@section('og_title', 'About HealthyLife Remedy — Our Mission & Expert Team')
@section('og_description', "Meet the doctors, dietitians, and certified experts who write and review every article on HealthyLife Remedy.")

@section('content')

@php
    $contributors = $contributors ?? [
        (object)['initials' => 'SM', 'name' => 'Dr. Sarah Mitchell', 'role' => 'Cardiologist, MD', 'bio' => 'Board-certified cardiologist with 14 years of clinical practice. Leads our heart health and cardiovascular risk-reduction coverage. Trained at Johns Hopkins.'],
        (object)['initials' => 'ER', 'name' => 'Emma Rhodes, RD',    'role' => 'Registered Dietitian', 'bio' => 'Specialises in anti-inflammatory diets, gut health, and sustainable weight management. Works with both clinical and general populations.'],
        (object)['initials' => 'JO', 'name' => 'James Okafor, ND',   'role' => 'Naturopathic Doctor', 'bio' => 'Reviews our herbal remedy and adaptogen coverage against primary clinical literature. Strong background in evidence-based integrative medicine.'],
        (object)['initials' => 'PN', 'name' => 'Dr. Priya Nair',     'role' => 'Sleep Medicine Physician', 'bio' => 'Pulmonologist and sleep medicine specialist covering circadian biology, insomnia, and sleep-related cardiovascular risk.'],
        (object)['initials' => 'CM', 'name' => 'Carlos Mendez, CSCS','role' => 'Certified Strength & Conditioning Specialist', 'bio' => 'Fifteen years in applied sports science and performance coaching. Covers Zone 2 training, longevity fitness, and exercise physiology.'],
        (object)['initials' => 'MC', 'name' => 'Dr. Maya Chen',      'role' => 'Integrative Medicine Physician', 'bio' => 'MD with fellowship training in integrative medicine. Bridges conventional and evidence-based complementary approaches in our mental health and stress coverage.'],
    ];
@endphp

<!-- HERO -->
<section class="hero-v2"
  style="padding:6rem 0 4rem; background-image:url('https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=1600&q=85&auto=format&fit=crop');">
  <div class="container">
    <span class="eyebrow">Our story</span>
    <h1 class="hero-h1">Eight years of asking: does the evidence actually support this?</h1>
    <p class="hero-sub hero-sub--wide">HealthyLife Remedy exists because most health information online — even the well-meaning kind — isn't held to any standard. We built a publication that is.</p>
  </div>
</section>

<!-- MISSION -->
<section class="section-dark py-section">
  <div class="container">
    <div class="feature-row mb-5">
      <div class="feature-media img-ph img-ph-3"
           style="background-image:url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&q=80&auto=format&fit=crop')"></div>
      <div class="feature-text">
        <span class="eyebrow">How we started</span>
        <h3>A small newsletter that refused to lower its standards.</h3>
        <p class="lead-text">HealthyLife Remedy launched in 2018 as a fortnightly newsletter written by a registered dietitian who was tired of seeing unsupported health claims go viral — "detoxes" that no physician would endorse, herbal supplements marketed on testimonials instead of trials.</p>
        <p class="lead-text">The newsletter grew because readers noticed the difference: every claim came with a source, every recommendation came with caveats where appropriate, and nothing was published just because it sounded compelling.</p>
        <p class="lead-text" style="margin-bottom:0;">Today HealthyLife Remedy is a multi-author publication with physicians, registered dietitians, certified trainers, and naturopathic doctors — all of whom review content against peer-reviewed literature before anything reaches you.</p>
      </div>
    </div>
  </div>
</section>

<!-- EDITORIAL STANDARDS -->
<section class="section-pill py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Editorial process</span>
      <h2>What happens before an article goes live.</h2>
      <p class="section-subhead">
        Our review process is more rigorous than most health publications. Here's why that matters, and exactly what it involves.
      </p>
    </div>

    <div class="row g-4">
      @foreach([
        ['step'=>'01','icon'=>'bi-search','title'=>'Topic qualification',     'desc'=>'Every proposed topic is assessed for clinical relevance and reader benefit. We don\'t cover a subject just because it\'s trending — there has to be substantive evidence worth writing about.'],
        ['step'=>'02','icon'=>'bi-journal-bookmark-fill','title'=>'Primary source review','desc'=>'Writers work from peer-reviewed journals, clinical trial databases, and guidance from institutions such as NICE, the NIH, and the American Heart Association. Secondary sources are not accepted as evidence.'],
        ['step'=>'03','icon'=>'bi-person-check-fill','title'=>'Expert review',  'desc'=>'A qualified clinician — appropriate to the topic — reads the draft, checks claims against source material, and flags anything that overstates certainty or omits important nuance.'],
        ['step'=>'04','icon'=>'bi-arrow-repeat','title'=>'Ongoing updates',     'desc'=>'Health science evolves. Articles are flagged for review when new evidence emerges, and we revise them rather than letting outdated content quietly sit online.'],
      ] as $step)
      <div class="col-md-6 col-lg-3">
        <div class="value-pillar">
          <div class="pillar-icon"><i class="bi {{ $step['icon'] }}"></i></div>
          <span class="eyebrow" style="font-size:0.68rem; margin-bottom:0.5rem;">Step {{ $step['step'] }}</span>
          <h3>{{ $step['title'] }}</h3>
          <p>{{ $step['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- TEAM -->
<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">The team</span>
      <h2>Meet the clinicians behind the content.</h2>
      <p class="section-subhead">
        Every article on HealthyLife Remedy has a credentialed author or reviewer. These are the people responsible for the content you read.
      </p>
    </div>

    <div class="row g-4">
      @foreach($contributors as $person)
      <div class="col-md-6 col-lg-4">
        <div class="author-card-v2">
          <div class="author-avatar-lg">{{ $person->initials }}</div>
          <h3>{{ $person->name }}</h3>
          <span class="author-role">{{ $person->role }}</span>
          <p>{{ $person->bio }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- WHAT WE DON'T DO -->
<section class="section-pill py-section">
  <div class="container">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5">
        <span class="eyebrow">Our limits</span>
        <h2>What HealthyLife Remedy is not.</h2>
        <p class="section-lead-text">
          Being useful means being honest about what we are — and what we aren't. We're a health education publication, not a clinical service.
        </p>
      </div>
      <div class="col-lg-7">
        <div class="row g-3">
          @foreach([
            ['icon'=>'bi-x-circle-fill','title'=>'Not a medical practice',        'desc'=>'Our articles provide health education, not personalised medical advice. For diagnosis, treatment, or anything specific to your health, consult a qualified clinician.'],
            ['icon'=>'bi-x-circle-fill','title'=>'Not a supplement shop',          'desc'=>'We don\'t sell products. When we cover supplements or herbs, our only interest is in what the evidence says — not in recommending brands.'],
            ['icon'=>'bi-x-circle-fill','title'=>'Not a clickbait operation',      'desc'=>'We don\'t publish "10 foods that cure cancer" or "doctors hate this one trick." That type of content is exactly why we started writing.'],
            ['icon'=>'bi-x-circle-fill','title'=>'Not a miracle-cure publication', 'desc'=>'If the evidence for something is limited or mixed, we say so. Honest uncertainty is more useful to readers than false confidence.'],
          ] as $limit)
          <div class="col-sm-6">
            <div class="value-pillar">
              <div class="pillar-icon" style="background:rgba(200,50,50,0.08); color:#c83232; border-color:rgba(200,50,50,0.15);">
                <i class="bi {{ $limit['icon'] }}"></i>
              </div>
              <h3>{{ $limit['title'] }}</h3>
              <p>{{ $limit['desc'] }}</p>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="section-dark" style="padding-bottom:5.5rem;">
  <div class="container">
    <div class="newsletter-band">
      <h2>Start with one well-researched article.</h2>
      <p>Browse our full library of clinician-reviewed guides on nutrition, natural remedies, fitness, sleep, and heart health — all free, all the time.</p>
      <a href="{{ route('remedies.index') }}" class="btn-pill-primary btn-pill-primary--lg">
        Explore the library
      </a>
    </div>
  </div>
</section>

@endsection

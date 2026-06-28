@extends('layouts.app')

@section('title', 'About Us | HealthyLife Remedy')
@section('meta_description', "Learn about HealthyLife Remedy's mission to provide evidence-based natural health information, and meet the doctors, dietitians, and experts behind our content.")

@section('content')

{{-- NOTE: $contributors could come from a Team/Author model if you want this list dynamic. --}}
@php
    $contributors = $contributors ?? [
        (object)['initials' => 'SM', 'name' => 'Dr. Sarah Mitchell', 'bio' => 'Cardiologist, MD — covers heart health and cardiovascular risk reduction.'],
        (object)['initials' => 'ER', 'name' => 'Emma Rhodes, RD', 'bio' => 'Registered Dietitian — covers nutrition science and meal planning.'],
        (object)['initials' => 'JO', 'name' => 'James Okafor, ND', 'bio' => 'Naturopathic Doctor — covers herbal remedies and adaptogens.'],
    ];
@endphp

<section class="hero-v2" style="padding:5rem 0 3rem;">
  <div class="container">
    <span class="eyebrow">Our story</span>
    <h1 style="font-size:2.6rem;">About HealthyLife Remedy.</h1>
    <p class="hero-sub">We've spent eight years cutting through wellness noise to bring you natural health information that's actually grounded in research — not trends, not anecdotes, and not anyone's product line.</p>
  </div>
</section>

<section class="section-dark py-section" style="padding-top:2rem;">
  <div class="container">
    <div class="feature-row mb-5">
      <div class="feature-media img-ph img-ph-3"></div>
      <div class="feature-text">
        <h3>How we got here.</h3>
        <p class="lead-text">HealthyLife Remedy started in 2018 as a small newsletter written by a registered dietitian frustrated by how much health misinformation was circulating online — miracle cures, fad detoxes, and supplement claims with no science behind them.</p>
        <p class="lead-text">What began as a few hundred subscribers has grown into a publication read by hundreds of thousands of people each month, but our founding mission hasn't changed: take natural health and home remedies seriously enough to actually check the evidence before we publish anything.</p>
        <p class="lead-text" style="margin-bottom:0;">Today our team includes physicians, registered dietitians, certified trainers, and naturopathic doctors, all of whom review claims against peer-reviewed research before they ever reach you.</p>
      </div>
    </div>
  </div>
</section>

<section class="section-pill py-section">
  <div class="container">
    <div class="trust-badge-row justify-content-center mb-5">
      <span class="trust-badge"><i class="bi bi-shield-check"></i> Evidence-based</span>
      <span class="trust-badge"><i class="bi bi-mortarboard-fill"></i> Clinician-reviewed</span>
      <span class="trust-badge"><i class="bi bi-eye-slash-fill"></i> No hidden agendas</span>
      <span class="trust-badge"><i class="bi bi-heart-fill"></i> Reader-first since 2018</span>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="stat-block text-center">
          <span class="stat-num d-block" style="font-size:2.4rem;">Evidence-Based</span>
          <p>Every article is grounded in peer-reviewed research and reviewed by certified health professionals.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-block text-center">
          <span class="stat-num d-block" style="font-size:2.4rem;">Reader-First</span>
          <p>We prioritize your health over clickbait. Honest information, no miracle cures, no hidden agendas.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="stat-block text-center">
          <span class="stat-num d-block" style="font-size:2.4rem;">Expert Authors</span>
          <p>Our writers are doctors, registered dietitians, certified trainers, and accredited health coaches.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section-dark py-section">
  <div class="container">
    <div class="text-center mb-5">
      <span class="eyebrow d-flex justify-content-center">Who writes this</span>
      <h2 style="font-size:2.2rem; color:#fff;">Meet a few of our contributors.</h2>
    </div>
    <div class="row g-4">
      @foreach($contributors as $person)
      <div class="col-md-4">
        <div class="card-dark p-4 text-center">
          <span class="author-avatar-v2 mx-auto mb-3" style="width:64px;height:64px;font-size:1.3rem;">{{ $person->initials }}</span>
          <h3 style="font-size:1.05rem;">{{ $person->name }}</h3>
          <p class="excerpt" style="-webkit-line-clamp: unset;">{{ $person->bio }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection

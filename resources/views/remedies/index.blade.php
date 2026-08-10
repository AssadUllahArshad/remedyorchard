@extends('layouts.app')

@section('title', 'All Remedies & Articles | Healthy Habits Hub')
@section('meta_description', 'Browse our complete library of clinician-reviewed articles on nutrition, home remedies, mental health, fitness, sleep, and heart health.')
@section('og_title', 'All Remedies & Articles — Healthy Habits Hub')
@section('og_description', 'Browse our complete library of clinician-reviewed articles on nutrition, home remedies, mental health, fitness, sleep, and heart health.')

@section('content')

@php
    $imageAssets = [
        'nutrition'    => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
        'meal_planning' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
        'herbs'        => 'https://images.unsplash.com/photo-1508595165502-3e2652e5a405?w=800&q=80&auto=format&fit=crop',
        'fitness'      => 'https://images.unsplash.com/photo-1573063784589-65fdbd5b6a8f?w=800&q=80&auto=format&fit=crop',
        'sleep'        => 'https://images.unsplash.com/photo-1631558432963-2c7eb7fdc5e2?w=800&q=80&auto=format&fit=crop',
        'heart'        => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=800&q=80&auto=format&fit=crop',
        'mental-health'=> 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
    ];

    $categories = $categories ?? [
        (object)['name' => 'Nutrition',     'slug' => 'nutrition'],
        (object)['name' => 'Home Remedies', 'slug' => 'home-remedies'],
        (object)['name' => 'Mental Health', 'slug' => 'mental-health'],
        (object)['name' => 'Fitness',       'slug' => 'fitness'],
        (object)['name' => 'Sleep',         'slug' => 'sleep'],
        (object)['name' => 'Heart Health',  'slug' => 'heart-health'],
    ];

    $articles = $articles ?? [
        (object)['title' => '12 Home Remedies to Lower Blood Pressure Naturally',                 'slug' => 'blood-pressure-remedies', 'excerpt' => 'Science-backed natural approaches to blood pressure management — before or alongside medication.',          'thumb_class' => 'img-ph-1', 'thumbnail_url' => $imageAssets['heart'],         'read_time' => '8 min read',  'category' => (object)['name' => 'Heart Health'],  'author' => (object)['name' => 'Dr. Sarah Mitchell']],
        (object)['title' => 'The Anti-Inflammatory Diet: A 30-Day Reset Plan',                   'slug' => 'anti-inflammatory-diet',  'excerpt' => 'A week-by-week guide to identifying inflammatory trigger foods and building a sustainable replacement diet.', 'thumb_class' => 'img-ph-2', 'thumbnail_url' => $imageAssets['nutrition'],    'read_time' => '12 min read', 'category' => (object)['name' => 'Nutrition'],     'author' => (object)['name' => 'Emma Rhodes, RD']],
        (object)['title' => '7 Adaptogenic Herbs — What the Research Actually Shows',            'slug' => 'adaptogenic-herbs',       'excerpt' => 'Ashwagandha, rhodiola, holy basil: an honest look at the clinical evidence for each.',                   'thumb_class' => 'img-ph-3', 'thumbnail_url' => $imageAssets['herbs'],        'read_time' => '7 min read',  'category' => (object)['name' => 'Home Remedies'], 'author' => (object)['name' => 'James Okafor, ND']],
        (object)['title' => 'Sleep Hygiene After 40: Why It Changes and What Actually Helps',    'slug' => 'sleep-hygiene',           'excerpt' => 'Sleep architecture shifts significantly after 40. Understanding your circadian biology is the first step.',  'thumb_class' => 'img-ph-4', 'thumbnail_url' => $imageAssets['sleep'],        'read_time' => '9 min read',  'category' => (object)['name' => 'Sleep'],         'author' => (object)['name' => 'Dr. Priya Nair']],
        (object)['title' => 'Zone 2 Cardio: The Most Underrated Health Investment You Can Make', 'slug' => 'zone-2-cardio',           'excerpt' => 'Elite athletes do 80% of training at low intensity. Emerging research shows this approach benefits everyone.',  'thumb_class' => 'img-ph-5', 'thumbnail_url' => $imageAssets['fitness'],      'read_time' => '10 min read', 'category' => (object)['name' => 'Fitness'],       'author' => (object)['name' => 'Carlos Mendez, CSCS']],
        (object)['title' => 'Chronic vs Acute Stress: Why the Distinction Changes Everything',   'slug' => 'chronic-vs-acute-stress', 'excerpt' => 'Short-term stress can sharpen performance. Chronic stress quietly damages every major body system. Here\'s how to tell them apart.',     'thumb_class' => 'img-ph-1', 'thumbnail_url' => $imageAssets['mental-health'],'read_time' => '8 min read',  'category' => (object)['name' => 'Mental Health'], 'author' => (object)['name' => 'Dr. Maya Chen']],
    ];
@endphp

<!-- HERO -->
<section class="hero-v2"
  style="padding:5rem 0 3.5rem; background-image:url('{{ asset('images/remedies-hero.jpg') }}');">
  <div class="container">
    <span class="eyebrow">The full library</span>
    <h1 class="hero-h1">Clinician-Reviewed Health Guides</h1>
    <p class="hero-sub" style="max-width:640px;">
      Evidence-based, research-informed articles on nutrition, natural remedies, mental health, fitness, sleep and cardiovascular health — each guide carefully reviewed by a qualified clinician before publication, so you can find clear, trustworthy health information you can rely on.
    </p>
    <div class="d-flex flex-wrap gap-3 mt-3">
      <span class="trust-badge"><i class="bi bi-shield-check"></i> Peer-reviewed sources only</span>
      <span class="trust-badge"><i class="bi bi-mortarboard-fill"></i> Expert-reviewed</span>
      <span class="trust-badge"><i class="bi bi-lock-fill"></i> Always free to read</span>
    </div>
  </div>
</section>

<!-- ARTICLES GRID -->
<section class="section-dark py-section" style="padding-top:2.5rem;">
  <div class="container">

    {{-- Category filter pills --}}
    <div class="category-filters-v2 mb-5">
      <a href="{{ route('remedies.index') }}" class="pill-filter {{ empty($activeCategory) ? 'active' : '' }}">
        All topics
      </a>
      @foreach($categories as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}" class="pill-filter {{ ($activeCategory ?? '') === $cat->slug ? 'active' : '' }}">
        {{ $cat->name }}
      </a>
      @endforeach
    </div>

    {{-- Articles --}}
    <div class="row g-4">
      @forelse($articles as $article)
      <div class="col-md-6 col-lg-4">
        <a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none d-block h-100">
          <div class="card-dark h-100">
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
      @empty
      <div class="col-12 text-center py-5">
        <i class="bi bi-journal-text empty-state-icon"></i>
        <h3 class="empty-state-heading">No articles published yet</h3>
        <p class="section-lead-text" style="max-width:360px; margin:0 auto 1rem;">Check back soon — new guides are published regularly.</p>
        <a href="{{ route('home') }}" class="btn-pill-outline mt-2">Back to home</a>
      </div>
      @endforelse
    </div>

    {{-- Pagination --}}
    @if($articles instanceof \Illuminate\Pagination\LengthAwarePaginator && $articles->hasPages())
    <div class="mt-5 d-flex justify-content-center">
      {{ $articles->links() }}
    </div>
    @endif

  </div>
</section>

@endsection

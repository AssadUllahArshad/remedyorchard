@extends('layouts.app')

@section('title', 'All Remedies & Articles | HealthyLife Remedy')
@section('meta_description', 'Browse our full library of evidence-based articles on nutrition, home remedies, mental health, fitness, sleep, and heart health.')

@section('content')

{{--
    NOTE FOR BACKEND INTEGRATION:
    $articles    -> paginated Eloquent collection, e.g.:
                    Article::with(['category','author'])->published()->latest()->paginate(9)
                    Each item needs: title, slug, excerpt, thumb_class (or thumbnail_url),
                    read_time, category->name, category->slug, author->name
    $categories  -> Category::all() for the filter pills
    $activeCategory -> slug of currently selected filter, or null for "All"
--}}

@php
    $categories = $categories ?? [
        (object)['name' => 'Nutrition', 'slug' => 'nutrition'],
        (object)['name' => 'Home Remedies', 'slug' => 'home-remedies'],
        (object)['name' => 'Mental Health', 'slug' => 'mental-health'],
        (object)['name' => 'Fitness', 'slug' => 'fitness'],
        (object)['name' => 'Sleep', 'slug' => 'sleep'],
        (object)['name' => 'Heart Health', 'slug' => 'heart-health'],
    ];

    $articles = $articles ?? [
        (object)['title' => '12 Proven Home Remedies to Lower Blood Pressure Naturally', 'slug' => 'blood-pressure-remedies', 'excerpt' => 'Science-backed natural approaches that can make a meaningful difference, before or alongside medication.', 'thumb_class' => 'img-ph-1', 'read_time' => '8 min read', 'category' => (object)['name' => 'Heart Health'], 'author' => (object)['name' => 'Dr. Sarah Mitchell']],
        (object)['title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan', 'slug' => 'anti-inflammatory-diet', 'excerpt' => 'Chronic inflammation is the root cause of most modern diseases. This structured plan helps you eliminate trigger foods step by step.', 'thumb_class' => 'img-ph-2', 'read_time' => '12 min read', 'category' => (object)['name' => 'Nutrition'], 'author' => (object)['name' => 'Emma Rhodes, RD']],
        (object)['title' => '7 Adaptogenic Herbs That Actually Work for Stress Relief', 'slug' => 'adaptogenic-herbs', 'excerpt' => 'Ashwagandha, rhodiola, holy basil — the research on adaptogens has exploded in the past decade. Here\'s what holds up.', 'thumb_class' => 'img-ph-3', 'read_time' => '7 min read', 'category' => (object)['name' => 'Home Remedies'], 'author' => (object)['name' => 'James Okafor, ND']],
        (object)['title' => 'Sleep Hygiene for Adults Over 40: Why It Changes and What to Do', 'slug' => 'sleep-hygiene', 'excerpt' => 'Sleep architecture shifts significantly after 40. Understanding circadian biology helps you stop fighting your own body clock.', 'thumb_class' => 'img-ph-4', 'read_time' => '9 min read', 'category' => (object)['name' => 'Sleep'], 'author' => (object)['name' => 'Dr. Priya Nair']],
        (object)['title' => 'Zone 2 Cardio: The Most Underrated Health Investment You Can Make', 'slug' => 'zone-2-cardio', 'excerpt' => 'Elite athletes do 80% of their training at low intensity. Emerging research shows this approach delivers benefits for everyone.', 'thumb_class' => 'img-ph-5', 'read_time' => '10 min read', 'category' => (object)['name' => 'Fitness'], 'author' => (object)['name' => 'Carlos Mendez, CSCS']],
    ];
@endphp

<section class="hero-v2" style="padding:5rem 0 3rem;">
  <div class="container">
    <span class="eyebrow">The full library</span>
    <h1 style="font-size:2.6rem;">All remedies &amp; articles.</h1>
    <p class="hero-sub">340+ research-backed guides on nutrition, natural remedies, mental health, fitness, sleep, and heart health — every one reviewed by a clinician before it's published.</p>
  </div>
</section>

<section class="section-dark py-section" style="padding-top:2rem;">
  <div class="container">
    <div class="category-filters-v2 mb-5">
      <a href="{{ route('remedies.index') }}" class="pill-filter {{ empty($activeCategory) ? 'active' : '' }}">All</a>
      @foreach($categories as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}" class="pill-filter">{{ $cat->name }}</a>
      @endforeach
    </div>

    <div class="row g-4">
      @forelse($articles as $article)
      <div class="col-md-6 col-lg-4">
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
      @empty
      <div class="col-12">
        <div class="admin-empty-state" style="color: var(--text-on-dark-dim);">
          <i class="bi bi-journal-text" style="color: var(--emerald-line);"></i>
          <p>No articles published yet. Check back soon.</p>
        </div>
      </div>
      @endforelse

      <div class="col-md-6 col-lg-4">
        <div class="ad-ph-v2" style="height:100%; min-height:340px;">Advertisement</div>
      </div>
    </div>

    {{-- Pagination — uncomment once $articles is a real paginator
    <div class="mt-5 d-flex justify-content-center">
      {{ $articles->links() }}
    </div>
    --}}

    <div class="ad-ph-v2 ad-banner-v2 mt-5">Advertisement</div>
  </div>
</section>

@endsection

@extends('layouts.app')

@section('title', ($category->name ?? 'Category') . ' Articles | HealthyLife Remedy')
@section('meta_description', ($category->description ?? '') . ' Browse all HealthyLife Remedy articles in this category.')

@section('content')

{{--
    NOTE FOR BACKEND INTEGRATION:
    Route-model-bound via {category:slug} — controller should pass:
    $category   -> Category model (name, slug, icon, description)
    $articles   -> Article::where('category_id', $category->id)->published()->paginate(9)
    $categories -> Category::all() for the filter pill bar (to mark current one active)
--}}

@php
    $heroImages = [
        'nutrition'    => 'https://images.unsplash.com/photo-1490645935967-10de6ba17061?w=1200&q=80&auto=format&fit=crop',
        'home-remedies'=> 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=1200&q=80&auto=format&fit=crop',
        'mental-health'=> 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=1200&q=80&auto=format&fit=crop',
        'fitness'      => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=1200&q=80&auto=format&fit=crop',
        'sleep'        => 'https://images.unsplash.com/photo-1631558432963-2c7eb7fdc5e2?w=1200&q=80&auto=format&fit=crop',
        'heart-health' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=1200&q=80&auto=format&fit=crop',
    ];

    $category = $category ?? (object)[
        'name' => 'Nutrition',
        'slug' => 'nutrition',
        'icon' => 'bi-apple',
        'description' => 'Evidence-based articles on eating well, nutrient science, and sustainable dietary patterns — without the fad-diet hype.',
    ];

    $categories = $categories ?? [
        (object)['name' => 'Nutrition', 'slug' => 'nutrition'],
        (object)['name' => 'Home Remedies', 'slug' => 'home-remedies'],
        (object)['name' => 'Mental Health', 'slug' => 'mental-health'],
        (object)['name' => 'Fitness', 'slug' => 'fitness'],
        (object)['name' => 'Sleep', 'slug' => 'sleep'],
        (object)['name' => 'Heart Health', 'slug' => 'heart-health'],
    ];

    $articles = $articles ?? [
        (object)['title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan', 'slug' => 'anti-inflammatory-diet', 'excerpt' => 'Chronic inflammation is the root cause of most modern diseases. This structured plan helps you eliminate trigger foods step by step.', 'thumb_class' => 'img-ph-2', 'thumbnail_url' => $heroImages[$category->slug] ?? asset('images/nutrition.jpg'), 'read_time' => '12 min read', 'category' => (object)['name' => $category->name], 'author' => (object)['name' => 'Emma Rhodes, RD']],
    ];
@endphp

<section class="hero-v2" style="padding:5rem 0 3.5rem; background-image:url('{{ $heroImages[$category->slug] ?? $heroImages['nutrition'] }}');">
  <div class="container">
    <div class="d-flex align-items-center gap-3 mb-2">
      <span class="cat-icon cat-icon-hero">
        <i class="bi {{ $category->icon }}"></i>
      </span>
      <span class="eyebrow" style="margin-bottom:0;">Category</span>
    </div>
    <h1 class="hero-h1" style="margin-bottom:0.8rem;">{{ $category->name }}</h1>
    @if($category->description)
    <p class="hero-sub hero-sub--wide" style="margin-bottom:0;">{{ $category->description }}</p>
    @endif
  </div>
</section>

<section class="section-dark py-section" style="padding-top:2rem;">
  <div class="container">
    <div class="category-filters-v2 mb-5">
      <a href="{{ route('remedies.index') }}" class="pill-filter">All</a>
      @foreach($categories as $cat)
      <a href="{{ route('categories.show', $cat->slug) }}" class="pill-filter {{ $cat->slug === $category->slug ? 'active' : '' }}">{{ $cat->name }}</a>
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
      <div class="col-12 text-center py-5">
        <i class="bi bi-journal-text empty-state-icon"></i>
        <p class="section-lead-text" style="max-width:360px; margin:0 auto;">No articles in this category yet. Check back soon.</p>
      </div>
      @endforelse
    </div>

    <div class="ad-ph-v2 ad-banner-v2 mt-5">Advertisement</div>
  </div>
</section>

@endsection

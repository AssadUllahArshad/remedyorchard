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
        (object)['title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan', 'slug' => 'anti-inflammatory-diet', 'excerpt' => 'Chronic inflammation is the root cause of most modern diseases. This structured plan helps you eliminate trigger foods step by step.', 'thumb_class' => 'img-ph-2', 'read_time' => '12 min read', 'category' => (object)['name' => $category->name], 'author' => (object)['name' => 'Emma Rhodes, RD']],
    ];
@endphp

<section class="hero-v2" style="padding:5rem 0 3rem;">
  <div class="container d-flex align-items-center gap-3">
    <span class="cat-icon" style="width:60px;height:60px;font-size:1.5rem;"><i class="bi {{ $category->icon }}"></i></span>
    <div>
      <span class="eyebrow" style="margin-bottom:0.4rem;">Category</span>
      <h1 style="font-size:2.2rem; margin-bottom:0.4rem;">{{ $category->name }}</h1>
      <p class="hero-sub" style="margin-bottom:0;">{{ $category->description }}</p>
    </div>
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
            <div class="card-thumb img-ph {{ $article->thumb_class ?? 'img-ph-1' }}"></div>
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
          <p>No articles in this category yet. Check back soon.</p>
        </div>
      </div>
      @endforelse
    </div>

    <div class="ad-ph-v2 ad-banner-v2 mt-5">Advertisement</div>
  </div>
</section>

@endsection

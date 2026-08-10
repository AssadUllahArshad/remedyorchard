@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title) . ' | Healthy Habits Hub')
@section('meta_description', $article->meta_description ?? $article->excerpt ?? '')
@section('og_type', 'article')
@section('og_title', $article->meta_title ?? $article->title)
@section('og_description', $article->meta_description ?? $article->excerpt ?? '')
@section('og_image', $article->thumbnail_url ?? asset('logo/og-default.jpg'))

@if($article->thumbnail_url)
@section('preload_hints')
<link rel="preload" as="image" href="{{ $article->thumbnail_url }}">
<meta name="robots" content="index, follow">
@endsection
@endif

@push('scripts')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Article",
      "@id": "{{ route('articles.show', $article->slug) }}#article",
      "headline": {!! json_encode($article->title) !!},
      "description": {!! json_encode($article->excerpt ?? '') !!},
      "datePublished": "{{ optional($article->published_at)->toIso8601String() }}",
      "dateModified": "{{ $article->updated_at->toIso8601String() }}",
      "author": {
        "@type": "Person",
        "name": {!! json_encode($article->author->name ?? 'Healthy Habits Hub') !!}
      },
      "publisher": {
        "@id": "{{ config('seo.site_url') }}/#organization"
      },
      "image": {
        "@type": "ImageObject",
        "url": {!! json_encode($article->thumbnail_url ?? config('seo.og_image')) !!}
      },
      "url": "{{ route('articles.show', $article->slug) }}",
      "mainEntityOfPage": "{{ route('articles.show', $article->slug) }}"
      @if($article->read_time)
      ,"timeRequired": "{{ $article->read_time }}"
      @endif
      @if($article->category)
      ,"articleSection": {!! json_encode($article->category->name) !!}
      @endif
    },
    {
      "@type": "BreadcrumbList",
      "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "Home", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "Remedies", "item": "{{ url('/remedies') }}" },
        @if($article->category)
        { "@type": "ListItem", "position": 3, "name": {!! json_encode($article->category->name) !!}, "item": "{{ route('categories.show', $article->category->slug) }}" },
        { "@type": "ListItem", "position": 4, "name": {!! json_encode($article->title) !!}, "item": "{{ route('articles.show', $article->slug) }}" }
        @else
        { "@type": "ListItem", "position": 3, "name": {!! json_encode($article->title) !!}, "item": "{{ route('articles.show', $article->slug) }}" }
        @endif
      ]
    }
  ]
}
</script>
@endpush

@section('content')

{{--
    Route-model-bound via {article:slug}. Controller passes:
    $article  -> Article model with: title, slug, body (HTML — mews/purifier sanitises on save),
                 excerpt, thumbnail_url/thumb_class, read_time, published_at,
                 category (relation: name, slug), author (relation: name, role, initials)
    $related  -> Article::with(['category','author'])->published()->where('category_id', $article->category_id)
                          ->where('id','!=',$article->id)->inRandomOrder()->take(3)->get()
--}}

@php
    $imageAssets = [
        'nutrition'    => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
        'meal_planning' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=800&q=80&auto=format&fit=crop',
        'herbs'        => 'https://images.unsplash.com/photo-1508595165502-3e2652e5a405?w=800&q=80&auto=format&fit=crop',
        'fitness'      => 'https://images.unsplash.com/photo-1728209229705-b54381185d28?w=800&q=80&auto=format&fit=crop',
        'sleep'        => 'https://images.unsplash.com/photo-1631558432963-2c7eb7fdc5e2?w=800&q=80&auto=format&fit=crop',
        'heart'        => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?w=800&q=80&auto=format&fit=crop',
        'mental-health'=> 'https://images.unsplash.com/photo-1506126613408-eca07ce68773?w=800&q=80&auto=format&fit=crop',
    ];

    $article = $article ?? (object)[
        'title'        => 'The Anti-Inflammatory Diet: A 30-Day Reset Plan',
        'slug'         => 'anti-inflammatory-diet',
        'thumb_class'  => 'img-ph-2',
        'thumbnail_url'=> $imageAssets['nutrition'],
        'read_time'    => '12 min read',
        'published_at' => \Carbon\Carbon::parse('2026-06-20'),
        'category'     => (object)['name' => 'Nutrition', 'slug' => 'nutrition'],
        'author'       => (object)['name' => 'Emma Rhodes, RD', 'role' => 'Registered Dietitian', 'initials' => 'ER'],
        'body'         => '<p>Chronic inflammation is a key driver of many long-term health conditions, including heart disease, type 2 diabetes, and autoimmune disorders. An anti-inflammatory diet focuses on whole, minimally-processed foods that support the body\'s natural regulatory systems rather than triggering repeated immune responses.</p><h2>What Does "Anti-Inflammatory" Actually Mean?</h2><p>Foods don\'t directly cause or prevent inflammation — they influence the biochemical environment in which inflammation occurs. A diet rich in omega-3 fatty acids, polyphenols, fibre, and micronutrients provides the building blocks the body uses to regulate its inflammatory response. A diet high in refined carbohydrates, trans fats, and ultra-processed foods does the opposite.</p><h2>Week 1: Reduce the Obvious Triggers</h2><p>The first step is not adding foods but removing the main drivers. In week one, focus on cutting refined sugars, seed oils used in processed foods, and ultra-processed snacks. These three changes alone reduce the background inflammatory load enough that many people notice differences in energy and joint comfort within days.</p><h2>Week 2: Build the Foundation</h2><p>Replace what you removed with a simple structure: vegetables at most meals (especially leafy greens, cruciferous vegetables, and brightly coloured options), fatty fish 2–3 times per week, and extra virgin olive oil as your primary cooking fat. Add berries, walnuts, and green tea as daily habits if they fit your routine.</p>',
        'meta_title'   => null,
        'meta_description' => null,
        'excerpt'      => 'A week-by-week guide to reducing chronic inflammation through evidence-based dietary changes.',
    ];

    $related = $related ?? [
        (object)['title' => '12 Home Remedies to Lower Blood Pressure Naturally',    'slug' => 'blood-pressure-remedies', 'thumb_class' => 'img-ph-1', 'thumbnail_url' => $imageAssets['heart'],  'read_time' => '8 min read',  'category' => (object)['name' => 'Heart Health']],
        (object)['title' => '7 Adaptogenic Herbs — What the Research Actually Shows', 'slug' => 'adaptogenic-herbs',       'thumb_class' => 'img-ph-3', 'thumbnail_url' => $imageAssets['herbs'],  'read_time' => '7 min read',  'category' => (object)['name' => 'Home Remedies']],
        (object)['title' => 'Sleep Hygiene After 40: Why It Changes',               'slug' => 'sleep-hygiene',           'thumb_class' => 'img-ph-4', 'thumbnail_url' => $imageAssets['sleep'],  'read_time' => '9 min read',  'category' => (object)['name' => 'Sleep']],
    ];
@endphp

<main class="container py-5">

  {{-- Breadcrumb --}}
  <div class="breadcrumb-v2">
    <a href="{{ route('home') }}">Home</a>
    <span class="sep">/</span>
    <a href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
    <span class="sep">/</span>
    <span>{{ \Illuminate\Support\Str::limit($article->title, 60) }}</span>
  </div>

  <div class="row g-5">

    {{-- Main content --}}
    <div class="col-lg-8">
      <span class="tag-chip mb-3">{{ $article->category->name }}</span>

      <h1 class="mb-3" style="font-size:2.2rem; line-height:1.15;">{{ $article->title }}</h1>

      <div class="author-byline-v2">
        <span class="author-avatar-v2">{{ $article->author->initials }}</span>
        <div>
          <strong>{{ $article->author->name }}</strong>
          {{ $article->author->role ?? '' }}
          @if($article->author->role) &nbsp;&bull;&nbsp; @endif
          {{ $article->published_at->format('F j, Y') }}
          &nbsp;&bull;&nbsp; <i class="bi bi-clock"></i> {{ $article->read_time }}
        </div>
      </div>

      {{-- Hero image --}}
      <div class="article-hero-v2 img-ph {{ $article->thumb_class ?? 'img-ph-1' }}"
           @isset($article->thumbnail_url) style="background-image:url('{{ $article->thumbnail_url }}')" @endisset></div>

      {{-- Article body — sanitised by mews/purifier on save --}}
      <article class="article-body-v2" id="article-body">
        {!! $article->body !!}
      </article>

      {{-- In-content ad (after body) --}}
      @include('partials.ad-slot', ['slot' => config('seo.adsense_slot_article'), 'format' => 'auto'])

      {{-- Footer row --}}
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4 pt-4"
           style="border-top:1px solid var(--emerald-line);">
        <div class="trust-badge-row" style="gap:1rem;">
          <span class="trust-badge"><i class="bi bi-shield-check"></i> Clinician-reviewed</span>
          <span class="trust-badge"><i class="bi bi-journals"></i> Peer-reviewed sources</span>
        </div>
        <div class="d-flex gap-2" title="Share this article">
          <span class="share-label">Share:</span>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
             target="_blank" rel="noopener" class="social-icon-v2" aria-label="Share on Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}"
             target="_blank" rel="noopener" class="social-icon-v2" aria-label="Share on X (Twitter)">
            <i class="bi bi-twitter-x"></i>
          </a>
          <a href="mailto:?subject={{ rawurlencode($article->title) }}&body={{ urlencode(url()->current()) }}"
             class="social-icon-v2" aria-label="Share by email">
            <i class="bi bi-envelope"></i>
          </a>
        </div>
      </div>

      {{-- Medical disclaimer callout --}}
      <div class="callout-box-v2 mt-4">
        <h4><i class="bi bi-info-circle me-1"></i> Medical Disclaimer</h4>
        <p>This article is for informational purposes only and does not constitute medical advice. Consult a qualified healthcare provider before making changes to your health routine, especially if you have an existing medical condition or take medications.</p>
      </div>
    </div>

    {{-- Sidebar --}}
    <aside class="col-lg-4">

      {{-- Related articles --}}
      <div class="widget-dark mb-4">
        <h3>Related Articles</h3>
        @foreach($related as $rel)
        <a href="{{ route('articles.show', $rel->slug) }}" class="text-decoration-none">
          <div class="trending-item-v2">
            <div class="trending-thumb-v2 img-ph {{ $rel->thumb_class ?? 'img-ph-1' }}"
                 @isset($rel->thumbnail_url) style="background-image:url('{{ $rel->thumbnail_url }}')" @endisset></div>
            <div>
              <span class="tag-chip tag-chip-xs">{{ $rel->category->name }}</span>
              <h4>{{ $rel->title }}</h4>
              <span class="trending-date"><i class="bi bi-clock me-1"></i>{{ $rel->read_time }}</span>
            </div>
          </div>
        </a>
        @endforeach
      </div>

      {{-- Newsletter sidebar --}}
      <div class="sidebar-newsletter mb-4">
        <h3><i class="bi bi-envelope me-1"></i> Weekly Health Insights</h3>
        <p>One research-backed tip delivered every Tuesday — free.</p>
        <form method="POST" action="{{ route('newsletter.subscribe') }}">
          @csrf
          <input type="hidden" name="source" value="article-sidebar">
          <input type="email" name="email" placeholder="your@email.com" required autocomplete="email">
          <button type="submit">Subscribe Free</button>
        </form>
      </div>

      {{-- Sidebar ad --}}
      @include('partials.ad-slot', ['slot' => config('seo.adsense_slot_sidebar'), 'format' => 'auto'])

      {{-- Editorial standards --}}
      <div class="widget-dark">
        <h3>Our editorial standard</h3>
        <div class="trending-item-v2" style="border:none; padding-top:0;">
          <div>
            <p class="widget-body-text">Every article on Healthy Habits Hub is written by a credentialed author and reviewed by an appropriate clinician before publication. We cite peer-reviewed research — not other health blogs.</p>
            <a href="{{ route('about') }}" class="widget-link-cta">
              Meet the review team <i class="bi bi-arrow-right ms-1"></i>
            </a>
          </div>
        </div>
      </div>

    </aside>
  </div>
</main>

@endsection

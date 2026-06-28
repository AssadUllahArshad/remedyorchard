@extends('layouts.app')

@section('title', ($article->meta_title ?? $article->title) . ' | HealthyLife Remedy')
@section('meta_description', $article->meta_description ?? $article->excerpt ?? '')

@section('content')

{{--
    NOTE FOR BACKEND INTEGRATION:
    Route-model-bound via {article:slug}. Controller should pass:
    $article  -> Article model with: title, slug, body (HTML from Quill — sanitize before saving!),
                 excerpt, thumbnail_url/thumb_class, read_time, published_at, category (relation),
                 author (relation: name, role, initials or avatar_url)
    $related  -> Article::where('category_id', $article->category_id)->where('id','!=',$article->id)->take(2)->get()

    IMPORTANT: $article->body is rendered with {!! !!} (raw, unescaped) because it contains HTML
    from the rich text editor. Sanitize it server-side (e.g. with a HTML Purifier package) before
    storing or rendering to avoid XSS — never trust raw editor output as-is in production.
--}}

@php
    $article = $article ?? (object)[
        'title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan',
        'slug' => 'anti-inflammatory-diet',
        'thumb_class' => 'img-ph-2',
        'read_time' => '12 min read',
        'published_at' => \Carbon\Carbon::parse('2026-06-20'),
        'category' => (object)['name' => 'Nutrition', 'slug' => 'nutrition'],
        'author' => (object)['name' => 'Emma Rhodes, RD', 'role' => 'Registered Dietitian', 'initials' => 'ER'],
        'body' => '<p>Chronic inflammation is the root cause of most modern diseases. This is example fallback content — replace $article with a real Eloquent model.</p>',
    ];

    $related = $related ?? [
        (object)['title' => '7 Adaptogenic Herbs That Actually Work for Stress Relief', 'slug' => 'adaptogenic-herbs', 'thumb_class' => 'img-ph-3', 'read_time' => '7 min read', 'category' => (object)['name' => 'Home Remedies']],
        (object)['title' => '12 Proven Home Remedies to Lower Blood Pressure', 'slug' => 'blood-pressure-remedies', 'thumb_class' => 'img-ph-1', 'read_time' => '8 min read', 'category' => (object)['name' => 'Heart Health']],
    ];
@endphp

<main class="container py-5">
  <div class="breadcrumb-v2">
    <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
    <a href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a><span class="sep">/</span>
    <span>{{ $article->title }}</span>
  </div>

  <div class="row">
    <div class="col-lg-8">
      <span class="tag-chip">{{ $article->category->name }}</span>
      <h1 class="mb-3" style="font-size:2.3rem; color:#fff;">{{ $article->title }}</h1>

      <div class="author-byline-v2">
        <span class="author-avatar-v2">{{ $article->author->initials }}</span>
        <div>
          <strong>{{ $article->author->name }}</strong>
          {{ $article->author->role }} &nbsp;•&nbsp; {{ $article->published_at->format('F j, Y') }} &nbsp;•&nbsp; <i class="bi bi-clock"></i> {{ $article->read_time }}
        </div>
      </div>

      <div class="article-hero-v2 img-ph {{ $article->thumb_class ?? 'img-ph-1' }}"
           @isset($article->thumbnail_url) style="background-image:url('{{ $article->thumbnail_url }}')" @endisset></div>

      {{-- Rich text body from the admin WYSIWYG editor. Sanitize server-side before storing. --}}
      <article class="article-body-v2">
        {!! $article->body !!}
      </article>

      {{-- Share / tags row --}}
      <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mt-4 pt-4" style="border-top:1px solid var(--emerald-line);">
        <div class="trust-badge-row" style="gap:1rem;">
          <span class="trust-badge"><i class="bi bi-shield-check"></i> Clinician-reviewed</span>
        </div>
        <div class="d-flex gap-2">
          <a href="#" class="social-icon-v2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="social-icon-v2"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="social-icon-v2"><i class="bi bi-envelope"></i></a>
        </div>
      </div>
    </div>

    <aside class="col-lg-4">
      <div class="widget-dark">
        <h3>Related Articles</h3>
        @foreach($related as $rel)
        <a href="{{ route('articles.show', $rel->slug) }}" class="text-decoration-none">
        <div class="trending-item-v2">
          <div class="trending-thumb-v2 img-ph {{ $rel->thumb_class ?? 'img-ph-1' }}"></div>
          <div>
            <span class="tag-chip" style="margin-bottom:0.4rem;">{{ $rel->category->name }}</span>
            <h4>{{ $rel->title }}</h4>
            <span class="trending-date">{{ $rel->read_time }}</span>
          </div>
        </div>
        </a>
        @endforeach
      </div>

      <div class="newsletter-band" style="padding:2rem 1.6rem;">
        <h2 style="font-size:1.3rem;">Weekly Health Insights</h2>
        <p style="font-size:0.9rem;">Join 42,000+ readers getting research-backed tips every Tuesday.</p>
        <form class="newsletter-band-form" style="max-width:100%;" method="POST" action="{{ route('newsletter.subscribe') }}">
          @csrf
          <input type="email" name="email" placeholder="your@email.com" required style="flex:1 1 100%;">
          <button type="submit" style="flex:1 1 100%;">Subscribe Free</button>
        </form>
      </div>

      <div class="ad-ph-v2" style="height:500px;">Advertisement</div>
    </aside>
  </div>
</main>

@endsection

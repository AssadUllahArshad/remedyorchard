<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<?php
/**
 * XML Sitemap — HealthyLife Remedy
 *
 * Namespaces used:
 *   sitemaps.org/schemas/sitemap/0.9  — standard sitemap
 *   google.com/schemas/sitemap-image  — image sitemap extension
 *
 * Priority guide:
 *   1.0  Homepage
 *   0.9  Article library index
 *   0.8  Category hub pages
 *   0.7  Individual articles (fresh < 30 days)
 *   0.6  Individual articles (older)
 *   0.5  Secondary static pages (About, Contact, Advertise)
 *
 * Excluded deliberately (noindex pages):
 *   /privacy-policy, /terms-of-use, /cookie-policy, /medical-disclaimer
 *   /login, /admin/*, /api/*
 */
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

  {{-- ═══════════════════════════════════════════════════════════
       STATIC PAGES
  ═══════════════════════════════════════════════════════════ --}}

  {{-- Homepage — highest priority, refreshes whenever a new article is published --}}
  <url>
    <loc>{{ url('/') }}</loc>
    <lastmod>{{ $sitemapLastmod->toAtomString() }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>

  {{-- Article library — changes every time an article is added --}}
  <url>
    <loc>{{ url('/remedies') }}</loc>
    <lastmod>{{ $sitemapLastmod->toAtomString() }}</lastmod>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>

  {{-- About — evergreen, low change rate --}}
  <url>
    <loc>{{ url('/about') }}</loc>
    <lastmod>2024-01-01T00:00:00+00:00</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>

  {{-- Contact --}}
  <url>
    <loc>{{ url('/contact') }}</loc>
    <lastmod>2024-01-01T00:00:00+00:00</lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.5</priority>
  </url>

  {{-- Advertise --}}
  <url>
    <loc>{{ url('/advertise') }}</loc>
    <lastmod>2024-01-01T00:00:00+00:00</lastmod>
    <changefreq>yearly</changefreq>
    <priority>0.4</priority>
  </url>

  {{-- ═══════════════════════════════════════════════════════════
       CATEGORY HUB PAGES
       Only include categories that have at least one article.
  ═══════════════════════════════════════════════════════════ --}}

  @foreach($categories as $category)
  @if($category->articles_count > 0)
  <url>
    <loc>{{ route('categories.show', $category->slug) }}</loc>
    <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  @endif
  @endforeach

  {{-- ═══════════════════════════════════════════════════════════
       ARTICLE PAGES
       Priority 0.7 for articles published in the last 30 days,
       0.6 for older articles.
       changefreq is 'weekly' while fresh, 'monthly' thereafter.
       Image sitemap entries included for all articles with a
       featured thumbnail.
  ═══════════════════════════════════════════════════════════ --}}

  @foreach($articles as $article)
  @php
      $isFresh    = $article->published_at->diffInDays(now()) <= 30;
      $priority   = $isFresh ? '0.7' : '0.6';
      $changefreq = $isFresh ? 'weekly' : 'monthly';
  @endphp
  <url>
    <loc>{{ route('articles.show', $article->slug) }}</loc>
    <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
    <changefreq>{{ $changefreq }}</changefreq>
    <priority>{{ $priority }}</priority>
    @if($article->thumbnail_url)
    <image:image>
      <image:loc>{{ $article->thumbnail_url }}</image:loc>
      <image:title>{{ e($article->title) }}</image:title>
      @if($article->excerpt)
      <image:caption>{{ e(\Illuminate\Support\Str::limit(strip_tags($article->excerpt), 200)) }}</image:caption>
      @endif
    </image:image>
    @endif
  </url>
  @endforeach

</urlset>

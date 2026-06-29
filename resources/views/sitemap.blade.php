<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">

  {{-- Static pages --}}
  <url>
    <loc>{{ url('/') }}</loc>
    <changefreq>daily</changefreq>
    <priority>1.0</priority>
  </url>
  <url>
    <loc>{{ url('/remedies') }}</loc>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <url>
    <loc>{{ url('/about') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
  </url>
  <url>
    <loc>{{ url('/contact') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.6</priority>
  </url>
  <url>
    <loc>{{ url('/advertise') }}</loc>
    <changefreq>monthly</changefreq>
    <priority>0.5</priority>
  </url>

  {{-- Category pages --}}
  @foreach($categories as $category)
  <url>
    <loc>{{ route('categories.show', $category->slug) }}</loc>
    <lastmod>{{ $category->updated_at->toAtomString() }}</lastmod>
    <changefreq>weekly</changefreq>
    <priority>0.8</priority>
  </url>
  @endforeach

  {{-- Article pages (with image sitemap entries) --}}
  @foreach($articles as $article)
  <url>
    <loc>{{ route('articles.show', $article->slug) }}</loc>
    <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
    <changefreq>monthly</changefreq>
    <priority>0.7</priority>
    @if($article->thumbnail_url)
    <image:image>
      <image:loc>{{ $article->thumbnail_url }}</image:loc>
    </image:image>
    @endif
  </url>
  @endforeach

</urlset>

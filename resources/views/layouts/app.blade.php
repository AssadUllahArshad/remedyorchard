<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', config('seo.site_name') . ' — ' . config('seo.tagline'))</title>
<meta name="description" content="@yield('meta_description', config('seo.description'))">
<link rel="canonical" href="{{ url()->current() }}">
<link rel="icon" type="image/svg+xml" href="{{ asset('logo/icon-mark.svg') }}">
<meta name="robots" content="@yield('robots', 'index, follow')">
<link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">

{{-- Search Console verification --}}
@if(config('seo.google_verification'))
<meta name="google-site-verification" content="{{ config('seo.google_verification') }}">
@endif
@if(config('seo.bing_verification'))
<meta name="msvalidate.01" content="{{ config('seo.bing_verification') }}">
@endif

{{-- Open Graph --}}
<meta property="og:site_name" content="{{ config('seo.site_name') }}">
<meta property="og:type" content="@yield('og_type', 'website')">
<meta property="og:title" content="@yield('og_title', config('seo.site_name') . ' — ' . config('seo.tagline'))">
<meta property="og:description" content="@yield('og_description', config('seo.description'))">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="@yield('og_image', config('seo.og_image'))">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:locale" content="en_US">

{{-- Twitter / X Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{ config('seo.twitter_handle') }}">
<meta name="twitter:title" content="@yield('og_title', config('seo.site_name'))">
<meta name="twitter:description" content="@yield('og_description', config('seo.description'))">
<meta name="twitter:image" content="@yield('og_image', config('seo.og_image'))">

{{-- Google AdSense (only loads when ADSENSE_CLIENT_ID is set in .env) --}}
@if(config('seo.adsense_client'))
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client={{ config('seo.adsense_client') }}" crossorigin="anonymous"></script>
@endif

{{-- DNS prefetch + preconnect for all external origins --}}
<link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

{{-- Critical CSS --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">

{{-- Bootstrap Icons: load async — not needed for above-fold paint --}}
<link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
<noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"></noscript>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@yield('preload_hints')

{{-- Apply saved theme before paint to avoid flash --}}
<script>
  (function(){
    var t = localStorage.getItem('hlr-theme') || 'light';
    document.documentElement.setAttribute('data-theme', t);
  })();
</script>

@stack('styles')
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  function toggleTheme() {
    var html = document.documentElement;
    var next = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', next);
    localStorage.setItem('hlr-theme', next);
  }
  document.querySelectorAll('[data-toggle-theme]').forEach(function(btn) {
    btn.addEventListener('click', toggleTheme);
  });
  var mobileMenu = document.getElementById('mobileMenu');
  document.querySelectorAll('[data-toggle-menu]').forEach(function(btn) {
    btn.addEventListener('click', function() {
      if (mobileMenu) mobileMenu.classList.toggle('open');
    });
  });
</script>

{{-- Site-wide structured data --}}
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@graph": [
    {
      "@type": "Organization",
      "@id": "{{ config('seo.site_url') }}/#organization",
      "name": {{ Js::from(config('seo.site_name')) }},
      "url": "{{ config('seo.site_url') }}",
      "logo": {
        "@type": "ImageObject",
        "url": "{{ asset('logo/icon-mark.svg') }}"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "email": "{{ config('seo.contact_email') }}",
        "contactType": "customer support"
      }
      @if(config('seo.facebook_url') || config('seo.instagram_url') || config('seo.twitter_handle'))
      ,"sameAs": [
        @php $sameAs = array_filter([config('seo.facebook_url'), config('seo.instagram_url')]); @endphp
        {{ implode(',', array_map(fn($u) => '"'.$u.'"', $sameAs)) }}
      ]
      @endif
    },
    {
      "@type": "WebSite",
      "@id": "{{ config('seo.site_url') }}/#website",
      "url": "{{ config('seo.site_url') }}",
      "name": {{ Js::from(config('seo.site_name')) }},
      "description": {{ Js::from(config('seo.description')) }},
      "publisher": { "@id": "{{ config('seo.site_url') }}/#organization" },
      "potentialAction": {
        "@type": "SearchAction",
        "target": {
          "@type": "EntryPoint",
          "urlTemplate": "{{ url('/remedies') }}?search={search_term_string}"
        },
        "query-input": "required name=search_term_string"
      }
    }
  ]
}
</script>

@stack('scripts')
</body>
</html>

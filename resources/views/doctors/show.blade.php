@extends('layouts.app')

@section('title', $doctor->name . ' | Healthy Habits Hub')
@section('meta_description', \Illuminate\Support\Str::limit($doctor->bio ?: ($doctor->name . ' writes and reviews evidence-based health articles for Healthy Habits Hub.'), 155))
@section('og_title', $doctor->name . ' | Healthy Habits Hub')
@section('og_description', \Illuminate\Support\Str::limit($doctor->bio ?: 'Medical expert at Healthy Habits Hub.', 155))
@if($doctor->avatar_url)
@section('og_image', $doctor->avatar_url)
@endif

@push('scripts')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Person",
  "@id": "{{ route('doctors.show', $doctor->slug ?: $doctor->id) }}#person",
  "name": {!! json_encode($doctor->name, JSON_HEX_TAG | JSON_UNESCAPED_UNICODE) !!},
  "url": "{{ route('doctors.show', $doctor->slug ?: $doctor->id) }}"@if($doctor->avatar_url),
  "image": {!! json_encode($doctor->avatar_url, JSON_HEX_TAG) !!}@endif
}
</script>
@endpush

@section('content')
<section class="section-dark" style="padding:3.5rem 0;">
  <div class="container" style="max-width:980px;">
    <div class="breadcrumb-v2 mb-4">
      <a href="{{ route('home') }}">Home</a><span class="sep">/</span>
      <a href="{{ route('doctors.index') }}">Our Doctors</a><span class="sep">/</span>
      <span>{{ $doctor->name }}</span>
    </div>

    <div class="card-dark mb-4" style="padding:2.25rem;">
      <div class="d-flex flex-wrap align-items-center gap-4">
        @if($doctor->avatar_url)
          <img src="{{ $doctor->avatar_url }}" alt="{{ $doctor->name }}" width="128" height="128" fetchpriority="high" decoding="async" style="width:128px;height:128px;border-radius:50%;object-fit:cover;border:4px solid var(--emerald-bright);flex-shrink:0;">
        @else
          <div style="width:128px;height:128px;border-radius:50%;background:var(--emerald-pill);color:var(--emerald-bright);display:flex;align-items:center;justify-content:center;font-weight:800;font-size:2.2rem;border:4px solid var(--emerald-bright);flex-shrink:0;">{{ $doctor->initials }}</div>
        @endif
        <div style="flex:1;min-width:240px;">
          <h1 style="font-size:1.9rem;font-weight:800;margin-bottom:.3rem;">{{ $doctor->name }}</h1>
          @if($doctor->role)<div style="font-size:1rem;color:var(--emerald-bright);font-weight:700;margin-bottom:.35rem;">{{ $doctor->role }}</div>@endif
          <div class="d-flex flex-wrap gap-3" style="font-size:.87rem;color:var(--text-on-dark-dim);">
            @if($doctor->specialty)<span><i class="bi bi-heart-pulse me-1" style="color:var(--emerald-bright);"></i>{{ $doctor->specialty }}</span>@endif
            @if($doctor->qualifications)<span><i class="bi bi-mortarboard me-1" style="color:var(--emerald-bright);"></i>{{ $doctor->qualifications }}</span>@endif
            @if($doctor->experience_years)<span><i class="bi bi-award me-1" style="color:var(--emerald-bright);"></i>{{ $doctor->experience_years }}+ years experience</span>@endif
          </div>
        </div>
      </div>
      @if($doctor->bio)<p style="margin:1.5rem 0 0;font-size:.95rem;line-height:1.75;color:var(--text-on-dark-dim);">{{ $doctor->bio }}</p>@endif
      @php($educationLines = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', (string) $doctor->education)))))
      @if(count($educationLines))
        <div style="margin-top:1.5rem;padding-top:1.25rem;border-top:1px solid var(--emerald-line);">
          <div style="font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--text-on-dark-faint);margin-bottom:.6rem;">Education &amp; Credentials</div>
          <ul style="margin:0;padding-left:1.2rem;font-size:.9rem;color:var(--text-on-dark-dim);line-height:1.9;">@foreach($educationLines as $line)<li>{{ $line }}</li>@endforeach</ul>
        </div>
      @endif
    </div>

    <h2 style="font-size:1.35rem;font-weight:800;margin:2.25rem 0 1.25rem;">Articles by {{ $doctor->name }} <span style="color:var(--text-on-dark-faint);font-weight:600;font-size:1rem;">({{ $articles->count() }})</span></h2>
    <div class="row g-4">
      @forelse($articles as $article)
        <div class="col-md-6"><a href="{{ route('articles.show', $article->slug) }}" class="text-decoration-none d-block h-100"><div class="card-dark h-100"><div class="card-thumb img-ph {{ $article->thumb_class ?? 'img-ph-1' }}" @if($article->thumbnail_url) style="background-image:url('{{ $article->thumbnail_url }}')" @endif></div><div class="card-body"><div class="d-flex flex-wrap gap-1 mb-2">@foreach($article->categories->isNotEmpty() ? $article->categories : collect([$article->category]) as $category) @if($category)<span class="tag-chip">{{ $category->name }}</span>@endif @endforeach</div><h3>{{ $article->title }}</h3><p class="excerpt">{{ $article->excerpt }}</p><div class="card-meta"><span>{{ $article->read_time }}</span></div></div></div></a></div>
      @empty
        <div class="col-12"><p style="color:var(--text-on-dark-dim);">No published articles yet.</p></div>
      @endforelse
    </div>
  </div>
</section>
@endsection

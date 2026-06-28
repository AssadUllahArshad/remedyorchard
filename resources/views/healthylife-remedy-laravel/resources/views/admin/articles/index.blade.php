@extends('admin.layouts.admin')

@section('title', 'Articles')
@section('page-title', 'Articles')
@section('page-subtitle', 'Manage every post in your content library.')

@section('content')

{{--
    NOTE FOR BACKEND INTEGRATION:
    $articles -> paginated Article collection: Article::with('category')->latest()->paginate(10)
    $counts   -> ['all' => n, 'published' => n, 'draft' => n, 'scheduled' => n]
--}}

@php
    $counts = $counts ?? ['all' => 6, 'published' => 5, 'draft' => 1, 'scheduled' => 0];

    $articles = $articles ?? [
        (object)['id'=>1,'title' => '12 Proven Home Remedies to Lower Blood Pressure', 'category' => (object)['name'=>'Heart Health'], 'author' => (object)['name'=>'Dr. Sarah Mitchell'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-22'), 'thumb_class' => 'img-ph-1', 'views' => 18420],
        (object)['id'=>2,'title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan', 'category' => (object)['name'=>'Nutrition'], 'author' => (object)['name'=>'Emma Rhodes, RD'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-20'), 'thumb_class' => 'img-ph-2', 'views' => 22110],
        (object)['id'=>3,'title' => '7 Adaptogenic Herbs That Actually Work for Stress Relief', 'category' => (object)['name'=>'Home Remedies'], 'author' => (object)['name'=>'James Okafor, ND'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-18'), 'thumb_class' => 'img-ph-3', 'views' => 15870],
        (object)['id'=>4,'title' => 'Sleep Hygiene for Adults Over 40', 'category' => (object)['name'=>'Sleep'], 'author' => (object)['name'=>'Dr. Priya Nair'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-15'), 'thumb_class' => 'img-ph-4', 'views' => 11320],
        (object)['id'=>5,'title' => 'Zone 2 Cardio: The Most Underrated Health Investment', 'category' => (object)['name'=>'Fitness'], 'author' => (object)['name'=>'Carlos Mendez, CSCS'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-12'), 'thumb_class' => 'img-ph-5', 'views' => 9650],
        (object)['id'=>6,'title' => 'Magnesium for Sleep: What the Research Says', 'category' => (object)['name'=>'Sleep'], 'author' => (object)['name'=>'Dr. Priya Nair'], 'status' => 'draft', 'published_at' => null, 'thumb_class' => 'img-ph-1', 'views' => 0],
    ];
@endphp

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
  <div class="d-flex gap-2 flex-wrap">
    <a href="#" class="admin-filter-pill active">All <span class="ms-1">{{ $counts['all'] }}</span></a>
    <a href="#" class="admin-filter-pill">Published <span class="ms-1">{{ $counts['published'] }}</span></a>
    <a href="#" class="admin-filter-pill">Drafts <span class="ms-1">{{ $counts['draft'] }}</span></a>
    <a href="#" class="admin-filter-pill">Scheduled <span class="ms-1">{{ $counts['scheduled'] }}</span></a>
  </div>
  <a href="{{ route('admin.articles.create') }}" class="btn-admin-primary"><i class="bi bi-plus-lg"></i> New Article</a>
</div>

<div class="admin-card mb-4 d-flex flex-wrap gap-3 align-items-center">
  <input type="search" class="admin-input" placeholder="Search articles by title..." style="max-width:280px;">
  <select class="admin-select" style="max-width:200px;">
    <option>All Categories</option>
    <option>Nutrition</option>
    <option>Home Remedies</option>
    <option>Mental Health</option>
    <option>Fitness</option>
    <option>Sleep</option>
    <option>Heart Health</option>
  </select>
  <select class="admin-select" style="max-width:180px;">
    <option>Sort: Newest</option>
    <option>Sort: Oldest</option>
    <option>Sort: Most Viewed</option>
    <option>Sort: Title A-Z</option>
  </select>
</div>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th><input type="checkbox"></th>
        <th>Title</th>
        <th>Category</th>
        <th>Author</th>
        <th>Status</th>
        <th>Views</th>
        <th>Date</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($articles as $article)
      <tr>
        <td><input type="checkbox"></td>
        <td>
          <div class="d-flex align-items-center gap-3">
            <div class="table-thumb img-ph {{ $article->thumb_class }}"></div>
            <div>
              <div class="table-row-title">{{ $article->title }}</div>
              <div class="table-row-sub">/remedies/{{ \Illuminate\Support\Str::slug($article->title) }}</div>
            </div>
          </div>
        </td>
        <td>{{ $article->category->name }}</td>
        <td>{{ $article->author->name }}</td>
        <td><span class="status-badge {{ $article->status }}">{{ ucfirst($article->status) }}</span></td>
        <td>{{ $article->views > 0 ? number_format($article->views) : '—' }}</td>
        <td>{{ $article->published_at ? $article->published_at->format('M j, Y') : 'Not published' }}</td>
        <td>
          <div class="d-flex gap-2">
            <a href="{{ route('articles.show', \Illuminate\Support\Str::slug($article->title)) }}" target="_blank" class="row-action-btn" title="View live"><i class="bi bi-box-arrow-up-right"></i></a>
            <a href="{{ route('admin.articles.edit', $article->id) }}" class="row-action-btn" title="Edit"><i class="bi bi-pencil"></i></a>
            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Delete this article? This cannot be undone.');" style="display:inline;">
              @csrf @method('DELETE')
              <button type="submit" class="row-action-btn danger" title="Delete"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="8">
        <div class="admin-empty-state">
          <i class="bi bi-journal-x"></i>
          <p>No articles yet. <a href="{{ route('admin.articles.create') }}" style="color:var(--emerald-brand); font-weight:700;">Create your first one</a>.</p>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="admin-pagination">
    <span>Showing {{ count($articles) }} of {{ $counts['all'] }} articles</span>
    <div class="page-btns">
      <span class="page-btn active">1</span>
      {{-- Replace with {{ $articles->links() }} once $articles is a real paginator --}}
    </div>
  </div>
</div>

@endsection

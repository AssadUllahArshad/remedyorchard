@extends('admin.layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', "Here's what's happening with your site today.")

@section('content')

{{--
    NOTE FOR BACKEND INTEGRATION:
    $stats          -> assoc array: total_articles, published_articles, draft_articles,
                        total_subscribers, subscriber_growth_pct, total_messages, unread_messages,
                        total_views (if you track analytics)
    $recentArticles -> Article::latest()->take(5)->get()
    $recentMessages -> ContactMessage::latest()->take(4)->get()
--}}

@php
    $stats = $stats ?? [
        'total_articles' => 5, 'published_articles' => 5, 'draft_articles' => 1,
        'total_subscribers' => 42384, 'subscriber_growth_pct' => 8.4,
        'total_messages' => 12, 'unread_messages' => 3,
        'total_views' => 184230, 'views_growth_pct' => 12.1,
    ];

    $recentArticles = $recentArticles ?? [
        (object)['title' => '12 Proven Home Remedies to Lower Blood Pressure', 'category' => (object)['name'=>'Heart Health'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-22'), 'thumb_class' => 'img-ph-1'],
        (object)['title' => 'The Anti-Inflammatory Diet: A Complete 30-Day Plan', 'category' => (object)['name'=>'Nutrition'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-20'), 'thumb_class' => 'img-ph-2'],
        (object)['title' => '7 Adaptogenic Herbs That Actually Work', 'category' => (object)['name'=>'Home Remedies'], 'status' => 'published', 'published_at' => \Carbon\Carbon::parse('2026-06-18'), 'thumb_class' => 'img-ph-3'],
        (object)['title' => 'Magnesium for Sleep: What the Research Says', 'category' => (object)['name'=>'Sleep'], 'status' => 'draft', 'published_at' => null, 'thumb_class' => 'img-ph-4'],
    ];
@endphp

<div class="row g-4 mb-4">
  <div class="col-md-6 col-xl-3">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">{{ $stats['total_articles'] }}</span>
        <span class="stat-label">Total Articles</span>
        <div class="stat-delta up"><i class="bi bi-arrow-up-short"></i> {{ $stats['published_articles'] }} published</div>
      </div>
      <span class="stat-icon bg-emerald"><i class="bi bi-journal-richtext"></i></span>
    </div>
  </div>
  <div class="col-md-6 col-xl-3">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">{{ number_format($stats['total_subscribers']) }}</span>
        <span class="stat-label">Newsletter Subscribers</span>
        <div class="stat-delta up"><i class="bi bi-arrow-up-short"></i> {{ $stats['subscriber_growth_pct'] }}% this month</div>
      </div>
      <span class="stat-icon bg-blue"><i class="bi bi-envelope-paper-fill"></i></span>
    </div>
  </div>
  <div class="col-md-6 col-xl-3">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">{{ number_format($stats['total_views']) }}</span>
        <span class="stat-label">Page Views (30 days)</span>
        <div class="stat-delta up"><i class="bi bi-arrow-up-short"></i> {{ $stats['views_growth_pct'] }}% vs last month</div>
      </div>
      <span class="stat-icon bg-amber"><i class="bi bi-bar-chart-fill"></i></span>
    </div>
  </div>
  <div class="col-md-6 col-xl-3">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">{{ $stats['unread_messages'] }}</span>
        <span class="stat-label">Unread Messages</span>
        <div class="stat-delta down"><i class="bi bi-dot"></i> of {{ $stats['total_messages'] }} total</div>
      </div>
      <span class="stat-icon bg-rose"><i class="bi bi-chat-left-text-fill"></i></span>
    </div>
  </div>
</div>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 style="font-size:1.1rem;">Recent Articles</h2>
      <a href="{{ route('admin.articles.create') }}" class="btn-admin-primary"><i class="bi bi-plus-lg"></i> New Article</a>
    </div>

    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Article</th>
            <th>Category</th>
            <th>Status</th>
            <th>Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($recentArticles as $article)
          <tr>
            <td>
              <div class="d-flex align-items-center gap-3">
                <div class="table-thumb img-ph {{ $article->thumb_class }}"></div>
                <span class="table-row-title">{{ $article->title }}</span>
              </div>
            </td>
            <td>{{ $article->category->name }}</td>
            <td>
              <span class="status-badge {{ $article->status }}">{{ ucfirst($article->status) }}</span>
            </td>
            <td>{{ $article->published_at ? $article->published_at->format('M j, Y') : '—' }}</td>
            <td>
              <a href="{{ route('admin.articles.edit', 1) }}" class="row-action-btn"><i class="bi bi-pencil"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="col-lg-4">
    <h2 style="font-size:1.1rem;" class="mb-3">Quick Actions</h2>
    <div class="admin-card mb-3">
      <a href="{{ route('admin.articles.create') }}" class="d-flex align-items-center gap-3 text-decoration-none mb-3">
        <span class="stat-icon bg-emerald"><i class="bi bi-file-earmark-plus"></i></span>
        <div>
          <div class="table-row-title">Write a new article</div>
          <div class="table-row-sub">Start drafting with the rich text editor</div>
        </div>
      </a>
      <a href="{{ route('admin.categories.create') }}" class="d-flex align-items-center gap-3 text-decoration-none mb-3">
        <span class="stat-icon bg-blue"><i class="bi bi-tag"></i></span>
        <div>
          <div class="table-row-title">Add a category</div>
          <div class="table-row-sub">Organize your content library</div>
        </div>
      </a>
      <a href="{{ route('admin.messages.index') }}" class="d-flex align-items-center gap-3 text-decoration-none">
        <span class="stat-icon bg-rose"><i class="bi bi-inbox"></i></span>
        <div>
          <div class="table-row-title">Check messages</div>
          <div class="table-row-sub">{{ $stats['unread_messages'] }} unread from readers</div>
        </div>
      </a>
    </div>

    <h2 style="font-size:1.1rem;" class="mb-3">Category Breakdown</h2>
    <div class="admin-card">
      @foreach([
          ['name' => 'Heart Health', 'count' => 1, 'color' => '#c23a5c'],
          ['name' => 'Nutrition', 'count' => 1, 'color' => '#1f6e4f'],
          ['name' => 'Home Remedies', 'count' => 1, 'color' => '#2b5fa3'],
          ['name' => 'Sleep', 'count' => 1, 'color' => '#3d4fb0'],
          ['name' => 'Fitness', 'count' => 1, 'color' => '#c4622d'],
      ] as $row)
      <div class="d-flex justify-content-between align-items-center mb-2">
        <span style="font-size:0.88rem; color:var(--text-on-light-dim);">
          <span style="display:inline-block;width:8px;height:8px;border-radius:50%;background:{{ $row['color'] }};margin-right:0.5rem;"></span>
          {{ $row['name'] }}
        </span>
        <span style="font-size:0.88rem; font-weight:700;">{{ $row['count'] }}</span>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection

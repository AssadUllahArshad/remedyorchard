@extends('admin.layouts.admin')

@section('title', 'Edit Article')
@section('page-title', 'Edit Article')
@section('page-subtitle', 'Update "' . ($article->title ?? 'this article') . '".')

{{--
    NOTE FOR BACKEND INTEGRATION:
    Controller (Admin\Admin_ArticleController@edit) should pass:
    $article    -> Article::findOrFail($id) — including category_id, author_id, status, etc.
    $categories -> Category::all()
    $authors    -> Author::all()
--}}

@php
    $article = $article ?? (object)[
        'id' => 1,
        'title' => '7 Adaptogenic Herbs That Actually Work for Stress Relief',
        'slug' => 'adaptogenic-herbs',
        'excerpt' => "Ashwagandha, rhodiola, holy basil — the research on adaptogens has exploded in the past decade. Here's what holds up.",
        'body' => '<p>Adaptogens are a class of herbs believed to help the body resist physical, chemical, and biological stressors...</p>',
        'category_id' => 2,
        'author_id' => 3,
        'status' => 'published',
        'published_at' => '2026-06-18 09:00:00',
        'read_time' => '7 min read',
        'meta_title' => '',
        'meta_description' => '',
    ];
@endphp

@section('content')
    @include('admin.articles._form_fields', ['article' => $article])
@endsection

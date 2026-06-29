@extends('admin.layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('page-subtitle', 'Organize your articles into topics readers can browse.')

@section('content')

{{-- NOTE: $categories -> Category::withCount('articles')->get() --}}
@php
    $categories = $categories ?? [
        (object)['id'=>1,'name'=>'Nutrition','slug'=>'nutrition','icon'=>'bi-apple','articles_count'=>1],
        (object)['id'=>2,'name'=>'Home Remedies','slug'=>'home-remedies','icon'=>'bi-flower2','articles_count'=>2],
        (object)['id'=>3,'name'=>'Mental Health','slug'=>'mental-health','icon'=>'bi-cloud-fill','articles_count'=>1],
        (object)['id'=>4,'name'=>'Fitness','slug'=>'fitness','icon'=>'bi-lightning-charge-fill','articles_count'=>1],
        (object)['id'=>5,'name'=>'Sleep','slug'=>'sleep','icon'=>'bi-moon-stars-fill','articles_count'=>1],
        (object)['id'=>6,'name'=>'Heart Health','slug'=>'heart-health','icon'=>'bi-heart-fill','articles_count'=>1],
    ];
@endphp

<div class="d-flex justify-content-end mb-4">
  <a href="{{ route('admin.categories.create') }}" class="btn-admin-primary"><i class="bi bi-plus-lg"></i> New Category</a>
</div>

<div class="row g-4">
  @foreach($categories as $cat)
  <div class="col-md-6 col-lg-4">
    <div class="admin-card h-100">
      <div class="d-flex justify-content-between align-items-start mb-3">
        <span class="stat-icon bg-emerald"><i class="bi {{ $cat->icon }}"></i></span>
        <div class="d-flex gap-2">
          <a href="{{ route('admin.categories.edit', $cat->slug) }}" class="row-action-btn"><i class="bi bi-pencil"></i></a>
          <form action="{{ route('admin.categories.destroy', $cat->slug) }}" method="POST" onsubmit="return confirm('Delete this category? Articles inside it will need to be reassigned.');">
            @csrf @method('DELETE')
            <button type="submit" class="row-action-btn danger"><i class="bi bi-trash"></i></button>
          </form>
        </div>
      </div>
      <h3 style="font-size:1.1rem; color:var(--text-on-light);">{{ $cat->name }}</h3>
      <p class="table-row-sub mb-0">{{ $cat->articles_count }} {{ \Illuminate\Support\Str::plural('article', $cat->articles_count) }} &bull; /category/{{ $cat->slug }}</p>
    </div>
  </div>
  @endforeach
</div>

@endsection

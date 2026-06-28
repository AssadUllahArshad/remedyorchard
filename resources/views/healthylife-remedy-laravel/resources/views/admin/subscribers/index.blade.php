@extends('admin.layouts.admin')

@section('title', 'Subscribers')
@section('page-title', 'Newsletter Subscribers')
@section('page-subtitle', 'Everyone who has signed up to receive your weekly newsletter.')

@section('content')

{{-- NOTE: $subscribers -> Subscriber::latest()->paginate(15) --}}
@php
    $subscribers = $subscribers ?? [
        (object)['id'=>1,'email'=>'maria.r@example.com','subscribed_at'=>\Carbon\Carbon::parse('2026-06-25'),'source'=>'Homepage'],
        (object)['id'=>2,'email'=>'david.k@example.com','subscribed_at'=>\Carbon\Carbon::parse('2026-06-24'),'source'=>'Article footer'],
        (object)['id'=>3,'email'=>'sandra.p@example.com','subscribed_at'=>\Carbon\Carbon::parse('2026-06-23'),'source'=>'Homepage'],
        (object)['id'=>4,'email'=>'tom.h@example.com','subscribed_at'=>\Carbon\Carbon::parse('2026-06-21'),'source'=>'Article footer'],
        (object)['id'=>5,'email'=>'priya.singh@example.com','subscribed_at'=>\Carbon\Carbon::parse('2026-06-19'),'source'=>'Footer'],
    ];
@endphp

<div class="row g-4 mb-4">
  <div class="col-md-4">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">42,384</span>
        <span class="stat-label">Total Subscribers</span>
      </div>
      <span class="stat-icon bg-emerald"><i class="bi bi-envelope-paper-fill"></i></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">312</span>
        <span class="stat-label">New This Week</span>
        <div class="stat-delta up"><i class="bi bi-arrow-up-short"></i> 8.4%</div>
      </div>
      <span class="stat-icon bg-blue"><i class="bi bi-person-plus-fill"></i></span>
    </div>
  </div>
  <div class="col-md-4">
    <div class="admin-stat-tile">
      <div>
        <span class="stat-value">98.2%</span>
        <span class="stat-label">Subscribed (Not Unsubscribed)</span>
      </div>
      <span class="stat-icon bg-amber"><i class="bi bi-graph-up"></i></span>
    </div>
  </div>
</div>

<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
  <input type="search" class="admin-input" placeholder="Search by email..." style="max-width:300px;">
  <button class="btn-admin-outline"><i class="bi bi-download"></i> Export CSV</button>
</div>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th><input type="checkbox"></th>
        <th>Email</th>
        <th>Source</th>
        <th>Subscribed</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($subscribers as $sub)
      <tr>
        <td><input type="checkbox"></td>
        <td class="table-row-title">{{ $sub->email }}</td>
        <td>{{ $sub->source }}</td>
        <td>{{ $sub->subscribed_at->format('M j, Y') }}</td>
        <td>
          <form action="{{ route('admin.subscribers.destroy', $sub->id) }}" method="POST" onsubmit="return confirm('Remove this subscriber?');">
            @csrf @method('DELETE')
            <button type="submit" class="row-action-btn danger"><i class="bi bi-trash"></i></button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="5">
        <div class="admin-empty-state">
          <i class="bi bi-envelope"></i>
          <p>No subscribers yet.</p>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="admin-pagination">
    <span>Showing {{ count($subscribers) }} of 42,384 subscribers</span>
    <div class="page-btns">
      <span class="page-btn active">1</span>
    </div>
  </div>
</div>

@endsection

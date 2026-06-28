@extends('admin.layouts.admin')

@section('title', 'Message Detail')
@section('page-title', 'Message')
@section('page-subtitle', 'View and respond to this submission.')

@php
    $message = $message ?? (object)[
        'id' => 1, 'name' => 'Rachel Kim', 'email' => 'rachel.kim@example.com',
        'subject' => 'Story Tip', 'type' => 'contact',
        'body' => "Hi there,\n\nI think you'd be interested in covering continuous glucose monitors for non-diabetics — there's a growing trend of healthy people using them for biohacking purposes, and I'd love to see your team's evidence-based take on whether it's actually useful or mostly marketing.\n\nThanks for the great content!\n\nRachel",
        'received_at' => \Carbon\Carbon::parse('2026-06-27 14:20'),
    ];
@endphp

@section('content')

<div class="row g-4">
  <div class="col-lg-8">
    <div class="admin-card">
      <div class="d-flex justify-content-between align-items-start mb-4 pb-4" style="border-bottom:1px solid #EEF2EE;">
        <div>
          <h2 style="font-size:1.2rem; margin-bottom:0.3rem;">{{ $message->subject }}</h2>
          <p class="table-row-sub mb-0">From {{ $message->name }} &lt;{{ $message->email }}&gt;</p>
        </div>
        <span class="table-row-sub">{{ $message->received_at->format('F j, Y \a\t g:ia') }}</span>
      </div>

      <p style="white-space:pre-line; color:var(--text-on-light); line-height:1.7;">{{ $message->body }}</p>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="admin-form-section">
      <h3>Quick Reply</h3>
      <p class="admin-form-hint mb-3">This opens your default mail client — wire this up to a real reply flow if you want in-app email sending.</p>
      <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn-admin-primary w-100 justify-content-center">
        <i class="bi bi-reply-fill"></i> Reply via Email
      </a>
    </div>

    <div class="admin-form-section mb-0">
      <h3>Actions</h3>
      <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Delete this message?');">
        @csrf @method('DELETE')
        <button type="submit" class="btn-admin-outline w-100 justify-content-center" style="color:#c23a5c; border-color:#f3c6d3;">
          <i class="bi bi-trash"></i> Delete Message
        </button>
      </form>
    </div>
  </div>
</div>

@endsection

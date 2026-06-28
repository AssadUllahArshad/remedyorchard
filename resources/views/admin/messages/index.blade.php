@extends('admin.layouts.admin')

@section('title', 'Messages')
@section('page-title', 'Messages')
@section('page-subtitle', 'Contact form submissions and advertising inquiries from your readers.')

@section('content')

{{-- NOTE: $messages -> ContactMessage::latest()->paginate(15) --}}
@php
    $messages = $messages ?? [
        (object)['id'=>1,'name'=>'Rachel Kim','email'=>'rachel.kim@example.com','subject'=>'Story Tip','preview'=>"I think you'd be interested in covering continuous glucose monitors for non-diabetics...",'received_at'=>\Carbon\Carbon::parse('2026-06-27 14:20'),'read'=>false,'type'=>'contact'],
        (object)['id'=>2,'name'=>'Wellness Co.','email'=>'partnerships@wellnessco.com','subject'=>'Partnership / Advertising','preview'=>'We would love to discuss a newsletter sponsorship for our magnesium supplement line...','received_at'=>\Carbon\Carbon::parse('2026-06-26 09:05'),'read'=>false,'type'=>'advertise'],
        (object)['id'=>3,'name'=>'Mark Donnelly','email'=>'mdonnelly@example.com','subject'=>'Correction Request','preview'=>'In your Zone 2 cardio article, I think the heart rate percentage range may need...','received_at'=>\Carbon\Carbon::parse('2026-06-25 18:40'),'read'=>false,'type'=>'contact'],
        (object)['id'=>4,'name'=>'Angela Foster','email'=>'angela.f@example.com','subject'=>'General Question','preview'=>'Do you have any plans to cover intermittent fasting in more depth?','received_at'=>\Carbon\Carbon::parse('2026-06-22 11:15'),'read'=>true,'type'=>'contact'],
    ];
@endphp

<form method="GET" class="d-flex gap-2 mb-4 flex-wrap">
  <a href="{{ route('admin.messages.index') }}" class="admin-filter-pill {{ !request('status') && !request('type') ? 'active' : '' }}">All @if(method_exists($messages, 'total'))<span class="ms-1">{{ $messages->total() }}</span>@endif</a>
  <a href="{{ route('admin.messages.index', ['status' => 'unread']) }}" class="admin-filter-pill {{ request('status') === 'unread' ? 'active' : '' }}">Unread</a>
  <a href="{{ route('admin.messages.index', ['type' => 'contact']) }}" class="admin-filter-pill {{ request('type') === 'contact' ? 'active' : '' }}">Contact Form</a>
  <a href="{{ route('admin.messages.index', ['type' => 'advertise']) }}" class="admin-filter-pill {{ request('type') === 'advertise' ? 'active' : '' }}">Advertising</a>
</form>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th></th>
        <th>From</th>
        <th>Subject</th>
        <th>Preview</th>
        <th>Received</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @forelse($messages as $msg)
      <tr style="{{ !$msg->read ? 'background:rgba(40,98,58,0.04);' : '' }}">
        <td>
          @if(!$msg->read)
            <span style="width:8px;height:8px;border-radius:50%;background:var(--emerald-brand);display:inline-block;"></span>
          @endif
        </td>
        <td>
          <div class="table-row-title">{{ $msg->name }}</div>
          <div class="table-row-sub">{{ $msg->email }}</div>
        </td>
        <td>
          <span class="status-badge {{ $msg->type === 'advertise' ? 'scheduled' : 'draft' }}">{{ $msg->subject }}</span>
        </td>
        <td style="max-width:320px;">
          <span class="table-row-sub" style="display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $msg->preview }}</span>
        </td>
        <td>{{ $msg->received_at->format('M j, g:ia') }}</td>
        <td>
          <div class="d-flex gap-2">
            <a href="{{ route('admin.messages.show', $msg->id) }}" class="row-action-btn"><i class="bi bi-envelope-open"></i></a>
            <form action="{{ route('admin.messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?');">
              @csrf @method('DELETE')
              <button type="submit" class="row-action-btn danger"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        </td>
      </tr>
      @empty
      <tr><td colspan="6">
        <div class="admin-empty-state">
          <i class="bi bi-inbox"></i>
          <p>No messages yet.</p>
        </div>
      </td></tr>
      @endforelse
    </tbody>
  </table>
</div>

@endsection

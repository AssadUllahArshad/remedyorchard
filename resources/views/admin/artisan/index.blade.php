@extends('admin.layouts.admin')

@section('title', 'Artisan Console')
@section('page-title', 'Artisan Console')
@section('page-subtitle', 'Run common Laravel commands directly from the browser.')

@section('content')

{{--
  Security note: every command here is whitelisted in ArtisanController::$commands.
  Arbitrary commands cannot be executed — only the exact keys in that array.
--}}

{{-- Output panel --}}
@if(session('artisan_output') || session('artisan_error'))
<div class="admin-card mb-4" style="border-left: 4px solid {{ session('artisan_error') ? '#e53e3e' : '#3DAA62' }};">
  <div class="d-flex align-items-center justify-content-between mb-2">
    <strong style="font-size:0.9rem; color:{{ session('artisan_error') ? '#e53e3e' : '#3DAA62' }};">
      @if(session('artisan_error'))
        <i class="bi bi-x-circle me-1"></i> Command failed
      @else
        <i class="bi bi-check-circle me-1"></i> Command ran successfully
      @endif
    </strong>
    <code style="font-size:0.78rem; color:var(--text-on-light-dim); background:var(--admin-surface,#f3f4f6); padding:2px 8px; border-radius:4px;">
      php artisan {{ session('artisan_command') }}
    </code>
  </div>
  <pre style="margin:0; padding:0.75rem 1rem; background:#0d1117; color:{{ session('artisan_error') ? '#fc8181' : '#a7f3b8' }};
              font-family:'Courier New',monospace; font-size:0.82rem; line-height:1.65;
              border-radius:6px; white-space:pre-wrap; word-break:break-word;">{{ session('artisan_error') ?? session('artisan_output') }}</pre>
  @if(session('artisan_exit') !== null && !session('artisan_error'))
    <p style="margin:0.5rem 0 0; font-size:0.78rem; color:var(--text-on-light-dim);">
      Exit code: {{ session('artisan_exit') }}
    </p>
  @endif
</div>
@endif

{{-- Command groups --}}
@foreach($groups as $groupName => $commands)
<div class="mb-4">
  <h2 style="font-size:0.78rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase;
             color:var(--text-on-light-dim); margin-bottom:1rem; padding-bottom:0.5rem;
             border-bottom:1px solid var(--admin-border, #e5e7eb);">
    {{ $groupName }}
  </h2>

  <div class="row g-3">
    @foreach($commands as $cmd => $meta)
    <div class="col-md-6 col-xl-4">
      <div class="admin-card h-100 d-flex flex-column" style="gap:0;">
        <div class="d-flex align-items-start gap-3 mb-3">
          <span class="stat-icon bg-emerald" style="flex-shrink:0; width:36px; height:36px; font-size:1rem;">
            <i class="bi {{ $meta['icon'] }}"></i>
          </span>
          <div>
            <div class="table-row-title" style="font-size:0.95rem;">{{ $meta['label'] }}</div>
            <code style="font-size:0.72rem; color:var(--text-on-light-dim);">php artisan {{ $cmd }}</code>
          </div>
        </div>
        <p class="table-row-sub mb-3" style="flex:1;">{{ $meta['description'] }}</p>
        <form method="POST" action="{{ route('admin.artisan.run') }}"
              onsubmit="return confirmRun('{{ addslashes($meta['label']) }}', '{{ $cmd }}');">
          @csrf
          <input type="hidden" name="command" value="{{ $cmd }}">
          <button type="submit" class="btn-admin-outline w-100 justify-content-center"
                  style="font-size:0.82rem; padding:0.45rem 1rem;">
            <i class="bi bi-play-fill me-1"></i> Run
          </button>
        </form>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endforeach

<div class="admin-card mt-2" style="background:rgba(234,179,8,0.06); border-color:rgba(234,179,8,0.3);">
  <p style="margin:0; font-size:0.83rem; color:var(--text-on-light-dim);">
    <i class="bi bi-shield-lock me-1" style="color:#d97706;"></i>
    <strong style="color:#d97706;">Access restricted.</strong>
    Only whitelisted commands can be triggered here. This page is protected by admin authentication.
    Do not share the admin URL with untrusted parties.
  </p>
</div>

@push('scripts')
<script>
  function confirmRun(label, cmd) {
    return confirm('Run "' + label + '"?\n\nCommand: php artisan ' + cmd);
  }
</script>
@endpush

@endsection

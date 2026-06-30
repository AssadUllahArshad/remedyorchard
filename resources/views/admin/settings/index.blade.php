@extends('admin.layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Site Settings')
@section('page-subtitle', 'Configure your site name, SEO defaults, and integrations.')

@section('content')

{{-- NOTE: $settings -> a Settings model/singleton, or config values pulled from a settings table. --}}
@php
    $settings = $settings ?? (object)[
        'site_name' => 'HealthyLife Remedy',
        'site_tagline' => 'Your trusted guide to natural health, evidence-based nutrition, and holistic wellness.',
        'contact_email' => 'hello@healthyliferemedy.com',
        'newsletter_provider' => 'mailchimp',
        'google_analytics_id' => '',
        'facebook_url' => '', 'twitter_url' => '', 'instagram_url' => '', 'youtube_url' => '',
    ];
@endphp

<form method="POST" action="{{ route('admin.settings.update') }}">
  @csrf

  <div class="row g-4">
    <div class="col-lg-8">

      <div class="admin-form-section">
        <h3>General</h3>
        <label class="admin-form-label">Site Name</label>
        <input type="text" name="site_name" class="admin-input mb-3" value="{{ old('site_name', $settings->site_name) }}">

        <label class="admin-form-label">Tagline</label>
        <textarea name="site_tagline" class="admin-textarea mb-3" rows="2">{{ old('site_tagline', $settings->site_tagline) }}</textarea>

        <label class="admin-form-label">Contact Email</label>
        <input type="email" name="contact_email" class="admin-input" value="{{ old('contact_email', $settings->contact_email) }}">
      </div>

      <div class="admin-form-section">
        <h3>Social Links</h3>
        <label class="admin-form-label">Facebook URL</label>
        <input type="url" name="facebook_url" class="admin-input mb-3" placeholder="https://facebook.com/yourpage" value="{{ old('facebook_url', $settings->facebook_url) }}">

        <label class="admin-form-label">X (Twitter) URL</label>
        <input type="url" name="twitter_url" class="admin-input mb-3" placeholder="https://x.com/yourhandle" value="{{ old('twitter_url', $settings->twitter_url) }}">

        <label class="admin-form-label">Instagram URL</label>
        <input type="url" name="instagram_url" class="admin-input mb-3" placeholder="https://instagram.com/yourhandle" value="{{ old('instagram_url', $settings->instagram_url) }}">

        <label class="admin-form-label">YouTube URL</label>
        <input type="url" name="youtube_url" class="admin-input" placeholder="https://youtube.com/@yourchannel" value="{{ old('youtube_url', $settings->youtube_url) }}">
      </div>

      <div class="admin-form-section mb-0">
        <h3>Integrations</h3>
        <label class="admin-form-label">Newsletter Provider</label>
        <select name="newsletter_provider" class="admin-select mb-3">
          <option value="mailchimp" @selected($settings->newsletter_provider === 'mailchimp')>Mailchimp</option>
          <option value="convertkit" @selected($settings->newsletter_provider === 'convertkit')>ConvertKit</option>
          <option value="custom" @selected($settings->newsletter_provider === 'custom')>Custom (database only)</option>
        </select>

        <label class="admin-form-label">Google Analytics ID</label>
        <input type="text" name="google_analytics_id" class="admin-input" placeholder="G-XXXXXXXXXX" value="{{ old('google_analytics_id', $settings->google_analytics_id) }}">

        <label class="admin-form-label">Maintenance Mode</label>
        <div class="form-check form-switch">
          <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1" @checked(old('maintenance_mode', $settings->maintenance_mode ?? false))>
          <label class="form-check-label">Enable maintenance mode for the public site</label>
        </div>
      </div>

    </div>

    <div class="col-lg-4">
      <div class="admin-form-section">
        <h3>Admin Account</h3>
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="admin-user-avatar">{{ $authUserInitials ?? 'AD' }}</span>
          <div>
            <div class="table-row-title">{{ $authUserName ?? 'Admin User' }}</div>
            <div class="table-row-sub">{{ Auth::user()?->email ?? 'admin@healthyliferemedy.com' }}</div>
            <div class="table-row-sub">{{ $authUserRole ?? 'Admin' }}</div>
          </div>
        </div>
      </div>

      <div class="admin-form-section mb-0" style="border-color:#f3c6d3;">
        <h3 style="color:#c23a5c;">Maintenance</h3>
        <p class="admin-form-hint mb-3">Clear the application cache if changes are not appearing on the live site.</p>
        {{-- NOTE: cannot nest a <form> inside the settings <form> — using JS fetch instead --}}
        <button type="button" id="clearCacheBtn"
                class="btn-admin-outline w-100 justify-content-center"
                style="color:#c23a5c; border-color:#f3c6d3;">
          <i class="bi bi-arrow-clockwise me-1"></i> Clear Application Cache
        </button>
      </div>
    </div>
  </div>

  <div class="admin-save-bar">
    <button type="submit" class="btn-admin-primary"><i class="bi bi-check2"></i> Save Settings</button>
  </div>
</form>

@push('scripts')
<script>
document.getElementById('clearCacheBtn').addEventListener('click', function () {
  if (!confirm('Clear all application cache?')) return;
  const btn = this;
  btn.disabled = true;
  btn.innerHTML = '<i class="bi bi-hourglass-split me-1"></i> Clearing…';
  fetch('{{ route('admin.cache.clear') }}', {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Accept': 'application/json',
    },
  })
  .then(function (r) {
    if (r.ok || r.redirected) {
      btn.innerHTML = '<i class="bi bi-check2 me-1"></i> Cache Cleared!';
      btn.style.color = '#28623A';
      btn.style.borderColor = '#28623A';
      setTimeout(function () { location.reload(); }, 1200);
    } else {
      throw new Error('Request failed');
    }
  })
  .catch(function () {
    btn.disabled = false;
    btn.innerHTML = '<i class="bi bi-arrow-clockwise me-1"></i> Clear Application Cache';
    alert('Cache clear failed. Try via the Artisan Console instead.');
  });
});
</script>
@endpush

@endsection

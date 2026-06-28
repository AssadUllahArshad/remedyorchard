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
      </div>

    </div>

    <div class="col-lg-4">
      <div class="admin-form-section">
        <h3>Admin Users</h3>
        <p class="admin-form-hint mb-3">No user management wired up yet — this is a placeholder for when you add auth.</p>
        <div class="d-flex align-items-center gap-3 mb-3">
          <span class="admin-user-avatar" style="background:var(--emerald-brand);">AD</span>
          <div>
            <div class="table-row-title">Admin User</div>
            <div class="table-row-sub">admin@healthyliferemedy.com</div>
          </div>
        </div>
        <button type="button" class="btn-admin-outline w-100 justify-content-center"><i class="bi bi-plus-lg"></i> Invite Team Member</button>
      </div>

      <div class="admin-form-section mb-0" style="border-color:#f3c6d3;">
        <h3 style="color:#c23a5c;">Danger Zone</h3>
        <p class="admin-form-hint mb-3">These actions are destructive and should be protected carefully once your backend is wired up.</p>
        <button type="button" class="btn-admin-outline w-100 justify-content-center mb-2" style="color:#c23a5c; border-color:#f3c6d3;">Clear All Cache</button>
        <button type="button" class="btn-admin-outline w-100 justify-content-center" style="color:#c23a5c; border-color:#f3c6d3;">Export All Data</button>
      </div>
    </div>
  </div>

  <div class="admin-save-bar">
    <button type="submit" class="btn-admin-primary"><i class="bi bi-check2"></i> Save Settings</button>
  </div>
</form>

@endsection

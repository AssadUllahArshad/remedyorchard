@extends('layouts.app')

@section('title', 'Contact Us | HealthyLife Remedy')
@section('meta_description', 'Get in touch with the HealthyLife Remedy team for questions, story tips, corrections, or advertising and partnership inquiries.')

@section('content')

<!-- HERO -->
<section class="hero-v2"
  style="padding:5rem 0 3.5rem; background-image:url('https://images.unsplash.com/photo-1596591606975-97ee5cef3a1e?w=1600&q=80&auto=format&fit=crop');">
  <div class="container">
    <span class="eyebrow">Get in touch</span>
    <h1 class="hero-h1">We read every message.</h1>
    <p class="hero-sub" style="max-width:540px;">Questions, story tips, factual corrections, or partnership inquiries — send us a message and we'll get back to you.</p>
  </div>
</section>

<section class="section-dark py-section" style="padding-top:2.5rem;">
  <div class="container">

    @if(session('status'))
      <div class="alert-success-v2 mb-4">
        <i class="bi bi-check-circle-fill me-2"></i> {{ session('status') }}
      </div>
    @endif

    @if($errors->any())
      <div class="alert-success-v2 mb-4" style="background:rgba(200,50,50,0.10); border-color:#c83232; color:#c83232;">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> Please fix the errors below and try again.
      </div>
    @endif

    <div class="row g-5">

      {{-- Contact form --}}
      <div class="col-lg-7">
        <div class="card-dark p-4 p-md-5">
          <h2 class="mb-1" style="font-size:1.4rem;">Send us a message</h2>
          <p style="color:var(--text-on-dark-dim); font-size:0.9rem; margin-bottom:2rem;">We typically reply within 2 business days.</p>

          <form method="POST" action="{{ route('contact.submit') }}">
            @csrf

            <div class="row g-3 mb-1">
              <div class="col-md-6">
                <label class="form-label-v2" for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-input-v2"
                       placeholder="Jane" required value="{{ old('first_name') }}">
                @error('first_name')<span style="color:#e05555; font-size:0.82rem;">{{ $message }}</span>@enderror
              </div>
              <div class="col-md-6">
                <label class="form-label-v2" for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-input-v2"
                       placeholder="Doe" required value="{{ old('last_name') }}">
                @error('last_name')<span style="color:#e05555; font-size:0.82rem;">{{ $message }}</span>@enderror
              </div>
            </div>

            <label class="form-label-v2" for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-input-v2"
                   placeholder="you@example.com" required value="{{ old('email') }}">
            @error('email')<span style="color:#e05555; font-size:0.82rem; display:block; margin-top:-0.8rem; margin-bottom:0.8rem;">{{ $message }}</span>@enderror

            <label class="form-label-v2" for="subject">What is this about?</label>
            <select id="subject" name="subject" class="form-input-v2">
              <option value="General Question"         {{ old('subject') === 'General Question'         ? 'selected' : '' }}>General Question</option>
              <option value="Story Tip"               {{ old('subject') === 'Story Tip'               ? 'selected' : '' }}>Story Tip or Article Suggestion</option>
              <option value="Correction Request"      {{ old('subject') === 'Correction Request'      ? 'selected' : '' }}>Factual Correction</option>
              <option value="Partnership / Advertising" {{ old('subject') === 'Partnership / Advertising' ? 'selected' : '' }}>Partnership or Advertising</option>
              <option value="Other"                   {{ old('subject') === 'Other'                   ? 'selected' : '' }}>Other</option>
            </select>

            <label class="form-label-v2" for="message">Your Message</label>
            <textarea id="message" name="message" class="form-input-v2" rows="5"
                      placeholder="How can we help?" required>{{ old('message') }}</textarea>
            @error('message')<span style="color:#e05555; font-size:0.82rem; display:block; margin-top:-0.8rem; margin-bottom:0.8rem;">{{ $message }}</span>@enderror

            <button type="submit" class="btn-pill-primary btn-pill-primary--lg">
              <i class="bi bi-send me-1"></i> Send Message
            </button>
          </form>
        </div>
      </div>

      {{-- Contact info sidebar --}}
      <div class="col-lg-5">
        <h2 class="mb-4" style="font-size:1.3rem;">Other ways to reach us</h2>

        <div class="contact-info-block">
          <span class="ci-icon"><i class="bi bi-envelope-fill"></i></span>
          <div>
            <h4>General enquiries</h4>
            <p>info@healthyliferemedy.com</p>
          </div>
        </div>

        <div class="contact-info-block">
          <span class="ci-icon"><i class="bi bi-pencil-fill"></i></span>
          <div>
            <h4>Editorial &amp; corrections</h4>
            <p>info@healthyliferemedy.com<br>
            <span style="font-size:0.82rem; color:var(--text-on-dark-faint);">Factual errors are corrected within 48 hours of being confirmed.</span></p>
          </div>
        </div>

        <div class="contact-info-block">
          <span class="ci-icon"><i class="bi bi-megaphone-fill"></i></span>
          <div>
            <h4>Advertising &amp; partnerships</h4>
            <p>contact@healthyliferemedy.com<br>
            <span style="font-size:0.82rem; color:var(--text-on-dark-faint);">Editorial and commercial operations are kept strictly separate.</span></p>
          </div>
        </div>

        <div class="contact-info-block">
          <span class="ci-icon"><i class="bi bi-lightbulb-fill"></i></span>
          <div>
            <h4>Story tips &amp; article suggestions</h4>
            <p>Use the form with "Story Tip" selected. We read every suggestion, though we can't always respond individually.</p>
          </div>
        </div>

        <div class="callout-box-v2 mt-2">
          <h4><i class="bi bi-shield-exclamation me-2"></i>Medical Questions</h4>
          <p>We're a health education publication, not a medical practice. For personal health concerns, please consult a licensed healthcare provider. We cannot give individual medical advice.</p>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

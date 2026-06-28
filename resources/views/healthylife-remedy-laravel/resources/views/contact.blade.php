@extends('layouts.app')

@section('title', 'Contact Us | HealthyLife Remedy')
@section('meta_description', 'Get in touch with the HealthyLife Remedy team for questions, story tips, corrections, or advertising and partnership inquiries.')

@section('content')

<section class="hero-v2" style="padding:5rem 0 3rem;">
  <div class="container">
    <span class="eyebrow">We're listening</span>
    <h1 style="font-size:2.6rem;">Contact us.</h1>
    <p class="hero-sub">Questions, story tips, corrections, or partnership inquiries — we read every message.</p>
  </div>
</section>

<section class="section-dark py-section" style="padding-top:2rem;">
  <div class="container">

    @if(session('status'))
      <div class="alert alert-success mb-4" style="background:rgba(40,98,58,0.15); border:1px solid var(--emerald-brand); color:#fff; border-radius:10px;">
        {{ session('status') }}
      </div>
    @endif

    <div class="row g-5">
      <div class="col-lg-7">
        <div class="card-dark p-4 p-md-5">
          <h2 class="mb-4" style="font-size:1.4rem; color:#fff;">Send us a message</h2>

          {{-- NOTE: wire this up to your ContactController@store; validate name/email/subject/message server-side --}}
          <form method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <label style="color:var(--text-on-dark-dim); font-weight:700; font-size:0.88rem;">First Name</label>
                <input type="text" name="first_name" class="form-control mb-3" placeholder="Jane" required value="{{ old('first_name') }}" style="background:var(--emerald-deep); border:1px solid var(--emerald-line); color:#fff; border-radius:10px; padding:0.7rem 0.95rem;">
              </div>
              <div class="col-md-6">
                <label style="color:var(--text-on-dark-dim); font-weight:700; font-size:0.88rem;">Last Name</label>
                <input type="text" name="last_name" class="form-control mb-3" placeholder="Doe" required value="{{ old('last_name') }}" style="background:var(--emerald-deep); border:1px solid var(--emerald-line); color:#fff; border-radius:10px; padding:0.7rem 0.95rem;">
              </div>
            </div>
            <label style="color:var(--text-on-dark-dim); font-weight:700; font-size:0.88rem;">Email Address</label>
            <input type="email" name="email" class="form-control mb-3" placeholder="you@example.com" required value="{{ old('email') }}" style="background:var(--emerald-deep); border:1px solid var(--emerald-line); color:#fff; border-radius:10px; padding:0.7rem 0.95rem;">

            <label style="color:var(--text-on-dark-dim); font-weight:700; font-size:0.88rem;">Subject</label>
            <select name="subject" class="form-control mb-3" style="background:var(--emerald-deep); border:1px solid var(--emerald-line); color:#fff; border-radius:10px; padding:0.7rem 0.95rem;">
              <option>General Question</option>
              <option>Story Tip</option>
              <option>Correction Request</option>
              <option>Partnership / Advertising</option>
              <option>Other</option>
            </select>

            <label style="color:var(--text-on-dark-dim); font-weight:700; font-size:0.88rem;">Message</label>
            <textarea name="message" class="form-control mb-4" rows="5" placeholder="How can we help?" required style="background:var(--emerald-deep); border:1px solid var(--emerald-line); color:#fff; border-radius:10px; padding:0.7rem 0.95rem;">{{ old('message') }}</textarea>

            <button type="submit" class="btn-pill-primary" style="border:none; padding:0.85rem 1.8rem;">Send Message</button>
          </form>
        </div>
      </div>

      <div class="col-lg-5">
        <h2 class="mb-4" style="font-size:1.4rem; color:#fff;">Other ways to reach us</h2>

        <div class="d-flex gap-3 mb-4">
          <span class="cat-icon" style="width:44px;height:44px;flex-shrink:0;"><i class="bi bi-envelope-fill"></i></span>
          <div>
            <h4 style="color:#fff; font-size:0.98rem; margin-bottom:0.3rem;">Email</h4>
            <p style="color:var(--text-on-dark-dim); font-size:0.9rem;">hello@healthyliferemedy.com</p>
          </div>
        </div>

        <div class="d-flex gap-3 mb-4">
          <span class="cat-icon" style="width:44px;height:44px;flex-shrink:0;"><i class="bi bi-pencil-fill"></i></span>
          <div>
            <h4 style="color:#fff; font-size:0.98rem; margin-bottom:0.3rem;">Editorial / Corrections</h4>
            <p style="color:var(--text-on-dark-dim); font-size:0.9rem;">editorial@healthyliferemedy.com</p>
          </div>
        </div>

        <div class="d-flex gap-3 mb-4">
          <span class="cat-icon" style="width:44px;height:44px;flex-shrink:0;"><i class="bi bi-megaphone-fill"></i></span>
          <div>
            <h4 style="color:#fff; font-size:0.98rem; margin-bottom:0.3rem;">Advertising &amp; Partnerships</h4>
            <p style="color:var(--text-on-dark-dim); font-size:0.9rem;">partners@healthyliferemedy.com</p>
          </div>
        </div>

        <div class="d-flex gap-3 mb-4">
          <span class="cat-icon" style="width:44px;height:44px;flex-shrink:0;"><i class="bi bi-clock-fill"></i></span>
          <div>
            <h4 style="color:#fff; font-size:0.98rem; margin-bottom:0.3rem;">Response Time</h4>
            <p style="color:var(--text-on-dark-dim); font-size:0.9rem;">We typically respond within 2-3 business days.</p>
          </div>
        </div>

        <div class="callout-box-v2">
          <h4>Medical Questions?</h4>
          <p>We're a health publication, not a medical practice. For personal health concerns, please consult a licensed healthcare provider directly.</p>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

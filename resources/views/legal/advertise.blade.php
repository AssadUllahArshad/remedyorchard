@extends('layouts.app')

@section('title', 'Advertise With Us | Healthy Habits Hub')
@section('meta_description', 'Partner with Healthy Habits Hub to reach an engaged, health-conscious audience through display advertising, sponsored content, and newsletter placements.')

@section('content')
<section class="page-hero-light">
  <div class="container">
    <h1>Advertise With Us</h1>
    <p>Reach an engaged, health-conscious audience of over 200,000 monthly readers across nutrition, fitness, sleep, and wellness content.</p>
  </div>
</section>

<main class="section-light py-5">
  <div class="container">

    @if(session('status'))
      <div class="alert alert-success mb-4">{{ session('status') }}</div>
    @endif

    <div class="row g-4 mb-5">
      <div class="col-md-4">
        <div class="card-light text-center">
          <h3 style="font-size:2.2rem; color:var(--emerald-brand); font-weight:800;">200K+</h3>
          <p style="color:var(--text-on-light-dim); margin-bottom:0;">Monthly readers</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-light text-center">
          <h3 style="font-size:2.2rem; color:var(--emerald-brand); font-weight:800;">42K+</h3>
          <p style="color:var(--text-on-light-dim); margin-bottom:0;">Newsletter subscribers</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-light text-center">
          <h3 style="font-size:2.2rem; color:var(--emerald-brand); font-weight:800;">68%</h3>
          <p style="color:var(--text-on-light-dim); margin-bottom:0;">Readers aged 30-55</p>
        </div>
      </div>
    </div>

    <div class="row g-5">
      <div class="col-lg-7 article-body-v2">
        <h2>Advertising Opportunities</h2>
        <p>We offer a range of placements across our site for brands aligned with health, wellness, nutrition, and fitness, including:</p>
        <ul>
          <li>Display advertising (leaderboard, sidebar, and in-content placements)</li>
          <li>Sponsored content and reviewed product features</li>
          <li>Newsletter sponsorships reaching 42,000+ weekly subscribers</li>
          <li>Affiliate partnerships for relevant, vetted products</li>
        </ul>

        <h2>Our Editorial Standards</h2>
        <p>All sponsored content is clearly labeled and subject to the same evidence-based editorial review as our regular articles. We do not accept advertising for products making unsubstantiated medical claims.</p>
      </div>

      <div class="col-lg-5">
        <div class="contact-form-card-v2">
          <h3 class="mb-3" style="font-size:1.2rem;">Request Our Media Kit</h3>
          <form method="POST" action="{{ route('advertise.submit') }}">
            @csrf
            <label>Company Name</label>
            <input type="text" name="company_name" class="form-control" placeholder="Your company" required value="{{ old('company_name') }}">
            <label>Email Address</label>
            <input type="email" name="email" class="form-control" placeholder="you@company.com" required value="{{ old('email') }}">
            <label>Tell us about your goals</label>
            <textarea name="message" class="form-control" rows="4" placeholder="What are you hoping to promote?">{{ old('message') }}</textarea>
            <button type="submit" class="btn-brand-solid">Request Media Kit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

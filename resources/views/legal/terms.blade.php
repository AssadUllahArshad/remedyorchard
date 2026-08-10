@extends('layouts.app')

@section('title', 'Terms of Use | Healthy Habits Hub')
@section('meta_description', 'Read the terms and conditions governing your use of healthyhabitshub.com.')
@section('robots', 'noindex, follow')

@section('content')
<section class="page-hero-light">
  <div class="container">
    <h1>Terms of Use</h1>
    <p>Last updated: {{ $lastUpdated ?? 'June 28, 2026' }}</p>
  </div>
</section>
<main class="section-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 article-body-v2">
        <p>By accessing or using healthyhabitshub.com, you agree to be bound by these Terms of Use. If you do not agree, please discontinue use of the site.</p>

        <h2>Use of Content</h2>
        <p>All articles, graphics, and other materials on this site are owned by Healthy Habits Hub or used with permission, and are protected by copyright law. You may share links to our content but may not republish, copy, or distribute substantial portions without written permission.</p>

        <h2>Not Medical Advice</h2>
        <p>Content on this site is for informational and educational purposes only and is not a substitute for professional medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider regarding any medical condition. See our <a href="{{ route('medical-disclaimer') }}">Medical Disclaimer</a> for full detail.</p>

        <h2>User Conduct</h2>
        <p>You agree not to use this site to post unlawful, harmful, or abusive content, attempt to gain unauthorized access to our systems, or interfere with the site's normal operation.</p>

        <h2>Third-Party Links</h2>
        <p>Our site may contain links to third-party websites. We are not responsible for the content, accuracy, or privacy practices of any linked external site.</p>

        <h2>Limitation of Liability</h2>
        <p>Healthy Habits Hub and its contributors are not liable for any damages arising from your use of, or inability to use, this site or its content.</p>

        <h2>Changes to These Terms</h2>
        <p>We may revise these Terms of Use at any time. Continued use of the site after changes are posted constitutes acceptance of the revised terms.</p>

        <h2>Contact</h2>
        <p>Questions about these terms can be sent to info@healthyhabitshub.com or via our <a href="{{ route('contact') }}">Contact page</a>.</p>
      </div>
    </div>
  </div>
</main>
@endsection

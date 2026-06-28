@extends('layouts.app')

@section('title', 'Privacy Policy | HealthyLife Remedy')
@section('meta_description', 'Read the HealthyLife Remedy privacy policy to learn how we collect, use, and protect your personal information.')

@section('content')
<section class="page-hero-light">
  <div class="container">
    <h1>Privacy Policy</h1>
    <p>Last updated: {{ $lastUpdated ?? 'June 28, 2026' }}</p>
  </div>
</section>
<main class="section-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 article-body-v2">
        <p>HealthyLife Remedy ("we," "us," or "our") respects your privacy. This Privacy Policy explains what information we collect when you visit healthyliferemedy.com, how we use it, and the choices available to you.</p>

        <h2>Information We Collect</h2>
        <h3>Information You Provide</h3>
        <p>When you subscribe to our newsletter, submit a contact form, or leave a comment, we collect the information you provide, such as your name and email address.</p>

        <h3>Information Collected Automatically</h3>
        <p>Like most websites, we automatically collect certain information when you visit, including your IP address, browser type, device type, pages visited, and time spent on those pages, typically through cookies and similar tracking technologies.</p>

        <h2>How We Use Your Information</h2>
        <ul>
          <li>To deliver the newsletter content you've signed up for</li>
          <li>To respond to inquiries submitted through our contact form</li>
          <li>To understand how visitors use our site so we can improve content and navigation</li>
          <li>To serve relevant advertising through third-party ad networks</li>
        </ul>

        <h2>Cookies</h2>
        <p>We use cookies to remember your preferences, understand site traffic, and support advertising operations. You can control or disable cookies through your browser settings, though some site features may not function properly without them. See our <a href="{{ route('cookie-policy') }}">Cookie Policy</a> for more detail.</p>

        <h2>Third-Party Services</h2>
        <p>We may use third-party services for analytics, email delivery, and advertising. These providers have their own privacy policies governing how they handle data, and we encourage you to review them.</p>

        <h2>Your Choices</h2>
        <p>You can unsubscribe from our newsletter at any time using the link included in every email. You may also contact us directly to request access to, correction of, or deletion of personal data we hold about you.</p>

        <h2>Children's Privacy</h2>
        <p>Our site is not directed at children under 13, and we do not knowingly collect personal information from children.</p>

        <h2>Changes to This Policy</h2>
        <p>We may update this Privacy Policy from time to time. Material changes will be reflected by an updated "Last updated" date at the top of this page.</p>

        <h2>Contact Us</h2>
        <p>If you have questions about this Privacy Policy, please reach out via our <a href="{{ route('contact') }}">Contact page</a> or email hello@healthyliferemedy.com.</p>
      </div>
    </div>
  </div>
</main>
@endsection

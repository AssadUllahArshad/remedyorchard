@extends('layouts.app')

@section('title', 'Cookie Policy | HealthyLife Remedy')
@section('meta_description', 'Learn how HealthyLife Remedy uses cookies and how you can manage your cookie preferences.')

@section('content')
<section class="page-hero-light">
  <div class="container">
    <h1>Cookie Policy</h1>
    <p>Last updated: {{ $lastUpdated ?? 'June 28, 2026' }}</p>
  </div>
</section>
<main class="section-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 article-body-v2">
        <p>This Cookie Policy explains how HealthyLife Remedy uses cookies and similar tracking technologies when you visit our site.</p>

        <h2>What Are Cookies?</h2>
        <p>Cookies are small text files placed on your device that help websites remember information about your visit, such as your preferences and browsing activity.</p>

        <h2>Types of Cookies We Use</h2>
        <ul>
          <li><strong>Essential cookies</strong> — required for basic site functionality, such as remembering your cookie consent choice.</li>
          <li><strong>Analytics cookies</strong> — help us understand how visitors interact with our content so we can improve it.</li>
          <li><strong>Advertising cookies</strong> — used by our ad partners to deliver relevant ads and measure campaign performance.</li>
        </ul>

        <h2>Managing Cookies</h2>
        <p>Most browsers let you control cookies through their settings, including blocking or deleting them. Note that disabling certain cookies may affect site functionality.</p>

        <h2>Third-Party Cookies</h2>
        <p>Some cookies are placed by third-party services we use, such as advertising networks and analytics providers. These third parties have their own cookie and privacy policies.</p>

        <h2>Questions</h2>
        <p>If you have questions about our use of cookies, contact us at info@healthyliferemedy.com.</p>
      </div>
    </div>
  </div>
</main>
@endsection

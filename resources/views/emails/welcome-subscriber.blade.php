<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome to HealthyLife Remedy</title>
<style>
  body { margin:0; padding:0; background:#f4f4f4; font-family:Inter,Arial,sans-serif; }
  .wrap { max-width:580px; margin:32px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08); }
  .header { background:#28623A; padding:36px 32px; text-align:center; }
  .header .logo-mark { width:52px; height:52px; margin:0 auto 14px; }
  .header h1 { margin:0; color:#ffffff; font-size:1.4rem; font-weight:800; }
  .header p { margin:6px 0 0; color:rgba(255,255,255,0.75); font-size:0.9rem; }
  .body { padding:32px; text-align:center; }
  .body h2 { color:#1a3d25; font-size:1.15rem; font-weight:700; margin:0 0 12px; }
  .body p { color:#4b5563; font-size:0.95rem; line-height:1.7; margin:0 0 16px; }
  .highlight { background:#f0f9f3; border-radius:10px; padding:20px; margin:24px 0; text-align:left; }
  .highlight ul { margin:0; padding:0 0 0 18px; color:#374151; font-size:0.9rem; line-height:1.9; }
  .btn { display:inline-block; background:#28623A; color:#ffffff !important; text-decoration:none; padding:13px 30px; border-radius:8px; font-size:0.95rem; font-weight:700; margin:8px 0 24px; }
  .footer { background:#f4f4f4; padding:18px 32px; text-align:center; font-size:0.78rem; color:#9ca3af; border-top:1px solid #e5e7eb; line-height:1.6; }
  .footer a { color:#28623A; text-decoration:none; }
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <svg class="logo-mark" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg">
      <circle cx="26" cy="26" r="26" fill="rgba(255,255,255,0.15)"/>
      <path d="M13 27 L19 27 L22 18 L27 35 L31 22 L34 27 L39 27" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    <h1>HealthyLife Remedy</h1>
    <p>Evidence-based health & wellness</p>
  </div>
  <div class="body">
    <h2>You're officially subscribed!</h2>
    <p>Welcome aboard. You'll now receive our weekly newsletter packed with evidence-based health tips, home remedies, and wellness guides — straight to your inbox.</p>

    <div class="highlight">
      <strong style="display:block; margin-bottom:8px; color:#1a3d25;">What to expect:</strong>
      <ul>
        <li>Weekly digest of new articles &amp; remedies</li>
        <li>Exclusive tips not published on the site</li>
        <li>No spam — unsubscribe anytime</li>
      </ul>
    </div>

    <a href="{{ url('/remedies') }}" class="btn">Browse Articles Now</a>

    <p style="font-size:0.85rem; color:#9ca3af;">Your subscribed email: {{ $subscriberEmail }}</p>
  </div>
  <div class="footer">
    You're receiving this because you subscribed at <a href="{{ url('/') }}">healthyliferemedy.com</a>.<br>
    To unsubscribe, reply to this email with "unsubscribe" in the subject line.<br><br>
    &copy; {{ date('Y') }} HealthyLife Remedy. All rights reserved.
  </div>
</div>
</body>
</html>

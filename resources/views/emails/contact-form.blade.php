<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Contact Message</title>
<style>
  body { margin:0; padding:0; background:#f4f4f4; font-family:Inter,Arial,sans-serif; }
  .wrap { max-width:580px; margin:32px auto; background:#ffffff; border-radius:10px; overflow:hidden; box-shadow:0 2px 12px rgba(0,0,0,0.08); }
  .header { background:#28623A; padding:28px 32px; }
  .header h1 { margin:0; color:#ffffff; font-size:1.2rem; font-weight:700; letter-spacing:0.3px; }
  .header p { margin:4px 0 0; color:rgba(255,255,255,0.7); font-size:0.85rem; }
  .body { padding:28px 32px; }
  .field { margin-bottom:18px; }
  .field label { display:block; font-size:0.75rem; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:4px; }
  .field p { margin:0; font-size:0.95rem; color:#111827; line-height:1.6; }
  .message-box { background:#f9fafb; border-left:4px solid #28623A; border-radius:0 6px 6px 0; padding:14px 16px; margin-top:6px; }
  .footer { background:#f4f4f4; padding:16px 32px; text-align:center; font-size:0.78rem; color:#9ca3af; border-top:1px solid #e5e7eb; }
  .btn { display:inline-block; background:#28623A; color:#ffffff; text-decoration:none; padding:10px 22px; border-radius:6px; font-size:0.88rem; font-weight:600; margin-top:20px; }
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <h1>New Contact Form Submission</h1>
    <p>Healthy Habits Hub — {{ now()->format('M j, Y \a\t g:ia') }}</p>
  </div>
  <div class="body">
    <div class="field">
      <label>From</label>
      <p>{{ $submission->name }} &lt;{{ $submission->email }}&gt;</p>
    </div>
    <div class="field">
      <label>Subject</label>
      <p>{{ $submission->subject }}</p>
    </div>
    <div class="field">
      <label>Message</label>
      <div class="message-box">
        <p>{{ strip_tags($submission->body) }}</p>
      </div>
    </div>
    <a href="{{ url('/admin/messages') }}" class="btn">View in Admin Panel</a>
  </div>
  <div class="footer">
    This email was sent automatically when someone submitted the contact form on Healthy Habits Hub.<br>
    Reply directly to this email to respond to {{ $submission->name }}.
  </div>
</div>
</body>
</html>

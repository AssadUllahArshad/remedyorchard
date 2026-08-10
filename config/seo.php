<?php

return [
    'site_name'           => env('APP_NAME', 'Healthy Habits Hub'),
    'site_url'            => env('APP_URL', 'https://healthyhabitshub.com'),
    'tagline'             => 'Evidence-Based Natural Health & Wellness',
    'description'         => 'Clinician-reviewed natural remedies, nutrition guides and wellness tips backed by science. Trusted, evidence-based health advice you can rely on.',
    'contact_email'       => env('ADMIN_EMAIL', 'info@healthyhabitshub.com'),

    // Social handles (no @ prefix for schema, with @ for meta tags)
    'twitter_handle'      => env('TWITTER_HANDLE', '@healthyhabitshub'),
    'facebook_url'        => env('FACEBOOK_URL', ''),
    'instagram_url'       => env('INSTAGRAM_URL', ''),

    // Google / Search Console
    'google_verification' => env('GOOGLE_SITE_VERIFICATION', ''),
    'bing_verification'   => env('BING_SITE_VERIFICATION', ''),

    // Google AdSense
    'adsense_client'      => env('ADSENSE_CLIENT_ID', ''),       // ca-pub-XXXXXXXXXXXXXXXX
    'adsense_slot_article'=> env('ADSENSE_SLOT_ARTICLE', ''),    // in-content article slot
    'adsense_slot_sidebar'=> env('ADSENSE_SLOT_SIDEBAR', ''),    // sidebar slot

    // Default OG image (1200×630px recommended)
    'og_image'            => env('APP_URL', '') . '/logo/og-default.jpg',
];

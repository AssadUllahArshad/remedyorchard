<?php

return [
    'site_name'           => env('APP_NAME', 'HealthyLife Remedy'),
    'site_url'            => env('APP_URL', 'https://healthyliferemedy.com'),
    'tagline'             => 'Evidence-Based Natural Health & Wellness',
    'description'         => 'Your trusted guide to natural health, evidence-based nutrition, and holistic wellness. Doctor-reviewed articles on home remedies, nutrition, mental health, fitness, sleep, and heart health.',
    'contact_email'       => env('ADMIN_EMAIL', 'info@healthyliferemedy.com'),

    // Social handles (no @ prefix for schema, with @ for meta tags)
    'twitter_handle'      => env('TWITTER_HANDLE', '@healthyliferemedy'),
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'site_tagline',
        'contact_email',
        'newsletter_provider',
        'google_analytics_id',
        'facebook_url',
        'twitter_url',
        'instagram_url',
        'youtube_url',
        'maintenance_mode',
    ];

    protected $casts = [
        'maintenance_mode' => 'boolean',
    ];
}

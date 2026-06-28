<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first() ?? new Setting();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'newsletter_provider' => ['nullable', 'string', 'max:255'],
            'google_analytics_id' => ['nullable', 'string', 'max:255'],
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'maintenance_mode' => ['nullable', 'boolean'],
        ]);

        $data['maintenance_mode'] = $request->boolean('maintenance_mode');

        $settings = Setting::firstOrNew();
        $settings->fill($data);
        $settings->save();

        return back()->with('status', 'Settings saved.');
    }
}

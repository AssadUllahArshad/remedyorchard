<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => 'Healthy Life Remedy',
                'site_tagline' => 'Natural remedies and wellness insights',
                'contact_email' => 'hello@healthyhabitshub.com',
                'newsletter_provider' => 'custom',
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Subscriber;
use Illuminate\Database\Seeder;

class SubscriberSeeder extends Seeder
{
    public function run(): void
    {
        Subscriber::firstOrCreate(
            ['email' => 'reader@example.com'],
            ['source' => 'website', 'active' => true]
        );
    }
}

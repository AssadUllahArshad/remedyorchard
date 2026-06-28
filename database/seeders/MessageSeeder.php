<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        ContactMessage::firstOrCreate(
            ['email' => 'hello@example.com'],
            [
                'name' => 'Sample Visitor',
                'subject' => 'Welcome',
                'type' => 'contact',
                'body' => 'This is a sample contact message.',
                'read' => false,
                'received_at' => now(),
            ]
        );
    }
}

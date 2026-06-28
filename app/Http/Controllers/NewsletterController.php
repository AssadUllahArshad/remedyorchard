<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        Subscriber::updateOrCreate(
            ['email' => $data['email']],
            [
                'source' => 'newsletter-form',
                'active' => true,
                'subscribed_at' => now(),
            ]
        );

        return back()->with('status', 'Thanks for subscribing!');
    }
}

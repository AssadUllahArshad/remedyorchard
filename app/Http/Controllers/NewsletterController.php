<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeSubscriber;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
        ]);

        $result = Subscriber::updateOrCreate(
            ['email' => $data['email']],
            [
                'source' => $request->input('source', 'newsletter-form'),
                'active' => true,
                'subscribed_at' => now(),
            ]
        );

        // Only send welcome email to brand-new subscribers
        if ($result->wasRecentlyCreated) {
            Mail::to($data['email'])->send(new WelcomeSubscriber($data['email']));
        }

        return back()->with('status', 'You\'re subscribed! Check your inbox for a welcome email.');
    }
}

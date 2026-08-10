<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeSubscriber;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

        // The subscription itself must succeed regardless of whether the
        // welcome email can be sent — a misconfigured/down mail server
        // should never turn a successful signup into a user-facing error.
        $emailSent = false;
        if ($result->wasRecentlyCreated) {
            try {
                Mail::to($data['email'])->send(new WelcomeSubscriber($data['email']));
                $emailSent = true;
            } catch (\Throwable $e) {
                Log::error('Failed to send welcome subscriber email: ' . $e->getMessage());
            }
        }

        $message = $emailSent
            ? "You're subscribed! Check your inbox for a welcome email."
            : "You're subscribed!";

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
            ]);
        }

        return back()->with('status', $message);
    }
}

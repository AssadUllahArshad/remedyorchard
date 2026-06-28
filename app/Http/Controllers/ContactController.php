<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Mews\Purifier\Facades\Purifier;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        ContactMessage::create([
            'name' => trim($data['first_name'] . ' ' . $data['last_name']),
            'email' => $data['email'],
            'subject' => $data['subject'] ?? 'General inquiry',
            'body' => Purifier::clean($data['message']),
            'type' => 'contact',
            'received_at' => now(),
        ]);

        return back()->with('status', 'Thanks! Your message has been received.');
    }

    public function storeAdvertiseInquiry(Request $request)
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        ContactMessage::create([
            'name' => $data['company_name'],
            'email' => $data['email'],
            'subject' => 'Advertise inquiry',
            'body' => Purifier::clean($data['message'] ?? ''),
            'type' => 'advertise',
            'received_at' => now(),
        ]);

        return back()->with('status', 'Advertise inquiry received. Thank you.');
    }
}

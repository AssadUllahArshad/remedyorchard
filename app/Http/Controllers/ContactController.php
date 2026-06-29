<?php

namespace App\Http\Controllers;

use App\Mail\AdvertiseInquirySubmitted;
use App\Mail\ContactFormSubmitted;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        $contactMessage = ContactMessage::create([
            'name' => trim($data['first_name'] . ' ' . $data['last_name']),
            'email' => $data['email'],
            'subject' => $data['subject'] ?? 'General inquiry',
            'body' => strip_tags($data['message']),
            'type' => 'contact',
            'received_at' => now(),
        ]);

        Mail::to(config('mail.admin_address', env('ADMIN_EMAIL', 'info@healthyliferemedy.com')))
            ->send(new ContactFormSubmitted($contactMessage));

        return back()->with('status', 'Thanks! Your message has been received. We\'ll get back to you within 48 hours.');
    }

    public function storeAdvertiseInquiry(Request $request)
    {
        $data = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        $contactMessage = ContactMessage::create([
            'name' => $data['company_name'],
            'email' => $data['email'],
            'subject' => 'Advertise inquiry',
            'body' => strip_tags($data['message'] ?? ''),
            'type' => 'advertise',
            'received_at' => now(),
        ]);

        Mail::to(config('mail.partnerships_address', env('PARTNERSHIPS_EMAIL', 'contact@healthyliferemedy.com')))
            ->send(new AdvertiseInquirySubmitted($contactMessage));

        return back()->with('status', 'Advertising inquiry received. Our partnerships team will be in touch shortly.');
    }
}

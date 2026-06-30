<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public ContactMessage $submission) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Message: ' . $this->submission->subject,
            replyTo: [new \Illuminate\Mail\Mailables\Address($this->submission->email, $this->submission->name)],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact-form');
    }
}

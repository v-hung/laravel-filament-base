<?php

namespace App\Mail\Contact;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class ContactConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Contact $contact) {}

    public function envelope(): Envelope
    {
        App::setLocale($this->contact->locale ?? config('app.locale'));

        return new Envelope(
            subject: __('mail.contact.confirmation.subject', ['site_name' => setting('shop.site_name')]),
        );
    }

    public function content(): Content
    {
        App::setLocale($this->contact->locale ?? config('app.locale'));

        return new Content(
            markdown: 'mail.contact.confirmation',
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

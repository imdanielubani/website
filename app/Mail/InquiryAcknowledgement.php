<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Confirmation sent to the visitor after they submit a form. Sent in the
 * visitor's language (set with ->locale() when sending); replies go to the
 * company inbox.
 */
class InquiryAcknowledgement extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $form,
        public string $name,
        public string $inquiryType,
        public string $receivedAt,
    ) {}

    public function envelope(): Envelope
    {
        $replyTo = config('company.contact.email');

        return new Envelope(
            replyTo: $replyTo ? [new Address($replyTo, config('company.name'))] : [],
            subject: __('We have received your message') . ' | ' . config('company.name'),
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.acknowledgement', text: 'emails.acknowledgement-text');
    }
}

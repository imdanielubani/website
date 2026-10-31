<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Internal notification sent to the company for every form submission.
 */
class InquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @param  array<string, string|null>  $fields  label => value, in display order
     */
    public function __construct(
        public string $form,
        public string $replyName,
        public string $replyEmail,
        public array $fields,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            replyTo: [new Address($this->replyEmail, $this->replyName)],
            subject: "New {$this->form}: {$this->replyName}",
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.inquiry');
    }
}

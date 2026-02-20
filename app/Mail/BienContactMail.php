<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BienContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau contact pour le bien #' . $this->payload['bien_id'],
            replyTo: [
                new Address($this->payload['email'], $this->payload['prenom'] . ' ' . $this->payload['name']),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.bien-contact',
            with: ['payload' => $this->payload],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

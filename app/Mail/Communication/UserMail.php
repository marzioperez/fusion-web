<?php

namespace App\Mail\Communication;

use App\Models\Communication;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable {
    use Queueable, SerializesModels;

    public function __construct(public Communication $communication, public User $user) {
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: $this->communication['subject'],
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.communication.user-mail',
            with: [
                'communication' => $this->communication,
                'user' => $this->user
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

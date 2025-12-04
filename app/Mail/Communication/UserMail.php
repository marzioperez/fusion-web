<?php

namespace App\Mail\Communication;

use App\Models\Communication;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
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

    public function attachments(): array {
        return $this->communication
            ->getMedia('attachments')
            ->map(function ($media) {
                return Attachment::fromStorageDisk(
                    $media->disk,
                    $media->getPathRelativeToRoot(),
                )
                    ->as($media->file_name)
                    ->withMime($media->mime_type);
            })
            ->all();
    }
}

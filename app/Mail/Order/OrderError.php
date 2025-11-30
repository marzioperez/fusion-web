<?php

namespace App\Mail\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderError extends Mailable {

    use Queueable, SerializesModels;

    public function __construct(public Order $order, public User $user){
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Order Error',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.order.order-error',
            with: ['order' => $this->order, 'user' => $this->user]
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

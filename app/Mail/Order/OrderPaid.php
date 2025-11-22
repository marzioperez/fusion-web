<?php

namespace App\Mail\Order;

use App\Models\Order;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class OrderPaid extends Mailable {
    use Queueable, SerializesModels;

    public function __construct(public Order $order, public User $user){
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Order successfully paid',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.order.order-paid',
            with: ['order' => $this->order, 'user' => $this->user]
        );
    }

    public function attachments(): array {
        $media_items = $this->order->getMedia('documents');
        return $media_items->map(function (Media $media) {
            return Attachment::fromData(
                fn () => Storage::disk($media->disk)->get($media->getPathRelativeToRoot()),
                $media->file_name
            )->withMime($media->mime_type);
        })->all();
    }
}

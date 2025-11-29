<?php

namespace App\Mail\Report;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScheduleEntryMenusReport extends Mailable {
    use Queueable, SerializesModels;

    public string $file_name;
    public string $file_path;
    public string $from_date;
    public string $to_date;

    public function __construct($from_date, $to_date, $file_path, $file_name) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        $this->file_path = $file_path;
        $this->file_name = $file_name;
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'Schedule menu report',
        );
    }

    public function content(): Content {
        return new Content(
            view: 'mail.report.schedule-entry-menu',
            with: ['from' => $this->from_date, 'to' => $this->to_date]
        );
    }

    public function attachments(): array {
        return [
            Attachment::fromPath($this->file_path)
                ->as($this->file_name)
                ->withMime('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
        ];
    }
}

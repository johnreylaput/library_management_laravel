<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $userName,
        public $itemTitle,
        public $requestType,
        public $status,
        public $dueDate = null,
        public $notes = null
    ) {
    }

    public function envelope(): Envelope
    {
        $subject = match ($this->status) {
            'Approved' => ucfirst($this->requestType) . ' Request Approved',
            'Rejected' => ucfirst($this->requestType) . ' Request Rejected',
            default => ucfirst($this->requestType) . ' Request Update',
        };

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.request-status',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

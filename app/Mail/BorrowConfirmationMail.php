<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public $userName,
        public $itemTitle,
        public $dueDate,
        public $borrowDate,
        public $itemType = 'Book'
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Borrow Confirmation - ' . $this->itemType . ' Borrowed Successfully',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.borrow-confirmation',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

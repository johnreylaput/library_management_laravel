<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BorrowDueMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $userName, public $itemTitle, public $dueDate, public $status)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->status === 'Overdue' ? 'Overdue: Please return your borrowed item' : 'Reminder: Your borrowed item is due soon',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.borrow-due',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

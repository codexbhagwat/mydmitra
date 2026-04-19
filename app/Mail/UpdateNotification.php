<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $updateTitle;
    public string $updateDescription;
    public string $userName;

    public function __construct(string $title, string $description, string $userName)
    {
        $this->updateTitle       = $title;
        $this->updateDescription = $description;
        $this->userName          = $userName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '📢 ' . $this->updateTitle . ' — Mydmitra',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.update-notification',
        );
    }
}
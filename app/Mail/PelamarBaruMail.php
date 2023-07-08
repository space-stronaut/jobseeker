<?php

namespace App\Mail;

use App\Models\Pelamaran;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PelamarBaruMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $title;
    protected $pelamaran;
    /**
     * Create a new message instance.
     */
    public function __construct($title, $pelamaran)
    {
        $this->title = $title;
        $this->pelamaran = $pelamaran;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pelamar Baru Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.pelamar',
            with: [
                'title' => $this->title,
                'pelamaran' => Pelamaran::find($this->pelamaran)
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

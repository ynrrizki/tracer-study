<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AlumniPPMail extends Mailable
{
    use Queueable, SerializesModels;
    public $mailData;
    /**
     * Create a new message instance.
     */
    public function __construct($formData)
    {
        $this->mailData  = $formData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address('yanuarrizki165@gmail.com', 'Tracer Study Prestasi Prima'),
            subject: 'Alumni Prestasi Prima Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $data = $this->mailData;
        return new Content(
            view: 'pages.admin.mail.alumniContact',
            with: [
                'name' => $data['name'],
                'messageForYou' => $data['message'],
            ],
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

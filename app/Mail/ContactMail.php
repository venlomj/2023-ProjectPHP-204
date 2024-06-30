<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /** Create a new message instance. ...*/
    public function __construct($data)
    {
        $this->data = $data;
    }

    /** Get the message envelope. ...*/
    public function envelope()
    {
        return new Envelope(
            from: new Address($this->data['fromEmail'], $this->data['fromName']),
            subject: $this->data['subject'],
        );
    }

    /** Get the message content definition. ...*/
    public function content()
    {
        return new Content(
            markdown: 'emails.contact',
        );
    }

    /** Get the attachments for the message. ...*/
    public function attachments()
    {
        return [];
    }
}


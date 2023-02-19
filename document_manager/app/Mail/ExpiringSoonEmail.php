<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ExpiringSoonEmail extends Mailable
{
    use Queueable, SerializesModels;

    public  $senderEmail;
    public $receiverEmail;
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($senderEmail, $receiverEmail, $message)
    {
        //
        $this->senderEmail = $senderEmail;
        $this->receiverEmail=$receiverEmail;
        $this->message = $message;
    }


    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {

        return new Envelope(
            from: new Address($this->senderEmail),
            replyTo: [
                new Address($this->receiverEmail),
            ],
            subject: 'Expiring Soon Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'emails.expiringsoon',
            with: [
                'recipient' => $this->receiverEmail,
                'message' => $this->message,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

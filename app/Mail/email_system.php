<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class email_system extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // To store the data passed from the controller
    public $emailFrom;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct($emailDataRows, $email_from)
    {
        $this->data = $emailDataRows; // Store the data to use in the email
        $this->emailFrom = $email_from;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mail Maestro', // Set your email subject
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.email_system', // The view that will be used for the email content
            with: [
                'data' => $this->data,
                'email_from' => $this->emailFrom
            ] // Pass data to the email view
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Attach file if exists
        $attachments = [];
        if (isset($this->data['attachment']) && $this->data['attachment']) {
            $attachments[] = \Illuminate\Mail\Mailables\Attachment::fromStorageDisk('public', $this->data['attachment']);
        }

        // dd($attachments);
        return $attachments;
    }
}

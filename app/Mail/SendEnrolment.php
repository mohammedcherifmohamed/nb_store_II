<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEnrolment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
        protected $data;

    public function __construct( $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Course Enrollment',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.enrollment',
            with : [
                "course_title" => $this->data['course_title'],
                  "name" => $this->data['name'],
                  "Familly_name" => $this->data['Familly_name'],
                  "age" => $this->data['age'],
                  "wilaya" => $this->data['wilaya'],
                  "phone" => $this->data['phone'],
                  "notes" => $this->data['notes'],

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

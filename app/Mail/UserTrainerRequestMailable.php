<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\UserTrainerRequest;
use Illuminate\Mail\Mailables\Address;

class UserTrainerRequestMailable extends Mailable
{
    use Queueable, SerializesModels;

    public UserTrainerRequest $userTrainerRequest;

    /**
     * Create a new message instance.
     */
    public function __construct(UserTrainerRequest $userTrainerRequest)
    {
        $this->userTrainerRequest = $userTrainerRequest;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS')),
            subject: __('An user wants you to be his trainer'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.user-trainer-request',
            with: [
                'userTrainerRequest' => $this->userTrainerRequest
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

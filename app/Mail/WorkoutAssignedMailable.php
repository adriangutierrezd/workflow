<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WorkoutAssignedMailable extends Mailable
{
    use Queueable, SerializesModels;


    public User $user;
    public User $trainer;
    public Workout $workout;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, User $trainer, Workout $workout)
    {
        $this->user = $user;
        $this->trainer = $trainer;
        $this->workout = $workout;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(env('MAIL_FROM_ADDRESS'), env('APP_NAME', 'Workflow')),
            subject: __('New workout assigned'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.workout-assigned',
            with: [
                'user' => $this->user,
                'trainer' => $this->trainer,
                'workout' => $this->workout
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

<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RegisterVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: ' [ ' . config('app.name') . ' ] Confirme a criação da sua conta',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $token = $this->user->email . '|' . \Str::random(24);
        return new Content(
            markdown: 'mail.register-verification',
            with: [
                'userFullName' => $this->user->first_name . ' ' . $this->user->last_name,
                'confirmationLink' => config('app.url') . '/confirm-register?token=' . \Str::toBase64($token)
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

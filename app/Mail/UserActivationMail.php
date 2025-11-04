<?php

namespace App\Mail;

use App\Models\Token;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserActivationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private User $user;
    private Token $token;

    public function __construct(User $user, Token $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'User Activation',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.user-activation',
            with: [
                'user' => $this->user,
                'token' => $this->token->token
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

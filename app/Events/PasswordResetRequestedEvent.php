<?php

namespace App\Events;

use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class PasswordResetRequestedEvent
{
    use Dispatchable;

    public string $email;
    public Token $token;

    public function __construct(string $email, Token $token)
    {
        $this->email = $email;
        $this->token = $token;
    }
}

<?php

namespace App\Events;

use App\Models\Token;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class UserInvitedEvent
{
    use Dispatchable;

    public User $user;
    public Token $token;

    public function __construct(User $user, Token $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
}

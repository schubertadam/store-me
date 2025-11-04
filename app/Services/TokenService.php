<?php

namespace App\Services;

use App\Enums\TokenReasonEnum;
use App\Models\Token;
use Illuminate\Support\Str;

class TokenService
{
    public function create(string $email, TokenReasonEnum $reason): Token
    {
        return Token::query()->create([
            'email' => $email,
            'token' => hash_hmac('sha256', Str::random(40), config('app.key')),
            'reason' => $reason->value,
        ]);
    }
}

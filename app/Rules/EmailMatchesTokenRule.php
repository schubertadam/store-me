<?php

namespace App\Rules;

use App\Models\Token;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailMatchesTokenRule implements ValidationRule
{
    protected Token $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value !== $this->token->email) {
            $fail('The provided :attribute does not match the email associated with the token.');
        }
    }
}

<?php

namespace App\Http\Requests;

use App\Models\Token;
use App\Rules\EmailMatchesTokenRule;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var Token $token */
        $token = $this->route('token');

        return [
            'email' => ['required', 'email', new EmailMatchesTokenRule($token)],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function authorize(): bool
    {
        return auth()->guest();
    }
}

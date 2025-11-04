<?php

namespace App\Http\Controllers\Auth;

use App\Enums\TokenReasonEnum;
use App\Events\PasswordResetRequestedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordStoreRequest;
use App\Services\TokenService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ForgotPasswordController extends Controller
{
    private TokenService $tokenService;

    public function __construct(TokenService $tokenService)
    {
        $this->tokenService = $tokenService;
    }

    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(ForgotPasswordStoreRequest $request): RedirectResponse
    {
        $token = $this->tokenService->create($request->validated()['email'], TokenReasonEnum::PASSWORD_RESET);

        event(new PasswordResetRequestedEvent($token->email, $token));

        return redirect()->route('forgot-password.success');
    }

    public function success(): View
    {
        return view('auth.forgot-password-success');
    }
}

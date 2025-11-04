<?php

namespace App\Http\Controllers\Auth;

use App\Enums\TokenReasonEnum;
use App\Events\UserRegisteredEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterStoreRequest;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RegisterController extends Controller
{
    private UserService $userService;
    private TokenService $tokenService;

    public function __construct(UserService $userService, TokenService $tokenService)
    {
        $this->userService = $userService;
        $this->tokenService = $tokenService;
    }

    public function create(): View
    {
        return view('auth.register');
    }

    public function store(RegisterStoreRequest $request): RedirectResponse
    {
        $user = $this->userService->create($request->validated());
        $token = $this->tokenService->create($user->email, TokenReasonEnum::REGISTRATION);

        event(new UserRegisteredEvent($user, $token));

        return redirect()->route('register.success');
    }

    public function success(): View
    {
        return view('auth.register-success');
    }
}

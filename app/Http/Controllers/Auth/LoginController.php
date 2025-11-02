<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LockedOutException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginStoreRequest;
use App\Services\AuthService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function index(): View
    {
        return view('auth.login');
    }

    /**
     * @throws LockedOutException
     */
    public function store(LoginStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $this->authService->login($data['email'], $data['password'], session()->getId());

        return redirect()->intended(route('dashboard'));
    }
}

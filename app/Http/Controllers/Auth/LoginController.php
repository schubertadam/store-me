<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\LockedOutException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginStoreRequest;
use App\Services\AuthService;
use App\Services\CartService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginController extends Controller
{
    private AuthService $authService;
    private CartService $cartService;

    public function __construct(AuthService $authService, CartService $cartService) {
        $this->authService = $authService;
        $this->cartService = $cartService;
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
        $guestSessionId = $request->session()->getId();
        $data = $request->validated();

        $this->authService->login($data['email'], $data['password'], session()->getId());
        $this->cartService->mergeCarts($guestSessionId, auth()->id());

        return redirect()->intended(route('dashboard'));
    }
}

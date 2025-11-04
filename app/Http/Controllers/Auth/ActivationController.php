<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Token;
use App\Services\UserService;
use Illuminate\Contracts\View\View;

class ActivationController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function __invoke(Token $token): View
    {
        $this->userService->activate($token);

        return view('auth.activate');
    }
}

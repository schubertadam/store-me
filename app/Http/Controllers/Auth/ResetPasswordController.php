<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordUpdateRequest;
use App\Models\Token;
use App\Services\UserService;

class ResetPasswordController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function edit(Token $token)
    {
        return view('auth.reset-password', compact('token'));
    }

    public function update(ResetPasswordUpdateRequest $request, Token $token)
    {
        $user = $this->userService->find('email', $token->email);

        $this->userService->update($user, ['password' => $request->validated()['password']]);

        return redirect()->route('admin.login.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Enums\TokenReasonEnum;
use App\Events\UserInvitedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserStoreRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\TokenService;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
    private UserService $userService;
    private TokenService $tokenService;

    public function __construct(UserService $userService, TokenService $tokenService)
    {
        $this->userService = $userService;
        $this->tokenService = $tokenService;
    }

    public function index(): View
    {
        return view('admin.users.index');
    }

    public function create(): View
    {
        $data = $this->prepareFormData();
        $data['user'] = new User();

        return view('admin.users.create', $data);
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $user = $this->userService->create($data);

        if (!isset($data['password'])) {
            $token = $this->tokenService->create($data['email'], TokenReasonEnum::INVITATION);
            event(new UserInvitedEvent($user, $token));
        }

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user): View
    {
        $data = $this->prepareFormData();
        $data['user'] = $user;

        return view('admin.users.edit', $data);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $this->userService->update($user, $request->validated());

        return redirect()->route('admin.users.index');
    }

    private function prepareFormData(): array
    {
        $roles = Role::query()->pluck('name', 'id');

        return [
            'roles' => $roles,
        ];
    }
}

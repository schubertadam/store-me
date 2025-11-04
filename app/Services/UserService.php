<?php

namespace App\Services;

use App\Models\Token;
use App\Models\User;

class UserService
{
    /**
     * Create a new user with the given data
     * @param array $data The user data
     * @return User
     */
    public function create(array $data): User
    {
        return User::query()->create($data);
    }

    public function activate(Token $token): bool
    {
        $user = User::query()->where('email', $token->email)->first();

        return $user->markEmailAsVerified();
    }

    public function find(string $column, mixed $value): ?User
    {
        return User::query()->where($column, $value)->first();
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user;
    }
}

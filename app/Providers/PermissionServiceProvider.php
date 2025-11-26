<?php

namespace App\Providers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        $permissions = Permission::query()->get();

        if ($permissions->count() > 0) {
            $permissions->map(function (Permission $permission) {
                Gate::define($permission->name, function (User $user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        }
    }
}

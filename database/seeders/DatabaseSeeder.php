<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $customer = Role::query()->create(['name' => 'customer']);
        $adminstrator = Role::query()->create(['name' => 'adminstrator']);

        Permission::query()->insert([
            ['group' => 'user', 'name' => 'create-user'],
            ['group' => 'user', 'name' => 'view-user'],
            ['group' => 'user', 'name' => 'edit-user'],
            ['group' => 'user', 'name' => 'delete-user'],

            ['group' => 'category', 'name' => 'create-category'],
            ['group' => 'category', 'name' => 'view-category'],
            ['group' => 'category', 'name' => 'edit-category'],
            ['group' => 'category', 'name' => 'delete-category'],

            ['group' => 'product', 'name' => 'create-product'],
            ['group' => 'product', 'name' => 'view-product'],
            ['group' => 'product', 'name' => 'edit-product'],
            ['group' => 'product', 'name' => 'delete-product'],
        ]);

        foreach (Permission::all() as $permission) {
            $adminstrator->permissions()->attach($permission->id);
        }

        $admin = User::query()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => 'admin',
        ]);

        $admin->roles()->attach($adminstrator->id);
    }
}

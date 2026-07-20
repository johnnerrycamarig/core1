<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::where('name', 'super_admin')->first();

        if (! $role) {
            $role = Role::updateOrCreate(
                ['name' => 'super_admin'],
                ['guard_name' => 'web']
            );
        }

        $user = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Password123!'),
                'mfa_enabled' => false,
            ]
        );

        $user->roles()->syncWithoutDetaching([$role->id]);

        $permissionIds = Permission::pluck('id')->all();

        if (! empty($permissionIds)) {
            $role->permissions()->syncWithoutDetaching($permissionIds);
        }
    }
}

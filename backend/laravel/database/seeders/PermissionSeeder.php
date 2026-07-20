<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view_clients',
            'manage_clients',
            'view_equipment',
            'manage_equipment',
            'view_projects',
            'manage_projects',
            'view_job_orders',
            'manage_job_orders',
            'view_rentals',
            'manage_rentals',
            'view_invoices',
            'manage_invoices',
            'view_quotations',
            'manage_quotations',
            'view_maintenance',
            'manage_maintenance',
            'manage_users',
            'manage_roles',
            'manage_permissions',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission],
                ['guard_name' => 'web']
            );
        }
    }
}

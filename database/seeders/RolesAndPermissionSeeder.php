<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'manage users',
            'manage admins',
            'manage superadmins',
            'manage settings',
            'manage tools',
            'manage apps',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create/update roles and assign permissions
        $superAdminRole = Role::firstOrCreate(['name' => 'superAdmin']);
        $superAdminRole->syncPermissions($permissions);

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions(['manage users', 'manage admins', 'manage settings', 'manage tools', 'manage apps']);

        $userRole = Role::firstOrCreate(['name' => 'user']);

        // Update existing admins
        $admins = User::role('admin')->get();
        foreach ($admins as $admin) {
            $admin->syncRoles('admin');
        }

        // Assign superAdmin to a specific user (e.g., first admin)
        $superAdmin = User::find(1); // Replace with desired user ID
        if ($superAdmin) {
            $superAdmin->syncRoles('superAdmin');
        }
    }
}
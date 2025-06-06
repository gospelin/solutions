<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AssignRolesToExistingUsers extends Migration
{
    public function up(): void
    {
        // Create roles
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);

        // Assign 'user' role to all existing users
        User::all()->each(fn($user) => $user->assignRole('user'));

        // Create or update admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@mrsolution.com.ng'],
            [
                'name' => 'Admin',
                'password' => bcrypt('admin@123'), // Change this
            ]
        );
        $admin->assignRole('admin');
    }

    public function down(): void
    {
        // Check if model_has_roles table exists before detaching roles
        if (Schema::hasTable('model_has_roles')) {
            User::all()->each(fn($user) => $user->roles()->detach());
        }

        // Check if roles table exists before deleting roles
        if (Schema::hasTable('roles')) {
            Role::whereIn('name', ['user', 'admin'])->delete();
        }
    }
}

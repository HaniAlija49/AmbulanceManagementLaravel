<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

       // Create roles
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'doctor']);
        $role3 = Role::create(['name' => 'nurse']);
        $role4 = Role::create(['name' => 'patient']);

        // Create a user
        $user = User::create([
            'personal_number'=> 1234568791234,
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Admin123@'), // secret
        ]);

        // Assign roles to the user
        $user->assignRole('admin');
    }
}

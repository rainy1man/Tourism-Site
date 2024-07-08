<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create user role and assign permissions to this
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo([
        ]);

        // Create admin role and assign permissions to this
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
        ]);

        // Create super_admin role and assign permissions to this
        $super_admin = Role::create(['name' => 'super_admin']);
        $super_admin->givePermissionTo([
        ]);

        // Create a super_admin user
        $super_admin = User::create([
            'first_name' => 'super',
            'last_name' => 'admin',
            'phone_number' => '09127654321',
            'email' => 'example@gmail.com',
            'password' => '11aaAA@@'
        ]);

        // Assign super_admin role to the new user
        $super_admin->assignRole('super_admin');

    }
}

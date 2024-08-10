<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User Permissions
        Permission::create(['name' => 'see.user']);
        Permission::create(['name' => 'create.user']);
        Permission::create(['name' => 'update.user']);
        Permission::create(['name' => 'delete.user']);

        // Tour Permissions
        Permission::create(['name' => 'create.tour']);
        Permission::create(['name' => 'update.tour']);
        Permission::create(['name' => 'delete.tour']);

        // Trip Permissions
        Permission::create(['name' => 'create.trip']);
        Permission::create(['name' => 'update.trip']);
        Permission::create(['name' => 'delete.trip']);

        // Passenger Permissions
        Permission::create(['name' => 'see.passenger']);
        Permission::create(['name' => 'create.passenger']);
        Permission::create(['name' => 'update.passenger']);
        Permission::create(['name' => 'delete.passenger']);

        // Order Permissions
        Permission::create(['name' => 'see.order']);
        Permission::create(['name' => 'create.order']);
        Permission::create(['name' => 'update.order']);
        Permission::create(['name' => 'delete.order']);

        // Comment Permissions
        Permission::create(['name' => 'see.comment']);
        Permission::create(['name' => 'create.comment']);
        Permission::create(['name' => 'update.comment']);
        Permission::create(['name' => 'delete.comment']);

        // Score Permissions
        Permission::create(['name' => 'see.score']);
        Permission::create(['name' => 'create.score']);
        Permission::create(['name' => 'update.score']);
        Permission::create(['name' => 'delete.score']);

        // Favorite Permissions
        Permission::create(['name' => 'see.favorite']);
        Permission::create(['name' => 'create.favorite']);
        Permission::create(['name' => 'update.favorite']);
        Permission::create(['name' => 'delete.favorite']);

        // Refund Permissions
        Permission::create(['name' => 'see.refund']);
        Permission::create(['name' => 'create.refund']);
        Permission::create(['name' => 'update.refund']);
        Permission::create(['name' => 'delete.refund']);

        // Role Permissions
        Permission::create(['name' => 'see.role']);
        Permission::create(['name' => 'create.role']);
        Permission::create(['name' => 'update.role']);
        Permission::create(['name' => 'delete.role']);

        // Setting Permissions
        Permission::create(['name' => 'create.setting']);
        Permission::create(['name' => 'update.setting']);
        Permission::create(['name' => 'delete.setting']);

        // FAQ Permissions
        Permission::create(['name' => 'create.FAQ']);
        Permission::create(['name' => 'update.FAQ']);
        Permission::create(['name' => 'delete.FAQ']);

        // Media Permissions
        Permission::create(['name' => 'create.media']);
        Permission::create(['name' => 'delete.media']);
    }
}

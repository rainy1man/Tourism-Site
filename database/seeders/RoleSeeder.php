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
            'see.user',
            'see.passenger',
            'create.passenger',
            'update.passenger',
            'delete.passenger',
            'see.order',
            'create.order',
            'update.order',
            'delete.order',
            'see.comment',
            'create.comment',
            'update.comment',
            'delete.comment',
            'see.score',
            'create.score',
            'update.score',
            'delete.score',
            'see.favorite',
            'create.favorite',
            'update.favorite',
            'delete.favorite',
            'see.refund',
            'create.refund',
            'update.refund',
            'delete.refund',
        ]);

        // Create admin role and assign permissions to this
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo([
            'see.user',
            'create.user',
            'update.user',
            'delete.user',
            'create.trip',
            'update.trip',
            'delete.trip',
            'see.passenger',
            'create.passenger',
            'update.passenger',
            'delete.passenger',
            'see.order',
            'create.order',
            'update.order',
            'delete.order',
            'see.comment',
            'create.comment',
            'update.comment',
            'delete.comment',
            'see.score',
            'create.score',
            'update.score',
            'delete.score',
            'see.favorite',
            'create.favorite',
            'update.favorite',
            'delete.favorite',
            'create.tour',
            'update.tour',
            'delete.tour',
            'see.refund',
            'create.refund',
            'update.refund',
            'delete.refund',
            'create.FAQ',
            'update.FAQ',
            'delete.FAQ',
            'create.media',
            'delete.media',
        ]);

        // Create super_admin role and assign permissions to this
        $super_admin = Role::create(['name' => 'super_admin']);
        $super_admin->givePermissionTo([
            'see.user',
            'create.user',
            'update.user',
            'delete.user',
            'create.trip',
            'update.trip',
            'delete.trip',
            'see.passenger',
            'create.passenger',
            'update.passenger',
            'delete.passenger',
            'see.order',
            'create.order',
            'update.order',
            'delete.order',
            'see.comment',
            'create.comment',
            'update.comment',
            'delete.comment',
            'see.score',
            'create.score',
            'update.score',
            'delete.score',
            'see.favorite',
            'create.favorite',
            'update.favorite',
            'delete.favorite',
            'create.tour',
            'update.tour',
            'delete.tour',
            'see.refund',
            'create.refund',
            'update.refund',
            'delete.refund',
            'create.setting',
            'update.setting',
            'delete.setting',
            'create.FAQ',
            'update.FAQ',
            'delete.FAQ',
            'create.media',
            'delete.media',
            'see.role',
            'create.role',
            'update.role',
            'delete.role',
        ]);

        // Create a super_admin user
        $super_admin1 = User::create([
            'first_name' => 'محمد',
            'last_name' => 'مختاری',
            'phone_number' => '9390071638',
            'email' => 'mohammad@gmail.com',
            'password' => 'Momo1275'
        ]);

        // Assign super_admin role to the new user
        $super_admin1->assignRole('super_admin');

        // Create a super_admin user
        $super_admin2 = User::create([
            'first_name' => 'محمد امین',
            'last_name' => 'قهرمانی',
            'phone_number' => '9940362007',
            'email' => 'mohammadamin@gmail.com',
            'password' => 'Amin1234'
        ]);

        // Assign super_admin role to the new user
        $super_admin2->assignRole('super_admin');

        // Create a super_admin user
        $super_admin3 = User::create([
            'first_name' => 'ریحانه',
            'last_name' => 'کیان',
            'phone_number' => '9190365836',
            'email' => 'reyhaneh@gmail.com',
            'password' => 'Reyhaneh1234'
        ]);

        // Assign super_admin role to the new user
        $super_admin3->assignRole('super_admin');

        // Create a super_admin user
        $super_admin4 = User::create([
            'first_name' => 'مهتاب',
            'last_name' => 'خجیر',
            'phone_number' => '9225407221',
            'email' => 'mahtab@gmail.com',
            'password' => 'Mahtab1234'
        ]);

        // Assign super_admin role to the new user
        $super_admin4->assignRole('super_admin');

    }
}

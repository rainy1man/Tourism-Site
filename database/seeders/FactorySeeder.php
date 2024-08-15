<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Passenger;
use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 user and 2 passenger for each one
        for ($x = 1; $x <= 20; $x++) {
            $user = User::factory()->create();
            $user->assignRole('user');
            Passenger::factory(2)->for($user)->create();
        }
    }
}

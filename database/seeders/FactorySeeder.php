<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Passenger;
use App\Models\Tour;
use App\Models\Trip;
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
        // Create 50 user and 5 passenger for each user
        for ($x = 1; $x <= 50; $x++) {
            $user = User::factory()->create();
            $user->assignRole('user');
            Passenger::factory(5)->for($user)->create();
        }

        // Create 50 Tour with random city and 5 trip for each tour
        for ($x = 1; $x <= 50; $x++) {
            $city = City::find(1);
            $tour = Tour::factory()->for($city)->create();
            Trip::factory(5)->for($tour)->create();
        }


    }
}

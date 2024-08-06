<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => round(fake()->numberBetween(500000, 32000000), -4),
            'capacity' => round(fake()->numberBetween(50, 100), -1),
            'start_at' => fake()->dateTimeBetween('2024-08-12', '2024-08-20'),
            'end_at' => fake()->dateTimeBetween('2024-08-21', '2024-08-26'),
            'meal' => fake()->randomElement(['BB', 'HB', 'FB', 'AI'])
        ];
    }
}

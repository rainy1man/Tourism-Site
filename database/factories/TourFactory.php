<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->city(),
            'description' => fake()->text(25),
            'transport' => fake()->randomElement(['airplane', 'train', 'bus']),
            'stay_class' => fake()->randomElement(['hotel first class', 'hotel economy', 'hotel apartment', 'suit', 'cabin', 'tent']),
            'details' => [
                'services' => fake()->text(50),
                'stay_details' => fake()->text(50),
                'documents' => fake()->text(50),
                'rules' => fake()->text(50),
            ]
        ];
    }
}

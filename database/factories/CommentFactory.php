<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'text' => fake()->randomElement(['خیلی خوب بود', 'خوب بود', 'بد نبود', 'افتضاح بود', 'خیلی افتضاح بود']),
            'user_id' => fake()->numberBetween(1,25),
            'tour_id' => fake()->numberBetween(1, 13),
            'score' => fake()->numberBetween(1, 5),
            'visibility' => fake()->randomElement(['pending','approved','rejected']),
        ];
    }
}

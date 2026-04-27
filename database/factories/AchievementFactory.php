<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'achievement_name' => fake()->sentence(),
            'achievement_price' => fake()->numberBetween(10000, 100000),
            'achievement_description' => fake()->sentence(),
            'competition_id' => Competition::factory(),
        ];
    }
}

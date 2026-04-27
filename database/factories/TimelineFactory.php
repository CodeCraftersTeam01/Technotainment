<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeline>
 */
class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'timeline_name' => fake()->sentence(),
            'timeline_description' => fake()->sentence(),
            'timeline_start' => fake()->date(),
            'timeline_end' => fake()->date(),
            'competition_id' => Competition::factory(),
        ];
    }
}

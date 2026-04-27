<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Competition>
 */
class CompetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'competition_type' => fake()->randomElement(['E-Sports', 'Non-E-Sports']),
            'slug' => fake()->slug(),
            'competition_name' => fake()->company(),
            'competition_end_date' => fake()->date(),
            'competition_logo' => 'competition-logos/aFNBQbhAYKSPuZ7mRufIbxPvujFgamWSedY4FXKi.png',
            'competition_second_logo' => 'competition-logos/aFNBQbhAYKSPuZ7mRufIbxPvujFgamWSedY4FXKi.png',
            'competition_third_logo' => 'competition-logos/aFNBQbhAYKSPuZ7mRufIbxPvujFgamWSedY4FXKi.png',
            'competition_guide_book' => 'competition-guide-books/2TFAqAEnCvoyi9V8XbrXUrk7xpVJMRJ0QKgECF5u.pdf',
            'competition_instance_level' => 'SMA/SMK Sederajat',
            'competition_description' => fake()->sentence(),
            'competition_information' => fake()->sentence(),
            'competition_fee' => 50000,
            'event_id' => null,
        ];
    }
}

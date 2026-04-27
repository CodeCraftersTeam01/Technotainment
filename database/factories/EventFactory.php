<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_name' => 'Technotainment',
            'event_logo' => 'event-logos/6HJ5kX8lPgXkaCdIYdXW8fOOvmAJmObDYDvXdOhA.jpg',
            'event_theme' => 'Unleash Your Innovation in Technology and Entertainment',
            'event_about' => fake()->sentence(),
            'event_description' => fake()->sentence(),
            'event_year' => '2025',
            'event_status' => 'active',
        ];
    }
}

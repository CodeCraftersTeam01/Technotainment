<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sponsor>
 */
class SponsorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sponsor_name' => $this->faker->company(),
            'sponsor_logo' => 'media-partner-logos/kZEA7GndjO6qOVsFklrUl2J4HfS2EadM6rcDRrfR.png',
            'event_id' => Event::factory(),
        ];
    }
}

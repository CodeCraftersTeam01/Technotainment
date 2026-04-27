<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'team_name' => fake()->name(),
            'team_token' => fake()->uuid(),
            'team_logo' => fake()->imageUrl(),
            'team_email' => fake()->email(),
            'team_contact' => fake()->phoneNumber(),
            'team_instance' => fake()->randomElement(['YES', 'NO']),
            'team_instance_name' => fake()->company(),
            'competition_id' => Competition::factory(),
            'team_invoice' => fake()->imageUrl(),
            'team_invoice_status' => fake()->randomElement(['decline', 'pending', 'accept']),
        ];
    }
}

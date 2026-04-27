<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MemberTeam>
 */
class MemberTeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_team_name' => fake()->name(),
            'member_team_identity' => fake()->imageUrl(),
            'member_team_role' => fake()->randomElement(['Leader', 'Member', 'backup']),
            'team_id' => Team::factory(),
        ];
    }
}

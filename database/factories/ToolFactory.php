<?php

namespace Database\Factories;

use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tool>
 */
class ToolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Generate a sample name for the tool.
            'name' => fake()->sentence(),
            // Generate seven paragraphs describing the tool.
            'description' => fake()->paragraphs(7, true),
            // Create a user if the caller does not supply an existing user_id.
            'user_id' => User::factory(),
            // Randomly make the sample tool public or private.
            'is_public' => fake()->boolean(),
        ];
    }
}

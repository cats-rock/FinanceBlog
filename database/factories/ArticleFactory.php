<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // These values are used whenever an Article is created through its factory.
        return [
            // Faker creates realistic sample text so articles do not need to be entered manually.
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            // This is a fallback: create an author if the caller does not provide an existing user ID.
            'author_id' => User::factory(),
            // A generated article is randomly public (true) or private (false).
            'is_public' => fake()->boolean(),
        ];
    }
}

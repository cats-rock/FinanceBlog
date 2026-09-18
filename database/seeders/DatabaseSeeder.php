<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create the single blog user first so every sample article has a valid author.
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Generate ten articles and override the factory's fallback author.
        // Reusing this ID makes all ten articles belong to the same user.
        Article::factory(10)->create([
            'author_id' => $user->id,
        ]);
    }
}

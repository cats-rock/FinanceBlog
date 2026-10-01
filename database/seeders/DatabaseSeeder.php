<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
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
        // Create the project's known administrator explicitly instead of assigning admin status randomly.
        // This user is also the only article author during the current project stage.
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => true,
        ]);

        // Override the factory's fallback author so all sample articles belong to the known administrator.
        Article::factory(10)->create([
            'author_id' => $user->id,
        ]);

        // Create five standalone Tags; Article relationships are added in the next commit.
        Tag::factory(5)->create();
    }
}

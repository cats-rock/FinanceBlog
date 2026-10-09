<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Tool;
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

        // Create ten sample Articles owned by the known administrator.
        // Store the resulting collection so Tags can be attached to each Article.
        $articles = Article::factory(10)->create([
            'author_id' => $user->id,
        ]);

        // Seed the real calculator with its stable key so fresh databases can display it.
        Tool::create([
            'name' => 'Savings Rate Calculator',
            'description' => 'Calculate your monthly income, expenses, savings, and savings rate. Include employer contributions to see total savings alongside the cash remaining after expenses.',
            'user_id' => $user->id,
            'calculator_key' => 'savings-rate',
            'is_public' => true,
        ]);

        // Keep five Tools in total: the real calculator and four sample records.
        Tool::factory(4)->create([
            'user_id' => $user->id,
        ]);

        // Create five Tags that can be shared by the sample Articles.
        Tag::factory(5)->create();

        // Attach between zero and three random Tags to every Article.
        foreach ($articles as $article) {
            $article->tags()->attach(
                Tag::inRandomOrder()
                    ->take(rand(0, 3))
                    ->pluck('id')
            );
        }
    }
}

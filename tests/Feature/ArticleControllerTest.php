<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Rebuild the test database for each test so records never leak between tests.
uses(RefreshDatabase::class);

it('lists public articles on the index page with their author name', function () {
    // Arrange: create a known author and an explicitly public article.
    $user = User::factory()->create([
        'name' => 'John Doe',
    ]);

    Article::factory()->create([
        'title' => 'Public Article',
        'author_id' => $user->id,
        'is_public' => true,
    ]);

    // Act: request the same public article index that a visitor opens.
    $response = $this->get('/articles');

    // Assert: the page loads and displays both the public title and related author.
    $response->assertStatus(200);
    $response->assertSee('Public Article');
    $response->assertSee('by John Doe');
});

it('does not list private articles on the public index page', function () {
    // Arrange: create an article that the controller's public query must exclude.
    Article::factory()->create([
        'title' => 'Private Article',
        'is_public' => false,
    ]);

    // Act: request the public article index.
    $response = $this->get('/articles');

    // Assert: the page loads, but the private title is not present in its HTML.
    $response->assertStatus(200);
    $response->assertDontSee('Private Article');
});

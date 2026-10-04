<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists only authors with public articles and counts only public articles', function () {
    // Arrange: one public author and one User whose only Article is private.
    $author = User::factory()->create(['name' => 'John Doe']);
    $privateUser = User::factory()->create(['name' => 'Jane Private']);

    Article::factory()->create([
        'author_id' => $author->id,
        'is_public' => true,
    ]);
    Article::factory()->create([
        'author_id' => $author->id,
        'is_public' => false,
    ]);
    Article::factory()->create([
        'author_id' => $privateUser->id,
        'is_public' => false,
    ]);

    // Act: open the public Authors overview.
    $response = $this->get(route('authors.index'));

    // Assert: only the public author and public count are visible.
    $response->assertOk();
    $response->assertSee('John Doe');
    $response->assertSee('1 article');
    $response->assertDontSee('Jane Private');
});

it('shows an author with only their public articles', function () {
    // Arrange: give the same author one public and one private Article.
    $author = User::factory()->create(['name' => 'John Doe']);

    $publicArticle = Article::factory()->create([
        'title' => 'Public Finance Guide',
        'author_id' => $author->id,
        'is_public' => true,
    ]);
    Article::factory()->create([
        'title' => 'Private Finance Draft',
        'author_id' => $author->id,
        'is_public' => false,
    ]);

    // Act: open that User's public Author page.
    $response = $this->get(route('authors.show', $author));

    // Assert: the private title is not exposed.
    $response->assertOk();
    $response->assertSee('John Doe');
    $response->assertSee('1 article');
    $response->assertSee('Public Finance Guide');
    $response->assertDontSee('Private Finance Draft');
    $response->assertSee(route('articles.show', $publicArticle), escape: false);
});

it('returns a 404 when a user has no public articles', function () {
    $user = User::factory()->create();

    Article::factory()->create([
        'author_id' => $user->id,
        'is_public' => false,
    ]);

    $this->get(route('authors.show', $user))->assertNotFound();
});

it('returns a 404 for an unknown author', function () {
    $this->get(route('authors.show', 999))->assertNotFound();
});

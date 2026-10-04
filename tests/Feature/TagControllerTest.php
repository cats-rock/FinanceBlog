<?php

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists tags and counts only their public articles', function () {
    // Arrange: one used Tag and one valid Tag with no related Articles.
    $tag = Tag::factory()->create(['name' => 'Budgeting']);
    Tag::factory()->create(['name' => 'Unused Tag']);

    $publicArticle = Article::factory()->create(['is_public' => true]);
    $privateArticle = Article::factory()->create(['is_public' => false]);

    $publicArticle->tags()->attach($tag);
    $privateArticle->tags()->attach($tag);

    // Act: open the public Tags overview.
    $response = $this->get(route('tags.index'));

    // Assert: every Tag appears, but its count includes only public Articles.
    $response->assertOk();
    $response->assertSee('Budgeting');
    $response->assertSee('1 article');
    $response->assertSee('Unused Tag');
    $response->assertSee('0 articles');
});

it('shows a tag with only its public articles and their authors', function () {
    // Arrange: attach one public and one private Article to the same Tag.
    $tag = Tag::factory()->create(['name' => 'Investing']);
    $author = User::factory()->create(['name' => 'John Doe']);

    $publicArticle = Article::factory()->create([
        'title' => 'Public Investing Guide',
        'author_id' => $author->id,
        'is_public' => true,
    ]);
    $privateArticle = Article::factory()->create([
        'title' => 'Private Investing Draft',
        'author_id' => $author->id,
        'is_public' => false,
    ]);

    $publicArticle->tags()->attach($tag);
    $privateArticle->tags()->attach($tag);

    // Act: open the selected Tag's public detail page.
    $response = $this->get(route('tags.show', $tag));

    // Assert: only the public Article and its navigation links are visible.
    $response->assertOk();
    $response->assertSee('Investing');
    $response->assertSee('1 article');
    $response->assertSee('Public Investing Guide');
    $response->assertDontSee('Private Investing Draft');
    $response->assertSee('by John Doe');
    $response->assertSee(route('articles.show', $publicArticle), escape: false);
    $response->assertSee(route('authors.show', $author), escape: false);
});

it('shows a valid empty state for a tag without public articles', function () {
    $tag = Tag::factory()->create(['name' => 'Saving']);

    $response = $this->get(route('tags.show', $tag));

    $response->assertOk();
    $response->assertSee('0 articles');
    $response->assertSee('No public Articles use this Tag yet.');
});

it('returns a 404 for an unknown tag', function () {
    $this->get(route('tags.show', 999))->assertNotFound();
});

<?php

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// Rebuild the test database before each test so every scenario starts clean.
uses(RefreshDatabase::class);

it('shows the available tags on the create article form', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create(['name' => 'Investing']);

    $response = $this->actingAs($user)
        ->get(route('admin.articles.create'));

    $response->assertOk();
    $response->assertSee('Investing');
    $response->assertSee('value="'.$tag->id.'"', escape: false);
});

it('shows the available authors and current author on the edit article form', function () {
    $author = User::factory()->create(['name' => 'Current Author']);
    $otherAuthor = User::factory()->create(['name' => 'Other Author']);
    $article = Article::factory()->create(['author_id' => $author->id]);

    $response = $this->actingAs($author)
        ->get(route('admin.articles.edit', $article));

    $response->assertOk();
    $response->assertSee('Current Author');
    $response->assertSee('Other Author');
    $response->assertSeeInOrder(['value="'.$author->id.'"', 'selected'], escape: false);
});

it('attaches the selected tags when an article is created', function () {
    $user = User::factory()->create();
    $selectedTag = Tag::factory()->create();
    $unselectedTag = Tag::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.articles.store'), [
            'title' => 'Saving for the future',
            'content' => 'Article content',
            'author_id' => $user->id,
            'tags' => [$selectedTag->id],
        ]);

    $article = Article::where('title', 'Saving for the future')->firstOrFail();

    $response->assertRedirect(route('admin.articles.index'));
    $this->assertDatabaseHas('article_tag', [
        'article_id' => $article->id,
        'tag_id' => $selectedTag->id,
    ]);
    $this->assertDatabaseMissing('article_tag', [
        'article_id' => $article->id,
        'tag_id' => $unselectedTag->id,
    ]);
});

it("replaces an article's tags with the selections from the edit form", function () {
    $user = User::factory()->create();
    $article = Article::factory()->create(['author_id' => $user->id]);
    $oldTag = Tag::factory()->create();
    $newTag = Tag::factory()->create();
    $article->tags()->attach($oldTag);

    $response = $this->actingAs($user)
        ->put(route('admin.articles.update', $article), [
            'title' => 'Updated title',
            'content' => 'Updated content',
            'author_id' => $user->id,
            'tags' => [$newTag->id],
        ]);

    $response->assertRedirect(route('admin.articles.index'));
    $this->assertDatabaseHas('article_tag', [
        'article_id' => $article->id,
        'tag_id' => $newTag->id,
    ]);
    $this->assertDatabaseMissing('article_tag', [
        'article_id' => $article->id,
        'tag_id' => $oldTag->id,
    ]);
});

it('removes all tag relationships when no tags are selected', function () {
    $user = User::factory()->create();
    $article = Article::factory()->create(['author_id' => $user->id]);
    $article->tags()->attach(Tag::factory()->create());

    $response = $this->actingAs($user)
        ->put(route('admin.articles.update', $article), [
            'title' => 'Article without tags',
            'content' => 'Updated content',
            'author_id' => $user->id,
        ]);

    $response->assertRedirect(route('admin.articles.index'));
    expect($article->tags()->count())->toBe(0);
});

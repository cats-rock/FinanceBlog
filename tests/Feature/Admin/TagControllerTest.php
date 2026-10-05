<?php

use App\Models\Article;
use App\Models\Tag;
use App\Models\User;

it('lists tags on the admin index page', function () {
    $user = User::factory()->create();
    Tag::factory()->create(['name' => 'Investing']);

    $response = $this->actingAs($user)
        ->get(route('admin.tags.index'));

    $response->assertOk();
    $response->assertSee('Investing');
});

it('creates a tag', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.tags.store'), [
            'name' => 'Investing',
        ]);

    $response->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseHas('tags', ['name' => 'Investing']);
});

it('validates the name when creating a tag', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('admin.tags.store'), [
            'name' => '',
        ]);

    $response->assertSessionHasErrors('name');
    $this->assertDatabaseCount('tags', 0);
});

it('rejects a duplicate tag name when creating a tag', function () {
    $user = User::factory()->create();
    Tag::factory()->create(['name' => 'Investing']);

    $response = $this->actingAs($user)
        ->post(route('admin.tags.store'), [
            'name' => 'Investing',
        ]);

    $response->assertSessionHasErrors('name');
    $this->assertDatabaseCount('tags', 1);
});

it('updates a tag', function () {
    $user = User::factory()->create();
    $tag = Tag::factory()->create(['name' => 'Old Name']);

    $response = $this->actingAs($user)
        ->put(route('admin.tags.update', $tag), [
            'name' => 'New Name',
        ]);

    $response->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => 'New Name',
    ]);
});

it('rejects renaming a tag to another existing tag name', function () {
    $user = User::factory()->create();
    Tag::factory()->create(['name' => 'Investing']);
    $tag = Tag::factory()->create(['name' => 'Saving']);

    $response = $this->actingAs($user)
        ->put(route('admin.tags.update', $tag), [
            'name' => 'Investing',
        ]);

    $response->assertSessionHasErrors('name');
    $this->assertDatabaseHas('tags', [
        'id' => $tag->id,
        'name' => 'Saving',
    ]);
});

it('deletes a tag and its article connections', function () {
    $user = User::factory()->create();
    $article = Article::factory()->create(['author_id' => $user->id]);
    $tag = Tag::factory()->create();
    $article->tags()->attach($tag);

    // Confirm the pivot relationship exists before testing its cleanup.
    $this->assertDatabaseHas('article_tag', [
        'article_id' => $article->id,
        'tag_id' => $tag->id,
    ]);

    $response = $this->actingAs($user)
        ->delete(route('admin.tags.destroy', $tag));

    $response->assertRedirect(route('admin.tags.index'));
    $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    $this->assertDatabaseMissing('article_tag', [
        'article_id' => $article->id,
        'tag_id' => $tag->id,
    ]);
});

it('requires authentication to manage tags', function () {
    $this->get(route('admin.tags.index'))
        ->assertRedirect(route('login'));
});

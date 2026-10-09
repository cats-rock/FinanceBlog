<?php

use App\Models\Tool;
use App\Models\User;

it('shows the saved Tool values to an administrator', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $tool = Tool::factory()->for($admin)->create([
        'name' => 'Savings Rate Calculator',
        'description' => 'Compare monthly income and expenses.',
        'is_public' => true,
    ]);

    $response = $this->actingAs($admin)->get(route('admin.tools.edit', $tool));

    $response->assertOk();
    $response->assertViewIs('admin.tools.edit');
    $response->assertViewHas('tool', fn (Tool $selected) => $selected->is($tool));
    $response->assertSee('Savings Rate Calculator');
    $response->assertSee('Compare monthly income and expenses.');
    $response->assertSee('Save changes');
});

it('updates Tool details and visibility without changing its owner or calculator', function (string $visibility) {
    $admin = User::factory()->create(['is_admin' => true]);
    $otherUser = User::factory()->create();
    $tool = Tool::factory()->for($admin)->create([
        'calculator_key' => 'savings-rate',
        'is_public' => ! (bool) $visibility,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.tools.update', $tool), [
        'name' => 'Updated calculator',
        'description' => 'Updated instructions.',
        'is_public' => $visibility,
        'user_id' => $otherUser->id,
        'calculator_key' => 'unexpected-calculator',
    ]);

    $response->assertRedirect(route('admin.tools.index'));
    $response->assertSessionHasNoErrors();
    $this->assertDatabaseHas('tools', [
        'id' => $tool->id,
        'name' => 'Updated calculator',
        'description' => 'Updated instructions.',
        'is_public' => (int) $visibility,
        'user_id' => $admin->id,
        'calculator_key' => 'savings-rate',
    ]);
})->with(['private' => '0', 'public' => '1']);

it('redirects guests to login before editing or updating a Tool', function (string $method, string $routeName) {
    $tool = Tool::factory()->create(['name' => 'Original name']);

    $response = $this->{$method}(route($routeName, $tool), [
        'name' => 'Unauthorized change',
        'description' => 'Changed description.',
        'is_public' => '1',
    ]);

    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('tools', ['id' => $tool->id, 'name' => 'Original name']);
})->with([
    'edit' => ['get', 'admin.tools.edit'],
    'update' => ['put', 'admin.tools.update'],
]);

it('forbids regular users from editing or updating a Tool', function (string $method, string $routeName) {
    $user = User::factory()->create(['is_admin' => false]);
    $tool = Tool::factory()->for($user)->create(['name' => 'Original name']);

    $response = $this->actingAs($user)->{$method}(route($routeName, $tool), [
        'name' => 'Unauthorized change',
        'description' => 'Changed description.',
        'is_public' => '1',
    ]);

    $response->assertForbidden();
    $this->assertDatabaseHas('tools', ['id' => $tool->id, 'name' => 'Original name']);
})->with([
    'edit' => ['get', 'admin.tools.edit'],
    'update' => ['put', 'admin.tools.update'],
]);

it('requires all editable fields without saving partial changes', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $tool = Tool::factory()->for($admin)->create(['name' => 'Original name']);

    $response = $this->actingAs($admin)
        ->from(route('admin.tools.edit', $tool))
        ->put(route('admin.tools.update', $tool), []);

    $response->assertRedirect(route('admin.tools.edit', $tool));
    $response->assertSessionHasErrors([
        'name' => 'The name field is required.',
        'description' => 'The description field is required.',
        'is_public' => 'The is public field is required.',
    ]);
    $this->assertDatabaseHas('tools', ['id' => $tool->id, 'name' => 'Original name']);
});

it('rejects invalid Tool details and keeps the saved record', function (string $field, mixed $value, string $message) {
    $admin = User::factory()->create(['is_admin' => true]);
    $tool = Tool::factory()->for($admin)->create([
        'name' => 'Original name',
        'description' => 'Original description.',
        'is_public' => false,
    ]);
    $payload = [
        'name' => 'Changed name',
        'description' => 'Changed description.',
        'is_public' => '1',
        $field => $value,
    ];

    $response = $this->actingAs($admin)
        ->from(route('admin.tools.edit', $tool))
        ->put(route('admin.tools.update', $tool), $payload);

    $response->assertRedirect(route('admin.tools.edit', $tool));
    $response->assertSessionHasErrors([$field => $message]);
    $this->assertDatabaseHas('tools', [
        'id' => $tool->id,
        'name' => 'Original name',
        'description' => 'Original description.',
        'is_public' => false,
    ]);
})->with([
    'name type' => ['name', ['invalid'], 'The name field must be a string.'],
    'name length' => ['name', str_repeat('a', 256), 'The name field must not be greater than 255 characters.'],
    'description type' => ['description', ['invalid'], 'The description field must be a string.'],
    'visibility value' => ['is_public', '2', 'The is public field must be true or false.'],
]);

it('returns 404 when the requested Tool does not exist', function (string $method, string $routeName) {
    $admin = User::factory()->create(['is_admin' => true]);

    $response = $this->actingAs($admin)->{$method}(route($routeName, 999), [
        'name' => 'Changed name',
        'description' => 'Changed description.',
        'is_public' => '1',
    ]);

    $response->assertNotFound();
    $this->assertDatabaseCount('tools', 0);
})->with([
    'edit' => ['get', 'admin.tools.edit'],
    'update' => ['put', 'admin.tools.update'],
    'delete' => ['delete', 'admin.tools.destroy'],
]);

it('shows editing links and protected deletion forms for public and private Tools', function () {
    $admin = User::factory()->create(['is_admin' => true]);
    $publicTool = Tool::factory()->for($admin)->create(['name' => 'Public calculator', 'is_public' => true]);
    $privateTool = Tool::factory()->for($admin)->create(['name' => 'Private calculator', 'is_public' => false]);

    $response = $this->actingAs($admin)->get(route('admin.tools.index'));

    $response->assertOk();
    $response->assertSee('Public calculator');
    $response->assertSee('Private calculator');
    $response->assertSee('href="'.route('admin.tools.edit', $publicTool).'"', false);
    $response->assertSee('href="'.route('admin.tools.edit', $privateTool).'"', false);
    $response->assertSee('action="'.route('admin.tools.destroy', $publicTool).'"', false);
    $response->assertSee('action="'.route('admin.tools.destroy', $privateTool).'"', false);
    $response->assertSee('name="_method" value="DELETE"', false);
    $response->assertSee('name="_token"', false);
});

it('deletes only the selected Tool and keeps its owner and other Tools', function (bool $isPublic) {
    $admin = User::factory()->create(['is_admin' => true]);
    $owner = User::factory()->create();
    $tool = Tool::factory()->for($owner)->create([
        'is_public' => $isPublic,
        'calculator_key' => 'savings-rate',
    ]);
    $otherTool = Tool::factory()->for($owner)->create();

    $response = $this->actingAs($admin)->delete(route('admin.tools.destroy', $tool));

    $response->assertRedirect(route('admin.tools.index'));
    $this->assertModelMissing($tool);
    $this->assertModelExists($owner);
    $this->assertModelExists($otherTool);
    $this->get(route('tools.show', $tool))->assertNotFound();
})->with(['public' => true, 'private' => false]);

it('redirects guests to login without deleting the Tool', function () {
    $tool = Tool::factory()->create();

    $response = $this->delete(route('admin.tools.destroy', $tool));

    $response->assertRedirect(route('login'));
    $this->assertModelExists($tool);
});

it('forbids regular users from deleting even their own Tool', function () {
    $user = User::factory()->create(['is_admin' => false]);
    $tool = Tool::factory()->for($user)->create();

    $response = $this->actingAs($user)->delete(route('admin.tools.destroy', $tool));

    $response->assertForbidden();
    $this->assertModelExists($tool);
});

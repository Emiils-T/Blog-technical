<?php

use App\Models\User;

test('create post', function () {

    $user = User::factory()->create();
    $this->actingAs($user);

    $response = $this->post('posts/store', [
        'title' => 'title',
        'body' => 'body',
        'author_name' => $user->name,
    ]);
    $this->assertDatabaseHas('posts',[
        'title' => 'title',
        'body' => 'body',
        'author_name' => $user->name,
    ]);
    $response->assertStatus(302);
});

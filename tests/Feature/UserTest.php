<?php

use App\Models\User;

it('allows admin to create a user', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $this->actingAs($admin);

    $response = $this->postJson('/api/users', [
        'name' => 'New User',
        'email' => 'newuser@example.com',
        'password' => '12345678',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('users', ['email' => 'newuser@example.com']);
});

it('prevents non-admin user from creating another user', function () {
    $user = User::factory()->create()->assignRole('User');
    $this->actingAs($user);

    $response = $this->postJson('/api/users', [
        'name' => 'Attempted User',
        'email' => 'attempteduser@example.com',
        'password' => '12345678',
    ]);

    $response->assertStatus(403);
});

it('allows admin to update a user', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $user = User::factory()->create();

    $this->actingAs($admin);
    $response = $this->putJson("/api/users/{$user->id}", [
        'name' => 'Updated Name',
        'email' => $user->email,
        'password' => '12345678',
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('users', ['name' => 'Updated Name', 'email' => $user->email]);
});

it('allows admin to delete a user', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $user = User::factory()->create();

    $this->actingAs($admin);
    $response = $this->deleteJson("/api/users/{$user->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

it('prevents user from updating another user', function () {
    $user1 = User::factory()->create()->assignRole('User');
    $user2 = User::factory()->create();

    $this->actingAs($user1);
    $response = $this->putJson("/api/users/{$user2->id}", [
        'name' => 'Unauthorized Update',
        'email' => $user2->email,
        'password' => '12345678',
    ]);

    $response->assertStatus(403);
});

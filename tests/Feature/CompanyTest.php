<?php

use App\Models\Company;
use App\Models\User;

it('allows admin to create a company', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $this->actingAs($admin);

    $response = $this->postJson('/api/companies', [
        'name' => 'New Company',
        'description' => 'A test company description',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('companies', ['name' => 'New Company']);
});

it('prevents user without admin role from creating a company', function () {
    $user = User::factory()->create()->assignRole('User');
    $this->actingAs($user);

    $response = $this->postJson('/api/companies', [
        'name' => 'Attempted Company',
        'description' => 'User should not be able to do this',
    ]);

    $response->assertStatus(403);
});

it('allows admin to assign user to a company', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $user = User::factory()->create();
    $company = Company::factory()->create();

    $this->actingAs($admin);
    $response = $this->postJson("/api/companies/{$company->id}/assign-user/{$user->id}");

    $response->assertStatus(200);
    $this->assertDatabaseHas('company_user', [
        'user_id' => $user->id,
        'company_id' => $company->id,
    ]);
});

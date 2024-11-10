<?php

use App\Models\Company;
use App\Models\Project;
use App\Models\User;

it('allows admin to create a project', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $company = Company::factory()->create();

    $this->actingAs($admin);
    $response = $this->postJson('/api/projects', [
        'name' => 'New Project',
        'description' => 'Project description',
        'company_id' => $company->id,
        'type' => 'standard',
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('projects', ['name' => 'New Project']);
});

it('prevents non-admin user from creating a project', function () {
    $user = User::factory()->create()->assignRole('User');
    $company = Company::factory()->create();

    $this->actingAs($user);
    $response = $this->postJson('/api/projects', [
        'name' => 'User Project',
        'description' => 'User should not be able to create this',
        'company_id' => $company->id,
        'type' => 'standard',
    ]);

    $response->assertStatus(403);
});

it('allows admin to delete a project', function () {
    $admin = User::factory()->create()->assignRole('Admin');
    $project = Project::factory()->create();

    $this->actingAs($admin);
    $response = $this->deleteJson("/api/projects/{$project->id}");

    $response->assertStatus(200);
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

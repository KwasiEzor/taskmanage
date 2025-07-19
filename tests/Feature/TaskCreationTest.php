<?php

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;

it('displays the task create form', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $user->id]);

    $response = $this->actingAs($user)->get('/tasks/create');

    $response->assertStatus(200);
    $response->assertViewIs('tasks.create');
    $response->assertViewHas('projects');
});

it('creates a new task successfully', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create(['user_id' => $user->id]);

    $taskData = [
        'name' => 'Test Task',
        'description' => 'This is a test task description',
        'status' => TaskStatus::PENDING->value,
        'priority' => TaskPriority::MEDIUM->value,
        'project_id' => $project->id,
    ];

    $response = $this->actingAs($user)->post('/tasks', $taskData);

    $response->assertRedirect();
    $response->assertSessionHas('flash.banner', 'Task created successfully.');
    $response->assertSessionHas('flash.bannerStyle', 'success');

    $this->assertDatabaseHas('tasks', [
        'name' => 'Test Task',
        'description' => 'This is a test task description',
        'status' => TaskStatus::PENDING->value,
        'priority' => TaskPriority::MEDIUM->value,
        'project_id' => $project->id,
    ]);
});

it('validates required fields', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/tasks', []);

    $response->assertSessionHasErrors(['name', 'status', 'priority', 'project_id']);
});

it('validates project exists', function () {
    $user = User::factory()->create();

    $taskData = [
        'name' => 'Test Task',
        'status' => TaskStatus::PENDING->value,
        'priority' => TaskPriority::MEDIUM->value,
        'project_id' => 999, // Non-existent project
    ];

    $response = $this->actingAs($user)->post('/tasks', $taskData);

    $response->assertSessionHasErrors(['project_id']);
});

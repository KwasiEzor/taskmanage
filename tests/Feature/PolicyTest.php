<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PolicyTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_own_project()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)
            ->get(route('projects.show', $project))
            ->assertStatus(200);
    }

    public function test_user_cannot_view_other_users_project()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user2->id]);

        $this->actingAs($user1)
            ->get(route('projects.show', $project))
            ->assertStatus(403);
    }

    public function test_user_can_view_own_task()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->actingAs($user)
            ->get(route('tasks.show', $task))
            ->assertStatus(200);
    }

    public function test_user_cannot_view_other_users_task()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user2->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->actingAs($user1)
            ->get(route('tasks.show', $task))
            ->assertStatus(403);
    }

    public function test_user_can_view_assignment_if_assigned_or_task_owner()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);
        $assignment = Assignment::factory()->create([
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);

        $this->actingAs($user)
            ->get(route('assignments.show', $assignment))
            ->assertStatus(200);
    }

    public function test_user_cannot_view_assignment_if_not_assigned_or_task_owner()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user2->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);
        $assignment = Assignment::factory()->create([
            'task_id' => $task->id,
            'user_id' => $user2->id
        ]);

        $this->actingAs($user1)
            ->get(route('assignments.show', $assignment))
            ->assertStatus(403);
    }

    public function test_custom_403_page_is_displayed()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user2->id]);

        $response = $this->actingAs($user1)
            ->get(route('projects.show', $project));

        $response->assertStatus(403);
        $response->assertSee('Access Denied');
        $response->assertSee('Go Back');
        $response->assertSee('Go Home');
    }
}

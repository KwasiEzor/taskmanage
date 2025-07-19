<?php

namespace Tests\Feature;

use App\Models\Assignment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_can_be_soft_deleted()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        // Delete the project (soft delete)
        $response = $this->delete(route('projects.destroy', $project->slug));

        $response->assertRedirect(route('projects.index'));
        $response->assertSessionHas('success', 'Project archived successfully');

        // Project should be soft deleted
        $this->assertSoftDeleted($project);

        // Project should not appear in normal queries (but should exist in database with deleted_at)
        $this->assertDatabaseHas('projects', ['id' => $project->id, 'deleted_at' => now()]);
    }

    public function test_project_can_be_restored()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        // Soft delete the project
        $project->delete();

        // Restore the project
        $response = $this->patch(route('projects.restore', $project->slug));

        $response->assertRedirect(route('projects.show', $project));
        $response->assertSessionHas('success', 'Project restored successfully');

        // Project should be restored
        $this->assertNotSoftDeleted($project);
    }

    public function test_project_can_be_permanently_deleted()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        // Soft delete the project first
        $project->delete();

        // Permanently delete the project
        $response = $this->delete(route('projects.force-delete', $project->slug));

        $response->assertRedirect(route('projects.index'));
        $response->assertSessionHas('success', 'Project permanently deleted');

        // Project should be permanently deleted
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }

    public function test_task_can_be_soft_deleted()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->actingAs($user);

        // Delete the task (soft delete)
        $response = $this->delete(route('tasks.destroy', $task->slug));

        $response->assertRedirect(route('tasks.index'));
        $response->assertSessionHas('flash.banner', 'Task archived successfully.');

        // Task should be soft deleted
        $this->assertSoftDeleted($task);
    }

    public function test_task_can_be_restored()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);

        $this->actingAs($user);

        // Soft delete the task
        $task->delete();

        // Restore the task
        $response = $this->patch(route('tasks.restore', $task->slug));

        $response->assertRedirect(route('tasks.show', $task));
        $response->assertSessionHas('flash.banner', 'Task restored successfully.');

        // Task should be restored
        $this->assertNotSoftDeleted($task);
    }

    public function test_assignment_can_be_soft_deleted()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);
        $assignment = Assignment::factory()->create([
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);

        $this->actingAs($user);

        // Delete the assignment (soft delete)
        $response = $this->delete(route('assignments.destroy', $assignment->slug));

        $response->assertRedirect(route('assignments.index'));
        $response->assertSessionHas('flash.banner', 'Assignment archived successfully.');

        // Assignment should be soft deleted
        $this->assertSoftDeleted($assignment);
    }

    public function test_assignment_can_be_restored()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);
        $assignment = Assignment::factory()->create([
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);

        $this->actingAs($user);

        // Soft delete the assignment
        $assignment->delete();

        // Restore the assignment
        $response = $this->patch(route('assignments.restore', $assignment->slug));

        $response->assertRedirect(route('assignments.show', $assignment));
        $response->assertSessionHas('flash.banner', 'Assignment restored successfully.');

        // Assignment should be restored
        $this->assertNotSoftDeleted($assignment);
    }

    public function test_trashed_projects_page_shows_only_soft_deleted_projects()
    {
        $user = User::factory()->create();
        $activeProject = Project::factory()->create(['user_id' => $user->id]);
        $deletedProject = Project::factory()->create(['user_id' => $user->id]);
        $deletedProject->delete();

        $this->actingAs($user);

        $response = $this->get(route('projects.trashed'));

        $response->assertStatus(200);
        $response->assertViewHas('trashedProjects');
        $response->assertSee($deletedProject->name);
        $response->assertDontSee($activeProject->name);
    }

    public function test_trashed_tasks_page_shows_only_soft_deleted_tasks()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $activeTask = Task::factory()->create(['project_id' => $project->id]);
        $deletedTask = Task::factory()->create(['project_id' => $project->id]);
        $deletedTask->delete();

        $this->actingAs($user);

        $response = $this->get(route('tasks.trashed'));

        $response->assertStatus(200);
        $response->assertViewHas('trashedTasks');
        $response->assertSee($deletedTask->name);
        $response->assertDontSee($activeTask->name);
    }

    public function test_trashed_assignments_page_shows_only_soft_deleted_assignments()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);
        $task = Task::factory()->create(['project_id' => $project->id]);
        $activeAssignment = Assignment::factory()->create([
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);
        $deletedAssignment = Assignment::factory()->create([
            'task_id' => $task->id,
            'user_id' => $user->id
        ]);
        $deletedAssignment->delete();

        $this->actingAs($user);

        $response = $this->get(route('assignments.trashed'));

        $response->assertStatus(200);
        $response->assertViewHas('trashedAssignments');
        $response->assertSee($deletedAssignment->title);
        $response->assertDontSee($activeAssignment->title);
    }
}

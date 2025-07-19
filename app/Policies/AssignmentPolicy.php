<?php

namespace App\Policies;

use App\Models\Assignment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AssignmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view assignments list
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Assignment $assignment): bool
    {
        // Users can view assignments if they are the assigned user or the task owner
        return $user->id === $assignment->user_id || $user->id === $assignment->task->project->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->projects()->count() > 0; // All authenticated users can create assignments
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Assignment $assignment): bool
    {
        // Users can update assignments if they are the assigned user or the task owner
        return $user->id === $assignment->user_id || $user->id === $assignment->task->project->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Assignment $assignment): bool
    {
        // Users can delete assignments if they are the assigned user or the task owner
        return $user->id === $assignment->user_id || $user->id === $assignment->task->project->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Assignment $assignment): bool
    {
        // Users can restore assignments if they are the assigned user or the task owner
        return $user->id === $assignment->user_id || $user->id === $assignment->task->project->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Assignment $assignment): bool
    {
        // Users can permanently delete assignments if they are the assigned user or the task owner
        return $user->id === $assignment->user_id || $user->id === $assignment->task->project->user_id;
    }
}

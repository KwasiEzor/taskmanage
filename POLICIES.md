# Authorization Policies

This document explains the authorization policies implemented for the task management application.

## Overview

The application uses Laravel's authorization policies to control access to resources. Policies are defined for three main models:

- **ProjectPolicy**: Controls access to projects
- **TaskPolicy**: Controls access to tasks  
- **AssignmentPolicy**: Controls access to assignments

## Policy Rules

### ProjectPolicy

- **viewAny**: All authenticated users can view the projects list
- **view**: Only the project owner can view a specific project
- **create**: All authenticated users can create projects
- **update**: Only the project owner can update a project
- **delete**: Only the project owner can delete a project
- **restore**: Only the project owner can restore a soft-deleted project
- **forceDelete**: Only the project owner can permanently delete a project

### TaskPolicy

- **viewAny**: All authenticated users can view the tasks list
- **view**: Only the task owner (project owner) can view a specific task
- **create**: All authenticated users can create tasks
- **update**: Only the task owner (project owner) can update a task
- **delete**: Only the task owner (project owner) can delete a task
- **restore**: Only the task owner (project owner) can restore a soft-deleted task
- **forceDelete**: Only the task owner (project owner) can permanently delete a task

### AssignmentPolicy

- **viewAny**: All authenticated users can view the assignments list
- **view**: Users can view assignments if they are the assigned user OR the task owner
- **create**: All authenticated users can create assignments
- **update**: Users can update assignments if they are the assigned user OR the task owner
- **delete**: Users can delete assignments if they are the assigned user OR the task owner
- **restore**: Users can restore assignments if they are the assigned user OR the task owner
- **forceDelete**: Users can permanently delete assignments if they are the assigned user OR the task owner

## Usage in Controllers

Policies are used in controllers with the `authorize()` method:

```php
public function show(Task $task)
{
    $this->authorize('view', $task);
    
    $task->load(['project', 'assignments.user']);
    return view('tasks.show', compact('task'));
}
```

## Usage in Views

Policies can be used in Blade templates with the `@can` directive:

```blade
@can('update', $task)
    <a href="{{ route('tasks.edit', $task) }}">Edit Task</a>
@endcan

@can('delete', $task)
    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Task</button>
    </form>
@endcan
```

## Testing Policies

The policies are tested in `tests/Feature/PolicyTest.php` to ensure they work correctly:

- Users can only access their own resources
- Users cannot access other users' resources
- Assignment access is properly controlled based on assignment and task ownership

## Benefits

1. **Centralized Authorization**: All authorization logic is in one place
2. **Reusable**: Policies can be used in controllers, views, and other parts of the application
3. **Testable**: Policies can be easily tested in isolation
4. **Maintainable**: Changes to authorization rules only need to be made in the policy files
5. **Consistent**: The same authorization rules are applied everywhere

## File Structure

```
app/
├── Policies/
│   ├── ProjectPolicy.php
│   ├── TaskPolicy.php
│   └── AssignmentPolicy.php
└── Providers/
    └── AuthServiceProvider.php
``` 

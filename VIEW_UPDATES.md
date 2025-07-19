# View Updates for Policy Integration

This document outlines all the view updates made to integrate authorization policies throughout the application.

## Overview

All views have been updated to use Laravel's `@can` directive for authorization checks, ensuring that users only see actions they have permission to perform. This provides a better user experience by hiding unauthorized actions rather than showing them and then throwing errors.

## Custom 403 Error Page

### File: `resources/views/errors/403.blade.php`

A custom, well-designed 403 unauthorized page has been created with:

- **Modern Design**: Clean, professional layout with gradient background
- **Clear Messaging**: User-friendly error message explaining the issue
- **Action Buttons**: "Go Back" and "Go Home" buttons for easy navigation
- **Error Code Display**: Shows the 403 error code for reference
- **Support Information**: Contact information for help
- **Responsive Design**: Works well on all screen sizes

## Updated Views

### 1. Task Views

#### `resources/views/tasks/index.blade.php`
- **Create Button**: Only shows if user can create tasks
- **Task Cards**: Only displays tasks the user can view

#### `resources/views/tasks/show.blade.php`
- **Edit Button**: Only shows if user can update the task
- **Delete Button**: Only shows if user can delete the task

#### `resources/views/components/task-card.blade.php`
- **Edit Action**: Only shows if user can update the task
- **Delete Action**: Only shows if user can delete the task
- **Assign Action**: Only shows for authenticated users

### 2. Project Views

#### `resources/views/projects/index.blade.php`
- **Create Button**: Only shows if user can create projects
- **Project Cards**: Only displays projects the user can view

#### `resources/views/projects/show.blade.php`
- **Edit Button**: Only shows if user can update the project
- **Delete Button**: Only shows if user can delete the project
- **Create Task Button**: Only shows if user can update the project

#### `resources/views/components/project-card.blade.php`
- **View Button**: Only shows if user can view the project
- **Edit Button**: Only shows if user can update the project
- **Delete Button**: Only shows if user can delete the project

### 3. Assignment Views

#### `resources/views/assignments/index.blade.php`
- **Create Button**: Only shows if user can create assignments
- **Assignment Cards**: Only displays assignments the user can view
- **Empty State**: Create button in empty state respects permissions

#### `resources/views/assignments/show.blade.php`
- **Edit Button**: Only shows if user can update the assignment
- **Delete Button**: Only shows if user can delete the assignment
- **Task Links**: Only clickable if user can view the task
- **Project Links**: Only clickable if user can view the project
- **Action Buttons**: All action buttons respect permissions

#### `resources/views/components/assignment-card.blade.php`
- **Title Link**: Only clickable if user can view the assignment
- **Task Link**: Only clickable if user can view the task
- **Edit Button**: Only shows if user can update the assignment
- **Delete Button**: Only shows if user can delete the assignment

## Policy Integration Examples

### Using @can Directive

```blade
@can('update', $task)
    <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Edit Task</a>
@endcan

@can('delete', $task)
    <form method="POST" action="{{ route('tasks.destroy', $task) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-delete">Delete Task</button>
    </form>
@endcan
```

### Conditional Display

```blade
@can('view', $assignment)
    <a href="{{ route('assignments.show', $assignment) }}">
        {{ $assignment->title }}
    </a>
@else
    <span class="text-gray-500">{{ $assignment->title }}</span>
@endcan
```

### Create Permissions

```blade
@can('create', App\Models\Task::class)
    <a href="{{ route('tasks.create') }}" class="btn-create">Create Task</a>
@endcan
```

## Benefits

1. **Better UX**: Users only see actions they can actually perform
2. **Reduced Errors**: No more clicking buttons that lead to 403 errors
3. **Cleaner Interface**: Unauthorized actions are hidden, not disabled
4. **Consistent Experience**: Same authorization rules applied everywhere
5. **Professional Appearance**: Custom 403 page looks professional
6. **Accessibility**: Clear messaging about why access is denied

## Security Features

- **Granular Control**: Different permissions for view, create, update, delete
- **Contextual Permissions**: Assignment permissions consider both assignment ownership and task ownership
- **Consistent Enforcement**: Same rules applied in views and controllers
- **Graceful Degradation**: Unauthorized content is hidden, not broken

## Testing

All policy integrations are tested in `tests/Feature/PolicyTest.php`:

- Users can only see their own resources
- Users cannot access other users' resources
- Custom 403 page is displayed correctly
- Assignment permissions work correctly

## File Structure

```
resources/views/
├── errors/
│   └── 403.blade.php                    # Custom unauthorized page
├── tasks/
│   ├── index.blade.php                  # Updated with policies
│   └── show.blade.php                   # Updated with policies
├── projects/
│   ├── index.blade.php                  # Updated with policies
│   └── show.blade.php                   # Updated with policies
├── assignments/
│   ├── index.blade.php                  # Updated with policies
│   └── show.blade.php                   # Updated with policies
└── components/
    ├── task-card.blade.php              # Updated with policies
    ├── project-card.blade.php           # Updated with policies
    └── assignment-card.blade.php        # Updated with policies
``` 

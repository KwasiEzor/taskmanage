# Soft Delete Feature Documentation

## Overview

The soft delete functionality has been implemented for Projects, Tasks, and Assignments. This allows records to be temporarily archived instead of being permanently deleted from the database.

## How It Works

### Database Structure
- All three models (Project, Task, Assignment) use the `SoftDeletes` trait
- Each table has a `deleted_at` timestamp column that gets set when a record is soft deleted
- When `deleted_at` is `NULL`, the record is considered active
- When `deleted_at` has a timestamp, the record is considered soft deleted

### Models
- **Project**: Uses `SoftDeletes` trait with `getTasksCountAttribute()` method that includes soft deleted tasks
- **Task**: Uses `SoftDeletes` trait with `getAssignmentsCountAttribute()` method that includes soft deleted assignments  
- **Assignment**: Uses `SoftDeletes` trait

### Controllers
Each controller has been updated with three new methods:

1. **`restore($slug)`**: Restores a soft deleted record
2. **`forceDelete($slug)`**: Permanently deletes a record from the database
3. **`trashed()`**: Displays a list of all soft deleted records

### Routes
New routes have been added for each model:

```
GET    /projects/trashed                    - View archived projects
PATCH  /projects/{slug}/restore            - Restore a project
DELETE /projects/{slug}/force-delete       - Permanently delete a project

GET    /tasks/trashed                      - View archived tasks
PATCH  /tasks/{slug}/restore               - Restore a task
DELETE /tasks/{slug}/force-delete          - Permanently delete a task

GET    /assignments/trashed                - View archived assignments
PATCH  /assignments/{slug}/restore         - Restore an assignment
DELETE /assignments/{slug}/force-delete    - Permanently delete an assignment
```

## User Interface

### Navigation
- **Archived** buttons have been added to the main index pages (Projects, Tasks, Assignments)
- **Archived Items** section has been added to the user dropdown menu in the navigation
- Links to archived items are available in both desktop and mobile navigation

### Views
Three new view files have been created:
- `resources/views/projects/trashed.blade.php`
- `resources/views/tasks/trashed.blade.php`
- `resources/views/assignments/trashed.blade.php`

Each view displays:
- List of soft deleted records with relevant information
- **Restore** button to restore the record
- **Delete Permanently** button with confirmation dialog
- Pagination for large lists
- Empty state when no archived records exist

### User Experience
- When a user clicks "Delete" on any record, it's now soft deleted (archived)
- Success messages have been updated to say "archived" instead of "deleted"
- Users can access archived items through the navigation menu
- Restored items return to their normal state and are accessible again
- Permanent deletion requires confirmation to prevent accidental data loss

## Authorization

All soft delete operations are protected by the existing policies:
- **ProjectPolicy**: `restore()` and `forceDelete()` methods
- **TaskPolicy**: `restore()` and `forceDelete()` methods  
- **AssignmentPolicy**: `restore()` and `forceDelete()` methods

Users can only restore or permanently delete records they own or have permission to manage.

## Testing

Comprehensive tests have been created in `tests/Feature/SoftDeleteTest.php` that verify:
- Records can be soft deleted
- Records can be restored
- Records can be permanently deleted
- Trashed pages show only soft deleted records
- Proper authorization is enforced
- Success messages are displayed correctly

## Usage Examples

### Soft Delete a Project
```php
$project = Project::find(1);
$project->delete(); // Sets deleted_at timestamp
```

### Restore a Project
```php
$project = Project::withTrashed()->find(1);
$project->restore(); // Clears deleted_at timestamp
```

### Permanently Delete a Project
```php
$project = Project::withTrashed()->find(1);
$project->forceDelete(); // Removes from database completely
```

### Query Soft Deleted Records
```php
// Get only soft deleted records
$trashedProjects = Project::onlyTrashed()->get();

// Get all records including soft deleted
$allProjects = Project::withTrashed()->get();

// Get only active records (default behavior)
$activeProjects = Project::all();
```

## Benefits

1. **Data Recovery**: Accidental deletions can be reversed
2. **Audit Trail**: Maintains history of deleted records
3. **User Confidence**: Users can safely delete items knowing they can be recovered
4. **Compliance**: Helps meet data retention requirements
5. **User Experience**: Provides a "recycle bin" like functionality

## Migration Notes

The soft delete functionality is backward compatible:
- Existing delete operations now perform soft deletes
- No changes required to existing code
- All existing functionality continues to work as expected
- New restore and permanent delete options are available through the UI 

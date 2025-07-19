<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Task::class);

        $tasks = Task::with('assignments', 'project')
            ->whereHas('project', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->orderBy('created_at', 'desc');

        // Get tasks count for the current user through their projects
        $userTasksCount = Task::whereHas('project', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        // Always paginate, but use a larger page size when there are fewer tasks
        $perPage = $userTasksCount > 6 ? 10 : max($userTasksCount, 1);
        $tasks = $tasks->paginate($perPage);
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Task::class);

        $projects = Project::orderBy('name')->get();
        return view('tasks.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $this->authorize('create', Task::class);

        $task = Task::create($request->validated());

        return redirect()->route('tasks.show', $task)
            ->with('flash.banner', 'Task created successfully.')
            ->with('flash.bannerStyle', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $this->authorize('view', $task);

        $task->load(['project', 'assignments.user']);
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $this->authorize('update', $task);

        $projects = Project::orderBy('name')->get();
        return view('tasks.edit', compact('task', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->update($request->validated());

        return redirect()->route('tasks.show', $task)
            ->with('flash.banner', 'Task updated successfully.')
            ->with('flash.bannerStyle', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')
            ->with('flash.banner', 'Task deleted successfully.')
            ->with('flash.bannerStyle', 'success');
    }
}

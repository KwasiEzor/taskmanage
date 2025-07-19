<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Project::class);

        $query = Project::with(['tasks', 'category', 'user' => function ($query) {
            $query->where('user_id', Auth::id());
            $query->orderBy('created_at', 'desc');
        }])->latest();

        // Only paginate if there are more than 5 projects
        if ($query->count() > 5) {
            $projects = $query->paginate(6);
        } else {
            $projects = $query->get();
        }

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Project::class);

        $categories = \App\Models\Category::where('is_active', true)->get();
        return view('projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', Project::class);

        $project = Project::create(array_merge($request->validated(), [
            'user_id' => Auth::user()->id,
        ]));
        return redirect()->route('projects.show', $project)->with('success', 'Project created successfully');
    }

    public function createProjectTask(Project $project, StoreTaskRequest $request)
    {
        $this->authorize('update', $project);

        $project->tasks()->create($request->validated());
        return redirect()->route('projects.show', $project)->with('success', 'Task created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load('tasks');
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        $project->load('category');
        $categories = \App\Models\Category::where('is_active', true)->get();
        return view('projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());
        return redirect()->route('projects.show', $project)->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project archived successfully');
    }

    /**
     * Restore the specified soft deleted resource.
     */
    public function restore($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $this->authorize('restore', $project);

        $project->restore();
        return redirect()->route('projects.show', $project)->with('success', 'Project restored successfully');
    }

    /**
     * Permanently delete the specified resource.
     */
    public function forceDelete($slug)
    {
        $project = Project::withTrashed()->where('slug', $slug)->firstOrFail();
        $this->authorize('forceDelete', $project);

        $project->forceDelete();
        return redirect()->route('projects.index')->with('success', 'Project permanently deleted');
    }

    /**
     * Display a listing of soft deleted resources.
     */
    public function trashed()
    {
        $this->authorize('viewAny', Project::class);

        $trashedProjects = Project::onlyTrashed()
            ->with(['tasks', 'category', 'user'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('projects.trashed', compact('trashedProjects'));
    }
}

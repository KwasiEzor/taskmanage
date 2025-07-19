<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignmentRequest;
use App\Http\Requests\UpdateAssignmentRequest;
use App\Models\Assignment;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Assignment::class);

        $assignments = Assignment::with('task', 'user')
            ->whereHas('task', function ($query) {
                $query->whereHas('project', function ($query) {
                    $query->where('user_id', Auth::id());
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Assignment::class);

        $tasks = Task::with('project')->get();
        $users = User::all();
        return view('assignments.create', compact('tasks', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAssignmentRequest $request)
    {
        $this->authorize('create', Assignment::class);

        $assignment = Assignment::create($request->validated());

        return redirect()->route('assignments.index')
            ->with('flash.banner', 'Assignment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        $this->authorize('view', $assignment);

        $assignment->load(['task.project.category', 'user']);
        return view('assignments.show', compact('assignment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $tasks = Task::with('project')->get();
        $users = User::all();
        return view('assignments.edit', compact('assignment', 'tasks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssignmentRequest $request, Assignment $assignment)
    {
        $this->authorize('update', $assignment);

        $assignment->update($request->validated());

        return redirect()->route('assignments.index')
            ->with('flash.banner', 'Assignment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        $this->authorize('delete', $assignment);

        $assignment->delete();

        return redirect()->route('assignments.index')
            ->with('flash.banner', 'Assignment deleted successfully.');
    }
}

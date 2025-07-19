<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user();
        $projectsCount = $user->projects()->count();
        $tasksCount = Task::whereHas('project', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();
        $completedTasksCount = Task::whereHas('project', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', 'completed')->count();
        $pendingTasksCount = Task::whereHas('project', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })->where('status', '!=', 'completed')->count();
        $assignmentsCount = Assignment::where('user_id', $user->id)->count();
        $completedAssignmentsCount = Assignment::where('user_id', $user->id)->where('status', 'completed')->count();
        $pendingAssignmentsCount = Assignment::where('user_id', $user->id)->where('status', '!=', 'completed')->count();
        return view('dashboard', compact(
            'projectsCount',
            'tasksCount',
            'assignmentsCount',
            'completedTasksCount',
            'pendingTasksCount',
            'completedAssignmentsCount',
            'pendingAssignmentsCount',
        ));
    }
}

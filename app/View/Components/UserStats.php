<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class UserStats extends Component
{
    public $projectsCount;
    public $tasksCount;
    public $assignmentsCount;
    public $completedTasksCount;
    public $pendingTasksCount;
    public $completedAssignmentsCount;
    public $pendingAssignmentsCount;

    /**
     * Create a new component instance.
     */
    public function __construct($projectsCount, $tasksCount, $assignmentsCount, $completedTasksCount, $pendingTasksCount, $completedAssignmentsCount, $pendingAssignmentsCount)
    {
        $this->projectsCount = $projectsCount;
        $this->tasksCount = $tasksCount;
        $this->assignmentsCount = $assignmentsCount;
        $this->completedTasksCount = $completedTasksCount;
        $this->pendingTasksCount = $pendingTasksCount;
        $this->completedAssignmentsCount = $completedAssignmentsCount;
        $this->pendingAssignmentsCount = $pendingAssignmentsCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|string
    {
        return view('components.user-stats');
    }
}

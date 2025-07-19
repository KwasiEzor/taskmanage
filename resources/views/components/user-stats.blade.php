<div class="grid w-full grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
    <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow">
        <span class="text-3xl font-bold text-indigo-600">{{ $projectsCount }}</span>
        <span class="mt-2 text-gray-700">Projects</span>
    </div>
    <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow">
        <span class="text-3xl font-bold text-blue-600">{{ $tasksCount }}</span>
        <span class="mt-2 text-gray-700">Tasks</span>
        <div class="flex gap-2 mt-2 text-xs">
            <span class="text-green-600">Completed: {{ $completedTasksCount }}</span>
            <span class="text-yellow-600">Pending: {{ $pendingTasksCount }}</span>
        </div>
    </div>
    <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow">
        <span class="text-3xl font-bold text-purple-600">{{ $assignmentsCount }}</span>
        <span class="mt-2 text-gray-700">Assignments</span>
        <div class="flex gap-2 mt-2 text-xs">
            <span class="text-green-600">Completed: {{ $completedAssignmentsCount }}</span>
            <span class="text-yellow-600">Pending: {{ $pendingAssignmentsCount }}</span>
        </div>
    </div>
</div>

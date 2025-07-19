<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8">

                    <h1 class="mt-2 text-2xl font-medium text-gray-900">
                        Welcome to Task Manager!
                    </h1>

                    <p class="mt-6 leading-relaxed text-gray-500">
                        Manage your projects, tasks, and assignments efficiently. Get started by creating your first
                        project or explore existing ones.
                    </p>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
                    <x-user-stats :projects-count="$projectsCount" :tasks-count="$tasksCount"
                        :assignments-count="$assignmentsCount" :completed-tasks-count="$completedTasksCount"
                        :pending-tasks-count="$pendingTasksCount"
                        :completed-assignments-count="$completedAssignmentsCount"
                        :pending-assignments-count="$pendingAssignmentsCount" />
                </div>

                <div
                    class="grid grid-cols-1 gap-6 p-6 bg-gray-200 bg-opacity-25 md:grid-cols-2 lg:grid-cols-3 lg:gap-8 lg:p-8">
                    <!-- Projects -->
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="size-6 stroke-indigo-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0119.5 12v.75m-8.69-8.69A2.25 2.25 0 0012 2.25h-.75a2.25 2.25 0 00-2.25 2.25v.75m8.69 8.69A2.25 2.25 0 0112 21.75h-.75a2.25 2.25 0 01-2.25-2.25v-.75m8.69-8.69l-3-3m0 0l-3 3m3-3v11.25" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-900 ms-3">
                                <a href="{{ route('projects.index') }}"
                                    class="transition-colors hover:text-indigo-600">Projects</a>
                            </h2>
                        </div>

                        <p class="mt-4 text-sm leading-relaxed text-gray-500">
                            Create and manage your projects. Organize tasks and track progress across different
                            initiatives.
                        </p>

                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('projects.index') }}"
                                class="inline-flex items-center font-semibold text-indigo-700 hover:text-indigo-800">
                                View Projects
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    class="ms-1 size-5 fill-indigo-500">
                                    <path fill-rule="evenodd"
                                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('projects.create') }}"
                                class="inline-flex items-center font-semibold text-green-700 hover:text-green-800">
                                Create New
                            </a>
                        </div>
                    </div>

                    <!-- Tasks -->
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="size-6 stroke-blue-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-900 ms-3">
                                <a href="{{ route('tasks.index') }}"
                                    class="transition-colors hover:text-blue-600">Tasks</a>
                            </h2>
                        </div>

                        <p class="mt-4 text-sm leading-relaxed text-gray-500">
                            Break down your projects into manageable tasks. Set priorities and track completion status.
                        </p>

                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('tasks.index') }}"
                                class="inline-flex items-center font-semibold text-blue-700 hover:text-blue-800">
                                View Tasks
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    class="ms-1 size-5 fill-blue-500">
                                    <path fill-rule="evenodd"
                                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('tasks.create') }}"
                                class="inline-flex items-center font-semibold text-green-700 hover:text-green-800">
                                Create New
                            </a>
                        </div>
                    </div>

                    <!-- Assignments -->
                    <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-sm">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                class="size-6 stroke-purple-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <h2 class="text-xl font-semibold text-gray-900 ms-3">
                                <a href="{{ route('assignments.index') }}"
                                    class="transition-colors hover:text-purple-600">Assignments</a>
                            </h2>
                        </div>

                        <p class="mt-4 text-sm leading-relaxed text-gray-500">
                            Assign tasks to team members and track their progress. Manage workload distribution
                            effectively.
                        </p>

                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('assignments.index') }}"
                                class="inline-flex items-center font-semibold text-purple-700 hover:text-purple-800">
                                View Assignments
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    class="ms-1 size-5 fill-purple-500">
                                    <path fill-rule="evenodd"
                                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="{{ route('assignments.create') }}"
                                class="inline-flex items-center font-semibold text-green-700 hover:text-green-800">
                                Create New
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

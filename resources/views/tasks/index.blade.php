<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Tasks') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('tasks.trashed') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-300 ease-in-out bg-gray-100 rounded-md hover:bg-gray-200">
                    {{ __('Archived') }}
                </a>
                @can('create', App\Models\Task::class)
                <a href="{{ route('tasks.create') }}" class="px-4 py-1 rounded-md btn-indigo">Create Task</a>
                @endcan
            </div>
        </div>
    </x-slot>
    <x-wrapper-container class="mt-6 rounded-xl">
        @if($tasks->count() > 0)
        <section class="grid grid-cols-1 gap-4 md:grid-cols-2">
            @foreach ($tasks as $task)
            @can('view', $task)
            <x-task-card :task="$task" :assignAction="true" :editAction="true" :deleteAction="true" />
            @endcan
            @endforeach
        </section>
        <div class="mt-4">
            {{ $tasks->links() }}
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-12 text-center">
            <div class="w-16 h-16 mb-4 text-gray-400">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>
            <h3 class="mb-2 text-lg font-medium text-gray-900">No tasks found</h3>
            <p class="mb-4 text-gray-500">Get started by creating your first task.</p>
            @can('create', App\Models\Task::class)
            <a href="{{ route('tasks.create') }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                Create Task
            </a>
            @endcan
        </div>
        @endif
    </x-wrapper-container>
</x-app-layout>

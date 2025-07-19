<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Tasks') }}
            </h2>
            @can('create', App\Models\Task::class)
            <a href="{{ route('tasks.create') }}" class="px-4 py-1 rounded-md btn-indigo">Create Task</a>
            @endcan
        </div>
    </x-slot>
    <x-wrapper-container class="mt-6 rounded-xl">
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
    </x-wrapper-container>
</x-app-layout>

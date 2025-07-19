@php
$taskStatus = App\Enums\TaskStatus::from($task->status->value);
$taskPriority = App\Enums\TaskPriority::from($task->priority->value);
@endphp

<div x-data="{ showCreateAssignmentModal: false }">
    <x-app-layout>
        <x-banner />
        <x-slot name="header">
            <div class="flex items-center justify-between w-full">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    {{ __('Task Details') }}
                </h2>
                <div class="flex items-center justify-end gap-2">

                    @can('update', $task)
                    <a href="{{ route('tasks.edit', $task) }}"
                        class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                        {{ __('Edit Task') }}
                    </a>

                    @endcan
                    <a href="{{ route('tasks.index') }}" class="btn btn-black">
                        <x-heroicon-o-arrow-left class="w-4 h-4" />
                    </a>

                </div>
            </div>
        </x-slot>
        <x-wrapper-container class="mt-6 rounded-xl">
            <div class="mb-6">
                <div class="flex items-center justify-between">
                    <h3 class="mb-2 text-2xl font-bold">{{ $task->name }}</h3>
                    @can('delete', $task)
                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline-block"
                        onsubmit="return confirm('Are you sure you want to delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-red-500 rounded-md hover:bg-red-700">
                            <x-heroicon-o-trash class="w-4 h-4" />
                        </button>
                    </form>
                    @endcan
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <p>
                        <span class="text-sm text-gray-600 underline underline-offset-4">Status:</span>
                        <x-badge :label="$taskStatus->label()" :color="$taskStatus->color()" />
                    </p>
                    <p>
                        <span class="text-sm text-gray-600 underline underline-offset-4">Priority:</span>
                        <x-badge :label="$taskPriority->label()" :color="$taskPriority->color()" />
                    </p>

                </div>
                <p class="mb-1 text-sm text-indigo-500">Project: {{ $task->project->name ?? 'No project' }}</p>
                <p class="mb-1 text-gray-700">{{ $task->description ?? 'No description' }}</p>
                <p class="text-sm text-gray-500">Created at: {{ $task->created_at->format('d/m/Y') }}</p>
            </div>
            <hr class="w-full h-px my-4 border-gray-200" />
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h4 class="text-lg font-semibold">Assignments</h4>
                    <x-button @click="showCreateAssignmentModal = true" class="btn-indigo">Create Assignment</x-button>
                </div>
                @if($task->assignments->count())
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    @foreach($task->assignments as $assignment)
                    <x-assignment-card :assignment="$assignment" />
                    @endforeach
                </div>
                @else
                <p class="text-gray-500">No assignments for this task.</p>
                @endif
            </div>

        </x-wrapper-container>
    </x-app-layout>

    <x-assignments.assignment-modal :task="$task" />
</div>

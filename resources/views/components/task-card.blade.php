@props(['task','assignAction'=>false,'editAction'=>false,'deleteAction'=>false])

<div x-data="{ showCreateAssignmentModal: false }">

    @php
    $taskStatus = App\Enums\TaskStatus::from($task->status->value);
    $taskPriority = App\Enums\TaskPriority::from($task->priority->value);
    @endphp

    <article class="p-4 transition-shadow duration-300 ease-in-out bg-white rounded-lg shadow-md hover:shadow-lg">
        <div class="relative flex flex-col p-4 space-y-4 rounded-md bg-zinc-100/50">
            <div class="w-full space-y-2">
                <h3 class="flex items-center gap-2 font-medium text-md font-poppins ">
                    <a wire:navigate href="{{ route('tasks.show', $task) }}"
                        class="font-semibold hover:text-indigo-400 text-slate-700 text-md">
                        {{ $task->name }}
                    </a>
                </h3>
                {{-- Badges --}}
                <div class="flex items-center gap-2">
                    <p>
                        <span class="text-sm text-gray-600 underline underline-offset-4">Status:</span>
                        <x-badge :label="$taskStatus->label()" :color="$taskStatus->color()" />
                    </p>
                    <p>
                        <span class="text-sm text-gray-600 underline underline-offset-4">Priority:</span>
                        <x-badge :label="$taskPriority->label()" :color="$taskPriority->color()" />
                    </p>
                </div>
                <p class="text-sm text-indigo-500">Project: {{ $task->project->name ?? 'No project' }}</p>
                <p class="text-sm text-gray-600">{{ $task->description ?? 'No description' }}</p>
                <div class="flex items-center gap-2">
                    <p class="text-sm text-gray-600">Created at: {{ $task->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            <section class="flex justify-end gap-2">
                @if ($assignAction && auth()->check())
                <x-button @click="showCreateAssignmentModal = true" class="btn-black">Assign</x-button>
                @endif
                @if ($editAction)
                @can('update', $task)
                <a href="{{ route('tasks.edit', $task) }}" class="btn-green btn">
                    <x-heroicon-o-pencil class="w-4 h-4" />
                </a>
                @endcan
                @endif
                @if ($deleteAction)
                @can('delete', $task)
                <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="inline"
                    onsubmit="return confirm('Are you sure you want to delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-red">
                        <x-heroicon-o-trash class="w-4 h-4" />
                    </button>
                </form>
                @endcan
                @endif
            </section>
        </div>
    </article>

    @if ($assignAction)
    <x-assignments.assignment-modal :task="$task" />
    @endif
</div>

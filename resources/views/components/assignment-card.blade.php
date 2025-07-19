@props(['assignment'])

@php
$assignmentStatus = App\Enums\AssignmentStatus::from($assignment->status->value);
@endphp

<article class="p-4 transition-shadow duration-300 ease-in-out bg-white rounded-lg shadow-md hover:shadow-lg">
    <div class="relative flex flex-col p-4 space-y-4 rounded-md bg-zinc-100/50">
        <div class="w-full space-y-2">
            <p class="text-sm text-gray-600">
                <span class="text-sm text-gray-600 ">Title</span> :
                @can('view', $assignment)
                <a wire:navigate href="{{ route('assignments.show', $assignment) }}"
                    class="px-3 py-px font-semibold transition-all duration-300 ease-in-out border-b rounded-md text-fuchsia-500 text-md border-fuchsia-500 hover:bg-fuchsia-500 hover:text-white">
                    {{ $assignment->title ?? 'No title' }}
                </a>
                @else
                <span class="px-3 py-px font-semibold text-gray-500">
                    {{ $assignment->title ?? 'No title' }}
                </span>
                @endcan
            </p>
            <h3 class="flex items-center justify-between w-full gap-2 font-medium text-md font-poppins">
                @can('view', $assignment->task)
                <a wire:navigate href="{{ route('tasks.show', $assignment->task) }}">
                    <span class="text-sm text-gray-600 uppercase">Task: </span>
                    <span class="font-semibold hover:text-indigo-400 text-slate-700 text-md">
                        {{ $assignment->task->name }}
                    </span>
                </a>
                @else
                <span>
                    <span class="text-sm text-gray-600 uppercase">Task: </span>
                    <span class="font-semibold text-gray-500 text-md">
                        {{ $assignment->task->name }}
                    </span>
                </span>
                @endcan
            </h3>
            <p class="text-sm text-indigo-500"><span class="text-sm text-gray-600 underline underline-offset-4">Project
                    owner</span> : {{ $assignment->task->project->name ?? 'No project' }}</p>
            <p class="text-sm text-gray-600">Assigned to: {{ $assignment->user->name ?? 'No user assigned' }}
                <br>
                By:
                <a wire:navigate href="{{ route('users.show', $assignment->user) }}" class="text-sm text-indigo-500">
                    {{ $assignment->user->name }}
                </a>
            </p>
            <div class="flex items-center gap-2">
                <p class="text-sm text-gray-600">Assigned at : {{ $assignment->created_at->format('d/m/Y') ?? 'No
                    assigned at' }}</p>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-end w-full gap-2 pt-2 mt-4 border-t border-gray-200">
            @can('update', $assignment)
            <a href="{{ route('assignments.edit', $assignment) }}"
                class="px-3 py-1 text-sm font-medium text-blue-600 transition-colors duration-200 bg-blue-100 rounded-md hover:bg-blue-200">
                Edit
            </a>
            @endcan
            @can('delete', $assignment)
            <form method="POST" action="{{ route('assignments.destroy', $assignment) }}" class="inline"
                onsubmit="return confirm('Are you sure you want to delete this assignment?')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="px-3 py-1 text-sm font-medium text-red-600 transition-colors duration-200 bg-red-100 rounded-md hover:bg-red-200">
                    Delete
                </button>
            </form>
            @endcan
            <x-badge :label="$assignmentStatus->label()" :color="$assignmentStatus->color()" class="" />
        </div>
    </div>
</article>

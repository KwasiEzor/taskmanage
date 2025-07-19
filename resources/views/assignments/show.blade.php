@php
$assignmentStatus = App\Enums\AssignmentStatus::from($assignment->status->value);
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Assignment Details') }}
            </h2>
            <div class="flex items-center gap-2">
                @can('update', $assignment)
                <a wire:navigate href="{{ route('assignments.edit', $assignment) }}"
                    class="rounded-md btn btn-indigo">Edit</a>
                @endcan
                <a wire:navigate href="{{ route('assignments.index') }}" class="rounded-md btn btn-black">
                    <x-heroicon-o-arrow-left class="w-4 h-4" />
                </a>
            </div>
        </div>
    </x-slot>

    <x-wrapper-container class="mt-6 rounded-xl">
        <div class="relative flex flex-col gap-6">
            <!-- Assignment Header -->
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h1 class="mb-2 text-3xl font-bold text-slate-700">
                        {{ $assignment->title ?? 'No title' }}
                    </h1>
                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <span>Created: {{ $assignment->created_at->format('d/m/Y H:i') }}</span>
                        @if($assignment->updated_at != $assignment->created_at)
                        <span>Updated: {{ $assignment->updated_at->format('d/m/Y H:i') }}</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <x-badge :label="$assignmentStatus->label()" :color="$assignmentStatus->color()" class="text-sm" />
                    @can('delete', $assignment)
                    <form action="{{ route('assignments.destroy', $assignment) }}"
                        onsubmit="return confirm('Are you sure you want to delete this assignment?')" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button class="btn-red" type="submit">
                            <x-heroicon-o-trash class="w-4 h-4" />
                        </x-button>
                    </form>
                    @endcan
                </div>
            </div>

            <hr class="w-full h-px border-gray-200" />

            <!-- Assignment Details -->
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                <!-- Left Column -->
                <div class="space-y-6">
                    <!-- Description -->
                    <div>
                        <h3 class="mb-2 text-lg font-semibold text-slate-700">Description</h3>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <p class="text-gray-700 whitespace-pre-wrap">
                                {{ $assignment->description ?? 'No description provided' }}
                            </p>
                        </div>
                    </div>

                    <!-- Dates -->
                    <div>
                        <h3 class="mb-3 text-lg font-semibold text-slate-700">Timeline</h3>
                        <div class="space-y-3">
                            @if($assignment->start_date)
                            <div class="flex items-center gap-3">
                                <span class="w-24 text-sm font-medium text-gray-600">Start Date:</span>
                                <span class="text-sm text-gray-700">{{ $assignment->start_date->format('d/m/Y')
                                    }}</span>
                            </div>
                            @endif
                            @if($assignment->end_date)
                            <div class="flex items-center gap-3">
                                <span class="w-24 text-sm font-medium text-gray-600">End Date:</span>
                                <span class="text-sm text-gray-700">{{ $assignment->end_date->format('d/m/Y') }}</span>
                            </div>
                            @endif
                            @if($assignment->start_date && $assignment->end_date)
                            <div class="flex items-center gap-3">
                                <span class="w-24 text-sm font-medium text-gray-600">Duration:</span>
                                <span class="text-sm text-gray-700">
                                    {{ $assignment->start_date->diffInDays($assignment->end_date) }} days
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <!-- Associated Task -->
                    <div>
                        <h3 class="mb-3 text-lg font-semibold text-slate-700">Associated Task</h3>
                        <div class="p-4 border border-indigo-100 rounded-lg bg-indigo-50">
                            <div class="flex items-center justify-between mb-2">
                                @can('view', $assignment->task)
                                <a wire:navigate href="{{ route('tasks.show', $assignment->task) }}"
                                    class="text-lg font-semibold text-indigo-600 transition-colors hover:text-indigo-700">
                                    {{ $assignment->task->name }}
                                </a>
                                @else
                                <span class="text-lg font-semibold text-gray-500">
                                    {{ $assignment->task->name }}
                                </span>
                                @endcan
                                @php
                                $taskStatus = App\Enums\TaskStatus::from($assignment->task->status->value);
                                @endphp
                                <x-badge :label="$taskStatus->label()" :color="$taskStatus->color()" class="text-xs" />
                            </div>
                            <p class="mb-2 text-sm text-gray-600">{{ Str::limit($assignment->task->description, 100) }}
                            </p>
                            <div class="flex items-center gap-2 text-xs text-gray-500">
                                <span>Project: {{ $assignment->task->project->name }}</span>
                                <span>•</span>
                                <span>Created: {{ $assignment->task->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Assigned User -->
                    <div>
                        <h3 class="mb-3 text-lg font-semibold text-slate-700">Assigned User</h3>
                        <div class="p-4 border border-green-100 rounded-lg bg-green-50">
                            <div class="flex items-center gap-3">
                                <div class="flex items-center justify-center w-10 h-10 bg-green-500 rounded-full">
                                    <span class="text-sm font-semibold text-white">
                                        {{ strtoupper(substr($assignment->user->name, 0, 2)) }}
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <a wire:navigate href="{{ route('users.show', $assignment->user) }}"
                                        class="text-lg font-semibold text-green-600 transition-colors hover:text-green-700">
                                        {{ $assignment->user->name }}
                                    </a>
                                    <p class="text-sm text-gray-600">{{ $assignment->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Information -->
                    <div>
                        <h3 class="mb-3 text-lg font-semibold text-slate-700">Project Information</h3>
                        <div class="p-4 border border-purple-100 rounded-lg bg-purple-50">
                            @can('view', $assignment->task->project)
                            <a wire:navigate href="{{ route('projects.show', $assignment->task->project) }}"
                                class="text-lg font-semibold text-purple-600 transition-colors hover:text-purple-700">
                                {{ $assignment->task->project->name }}
                            </a>
                            @else
                            <span class="text-lg font-semibold text-gray-500">
                                {{ $assignment->task->project->name }}
                            </span>
                            @endcan
                            <p class="mt-1 text-sm text-gray-600">{{ Str::limit($assignment->task->project->description,
                                80) }}</p>
                            <div class="flex items-center gap-2 mt-2">
                                <span class="text-xs text-gray-500">Category:</span>
                                <span class="px-2 py-1 text-xs font-medium text-purple-600 bg-purple-100 rounded">
                                    {{ $assignment->task->project->category->name ?? 'No category' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-center gap-4 pt-6 border-t border-gray-200">
                @can('update', $assignment)
                <a wire:navigate href="{{ route('assignments.edit', $assignment) }}"
                    class="px-6 py-2 rounded-lg btn-indigo">
                    Edit Assignment
                </a>
                @endcan
                @can('view', $assignment->task)
                <a wire:navigate href="{{ route('tasks.show', $assignment->task) }}"
                    class="px-6 py-2 rounded-lg btn-black">
                    View Task
                </a>
                @endcan
                @can('view', $assignment->task->project)
                <a wire:navigate href="{{ route('projects.show', $assignment->task->project) }}"
                    class="px-6 py-2 rounded-lg btn-black">
                    View Project
                </a>
                @endcan
            </div>
        </div>
    </x-wrapper-container>
</x-app-layout>

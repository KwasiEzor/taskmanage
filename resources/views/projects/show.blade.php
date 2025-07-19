<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Project details') }}
            </h2>
            <div class="flex items-center gap-2">
                @can('update', $project)
                <a wire:navigate href="{{ route('projects.edit', $project) }}"
                    class="px-4 py-1 rounded-md btn-indigo">Edit</a>
                @endcan
                <a wire:navigate href="{{ route('projects.index') }}" class="btn btn-black">
                    <x-heroicon-o-arrow-left class="w-4 h-4" />
                </a>
            </div>
        </div>


    </x-slot>
    <x-wrapper-container class="mt-6 rounded-xl">
        <div class="relative flex flex-col gap-4">
            <h1 class="flex items-center gap-2 text-2xl font-bold">
                <span class="text-slate-700">Project :</span>
                <span class="text-indigo-400 underline capitalize hover:text-indigo-500 underline-offset-4">
                    {{ $project->name }}
                </span>
                @can('delete', $project)
                <form action="{{ route('projects.destroy', $project) }}"
                    onsubmit="return confirm('Are you sure you want to delete this project?')" method="POST">
                    @csrf
                    @method('DELETE')
                    <x-button class="btn-red" type="submit">
                        <x-heroicon-o-trash class="w-4 h-4" />
                    </x-button>
                </form>
                @endcan
            </h1>
            <span class="absolute flex items-center gap-2 top-2 right-2">
                <span class="text-sm text-gray-500">Active : </span>
                @if ($project->is_active)
                <span
                    class="px-2 py-px font-semibold text-green-500 uppercase border rounded-md border-green-400/50 bg-green-50">Yes</span>
                @else
                <span
                    class="px-2 py-px font-semibold text-red-500 uppercase border rounded-md border-red-400/50 bg-red-50">No</span>
                @endif
            </span>
            <p class="text-sm text-gray-500">
                <span class="font-bold">Category :</span>
                <span
                    class="px-2 py-px font-semibold uppercase border rounded-md hover:text-fuchsia-500 border-fuchsia-400/50 bg-fuchsia-50 text-fuchsia-500">
                    {{ $project->category->name ?? 'No category' }}
                </span>
            </p>
            <hr class="w-full h-px my-4 border-gray-200" />
            <section class="flex flex-col gap-4" x-data="{ showCreateTaskModal: false }">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold">Tasks</h2>
                    @can('update', $project)
                    <x-button class="btn-black" @click="showCreateTaskModal = true">Create Task</x-button>
                    @endcan
                </div>

                <hr class="w-full h-px my-4 border-gray-200" />
                <x-projects.project-modal :project="$project" />
            </section>
            <h3 class="text-sm font-semibold underline underline-offset-4">Description</h3>
            <p class="text-base text-gray-500">{{ $project->description ?? 'No description' }}</p>
            <div class="flex flex-col gap-4">
                <h2 class="text-lg font-bold">Task List</h2>
                <div class="flex flex-col gap-4">
                    @foreach ($project->tasks as $task)
                    <x-task-card :task="$task" />
                    @endforeach
                </div>
            </div>
        </div>
    </x-wrapper-container>
</x-app-layout>

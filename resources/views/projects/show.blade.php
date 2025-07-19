<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Project details') }}
            </h2>
            <div class="flex items-center gap-2">
                @can('update', $project)
                <a wire:navigate href="{{ route('projects.edit', $project) }}"
                    class="btn-indigo rounded-md px-4 py-1">Edit</a>
                @endcan
                <a wire:navigate href="{{ route('projects.index') }}" class="btn-black rounded-md px-4 py-1">Back</a>
            </div>
        </div>


    </x-slot>
    <x-wrapper-container class="mt-6 rounded-xl">
        <div class="flex flex-col gap-4 relative">
            <h1 class="text-2xl font-bold  flex items-center gap-2">
                <span class="text-slate-700">Project :</span>
                <span class="text-indigo-400 hover:text-indigo-500 capitalize underline underline-offset-4">
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
            <span class="absolute top-2 right-2 flex items-center gap-2">
                <span class="text-sm text-gray-500">Active : </span>
                @if ($project->is_active)
                <span
                    class=" uppercase font-semibold border border-green-400/50 bg-green-50 text-green-500 rounded-md px-2 py-px">Yes</span>
                @else
                <span
                    class="uppercase text-red-500 font-semibold border border-red-400/50 bg-red-50  rounded-md px-2 py-px">No</span>
                @endif
            </span>
            <p class="text-sm text-gray-500">
                <span class="font-bold">Category :</span>
                <span
                    class=" hover:text-fuchsia-500 uppercase font-semibold border border-fuchsia-400/50 bg-fuchsia-50 text-fuchsia-500 rounded-md px-2 py-px">
                    {{ $project->category->name ?? 'No category' }}
                </span>
            </p>
            <hr class="border-gray-200 h-px w-full my-4" />
            <section class="flex flex-col gap-4" x-data="{ showCreateTaskModal: false }">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-bold">Tasks</h2>
                    @can('update', $project)
                    <x-button class="btn-black" @click="showCreateTaskModal = true">Create Task</x-button>
                    @endcan
                </div>

                <hr class="border-gray-200 h-px w-full my-4" />
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

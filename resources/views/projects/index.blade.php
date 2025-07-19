<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Projects') }}
            </h2>
            @can('create', App\Models\Project::class)
            <a wire:navigate href="{{ route('projects.create') }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                {{ __('Create Project') }}
            </a>
            @endcan
        </div>
    </x-slot>
    <div class="py-12">
        <x-wrapper-container class="rounded-xl">
            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($projects as $project)
                @can('view', $project)
                <x-project-card :project="$project" />
                @endcan
                @endforeach
            </section>
            <div class="flex justify-end">
                {{ $projects->links() }}
            </div>
        </x-wrapper-container>
    </div>
</x-app-layout>

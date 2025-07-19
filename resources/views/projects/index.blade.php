<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Projects') }}
            </h2>
            <div class="flex space-x-2">
                <a href="{{ route('projects.trashed') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 transition-all duration-300 ease-in-out bg-gray-100 rounded-md hover:bg-gray-200">
                    {{ __('Archived') }}
                </a>
                @can('create', App\Models\Project::class)
                <a wire:navigate href="{{ route('projects.create') }}"
                    class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                    {{ __('Create Project') }}
                </a>
                @endcan
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <x-wrapper-container class="rounded-xl">
            <section class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                @forelse ($projects as $project)
                @can('view', $project)
                <x-project-card :project="$project" />
                @endcan
                @empty
                <div class="flex flex-col items-center justify-center w-full py-12 text-center col-span-full">
                    <div class="w-16 h-16 mb-4 text-gray-400">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-lg font-medium text-gray-900">No projects found</h3>
                    <p class="mb-4 text-gray-500">Get started by creating your first project.</p>
                    @can('create', App\Models\Project::class)
                    <a href="{{ route('projects.create') }}"
                        class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                        Create Project
                    </a>
                    @endcan
                </div>
                @endforelse
            </section>
            <div class="flex justify-end">
                {{ $projects->links() }}
            </div>
        </x-wrapper-container>
    </div>
</x-app-layout>

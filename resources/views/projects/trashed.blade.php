<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archived Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-medium text-gray-900">
                            Archived Projects
                        </h1>
                        <a href="{{ route('projects.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Projects
                        </a>
                    </div>

                    @if($trashedProjects->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($trashedProjects as $project)
                        <div
                            class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        {{ $project->name }}
                                    </h3>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Archived
                                    </span>
                                </div>

                                @if($project->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $project->description }}
                                </p>
                                @endif

                                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                    <span>Status: {{ $project->status->value }}</span>
                                    <span>Archived: {{ $project->deleted_at->format('M d, Y') }}</span>
                                </div>

                                @if($project->category)
                                <div class="mb-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $project->category->name }}
                                    </span>
                                </div>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        {{ $project->tasks_count ?? 0 }} tasks
                                    </div>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('projects.restore', $project->slug) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded">
                                                Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('projects.force-delete', $project->slug) }}"
                                            method="POST" class="inline"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this project? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white text-xs font-bold py-2 px-3 rounded">
                                                Delete Permanently
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $trashedProjects->links() }}
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No archived projects</h3>
                        <p class="text-gray-500">You don't have any archived projects at the moment.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

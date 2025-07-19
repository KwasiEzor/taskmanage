<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Archived Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-medium text-gray-900">
                            Archived Tasks
                        </h1>
                        <a href="{{ route('tasks.index') }}"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Back to Tasks
                        </a>
                    </div>

                    @if($trashedTasks->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($trashedTasks as $task)
                        <div
                            class="bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        {{ $task->name }}
                                    </h3>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Archived
                                    </span>
                                </div>

                                @if($task->description)
                                <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                    {{ $task->description }}
                                </p>
                                @endif

                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Status:</span>
                                        <span class="font-medium">{{ $task->status->value }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Priority:</span>
                                        <span class="font-medium">{{ $task->priority->value }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Project:</span>
                                        <span class="font-medium">{{ $task->project->name }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Archived:</span>
                                        <span class="font-medium">{{ $task->deleted_at->format('M d, Y') }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="text-sm text-gray-500">
                                        {{ $task->assignments_count ?? 0 }} assignments
                                    </div>
                                    <div class="flex space-x-2">
                                        <form action="{{ route('tasks.restore', $task->slug) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-500 hover:bg-green-700 text-white text-xs font-bold py-2 px-3 rounded">
                                                Restore
                                            </button>
                                        </form>
                                        <form action="{{ route('tasks.force-delete', $task->slug) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Are you sure you want to permanently delete this task? This action cannot be undone.')">
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
                        {{ $trashedTasks->links() }}
                    </div>
                    @else
                    <div class="text-center py-12">
                        <div class="text-gray-400 mb-4">
                            <svg class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">No archived tasks</h3>
                        <p class="text-gray-500">You don't have any archived tasks at the moment.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

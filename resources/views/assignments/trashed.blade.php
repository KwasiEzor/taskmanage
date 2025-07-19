<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Archived Assignments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 lg:p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-medium text-gray-900">
                            Archived Assignments
                        </h1>
                        <a href="{{ route('assignments.index') }}"
                            class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Back to Assignments
                        </a>
                    </div>

                    @if($trashedAssignments->count() > 0)
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($trashedAssignments as $assignment)
                        <div
                            class="transition-shadow duration-200 bg-white border border-gray-200 rounded-lg shadow-sm hover:shadow-md">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900 truncate">
                                        {{ $assignment->title }}
                                    </h3>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Archived
                                    </span>
                                </div>

                                @if($assignment->description)
                                <p class="mb-4 text-sm text-gray-600 line-clamp-2">
                                    {{ $assignment->description }}
                                </p>
                                @endif

                                <div class="mb-4 space-y-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Status:</span>
                                        <span class="font-medium">{{ $assignment->status->value }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Task:</span>
                                        <span class="font-medium">{{ $assignment->task->name }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Project:</span>
                                        <span class="font-medium">{{ $assignment->task->project->name }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Assigned to:</span>
                                        <span class="font-medium">{{ $assignment->user->name }}</span>
                                    </div>
                                    @if($assignment->start_date)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Start Date:</span>
                                        <span class="font-medium">{{ $assignment->start_date->format('M d, Y') }}</span>
                                    </div>
                                    @endif
                                    @if($assignment->end_date)
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">End Date:</span>
                                        <span class="font-medium">{{ $assignment->end_date->format('M d, Y') }}</span>
                                    </div>
                                    @endif
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500">Archived:</span>
                                        <span class="font-medium">{{ $assignment->deleted_at->format('M d, Y') }}</span>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between">
                                    <div class="w-full text-sm text-gray-500">
                                        Created: {{ $assignment->created_at->format('M d, Y') }}
                                    </div>
                                </div>
                                <div class="flex w-full mt-4 space-x-2">
                                    <form action="{{ route('assignments.restore', $assignment->slug) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="px-3 py-2 text-xs font-bold text-white bg-green-500 rounded hover:bg-green-700">
                                            Restore
                                        </button>
                                    </form>
                                    <form action="{{ route('assignments.force-delete', $assignment->slug) }}"
                                        method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to permanently delete this assignment? This action cannot be undone.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-3 py-2 text-xs font-bold text-white bg-red-500 rounded hover:bg-red-700">
                                            Delete Permanently
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $trashedAssignments->links() }}
                    </div>
                    @else
                    <div class="py-12 text-center">
                        <div class="mb-4 text-gray-400">
                            <svg class="w-12 h-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-lg font-medium text-gray-900">No archived assignments</h3>
                        <p class="text-gray-500">You don't have any archived assignments at the moment.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

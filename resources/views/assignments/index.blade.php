<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Assignments') }}
            </h2>
            @can('create', App\Models\Assignment::class)
            <a href="{{ route('assignments.create') }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                {{ __('Create Assignment') }}
            </a>
            @endcan
        </div>
    </x-slot>

    <x-wrapper-container class="mt-6 rounded-xl">
        @if($assignments->count() > 0)
        <section class="grid grid-cols-1 gap-4 md:grid-cols-2 ">
            @foreach ($assignments as $assignment)
            @can('view', $assignment)
            <x-assignment-card :assignment="$assignment" />
            @endcan
            @endforeach
        </section>
        <div class="mt-6">
            {{ $assignments->links() }}
        </div>
        @else
        <div class="flex flex-col items-center justify-center py-12 text-center">
            <div class="w-16 h-16 mb-4 text-gray-400">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                    </path>
                </svg>
            </div>
            <h3 class="mb-2 text-lg font-medium text-gray-900">No assignments found</h3>
            <p class="mb-4 text-gray-500">Get started by creating your first assignment.</p>
            @can('create', App\Models\Assignment::class)
            <a href="{{ route('assignments.create') }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                Create Assignment
            </a>
            @endcan
        </div>
        @endif
    </x-wrapper-container>
</x-app-layout>

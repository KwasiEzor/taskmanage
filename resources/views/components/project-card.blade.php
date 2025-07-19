@props(['project'])

@php
$statusEnum = $project->status instanceof App\Enums\ProjectStatus
? $project->status
: App\Enums\ProjectStatus::tryFrom($project->status);
@endphp

<article
    class="p-4 transition-shadow duration-300 ease-in-out bg-white rounded-lg shadow-md hover:shadow-lg border border-zinc-200 hover:border-indigo-400">
    <div class="relative flex flex-col p-4 space-y-4 rounded-md bg-zinc-100/50">
        <div class="w-full space-y-2">
            <h3 class="flex items-center gap-2 font-medium text-md font-poppins ">
                <span class="hover:text-indigo-400 text-slate-700 text-md">
                    {{ $project->name }}
                </span>
            </h3>
        </div>
        <div class="flex gap-2 flex-col">
            <div class="flex gap-2 items-center justify-between w-full ">
                <p class="flex items-center gap-1 text-sm text-gray-500">
                    <span class="text-sm text-gray-500">Category :</span>
                    <span
                        class="flex items-center justify-center px-2 py-px font-bold border border-fuchsia-500/50 bg-fuchsia-50 text-fuchsia-500 rounded-full">
                        {{ $project->category->name ?? 'No category' }}
                    </span>
                </p>
            </div>
            <div class="flex gap-2 items-center justify-between w-full ">
                <p class="flex items-center gap-1 text-sm text-gray-500">
                    <span class="text-sm text-gray-500">Tasks available :</span>
                    <span class="flex items-center justify-center px-1 font-bold text-white bg-indigo-400 rounded-full">
                        {{ $project->tasks->count() }}
                    </span>
                </p>
                <div class="flex items-center gap-2">
                    @can('view', $project)
                    <a wire:navigate href="{{ route('projects.show', $project) }}"
                        class="flex items-center justify-center px-3 py-1 text-sm font-bold text-white bg-indigo-400 rounded-md">
                        View
                    </a>
                    @endcan
                    @can('update', $project)
                    <a wire:navigate href="{{ route('projects.edit', $project) }}"
                        class="flex items-center justify-center px-3 py-1 text-sm font-bold text-white bg-green-500 rounded-md">
                        Edit
                    </a>
                    @endcan
                    @can('delete', $project)
                    <form method="POST" action="{{ route('projects.destroy', $project) }}" class="inline"
                        onsubmit="return confirm('Are you sure you want to delete this project?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center justify-center px-3 py-1 text-sm font-bold text-white bg-red-500 rounded-md">
                            Delete
                        </button>
                    </form>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</article>

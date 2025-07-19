<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Task') }}
            </h2>
            <a wire:navigate href="{{ route('tasks.show', $task) }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                {{ __('Back to Task') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <x-wrapper-container class="rounded-xl">
            <div class="max-w-2xl mx-auto">
                <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Task Name -->
                    <div>
                        <x-label for="name" value="{{ __('Task Name') }}" />
                        <x-input id="name" type="text" name="name" :value="old('name', $task->name)" required autofocus
                            class="block w-full mt-1" />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" rows="4"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $task->description) }}</textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <!-- Project -->
                    <div>
                        <x-label for="project_id" value="{{ __('Project') }}" />
                        <select id="project_id" name="project_id"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Project</option>
                            @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id', $task->project_id)==$project->id ?
                                'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="project_id" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select id="status" name="status"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Status</option>
                            @foreach(\App\Enums\TaskStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ old('status', $task->status->value)==$status->value
                                ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>

                    <!-- Priority -->
                    <div>
                        <x-label for="priority" value="{{ __('Priority') }}" />
                        <select id="priority" name="priority"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Priority</option>
                            @foreach(\App\Enums\TaskPriority::cases() as $priority)
                            <option value="{{ $priority->value }}" {{ old('priority', $task->
                                priority->value)==$priority->value ? 'selected' : '' }}>
                                {{ $priority->label() }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="priority" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4 btn-black">
                            {{ __('Update Task') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-wrapper-container>
    </div>
</x-app-layout>

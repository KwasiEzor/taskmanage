<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Assignment') }}
            </h2>
            <a wire:navigate href="{{ route('assignments.index') }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                {{ __('Back to Assignments') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <x-wrapper-container class="rounded-xl">
            <div class="max-w-2xl mx-auto">
                <form method="POST" action="{{ route('assignments.store') }}" class="space-y-6">
                    @csrf

                    <!-- Assignment Title -->
                    <div>
                        <x-label for="title" value="{{ __('Assignment Title') }}" />
                        <x-input id="title" type="text" name="title" :value="old('title')" required autofocus
                            class="block w-full mt-1" />
                        <x-input-error for="title" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" rows="4"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <!-- Task Selection -->
                    <div>
                        <x-label for="task_id" value="{{ __('Task') }}" />
                        <select id="task_id" name="task_id" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Task</option>
                            @foreach($tasks as $task)
                            <option value="{{ $task->id }}" {{ old('task_id')==$task->id ? 'selected' : '' }}>
                                {{ $task->name }} ({{ $task->project->name ?? 'No Project' }})
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="task_id" class="mt-2" />
                    </div>

                    <!-- User Assignment -->
                    <div>
                        <x-label for="user_id" value="{{ __('Assign To') }}" />
                        <select id="user_id" name="user_id" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('user_id')==$user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="user_id" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select id="status" name="status" required
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Status</option>
                            @foreach(\App\Enums\AssignmentStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ old('status')==$status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>

                    <!-- Start Date -->
                    <div>
                        <x-label for="start_date" value="{{ __('Start Date') }}" />
                        <x-input id="start_date" type="date" name="start_date" :value="old('start_date')"
                            class="block w-full mt-1" />
                        <x-input-error for="start_date" class="mt-2" />
                    </div>

                    <!-- End Date -->
                    <div>
                        <x-label for="end_date" value="{{ __('End Date') }}" />
                        <x-input id="end_date" type="date" name="end_date" :value="old('end_date')"
                            class="block w-full mt-1" />
                        <x-input-error for="end_date" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4 btn-black">
                            {{ __('Create Assignment') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-wrapper-container>
    </div>
</x-app-layout>

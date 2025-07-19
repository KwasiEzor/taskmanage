<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Create Project') }}
            </h2>
            <a wire:navigate href="{{ route('projects.index') }}"
                class="px-4 py-2 text-sm font-medium text-white transition-all duration-300 ease-in-out bg-indigo-500 rounded-md hover:bg-indigo-700">
                {{ __('Back to Projects') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <x-wrapper-container class="rounded-xl">
            <div class="max-w-2xl mx-auto">
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                    @csrf

                    <!-- Project Name -->
                    <div>
                        <x-label for="name" value="{{ __('Project Name') }}" />
                        <x-input id="name" type="text" name="name" :value="old('name')" required autofocus
                            class="block w-full mt-1" />
                        <x-input-error for="name" class="mt-2" />
                    </div>

                    <!-- Description -->
                    <div>
                        <x-label for="description" value="{{ __('Description') }}" />
                        <textarea id="description" name="description" rows="4"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-label for="status" value="{{ __('Status') }}" />
                        <select id="status" name="status"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Status</option>
                            @foreach(\App\Enums\ProjectStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ old('status')==$status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>

                    <!-- Category -->
                    <div>
                        <x-label for="category_id" value="{{ __('Category') }}" />
                        <select id="category_id" name="category_id"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : ''
                                }}>
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                        <x-input-error for="category_id" class="mt-2" />
                    </div>

                    <!-- Is Active -->
                    <div class="flex items-center">
                        <input id="is_active" type="checkbox" name="is_active" value="1" {{ old('is_active') ? 'checked'
                            : '' }}
                            class="text-indigo-600 border-gray-300 rounded shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <x-label for="is_active" value="{{ __('Active Project') }}" class="ml-2" />
                        <x-input-error for="is_active" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <x-button class="ml-4 btn-black">
                            {{ __('Create Project') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </x-wrapper-container>
    </div>
</x-app-layout>

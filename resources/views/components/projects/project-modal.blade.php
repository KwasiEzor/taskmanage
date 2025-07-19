@props(['project'])

<!-- Modal -->
<div x-show="showCreateTaskModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
    <div class="fixed inset-0 transform transition-all" @click="showCreateTaskModal = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-2xl sm:mx-auto"
        @click.stop x-trap.inert.noscroll="showCreateTaskModal" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Create Task</h3>
        </div>
        <div class="px-6 py-4">
            <form action="{{ route('projects.tasks.store', $project) }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-label for="name" value="Name" />
                        <x-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        <x-input-error for="name" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="description" value="Description" />
                        <textarea id="description" name="description"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            rows="3"></textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="status" value="Status" />
                        <select id="status" name="status"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="pending">Pending</option>
                            <option value="in_progress">In Progress</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                        <x-input-error for="status" class="mt-2" />
                    </div>
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div>
                        <x-label for="priority" value="Priority" />
                        <select id="priority" name="priority"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                        </select>
                        <x-input-error for="priority" class="mt-2" />
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <x-button type="button" class="btn-red" @click="showCreateTaskModal = false">
                        Cancel
                    </x-button>
                    <x-button type="submit" class="btn-indigo">
                        Create Task
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
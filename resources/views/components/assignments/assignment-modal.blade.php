@props(['task'])

<!-- Modal -->
<div x-show="showCreateAssignmentModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50" style="display: none;">
    <div class="fixed inset-0 transform transition-all" @click="showCreateAssignmentModal = false">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:max-w-2xl sm:mx-auto"
        @click.stop x-trap.inert.noscroll="showCreateAssignmentModal" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Create Assignment</h3>
            <p class="text-sm text-gray-600 mt-1">Assigning to task: {{ $task->name }}</p>
        </div>
        <div class="px-6 py-4">
            <form action="{{ route('assignments.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <x-label for="title" value="Title" />
                        <x-input id="title" name="title" type="text" class="mt-1 block w-full" required />
                        <x-input-error for="title" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="description" value="Description" />
                        <textarea id="description" name="description"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            rows="3"></textarea>
                        <x-input-error for="description" class="mt-2" />
                    </div>
                    <div>
                        <x-label for="user_id" value="Assign To" />
                        <select id="user_id" name="user_id"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            required>
                            <option value="">Select a user</option>
                            @foreach(App\Models\User::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                        <x-input-error for="user_id" class="mt-2" />
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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-label for="start_date" value="Start Date" />
                            <x-input id="start_date" name="start_date" type="date" class="mt-1 block w-full" />
                            <x-input-error for="start_date" class="mt-2" />
                        </div>
                        <div>
                            <x-label for="end_date" value="End Date" />
                            <x-input id="end_date" name="end_date" type="date" class="mt-1 block w-full" />
                            <x-input-error for="end_date" class="mt-2" />
                        </div>
                    </div>
                    <input type="hidden" name="task_id" value="{{ $task->id }}">
                </div>
                <div class="mt-6 flex justify-end space-x-3">
                    <x-button type="button" class="btn-red" @click="showCreateAssignmentModal = false">
                        Cancel
                    </x-button>
                    <x-button type="submit" class="btn-indigo">
                        Create Assignment
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
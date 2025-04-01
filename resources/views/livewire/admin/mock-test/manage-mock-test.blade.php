<div class="container mx-auto px-4 sm:px-8 py-8">
    @include('components.loader')

    <div class="flex flex-col gap-8" wire:loading.remove>
        <div class="w-full mb-8">
            <div class="bg-white shadow-md rounded-lg p-6">
                <!-- Header -->
                <div class="flex flex-wrap justify-between items-center p-4">
                    <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-600 pl-3 mb-5">
                        Mock Test Management
                    </h2>
                    <div class="flex gap-2">
                        <button wire:click="$toggle('showModal')"
                            class="bg-purple-800 hover:bg-purple-600 text-white px-4 py-2 rounded flex items-center gap-2">
                            <i class="bi bi-plus-circle"></i> Add New Test
                        </button>
                        <button wire:click="$toggle('showJsonModal')"
                            class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded flex items-center gap-2">
                            <i class="bi bi-file-earmark-code"></i> Import JSON
                        </button>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="mb-4 border-b border-gray-200">
                    <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
                        <li class="mr-2" role="presentation">
                            <button wire:click="$set('activeTab', 'tests')" 
                                class="inline-block p-4 rounded-t-lg {{ $activeTab === 'tests' ? 'border-b-2 border-purple-600 text-purple-600' : 'hover:text-gray-600 hover:border-gray-300' }}">
                                Mock Tests
                            </button>
                        </li>
                       
                    </ul>
                </div>

                <!-- JSON Import Modal -->
                @if ($showJsonModal)
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                        wire:click.self="$toggle('showJsonModal')">
                        <div class="relative top-20 mx-auto p-5 border w-2/3 shadow-lg rounded-md bg-white" wire:click.stop>
                            <h3 class="text-lg font-medium mb-4">Import Mock Test from JSON</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">JSON Data</label>
                                <textarea wire:model="jsonData" rows="10"
                                    class="w-full p-2 border rounded-md"
                                    placeholder='{
    "test_title": "Example Test",
    "course_id": 1,
    "level": "beginners",
    "status": true,
    "is_public": false,
    "questions": [
        {
            "question": "What is...",
            "options": ["Option 1", "Option 2", "Option 3", "Option 4"],
            "correct_answer": "Option 1",
            "marks": 1
        }
    ]
}'></textarea>
                                @error('jsonData') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>

                            <div class="flex justify-end gap-2">
                                <button wire:click="$toggle('showJsonModal')"
                                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                    Cancel
                                </button>
                                <button wire:click="importJson" wire:loading.attr="disabled"
                                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 disabled:opacity-50">
                                    <span wire:loading.remove wire:target="importJson">Import</span>
                                    <span wire:loading wire:target="importJson">Importing...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Mock Test Modal -->
                @if ($showModal)
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                        wire:click.self="$toggle('showModal')">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
                            wire:click.stop>
                            <form wire:submit="save">
                                <h3 class="text-lg font-medium mb-4">
                                    {{ $editingId ? 'Edit' : 'Create' }} Mock Test
                                </h3>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Test Title</label>
                                    <input type="text" wire:model="test_title"
                                        class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    @error('test_title')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Course</label>
                                    <select wire:model="course_id"
                                        class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="">Select Course</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="block text-sm font-medium text-gray-700">Level</label>
                                    <select wire:model="level"
                                        class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:outline-none focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="beginners">Beginners</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="hard">Hard</option>
                                    </select>
                                    @error('level')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="status"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                            {{ $status ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-600">Active</span>
                                    </label>
                                </div>

                                <div class="mb-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="is_public"
                                            class="rounded border-gray-300 text-indigo-600 shadow-sm"
                                            {{ $is_public ? 'checked' : '' }}>
                                        <span class="ml-2 text-sm text-gray-600">Public</span>
                                    </label>
                                </div>

                                <div class="flex justify-end space-x-2">
                                    <button type="button" wire:click="resetForm"
                                        class="px-4 py-2 text-gray-700 rounded hover:bg-gray-100">
                                        Cancel
                                    </button>
                                    <button type="submit" wire:loading.attr="disabled" 
                                        class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 disabled:opacity-50">
                                        <span wire:loading.remove wire:target="save">Save</span>
                                        <span wire:loading wire:target="save">Saving...</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif

                @if ($deleteId)
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                        <div class="bg-white p-5 rounded-md">
                            <p class="mb-4">Are you sure you want to delete this mock test?</p>
                            <div class="flex justify-end space-x-2">
                                <button wire:click="$set('deleteId', null)"
                                    class="px-4 py-2 text-gray-700 rounded hover:bg-gray-100">
                                    Cancel
                                </button>
                                <button wire:click="delete" wire:loading.attr="disabled"
                                    class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 disabled:opacity-50">
                                    <span wire:loading.remove wire:target="delete">Delete</span>
                                    <span wire:loading wire:target="delete">Deleting...</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tab Content -->
                <div class="mt-4">
                    @if ($activeTab === 'tests')
                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Title</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Course</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Level</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>

                                        <th scope="col"
                                            class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($tests as $test)
                                        <tr class="hover:bg-gray-50 text-center">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $test->test_title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $test->course->title }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ ucfirst($test->level) }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <button wire:click="toggleStatus({{ $test->id }})" wire:loading.attr="disabled"
                                                    class="px-2 py-1 rounded text-white {{ $test->status ? 'bg-green-500 hover:bg-green-600' : 'bg-red-500 hover:bg-red-600' }} disabled:opacity-50">
                                                    <span wire:loading.remove wire:target="toggleStatus({{ $test->id }})">
                                                        {{ $test->status ? 'Active' : 'Inactive' }}
                                                    </span>
                                                    <span wire:loading wire:target="toggleStatus({{ $test->id }})">
                                                        Updating...
                                                    </span>
                                                </button>
                                            </td>

                                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                                <div class="flex gap-2 item-center justify-center">
                                                    <button wire:click="edit({{ $test->id }})"
                                                        class="bg-blue-500 text-white py-1 px-4 rounded-lg">
                                                        Edit
                                                    </button>
                                                    <button wire:click="viewQuestions({{ $test->id }})"
                                                        class="bg-purple-800 text-white py-1 px-4 rounded-lg">
                                                        View
                                                    </button>
                                                    <button wire:click="confirmDelete({{ $test->id }})"
                                                        class="bg-red-500 text-white py-1 px-4 rounded-lg">
                                                        Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>


                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-3 text-center">
                                                No Test found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $tests->links() }}
                        </div>
                   
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

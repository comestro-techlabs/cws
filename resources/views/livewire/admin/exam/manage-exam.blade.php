<div>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- Search and Create Section -->
        <div class="flex justify-between items-center mb-6 mt-12 ">
            <div class="w-1/3">
                <input wire:model.debounce.300ms="search" type="text" placeholder="Search exams..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button wire:click="toggleForm" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                {{ $showForm ? 'Cancel' : 'Create Exam' }}
            </button>
        </div>

        <!-- Create/Edit Form -->
        @if($showForm)
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Exam' : 'Create New Exam' }}</h3>
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Exam Name</label>
                        <input wire:model="exam_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('exam_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Course</label>
                        <select wire:model.change="course_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Select Course</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        @error('course_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Batch</label>
                        <select wire:model.change="batch_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" {{ !$course_id ? 'disabled' : '' }}>
                            <option value="">Select Batch</option>
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                            @endforeach
                        </select>
                        @error('batch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        {{-- @if(!$course_id)
                            <p class="mt-1 text-sm text-gray-500">Please select a course first</p>
                        @elseif($course->batches->isEmpty())
                            <p class="mt-1 text-sm text-red-500">No batches available for this course</p>
                        @endif --}}
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Exam Date</label>
                        <input wire:model="exam_date" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                        @error('exam_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-2">
                        <label class="flex items-center">
                            <input wire:model="status" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm">
                            <span class="ml-2">Active</span>
                        </label>
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" wire:click="toggleForm" 
                        class="px-4 py-2 border rounded-lg hover:bg-gray-100">Cancel</button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        {{ $isEditing ? 'Update' : 'Create' }}
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Flash Messages -->
        @if (session()->has('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <!-- Exams Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($exams as $exam)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $exam->exam_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $exam->course->title }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $exam->batch->batch_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $exam->exam_date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="toggleStatus({{ $exam->id }})" 
                                class="px-3 py-1 rounded-full text-sm {{ $exam->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $exam->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button wire:click="edit({{ $exam->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $exam->id }})" 
                                class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Are you sure you want to delete this exam?')">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $exams->links() }}
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('batches-updated', () => {
            // Optional: Add any client-side logic here
        });
    });
</script>

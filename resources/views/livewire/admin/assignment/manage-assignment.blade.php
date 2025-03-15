<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
        <!-- Page Header -->
        <div class="mb-8 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">Manage Assignments</h1>
            <button wire:click="create" class="bg-teal-600 text-white px-4 py-2 rounded-lg hover:bg-teal-700 inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Assignment
            </button>
        </div>

        <!-- Filters Section -->
        <div class="bg-white p-6 rounded-lg shadow mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Filter by Course</label>
                    <select wire:model.live="course_id" class="mt-1 block w-full rounded-md border-gray-300">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Search</label>
                    <input type="text" wire:model.live="search" 
                        class="mt-1 block w-full rounded-md border-gray-300" 
                        placeholder="Search assignments...">
                </div>
                <div class="flex items-end">
                    <button wire:click="clearFilter" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-times mr-2"></i> Clear Filters
                    </button>
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if (session()->has('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Assignments Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Due Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($assignments as $assignment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $assignment->title }}</td>
                            <td class="px-6 py-4">{{ $assignment->course?->title ?? 'No Course' }}</td>
                            <td class="px-6 py-4">
                                @if($assignment->due_date)
                                    {{ \Carbon\Carbon::parse($assignment->due_date)->format('M d, Y H:i') }}
                                @else
                                    No Due Date
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleStatus({{ $assignment->id }})" 
                                    class="px-3 py-1 rounded-full text-sm {{ $assignment->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $assignment->status ? 'Active' : 'Inactive' }}
                                </button>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-3">
                                    <!-- View Submissions -->
                                    <button wire:click="viewAssignmentSubmissions({{ $assignment->id }})" 
                                        class="text-blue-600 hover:text-blue-900" 
                                        title="View Submissions">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    
                                    <!-- Edit -->
                                    <button wire:click="edit({{ $assignment->id }})" 
                                        class="text-teal-600 hover:text-teal-900"
                                        title="Edit Assignment">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    
                                    <!-- Delete -->
                                    <button wire:click="delete({{ $assignment->id }})" 
                                        onclick="return confirm('Are you sure you want to delete this assignment?')"
                                        class="text-red-600 hover:text-red-900"
                                        title="Delete Assignment">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No assignments found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4 border-t">
                {{ $assignments->links() }}
            </div>
        </div>
    </div>

    <!-- Create/Edit Modal -->
    @if($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50">
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl">
                        <form wire:submit="save">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <!-- Form fields -->
                                <div class="grid grid-cols-1 gap-4">
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Course</label>
                                            <select wire:model.live="course_id" class="mt-1 block w-full rounded-md border-gray-300">
                                                <option value="">Select Course</option>
                                                @foreach($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('course_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>

                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Batch</label>
                                            <select wire:model="batch_id" class="mt-1 block w-full rounded-md border-gray-300">
                                                <option value="">Select Batch</option>
                                                @foreach($batches as $batch)
                                                    <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('batch_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Title</label>
                                        <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300">
                                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Description</label>
                                        <textarea wire:model="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300"></textarea>
                                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700">Due Date</label>
                                        <input type="datetime-local" wire:model="due_date" class="mt-1 block w-full rounded-md border-gray-300">
                                        @error('due_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="flex items-center">
                                        <input type="checkbox" wire:model="status" class="rounded border-gray-300 text-teal-600">
                                        <label class="ml-2 block text-sm text-gray-900">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit" class="inline-flex w-full justify-center rounded-md bg-teal-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 sm:ml-3 sm:w-auto">
                                    {{ $editingAssignment ? 'Update' : 'Create' }}
                                </button>
                                <button type="button" wire:click="closeModal" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Submissions Modal -->
    @if($viewSubmissions)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity z-50">
            <div class="fixed inset-0 z-50 overflow-y-auto">
                <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                    <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <!-- Header -->
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold">
                                    {{ $currentAssignment->title }} - Submissions
                                </h3>
                                <button wire:click="closeSubmissions" class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                            <!-- Submissions Table -->
                            <div class="mt-4">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submitted</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Files</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @forelse($studentSubmissions as $submission)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $submission['student_name'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $submission['submitted_at'] }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                        {{ $submission['status'] === 'overdue' ? 'bg-red-100 text-red-800' : 
                                                           ($submission['status'] === 'submitted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                        {{ ucfirst($submission['status']) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                    @foreach($submission['files'] as $file)
                                                        <button wire:click="previewFile('{{ $file['file_path'] }}')" 
                                                                class="text-blue-600 hover:text-blue-900 mr-2">
                                                            File {{ $loop->iteration }}
                                                        </button>
                                                    @endforeach
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" 
                                                        wire:model.defer="grade" 
                                                        wire:change="updateGrade('{{ $submission['student_id'] }}', $event.target.value)"
                                                        class="w-20 rounded border-gray-300" 
                                                        min="0" 
                                                        max="100" 
                                                        value="{{ $submission['grade'] }}">
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                    No submissions found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- File Preview Modal -->
    @if($selectedFileId)
        <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-4 rounded-lg w-11/12 max-w-4xl h-5/6 relative">
                <button wire:click="closePreview" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                <iframe src="https://drive.google.com/file/d/{{ $selectedFileId }}/preview"
                        class="w-full h-[90%] border rounded-lg mt-8"></iframe>
            </div>
        </div>
    @endif
</div>

<div>
    @include('components.loader')

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow">
            <!-- Header -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="text-xl font-semibold text-gray-800">Manage Exams</h2>
            </div>

            <!-- Filters and Actions -->
            <div class="p-6 border-b space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search -->
                    <div class="lg:col-span-2">
                        <div class="relative">
                            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search exams..."
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                            <span class="absolute right-3 top-3 text-gray-400">
                                <i class="bi bi-search"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Course Filter -->
                    <div>
                        <select wire:model.live="filters.course"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                            <option value="">All Courses</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Batch Filter -->
                    <div>
                        <select wire:model.live="filters.batch"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                            <option value="">All Batches</option>
                            @foreach ($batches as $batch)
                                <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <select wire:model.live="filters.status"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                            <option value="">All Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-between items-center pt-4">
                    <button wire:click="resetFilters"
                        class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all duration-200">
                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset Filters
                    </button>
                    <div class="flex gap-2">
                        <button wire:click="toggleForm"
                            class="flex items-center gap-2 px-6 py-2.5 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-200">
                            <i class="bi bi-plus-lg"></i>
                            {{ $showForm ? 'Cancel' : 'Create Exam' }}
                        </button>
                        <button wire:click="$toggle('showJsonModal')"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Import JSON
                        </button>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            @if ($showForm)
                <div class="p-6 border-b bg-gray-50">
                    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Exam Name</label>
                                <input wire:model="exam_name" type="text"
                                    class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                                @error('exam_name')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Course</label>
                                <select wire:model.live="course_id"
                                    class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                                    <option value="">Select Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Batch</label>
                                <select wire:model="batch_id"
                                    class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200 disabled:bg-gray-100 disabled:cursor-not-allowed"
                                    {{ !$course_id ? 'disabled' : '' }}>
                                    <option value="">Select Batch</option>
                                    @if ($batches)
                                        @foreach ($batches as $batch)
                                            <option value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('batch_id')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Exam Date</label>
                                <input wire:model="exam_date" type="date"
                                    class="mt-1 w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-300 focus:border-purple-300 transition-all duration-200">
                                @error('exam_date')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center space-x-2">
                            <input wire:model="status" type="checkbox"
                                class="rounded border-gray-300 text-purple-600 shadow-sm">
                            <label class="text-sm text-gray-700">Active</label>
                        </div>

                        <div class="flex justify-end space-x-3">
                            <button type="submit"
                                class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                                {{ $isEditing ? 'Update' : 'Create' }}
                            </button>
                        </div>
                    </form>
                </div>
            @endif

        </div>

        <!-- JSON Import Modal -->
        @if ($showJsonModal)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                wire:click.self="$toggle('showJsonModal')">
                <div class="relative top-20 mx-auto p-5 border w-2/3 shadow-lg rounded-md bg-white">
                    <h3 class="text-lg font-medium mb-4">Import Exam from JSON</h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">JSON Data</label>
                        <textarea wire:model="jsonData" rows="10" class="w-full p-2 border rounded-md"
                            placeholder='{
                                "exam_name": "Example Exam",
                                "course_id": 1,
                                "batch_id": 1,
                                "exam_date": "2024-03-20",
                                "status": true,
                                "passcode": "123456",
                                "questions": [
                                    {
                                    "question": "First question?",
                                    "options": ["Option 1", "Option 2", "Option 3", "Option 4"],
                                    "correct_answer": "option1",
                                    "status": true
                                },
                                {
                                    "question": "second question?",
                                    "options": ["Option 1", "Option 2", "Option 3", "Option 4"],
                                    "correct_answer": "option1",
                                    "status": true
                                }
                                ]
                            }'>
                        </textarea>
                        @error('jsonData')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <button wire:click="$toggle('showJsonModal')"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </button>
                        <button wire:click="importJson"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                            Import
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <!-- Exam List -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Course</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Batch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($exams as $exam)
                        <tr>
                            <td class="px-6 py-4">{{ $exam->exam_name }}</td>
                            <td class="px-6 py-4">{{ $exam->course->title }}</td>
                            <td class="px-6 py-4">{{ $exam->batch->batch_name }}</td>
                            <td class="px-6 py-4">{{ $exam->exam_date }}</td>
                            <td class="px-6 py-4">
                                <button wire:click="toggleStatus({{ $exam->id }})"
                                    class="px-3 py-1.5 rounded-full text-xs font-semibold transition-colors duration-200
                                        {{ $exam->status ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-red-100 text-red-800 hover:bg-red-200' }}">
                                    <span wire:loading.remove wire:target="toggleStatus({{ $exam->id }})">
                                        {{ $exam->status ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span wire:loading wire:target="toggleStatus({{ $exam->id }})">
                                        <i class="bi bi-arrow-repeat animate-spin inline-block"></i>
                                    </span>
                                </button>
                            </td>
                            <td class="px-6 py-4 text-right text-sm space-x-2">
                                <button wire:click="edit({{ $exam->id }})"
                                    class="text-blue-600 hover:text-blue-900">
                                    Edit
                                </button>
                                <a href="{{ route('admin.exam.questions', ['examId' => $exam->id]) }}"
                                    class="text-purple-600 hover:text-purple-900">
                                    Questions
                                </a>
                                <button
                                    wire:click="{{ $exam->passcode ? 'showPasscode(' . $exam->id . ')' : 'generatePasscode(' . $exam->id . ')' }}"
                                    class="text-green-600 hover:text-green-900">
                                    {{ $exam->passcode ? 'Show Code' : 'Generate' }}
                                </button>
                                <button wire:click="delete({{ $exam->id }})"
                                    class="text-red-600 hover:text-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No exams found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!-- Passcode Modal -->
        @if ($showPasscodeModal)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full">
                    <h3 class="text-lg font-medium mb-4">Exam Passcode</h3>
                    <p class="text-2xl font-mono text-center mb-4">{{ $generatedPasscode }}</p>
                    <button wire:click="closePasscodeModal"
                        class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                        Close
                    </button>
                </div>
            </div>
        @endif
        <!-- Pagination -->
        <div class="px-6 py-4 border-t">
            {{ $exams->links() }}
        </div>
    </div>
</div>




<div>
    <div class="p-6 bg-white rounded-lg shadow-md">
        <!-- Search and Create Section -->
        <div class="flex justify-between items-center mt-12 mb-6">
            <div class="w-1/3">
                <input wire:model.debounce.300ms="search" type="text" placeholder="Search questions..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <button wire:click="$toggle('showForm')" class="px-12 py-2 bg-purple-800 text-white rounded-lg hover:bg-purple-600">
                {{ $showForm ? 'Hide Form' : 'Create Question' }}
            </button>
        </div>

        <!-- Create/Edit Form -->
        @if($showForm || $isEditing)
        <div class="mb-6 p-4 bg-gray-50 rounded-lg">
            <h3 class="text-lg font-semibold mb-4">{{ $isEditing ? 'Edit Question' : 'Create New Question' }}</h3>
            <form wire:submit.prevent="{{ $isEditing ? 'update' : 'create' }}">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Exam</label>
                        <select wire:model="exam_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Select Exam</option>
                            @foreach($exams as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                            @endforeach
                        </select>
                        @error('exam_id')
                         <p class="text-red-500 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Question</label>
                        <textarea wire:model="question" rows="3" 
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                            @error('question')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Option 1</label>
                            <input wire:model="option1" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('option1')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror  
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Option 2</label>
                            <input wire:model="option2" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('option2') 
                            <p class="text-red-500 text-sm">{{ $message }}</p>
                             @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Option 3</label>
                            <input wire:model="option3" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('option3')
                             <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Option 4</label>
                            <input wire:model="option4" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            @error('option4') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Correct Answer</label>
                        <select wire:model="correct_answer" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                            <option value="">Select Correct Answer</option>
                            <option value="option1">Option 1</option>
                            <option value="option2">Option 2</option>
                            <option value="option3">Option 3</option>
                            <option value="option4">Option 4</option>
                        </select>
                        @error('correct_answer') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="flex items-center">
                            <input wire:model="status" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm">
                            <span class="ml-2">Active</span>
                        </label>
                    </div>
                </div>

                <div class="mt-4 flex justify-end space-x-3">
                    <button type="button" wire:click="$set('showForm', false)" 
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

        <!-- Questions Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Exam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Options</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Correct Answer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($quizzes as $quiz)
                    <tr>
                        <td class="px-6 py-4">{{ $quiz->question }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $quiz->exam->exam_name }}</td>
                        <td class="px-6 py-4">
                            <ul class="list-disc list-inside">
                                <li>{{ $quiz->option1 }}</li>
                                <li>{{ $quiz->option2 }}</li>
                                <li>{{ $quiz->option3 }}</li>
                                <li>{{ $quiz->option4 }}</li>
                            </ul>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $quiz->correct_answer }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button wire:click="toggleStatus({{ $quiz->id }})" 
                                class="px-3 py-1 rounded-full text-sm {{ $quiz->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $quiz->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <button wire:click="edit({{ $quiz->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $quiz->id }})" 
                                class="text-red-600 hover:text-red-900"
                                onclick="return confirm('Are you sure you want to delete this question?')">
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
            {{ $quizzes->links() }}
        </div>
    </div>
</div>

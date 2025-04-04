<div>
    <!-- Exam Details Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div>
                <h2 class="text-2xl font-bold text-purple-800 mb-6">{{ $exam->exam_name }}</h2>
                <div class="space-y-3">
                    <p class="text-gray-600"><span class="font-semibold">Course:</span> {{ $exam->course->title }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Batch:</span> {{ $exam->batch->batch_name }}</p>
                    <p class="text-gray-600"><span class="font-semibold">Date:</span> {{ $exam->exam_date }}</p>
                </div>
            </div>
            <div>
                <div class="mb-4">
                    <span class="px-4 py-2 rounded-full {{ $exam->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $exam->status ? 'Active' : 'Inactive' }}
                    </span>
                </div>
                @if($exam->passcode)
                    <p class="text-gray-600"><span class="font-semibold">Passcode:</span> {{ $exam->passcode }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-lg p-6">
        <!-- Actions Header -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center space-x-4">
                <div class="w-64">
                    <input wire:model.live="search" type="text" placeholder="Search questions..." 
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-purple-300">
                </div>
                @if(count($selectedQuestions) > 0)
                    <button wire:click="deleteSelected" 
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                        Delete Selected ({{ count($selectedQuestions) }})
                    </button>
                @endif
            </div>
            <a href="{{ route('admin.quiz', ['examId' => $exam->id]) }}" wire:navigate
                class="px-4 py-2 bg-purple-800 text-white rounded-lg hover:bg-purple-700 transition-colors">
                Add New Question
            </a>
        </div>

        <!-- Questions Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-4 p-4">
                            <input type="checkbox" wire:model.live="selectAll">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Question</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Options</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($questions as $question)
                        <tr>
                            <td class="w-4 p-4">
                                <input type="checkbox" wire:model.live="selectedQuestions" value="{{ $question->id }}">
                            </td>
                            <td class="px-6 py-4 max-w-xs">
                                <p class="text-sm text-gray-900">{{ $question->question }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="{{ $question->correct_answer === 'option1' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                            1. {{ $question->option1 }}
                                        </span>
                                        @if($question->correct_answer === 'option1')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="{{ $question->correct_answer === 'option2' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                            2. {{ $question->option2 }}
                                        </span>
                                        @if($question->correct_answer === 'option2')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="{{ $question->correct_answer === 'option3' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                            3. {{ $question->option3 }}
                                        </span>
                                        @if($question->correct_answer === 'option3')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <span class="{{ $question->correct_answer === 'option4' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                            4. {{ $question->option4 }}
                                        </span>
                                        @if($question->correct_answer === 'option4')
                                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-medium 
                                    {{ $question->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $question->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="editQuestion({{ $question->id }})" 
                                    class="text-blue-600 hover:text-blue-900">Edit</button>
                                <button wire:click="delete({{ $question->id }})"
                                    class="text-red-600 hover:text-red-900">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $questions->links() }}
        </div>
    </div>

    <!-- Edit Modal -->
    @if($showEditModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center">
            <div class="bg-white rounded-lg p-6 max-w-2xl w-full">
                <h3 class="text-lg font-medium mb-4">Edit Question</h3>
                <!-- Add your edit form here -->
                <div class="mt-4 flex justify-end space-x-3">
                    <button wire:click="$set('showEditModal', false)" 
                        class="px-4 py-2 border rounded-lg">Cancel</button>
                    <button wire:click="updateQuestion" 
                        class="px-4 py-2 bg-purple-600 text-white rounded-lg">Save</button>
                </div>
            </div>
        </div>
    @endif
</div>

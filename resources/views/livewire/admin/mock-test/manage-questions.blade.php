<div class="container mx-auto px-4 py-6">
    @include('components.loader')

    <div class="bg-white rounded-lg shadow-md p-6">
        <!-- Header with back button and details -->
        <div class="border-b border-gray-200 pb-6 mb-6">
            <div class="flex items-center gap-4 mb-4">
                <a wire:navigate href="{{ route('admin.mocktest') }}" 
                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-3 py-2 rounded-lg inline-flex items-center gap-2">
                    <i class="bi bi-arrow-left"></i>
                    Back to Tests
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Test Details -->
                <div>
                    <h2 class="text-xl font-semibold text-slate-500 border-s-4 border-s-purple-600 pl-3 mb-3">
                        {{ $mockTest->test_title }}
                    </h2>
                    <div class="space-y-2 ml-4">
                        <p class="flex items-center gap-2 text-gray-600">
                            <i class="bi bi-book text-purple-600"></i>
                            <span class="font-medium">Course:</span> {{ $mockTest->course->title }}
                        </p>
                        <p class="flex items-center gap-2 text-gray-600">
                            <i class="bi bi-bar-chart text-purple-600"></i>
                            <span class="font-medium">Level:</span> 
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($mockTest->level === 'beginners') bg-green-100 text-green-800
                                @elseif($mockTest->level === 'intermediate') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($mockTest->level) }}
                            </span>
                        </p>
                        <p class="flex items-center gap-2 text-gray-600">
                            <i class="bi bi-circle-fill {{ $mockTest->status ? 'text-green-500' : 'text-red-500' }}"></i>
                            <span class="font-medium">Status:</span> 
                            <span class="px-2 py-1 rounded-full text-xs {{ $mockTest->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $mockTest->status ? 'Active' : 'Inactive' }}
                            </span>
                        </p>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-3">Test Statistics</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-500">Total Questions</p>
                            <p class="text-2xl font-semibold text-purple-600">{{ $questions->total() }}</p>
                        </div>
                        <div class="bg-white p-3 rounded-lg shadow-sm">
                            <p class="text-sm text-gray-500">Total Attempts</p>
                            <p class="text-2xl font-semibold text-purple-600">{{ $mockTest->results->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action buttons -->
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-4">
                <h3 class="text-lg font-medium text-gray-700">Manage Questions</h3>
                @if(count($selectedQuestions) > 0)
                    <button wire:click="showBulkDeleteModal"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                        <i class="bi bi-trash3"></i> Delete Selected ({{ count($selectedQuestions) }})
                    </button>
                @endif
            </div>
            <div class="flex gap-2">
                <button wire:click="$toggle('showJsonModal')"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="bi bi-file-earmark-code"></i> Import JSON
                </button>
                <button wire:click="$toggle('showQuestionForm')" 
                    class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                    <i class="bi bi-plus-circle"></i> Add Question
                </button>
            </div>
        </div>

        <!-- Bulk Delete Modal -->
        @if($bulkDeleteModal)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-5 rounded-md shadow-lg">
                    <h3 class="text-lg font-medium mb-3">Delete Questions</h3>
                    <p class="mb-4">Are you sure you want to delete {{ count($selectedQuestions) }} questions? This action cannot be undone.</p>
                    <div class="flex justify-end gap-2">
                        <button wire:click="$set('bulkDeleteModal', false)" 
                            class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
                            Cancel
                        </button>
                        <button wire:click="bulkDelete"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Delete Questions
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if($showJsonModal)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full"
                wire:click.self="$toggle('showJsonModal')">
                <div class="relative top-20 mx-auto p-5 border w-2/3 shadow-lg rounded-md bg-white" wire:click.stop>
                    <h3 class="text-lg font-medium mb-4">Import Questions from JSON</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">JSON Data</label>
                        <textarea wire:model="jsonData" rows="10"
                            class="w-full p-2 border rounded-md"
                            placeholvader='[
    {
        "question": "What is...",
        "options": ["Option 1", "Option 2", "Option 3", "Option 4"],
        "correct_answer": "Option 1",
        "marks": 1
    }
]'></textarea>
                        @error('jsonData') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <button wire:click="$toggle('showJsonModal')"
                            class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                            Cancel
                        </button>
                        <button wire:click="importJson" wire:loading.attr="disabled"
                            class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 disabled:opacity-50 flex items-center gap-2">
                            <span wire:loading.remove wire:target="importJson">Import</span>
                            <span wire:loading wire:target="importJson">Importing...</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if($showQuestionForm)
        <div class="mb-8 bg-gray-50 p-4 rounded">
            <form wire:submit.prevent="{{ $editingQuestionId ? 'update' : 'save' }}">
                <div class="mb-4">
                    <label class="block mb-2">Question</label>
                    <textarea wire:model="question" class="w-full rounded border p-2" rows="3"></textarea>
                    @error('question') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Options</label>
                    @foreach($options as $index => $option)
                        <input type="text" wire:model="options.{{ $index }}" 
                            class="w-full rounded border p-2 mb-2"
                            placeholder="Option {{ $index + 1 }}">
                        @error("options.$index") <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    @endforeach
                </div>

                <div class="mb-4">
                    <label class="block mb-2">Correct Answer</label>
                    <select wire:model="correct_answer" class="w-full rounded border p-2">
                        <option value="">Select correct answer</option>
                        @foreach($options as $option)
                            @if($option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('correct_answer') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="resetForm"
                        class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                        {{ $editingQuestionId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
        @endif

        <!-- Delete Confirmation Modal -->
        @if($deleteId)
            <div class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center">
                <div class="bg-white p-5 rounded-md shadow-lg">
                    <h3 class="text-lg font-medium mb-3">Delete Question</h3>
                    <p class="mb-4">Are you sure you want to delete this question? This action cannot be undone.</p>
                    <div class="flex justify-end gap-2">
                        <button wire:click="$set('deleteId', null)" 
                            class="px-4 py-2 text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
                            Cancel
                        </button>
                        <button wire:click="delete({{ $deleteId }})"
                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                            Delete Question
                        </button>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
            <!-- Select All Checkbox -->
            <div class="col-span-full mb-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model.live="selectAll" 
                        class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                    <span class="text-sm font-medium text-gray-700">Select All Questions</span>
                </label>
            </div>

            @forelse($questions as $question)
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="p-5">
                        <!-- Add checkbox -->
                        <div class="flex items-center gap-2 mb-4">
                            <input type="checkbox" 
                                wire:model.live="selectedQuestions" 
                                value="{{ $question->id }}"
                                class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <h3 class="text-lg font-medium text-gray-900 flex-1">{{ $question->question }}</h3>
                        </div>

                        <div class="space-y-2">
                            @foreach(json_decode($question->options) as $index => $option)
                                <div class="flex items-center p-2 {{ $option === $question->correct_answer ? 'bg-green-50 border-green-200' : 'bg-gray-50' }} border rounded-lg">
                                    <span class="w-6 h-6 flex items-center justify-center rounded-full {{ $option === $question->correct_answer ? 'bg-green-500 text-white' : 'bg-gray-200' }} mr-2">
                                        {{ chr(65 + $index) }}
                                    </span>
                                    <span class="{{ $option === $question->correct_answer ? 'text-green-700 font-medium' : 'text-gray-700' }}">
                                        {{ $option }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-gray-100 flex justify-between items-center text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <i class="bi bi-star-fill text-yellow-400"></i>
                                Marks: {{ $question->marks }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="bi bi-clock-history"></i>
                                {{ $question->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-500">
                    <i class="bi bi-journal-x text-4xl mb-2"></i>
                    <p>No questions found</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $questions->links() }}
        </div>
    </div>
</div>

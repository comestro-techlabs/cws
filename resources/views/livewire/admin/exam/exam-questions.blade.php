<div>
    <div class="p-6 bg-white rounded-xl shadow-lg mt-12">
        <div class="mb-6">
            <h2 class="md:text-xl text-lg font-semibold text-slate-500 border-s-4 border-s-purple-800 pl-3 mb-5">{{ $exam->exam_name }} Questions</h2>
            <p class="text-gray-600">Course: {{ $exam->course->title }}</p>
        </div>

        <!-- Search Section -->
        <div class="flex justify-between items-center mb-6">
            <div class="w-1/3">
                <input wire:model.live="search" type="text" placeholder="Search questions..." 
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <a href="{{ route('admin.quiz', ['examId' => $exam->id]) }}" wire:navigate
                class="px-4 py-2 bg-purple-800 text-white rounded-lg hover:bg-purple-600">
                Add New Question
            </a>
        </div>

        <!-- Questions Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
            @foreach($questions as $question)
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow p-5">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-base font-medium text-gray-900">{{ $question->question }}</h3>
                        <span class="px-3 py-1 rounded-full text-xs font-medium {{ $question->status ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $question->status ? 'Active' : 'Inactive' }}
                        </span>
                    </div>

                    <div class="space-y-2 mb-4">
                        <p class="text-sm text-gray-600">Options:</p>
                        <ul class="space-y-1 text-sm">
                            <li class="flex items-center {{ $question->correct_answer === 'option1' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $question->option1 }}
                            </li>
                            <li class="flex items-center {{ $question->correct_answer === 'option2' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $question->option2 }}
                            </li>
                            <li class="flex items-center {{ $question->correct_answer === 'option3' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $question->option3 }}
                            </li>
                            <li class="flex items-center {{ $question->correct_answer === 'option4' ? 'text-green-600 font-medium' : 'text-gray-600' }}">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $question->option4 }}
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Improved Pagination -->
        <div class="mt-6">
            {{ $questions->links() }}
        </div>
    </div>
</div>

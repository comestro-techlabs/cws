<div class="min-h-screen bg-gray-50 py-8">
    @include('components.loader')
    
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Result Header -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-6">
            <div class="p-6 sm:p-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $examName }}</h1>
                        <p class="text-gray-500 mt-1">Attempt {{ $attempt }} Result</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('student.takeExam') }}" 
                            class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to Exams
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Score Summary -->
            <div class="border-t border-gray-100">
                <div class="grid grid-cols-2 sm:grid-cols-4 divide-x divide-gray-100">
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-gray-900">{{ $percentage }}%</div>
                        <div class="text-sm text-gray-500 mt-1">Overall Score</div>
                    </div>
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-green-600">{{ $correctAnswers }}</div>
                        <div class="text-sm text-gray-500 mt-1">Correct Answers</div>
                    </div>
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-red-600">{{ $incorrectAnswers }}</div>
                        <div class="text-sm text-gray-500 mt-1">Incorrect Answers</div>
                    </div>
                    <div class="p-6 text-center">
                        <div class="text-3xl font-bold text-gray-900">{{ $totalMarks }}</div>
                        <div class="text-sm text-gray-500 mt-1">Total Marks</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Answers -->
        <div class="space-y-6">
            @foreach($results as $index => $result)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <h3 class="text-lg font-medium text-gray-900">
                                    Question {{ $index + 1 }}
                                    <span class="ml-2 px-2 py-1 text-sm rounded-full 
                                        {{ $result->obtained_marks > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $result->obtained_marks > 0 ? 'Correct' : 'Incorrect' }}
                                    </span>
                                </h3>
                                <p class="mt-2 text-gray-700">{{ $result->quiz->question }}</p>
                            </div>
                            <span class="text-sm font-medium text-gray-500">
                                {{ $result->quiz->marks }} marks
                            </span>
                        </div>

                        <div class="mt-4 space-y-3">
                            @foreach(range(1,4) as $option)
                                <div class="flex items-center p-3 rounded-lg
                                    {{ $result->selected_option === 'option'.$option ? 
                                        ($result->obtained_marks > 0 ? 'bg-green-50 border-2 border-green-500' : 'bg-red-50 border-2 border-red-500') :
                                        ($result->quiz->correct_answer === 'option'.$option ? 'bg-green-50 border-2 border-green-500' : 'bg-gray-50 border border-gray-200') }}">
                                    <div class="flex-1">
                                        {{ $result->quiz->{'option'.$option} }}
                                    </div>
                                    @if($result->selected_option === 'option'.$option)
                                        <svg class="w-5 h-5 {{ $result->obtained_marks > 0 ? 'text-green-500' : 'text-red-500' }}" fill="currentColor" viewBox="0 0 20 20">
                                            @if($result->obtained_marks > 0)
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            @else
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            @endif
                                        </svg>
                                    @endif
                                    @if($result->quiz->correct_answer === 'option'.$option && $result->selected_option !== 'option'.$option)
                                        <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
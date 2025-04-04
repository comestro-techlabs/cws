<div class="min-h-screen bg-gray-50 pt-24 pb-8 mt-20">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Result Summary Card -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Test Results</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-blue-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-blue-600 mb-1">Total Score</h3>
                    <p class="text-3xl font-bold text-blue-700">{{ $score }}/{{ $totalMarks }}</p>
                </div>
                <div class="bg-green-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-green-600 mb-1">Percentage</h3>
                    <p class="text-3xl font-bold text-green-700">{{ $percentage }}%</p>
                </div>
                <div class="bg-purple-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-purple-600 mb-1">Correct Answers</h3>
                    <p class="text-3xl font-bold text-purple-700">{{ $correctAnswers }}/{{ count($questions) }}</p>
                </div>
            </div>
        </div>

        <!-- Detailed Analysis -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Detailed Analysis</h2>
            <div class="space-y-8">
                @foreach($questions as $index => $question)
                    <div class="border-b border-gray-100 last:border-0 pb-6 last:pb-0">
                        <div class="flex items-start gap-3">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center {{ isset($answers[$question['id']]) && $answers[$question['id']] === $question['correct_answer'] ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $index + 1 }}
                            </span>
                            <div class="flex-1">
                                <p class="text-gray-800 font-medium mb-4">{{ $question['question'] }}</p>
                                
                                <div class="space-y-2">
                                    @foreach(json_decode($question['options']) as $option)
                                        <div class="flex items-center p-3 rounded-lg {{ $option === $question['correct_answer'] ? 'bg-green-50 border-green-200' : (isset($answers[$question['id']]) && $option === $answers[$question['id']] && $answers[$question['id']] !== $question['correct_answer'] ? 'bg-red-50 border-red-200' : 'bg-gray-50') }}">
                                            @if($option === $question['correct_answer'])
                                                <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            @elseif(isset($answers[$question['id']]) && $option === $answers[$question['id']] && $answers[$question['id']] !== $question['correct_answer'])
                                                <svg class="w-5 h-5 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            @endif
                                            <span>{{ $option }}</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="mt-4 text-sm">
                                    <span class="font-medium text-gray-600">Correct Answer:</span>
                                    <span class="text-green-600">{{ $question['correct_answer'] }}</span>
                                    
                                    @if(isset($answers[$question['id']]))
                                        <span class="ml-4 font-medium text-gray-600">Your Answer:</span>
                                        <span class="{{ $answers[$question['id']] === $question['correct_answer'] ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $answers[$question['id']] }}
                                        </span>
                                    @else
                                        <span class="ml-4 text-gray-500">(Not answered)</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('public.mocktest') }}" 
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700">
                Try Another Test
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
    </div>
</div>

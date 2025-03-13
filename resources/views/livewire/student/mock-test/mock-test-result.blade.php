<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">{{ $mockTest->test_title }} - Result</h2>
    
    <!-- Score Summary -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Score</h3>
                <p class="text-2xl text-blue-600 font-bold">
                    {{ $result->score }} / {{ collect($questions)->sum('marks') }}
                </p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Percentage</h3>
                <p class="text-2xl text-blue-600 font-bold">
                    {{ number_format(($result->score / collect($questions)->sum('marks')) * 100, 2) }}%
                </p>
            </div>
            <div class="text-center">
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Completed At</h3>
                <p class="text-xl text-gray-600">{{ $result->completed_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
    </div>

    <!-- Detailed Answer Sheet -->
    <div class="space-y-6">
        @forelse($questions as $index => $question)
            @php
                $userAnswer = $answers[$question['id']] ?? 'Not Answered';
                $options = json_decode($question['options'], true);
                $isCorrect = $userAnswer === $question['correct_answer'];
                $totalMarks = collect($questions)->sum('marks');
            @endphp
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex justify-between items-start mb-4">
                    <h4 class="text-lg font-semibold text-gray-800">
                        Question {{ $index + 1 }} ({{ $question['marks'] }} marks)
                    </h4>
                    <span class="px-2 py-1 rounded text-sm font-medium
                        {{ $isCorrect ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $isCorrect ? 'Correct' : 'Incorrect' }}
                    </span>
                </div>
                
                <p class="text-gray-700 mb-4">{{ $question['question'] }}</p>
                
                <div class="space-y-3">
                    <div class="flex items-center">
                        <span class="font-medium text-gray-700 min-w-[120px]">Your Answer:</span>
                        <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-600' }} font-medium">
                            {{ $userAnswer }}
                        </span>
                    </div>
                    <div class="flex items-center">
                        <span class="font-medium text-gray-700 min-w-[120px]">Correct Answer:</span>
                        <span class="text-green-600 font-medium">{{ $question['correct_answer'] }}</span>
                    </div>
                    <div>
                        <span class="font-medium text-gray-700 block mb-1">Options:</span>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach($options as $option)
                                <div class="flex items-center">
                                    <input 
                                        type="radio"
                                        disabled
                                        class="mr-2"
                                        @if($option === $userAnswer) checked @endif
                                    >
                                    <span class="{{ $option === $question['correct_answer'] ? 'text-green-600' : ($option === $userAnswer ? 'text-red-600' : 'text-gray-600') }}">
                                        {{ $option }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-md p-6">
                <p class="text-gray-600 text-center">No questions found for this test.</p>
            </div>
        @endforelse
    </div>

    <!-- Back Button -->
    <div class="mt-8 flex justify-end">
        <a href="{{ route('v2.student.mocktest') }}"
           class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Tests
        </a>
    </div>
</div>
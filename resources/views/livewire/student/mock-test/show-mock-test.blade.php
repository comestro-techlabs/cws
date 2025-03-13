<div class="container mx-auto px-4 py-8">
    <h2 class="text-3xl font-bold mb-6 text-gray-800">{{ $mockTest->test_title }}</h2>

    @if($attempted && !$submitted)
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
            <p class="font-medium">You have already attempted this test.</p>
            <a   href="{{ route('v2.student.mocktest.result', $mockTestId) }}" 
               class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                View Results
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <!-- Sidebar with Question Navigation -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow-md p-4 sticky top-4">
                    <h5 class="text-xl font-semibold text-gray-800 mb-4">Questions</h5>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach($questions as $index => $question)
                            <button 
                                wire:click="goToQuestion({{ $index }})"
                                class="py-2 px-3 rounded-lg text-sm font-medium transition duration-300
                                    {{ $currentQuestionIndex === $index ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}
                                    {{ isset($answers[$question['id']]) ? 'border-2 border-green-500' : 'border-2 border-transparent' }}
                                    {{ $submitted ? 'cursor-not-allowed opacity-60' : '' }}"
                                @if($submitted) disabled @endif
                            >
                                {{ $index + 1 }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Main Question Area -->
            <div class="md:col-span-3">
                @if(count($questions) > 0)
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h5 class="text-2xl font-semibold text-gray-800">
                                Question {{ $currentQuestionIndex + 1 }} of {{ count($questions) }}
                            </h5>
                            <span class="text-sm text-gray-600">Marks: {{ $questions[$currentQuestionIndex]['marks'] }}</span>
                        </div>
                        <p class="text-gray-700 mb-6 text-lg">{{ $questions[$currentQuestionIndex]['question'] }}</p>
                        
                        @php
                            $options = json_decode($questions[$currentQuestionIndex]['options'], true);
                        @endphp
                        
                        <div class="space-y-4 mb-6">
                            @foreach($options as $option)
                                <label class="flex items-center space-x-3 {{ $submitted ? 'cursor-not-allowed opacity-60' : 'cursor-pointer' }}">
                                    <input 
                                        type="radio" 
                                        class="form-radio h-5 w-5 text-blue-600 transition duration-300"
                                        name="answer_{{ $questions[$currentQuestionIndex]['id'] }}"
                                        wire:model.debounce.500ms="answers.{{ $questions[$currentQuestionIndex]['id'] }}"
                                        wire:change="updateAnswer({{ $questions[$currentQuestionIndex]['id'] }}, '{{ $option }}')"
                                        value="{{ $option }}"
                                        @if($submitted) disabled @endif
                                    >
                                    <span class="text-gray-700 text-base">{{ $option }}</span>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex justify-between items-center">
                            <div class="space-x-3">
                                <button 
                                    wire:click="previousQuestion" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition duration-300
                                        {{ $submitted || $currentQuestionIndex === 0 ? 'cursor-not-allowed opacity-60' : '' }}"
                                    @if($submitted || $currentQuestionIndex === 0) disabled @endif
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                    Previous
                                </button>
                                <button 
                                    wire:click="nextQuestion" 
                                    class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition duration-300
                                        {{ $submitted || $currentQuestionIndex === count($questions) - 1 ? 'cursor-not-allowed opacity-60' : '' }}"
                                    @if($submitted || $currentQuestionIndex === count($questions) - 1) disabled @endif
                                >
                                    Next
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>
                            <button 
                                wire:click="submitTest" 
                                class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300
                                    {{ $submitted ? 'cursor-not-allowed opacity-60' : '' }}"
                                @if($submitted) disabled @endif
                            >
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                {{ $submitted ? 'Submitted' : 'Submit Test' }}
                            </button>
                        </div>

                        @if($submitted)
                            <div class="mt-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-lg">
                                <p class="font-medium">Test has been submitted successfully!</p>
                                <a href="{{ route('v2.student.mocktest.result', $mockTestId) }}" 
                                   class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    View Results
                                </a>
                            </div>
                        @endif
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <p class="text-gray-600 text-center">No questions available for this test.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
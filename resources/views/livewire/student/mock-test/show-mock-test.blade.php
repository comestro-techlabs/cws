
@php
    $totalQuestions = count($questions);
    $percentage = $totalQuestions > 0 
        ? floor((count(array_filter($answers)) / $totalQuestions) * 100) 
        : 0;
    
    $circumference = 2 * pi() * 40;
    $dashOffset = $totalQuestions > 0
        ? $circumference * (1 - count(array_filter($answers)) / $totalQuestions)
        : $circumference;
@endphp
<div class="min-h-screen bg-gray-50">
    <!-- Fixed Header -->
    <div class="fixed top-0 left-0 right-0 bg-white border-b z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <h2 class="text-xl font-bold text-gray-800">{{ $mockTest->test_title }}</h2>
                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">
                            {{ count(array_filter($answers)) }}/{{ count($questions) }} Answered
                        </span>
                        <div class="text-gray-600">
                            <span class="font-medium">Time Left:</span>
                            <span class="ml-2 text-red-600 font-bold">00:45:30</span>
                        </div>
                    </div>
                    <button wire:click="submitTest"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-all">
                        End Test
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-20 pb-8">
        @if($attempted && !$submitted)
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
            <p class="font-medium">You have already attempted this test.</p>
            <a href="{{ route('v2.student.mocktest.result', $mockTestId) }}"
                class="mt-3 inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
                View Results
            </a>
        </div>
        @else
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Enhanced Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border rounded-xl p-6 sticky top-24">
                        <!-- Progress Circle -->
                        <div class="mb-6 flex justify-center">
                            <div class="relative inline-flex items-center justify-center">
                                <svg class="w-24 h-24 transform -rotate-90">
                                    <circle
                                        class="text-gray-200"
                                        stroke-width="8"
                                        stroke="currentColor"
                                        fill="transparent"
                                        r="40"
                                        cx="48"
                                        cy="48"
                                    />
                                    <circle
                                        class="text-blue-600"
                                        stroke-width="8"
                                        stroke="currentColor"
                                        fill="transparent"
                                        r="40"
                                        cx="48"
                                        cy="48"
                                        stroke-dasharray="{{ $circumference }}"
                                        stroke-dashoffset="{{$dashOffset }}"
                                    />
                                </svg>
                                <span class="absolute text-xl font-bold text-blue-600">
                                    {{ $percentage }}%
                                </span>
                            </div>
                        </div>

                        <!-- Question Stats -->
                        <div class="flex justify-between text-sm mb-6 px-2">
                            <div>
                                <div class="font-medium text-gray-500">Answered</div>
                                <div class="text-2xl font-bold text-green-600">{{ count(array_filter($answers)) }}</div>
                            </div>
                            <div>
                                <div class="font-medium text-gray-500">Remaining</div>
                                <div class="text-2xl font-bold text-red-600">{{ count($questions) - count(array_filter($answers)) }}</div>
                            </div>
                        </div>

                        <!-- Question Navigation -->
                        <div class="space-y-4">
                            <h5 class="font-medium text-gray-700 px-2">Questions</h5>
                            <div class="grid grid-cols-4 gap-2">
                                @foreach($questions as $index => $question)
                                    <button
                                        wire:click="goToQuestion({{ $index }})"
                                        class="relative aspect-square flex items-center justify-center rounded-lg text-sm font-medium transition-all
                                            {{ $currentQuestionIndex === $index ? 'bg-blue-600 text-white ring-2 ring-blue-300' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}
                                            {{ isset($answers[$question['id']]) ? 'before:absolute before:top-1 before:right-1 before:w-2 before:h-2 before:bg-green-500 before:rounded-full' : '' }}"
                                    >
                                        {{ $index + 1 }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Question Area -->
                <div class="lg:col-span-3">
                    @if(count($questions) > 0)
                        <div class="bg-white border rounded-xl p-6">
                            <!-- Question Header -->
                            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-xl mb-6">
                                <div>
                                    <h5 class="text-2xl font-bold text-gray-800">Question {{ $currentQuestionIndex + 1 }}</h5>
                                    <p class="text-sm text-gray-500">of {{ count($questions) }} questions</p>
                                </div>
                                <span class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium">
                                    {{ $questions[$currentQuestionIndex]['marks'] }} marks
                                </span>
                            </div>

                            <!-- Question Content -->
                            <div class="p-6 bg-gray-50 rounded-xl mb-6">
                                <p class="text-gray-800 text-lg leading-relaxed">
                                    {{ $questions[$currentQuestionIndex]['question'] }}
                                </p>
                            </div>

                            <!-- Options -->
                            <div wire:key="question-{{ $questions[$currentQuestionIndex]['id'] }}" class="space-y-3 mb-6">
                                @foreach(json_decode($questions[$currentQuestionIndex]['options'], true) as $option)
                                    <label class="block w-full p-4 border rounded-xl hover:bg-blue-50 hover:border-blue-200
                                        cursor-pointer transition-all {{ $submitted ? 'opacity-60 cursor-not-allowed' : '' }}">
                                        <div class="flex items-center gap-3">
                                            <input type="radio"
                                                name="question_{{ $questions[$currentQuestionIndex]['id'] }}"
                                                value="{{ $option }}"
                                                wire:click="saveAnswer('{{ $questions[$currentQuestionIndex]['id'] }}', '{{ $option }}')"
                                                class="w-5 h-5 text-blue-600 border-gray-300 focus:ring-blue-500"
                                                {{ $submitted ? 'disabled' : '' }}
                                                {{ isset($answers[$questions[$currentQuestionIndex]['id']]) && $answers[$questions[$currentQuestionIndex]['id']] === $option ? 'checked' : '' }}
                                            >
                                            <span class="text-gray-700">{{ $option }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>

                            <!-- Navigation Buttons -->
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

                                    @if($currentQuestionIndex < count($questions) - 1)
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
                                    @endif
                                </div>

                                @if($currentQuestionIndex === count($questions) - 1)
                                <button
                                    wire:click="submitTest"
                                    class="inline-flex items-center px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-300
                                        {{ $submitted ? 'cursor-not-allowed opacity-60' : '' }}"
                                    @if($submitted) disabled @endif
                                >
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Submit Test
                                </button>
                                @endif
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
</div>
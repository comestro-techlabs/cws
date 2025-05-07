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
                        <div class="text-gray-600" wire:poll.1s="decrementTime">
                            Time Left: {{ gmdate("H:i:s", $timeLeft) }}
                        </div>
                    </div>
                    <button wire:click="submitTest" 
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
                        End Test
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 pt-20 pb-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Enhanced Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white border rounded-xl p-6 sticky top-24">
                    <!-- Progress Circle -->
                    <div class="mb-6 flex justify-center">
                        <div class="relative inline-flex items-center justify-center">
                            <svg class="w-24 h-24 transform -rotate-90">
                                <circle class="text-gray-200" stroke-width="8" stroke="currentColor" fill="transparent"
                                    r="40" cx="48" cy="48" />
                                <circle class="text-blue-600" stroke-width="8" stroke="currentColor" fill="transparent"
                                    r="40" cx="48" cy="48" stroke-dasharray="{{ $circumference }}"
                                    stroke-dashoffset="{{$dashOffset }}" />
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
                            <div class="text-2xl font-bold text-red-600">
                                {{ count($questions) - count(array_filter($answers)) }}</div>
                        </div>
                    </div>

                    <!-- Question Navigation -->
                    <div class="space-y-4">
                        <h5 class="font-medium text-gray-700 px-2">Questions</h5>
                        <div class="grid grid-cols-4 gap-2">
                            @foreach($questions as $index => $question)
                            <button wire:click="goToQuestion({{ $index }})"
                                class="relative aspect-square flex items-center justify-center rounded-lg text-sm font-medium transition-all
                                    {{ $currentQuestionIndex === $index ? 'bg-blue-600 text-white ring-2 ring-blue-300' : 'bg-gray-50 text-gray-700 hover:bg-gray-100' }}
                                    {{ isset($answers[$question['id']]) ? 'before:absolute before:top-1 before:right-1 before:w-2 before:h-2 before:bg-green-500 before:rounded-full' : '' }}">
                                {{ $index + 1 }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Question Area -->
            <div class="lg:col-span-3">
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
                    @if($submitted)
                        <div class="text-center">
                            <h3 class="text-2xl font-bold mb-4">Test Completed!</h3>
                            <p class="text-lg mb-4">Your Score: {{ $score }} / {{ array_sum(array_column($questions, 'marks')) }}</p>
                            <a href="{{ route('public.mocktest') }}" 
                                class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                                Try Another Test
                            </a>
                        </div>
                    @else
                        <div class="mb-6">
                            <h3 class="text-xl font-semibold mb-4">Question {{ $currentQuestionIndex + 1 }}</h3>
                            <p class="text-lg">{{ $questions[$currentQuestionIndex]['question'] }}</p>
                        </div>

                        <div class="space-y-4">
                            @foreach(json_decode($questions[$currentQuestionIndex]['options']) as $option)
                                <label class="block">
                                    <div class="flex items-center p-4 border rounded-lg cursor-pointer
                                        {{ isset($answers[$questions[$currentQuestionIndex]['id']]) && $answers[$questions[$currentQuestionIndex]['id']] === $option 
                                            ? 'bg-blue-50 border-blue-200' 
                                            : 'hover:bg-gray-50' }}">
                                        <input type="radio" 
                                            name="answer_{{ $questions[$currentQuestionIndex]['id'] }}" 
                                            value="{{ e($option) }}"
                                            wire:click="saveAnswer('{{ $questions[$currentQuestionIndex]['id'] }}', '{{ addslashes($option) }}')"
                                            {{ isset($answers[$questions[$currentQuestionIndex]['id']]) && $answers[$questions[$currentQuestionIndex]['id']] === $option ? 'checked' : '' }}
                                            class="mr-3 text-blue-600 focus:ring-blue-500">
                                        <span class="text-gray-700">{{ $option }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <div class="flex justify-between mt-6">
                            <button wire:click="previousQuestion"
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 disabled:opacity-50"
                                {{ $currentQuestionIndex === 0 ? 'disabled' : '' }}>
                                Previous
                            </button>
                            
                            @if($currentQuestionIndex < count($questions) - 1)
                                <button wire:click="nextQuestion"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    Next
                                </button>
                            @else
                                <button wire:click="submitTest"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                                    Submit Test
                                </button>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

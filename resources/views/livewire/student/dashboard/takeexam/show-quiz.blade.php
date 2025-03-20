<div class="min-h-screen bg-gray-50" 
    x-data="{ 
        isFullscreen: @entangle('isFullscreen')
    }">
    @if (!$passcodeVerified)
        <div class="container mx-auto py-12 px-6">
            <div class="bg-white rounded-lg p-6 max-w-md mx-auto">
                <h2 class="text-xl font-semibold mb-4">Enter Exam Passcode</h2>
                <form wire:submit.prevent="verifyPasscode">
                    <div class="mb-4">
                        <label for="passcode" class="block text-sm font-medium text-gray-700">Passcode</label>
                        <input type="text" id="passcode" wire:model="passcode"
                            class="mt-1 p-2 block w-full rounded-md border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">
                        @if ($passcodeError)
                            <span class="text-red-500 text-sm">{{ $passcodeError }}</span>
                        @endif
                    </div>
                    <button type="submit"
                        class="w-full bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-600">
                        Verify Passcode
                    </button>
                </form>
            </div>
        </div>
    @else
        <div id="instructions" class="bg-white rounded-lg p-8 mb-6 mx-auto max-w-4xl" x-show="!isFullscreen">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-3">Exam Instructions</h2>
                <p class="text-purple-600 font-semibold text-lg">Please read the instructions carefully</p>
            </div>
            
            <div class="bg-purple-50 p-6 rounded-xl border border-purple-100 mb-6">
                <ul class="space-y-4">
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-700">Click the "Start Exam" button in the top-right corner to begin in fullscreen mode</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        <span class="text-gray-700">You must stay in fullscreen mode throughout the exam</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="text-gray-700">Switching tabs or exiting fullscreen will result in automatic submission</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span class="text-gray-700">Answer all questions before submitting your exam</span>
                    </li>
                </ul>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button wire:click="startExam" 
                    class="inline-flex items-center gap-2 px-8 py-3 bg-purple-800 hover:bg-purple-700 text-white rounded-lg transition-all duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0 0l-5-5m-7 11h4m-4 0v4m0-4l5 5m5-9v4m0-4h-4m4 0l-5 5" />
                    </svg>
                    <span class="font-medium">Start Exam in Fullscreen</span>
                </button>
            </div>
        </div>

        <div class="container mx-auto py-6" x-show="isFullscreen">
            <!-- Quiz Header -->
            <div class="bg-white border-b sticky top-0 z-10">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center py-4">
                        <h1 class="text-xl font-bold text-gray-800">{{ $courses->exams->first()->exam_name ?? 'Exam' }}</h1>
                        <div class="flex items-center gap-4">
                            <span class="px-4 py-2 bg-purple-100 text-purple-800 rounded-lg font-medium">
                                Time Remaining: <span>{{ $timeRemaining }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Question Navigation -->
            <div class="container mx-auto px-4 py-6">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                    <!-- Question List -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-lg p-4 sticky top-24">
                            <div class="grid grid-cols-5 gap-2">
                                @foreach($quizzes as $index => $quiz)
                                    <button wire:click="goToQuestion({{ $index }})"
                                        class="aspect-square flex items-center justify-center text-sm font-medium border rounded-lg
                                        {{ $currentQuestion === $index ? 'bg-purple-600 text-white' : '' }}
                                        {{ isset($answers[$quiz->id]) ? 'bg-green-500 text-white' : 'bg-gray-50' }}">
                                        {{ $index + 1 }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Question Area -->
                    <div class="lg:col-span-3">
                        <div class="bg-white rounded-lg p-6">
                            @if($quizzes->count() > 0 && isset($quizzes[$currentQuestion]))
                                <div class="mb-4">
                                    <h6 class="text-lg font-semibold">Question {{ $currentQuestion + 1 }}</h6>
                                    <p class="text-gray-700">{{ $quizzes[$currentQuestion]->question }}</p>
                                </div>
                                
                                @foreach(range(1,4) as $optionNum)
                                    <div class="mb-2">
                                        <label class="inline-flex items-center gap-3 w-full px-4 py-2 text-sm font-medium border rounded-lg cursor-pointer 
                                            {{ $answers[$quizzes[$currentQuestion]->id] == 'option'.$optionNum ? 'bg-blue-500 text-white' : 'bg-gray-50' }}">
                                            <input type="radio" 
                                                wire:model="answers.{{ $quizzes[$currentQuestion]->id }}"
                                                value="option{{ $optionNum }}"
                                                class="hidden">
                                            {{ $quizzes[$currentQuestion]->{'option'.$optionNum} }}
                                        </label>
                                    </div>
                                @endforeach

                                <div class="flex justify-between mt-6">
                                    <button wire:click="previousQuestion"
                                        class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg"
                                        {{ $currentQuestion === 0 ? 'disabled' : '' }}>
                                        Previous
                                    </button>
                                    
                                    @if($currentQuestion < $quizzes->count() - 1)
                                        <button wire:click="nextQuestion"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg">
                                            Next
                                        </button>
                                    @else
                                        <button wire:click="submitExam"
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg">
                                            Submit
                                        </button>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
document.addEventListener('livewire:initialized', () => {
    Livewire.on('enterFullscreen', () => {
        document.documentElement.requestFullscreen()
            .catch(err => console.error('Error attempting to enable fullscreen:', err));
    });

    Livewire.on('exitFullscreen', () => {
        if (document.fullscreenElement) {
            document.exitFullscreen()
                .catch(err => console.error('Error attempting to disable fullscreen:', err));
        }
    });
});
</script>
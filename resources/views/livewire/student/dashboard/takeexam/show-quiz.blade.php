<div class="min-h-screen bg-gray-50" x-data="{ isFullscreen: @entangle('isFullscreen') }" 
    oncopy="return false" 
    oncut="return false" 
    onpaste="return false">
    <!-- @include('components.loader') -->
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
                <button type="submit" class="w-full bg-purple-800 text-white px-4 py-2 rounded-lg hover:bg-purple-600">
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
                    <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-gray-700">Click the "Start Exam" button to begin in fullscreen mode</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="text-gray-700">You must stay in fullscreen mode throughout the exam</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <span class="text-gray-700">Exiting fullscreen will result in automatic submission</span>
                </li>
                <li class="flex items-start">
                    <svg class="h-6 w-6 text-purple-600 mr-3 mt-0.5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span class="text-gray-700">Answer all questions before submitting your exam</span>
                </li>
            </ul>
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button wire:click="startExam"
                class="inline-flex items-center gap-2 px-8 py-3 bg-purple-800 hover:bg-purple-700 text-white rounded-lg transition-all duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8V4m0 0h4M4 4l5 5m11-5h-4m4 0v4m0 0l-5-5m-7 11h4m-4 0v4m0-4l5 5m5-9v4m0-4h-4m4 0l-5 5" />
                </svg>
                <span class="font-medium">Start Exam in Fullscreen</span>
            </button>
        </div>
    </div>

    <div class="min-h-screen bg-gray-100" x-show="isFullscreen">
        <div class="bg-white border-b shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center space-x-4">
                        <h1 class="text-xl font-bold text-gray-800">{{ $courses->exams->first()->exam_name ?? 'Exam' }}
                        </h1>
                        <span class="px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-sm font-medium">
                            Question {{ $currentQuestion + 1 }} of {{ $quizzes->count() }}
                        </span>
                    </div>
                    <div class="flex items-center gap-4">
                        <div
                            class="px-4 py-2 bg-purple-100 text-purple-800 rounded-lg font-medium flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div wire:poll.1000ms="updateTimer" class="text-center text-xl font-semibold text-purple-700">
                                Time Remaining: {{ gmdate("i:s", $timeRemainingInSeconds) }}
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 lg:col-span-3">
                    <div class="bg-white rounded-lg shadow-sm p-4 sticky top-24">
                        <h3 class="text-sm font-medium text-gray-700 mb-3">Questions Overview</h3>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach($quizzes as $index => $quiz)
                            <button wire:click="goToQuestion({{ $index }})"
                                class="aspect-square flex items-center justify-center text-sm font-medium border rounded-lg transition-all duration-200
                                        {{ $currentQuestion === $index ? 'ring-2 ring-purple-500 border-purple-500' : '' }}
                                        {{ isset($answers[$quiz->id]) && $answers[$quiz->id] ? 'bg-green-500 border-green-500 text-white hover:bg-green-600' : 'bg-white hover:bg-gray-50' }}">
                                {{ $index + 1 }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-span-12 lg:col-span-9">
                    <div class="bg-white rounded-lg shadow-sm">
                        @if($quizzes->count() > 0 && isset($quizzes[$currentQuestion]))
                        <div class="p-6 border-b">
                            <h2 class="text-lg font-semibold text-gray-900">Question {{ $currentQuestion + 1 }}</h2>
                            <p class="mt-2 text-gray-700">{{ $quizzes[$currentQuestion]->question }}</p>
                        </div>

                        <div class="p-6" wire:key="question-{{ $quizzes[$currentQuestion]->id }}">
                            <form>
                                @foreach(range(1,4) as $optionNum)
                                <label class="relative block mb-3">
                                    <input type="radio" 
                                        wire:model.live="currentAnswer" 
                                        value="option{{ $optionNum }}"
                                        name="question_{{ $quizzes[$currentQuestion]->id }}" 
                                        class="peer sr-only"
                                        wire:loading.attr="disabled">
                                    <div class="w-full p-4 border rounded-lg cursor-pointer transition-all duration-200
                                        {{ $currentAnswer === 'option'.$optionNum ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-500' : 'border-gray-300 hover:bg-gray-50' }}">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-6 h-6 rounded-full border-2 flex items-center justify-center
                                                            {{ $currentAnswer === 'option'.$optionNum ? 'border-purple-500 bg-purple-500' : 'border-gray-300' }}">
                                                @if($currentAnswer === 'option'.$optionNum)
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 12 12">
                                                    <circle cx="6" cy="6" r="3" />
                                                </svg>
                                                @endif
                                            </div>
                                            <span
                                                class="text-gray-700">{{ $quizzes[$currentQuestion]->{'option'.$optionNum} }}</span>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </form>
                        </div>

                        <div class="p-6 bg-gray-50 border-t flex items-center justify-between">
                            <button wire:click="previousQuestion"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200"
                                {{ $currentQuestion === 0 ? 'disabled' : '' }}>
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                                Previous
                            </button>

                            @if($currentQuestion < $quizzes->count() - 1)
                                <button wire:click="nextQuestion"
                                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-all duration-200">
                                    Next
                                    <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                                @else
                                <button wire:click="submitExam"
                                    class="inline-flex items-center px-6 py-2 border border-transparent rounded-lg text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Submit Exam
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
    // Enter fullscreen
    Livewire.on('enterFullscreen', () => {
        const elem = document.documentElement;
        if (elem.requestFullscreen) {
            elem.requestFullscreen()
                .then(() => console.log('Fullscreen enabled'))
                .catch(err => console.error('Fullscreen error:', err.message));
        } else {
            console.error('Fullscreen API not supported');
            alert('Your browser does not support fullscreen mode.');
        }
    });

    // Exit fullscreen
    Livewire.on('exitFullscreen', () => {
        if (document.fullscreenElement) {
            document.exitFullscreen()
                .then(() => console.log('Exited fullscreen'))
                .catch(err => console.error('Exit fullscreen error:', err.message));
        }
    });

    // Detect fullscreen changes
    document.addEventListener('fullscreenchange', () => {
        const isFullscreen = !!document.fullscreenElement;
        console.log('Fullscreen state changed:', isFullscreen);
        Livewire.dispatch('fullscreenChanged', {
            value: isFullscreen
        });
    });

    // Handle errors
    document.addEventListener('fullscreenerror', (event) => {
        console.error('Fullscreen error occurred:', event);
        alert('An error occurred while trying to enable fullscreen mode.');
    });

    // Add tab switch detection
    document.addEventListener('visibilitychange', () => {
        if (document.visibilityState === 'hidden') {
            Livewire.dispatch('tabSwitched');
        }
    });

    // Prevent copy/paste/cut
    document.addEventListener('keydown', (e) => {
        if (e.ctrlKey || e.metaKey) {
            // Prevent: ctrl/cmd + c, ctrl/cmd + v, ctrl/cmd + x
            if (['c', 'v', 'x'].includes(e.key.toLowerCase())) {
                e.preventDefault();
                return false;
            }
        }
    });

    // Prevent right click
    document.addEventListener('contextmenu', (e) => {
        e.preventDefault();
        return false;
    });

    // Prevent drag and drop
    document.addEventListener('dragstart', (e) => {
        e.preventDefault();
        return false;
    });
});
</script>
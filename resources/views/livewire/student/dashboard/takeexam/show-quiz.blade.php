<div>
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
        <button id="fullscreen-btn" class="bg-gray-800 text-white mt-5 p-2 rounded-lg fixed top-18 right-4 z-50">
            Fullscreen
        </button>

        <div class="container mx-auto py-12 px-6" id="quizzes">
            <div class="sticky top-0 bg-white p-4 flex space-x-2 overflow-x-auto w-full">
                @foreach ($courses->exams as $exam)
                    @if ($exam->status)
                        @foreach ($quizzes as $quiz)
                            @if ($quiz->status)
                                <button type="button"
                                    class="w-24 md:w-16 h-10 flex items-center justify-center font-medium border rounded-lg bg-gray-50 hover:bg-gray-100 quiz-nav-button disabled:bg-gray-300 disabled:cursor-not-allowed"
                                    data-target="question-{{ $quiz->id }}"
                                    disabled>
                                    {{ $loop->iteration }}
                                </button>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">
                <div class="md:col-span-3 bg-white rounded-lg">
                    <form id="quiz-form" wire:submit.prevent="storeAnswer" class="p-6">
                        @csrf
                        <div id="quiz-container">
                            @if ($quizzes && $quizzes->count() > 0)
                                @foreach ($quizzes as $quiz)
                                    <div class="quiz-question hidden" id="question-{{ $quiz->id }}">
                                        <div class="mb-4">
                                            <h6 class="text-lg font-semibold">Question {{ $loop->iteration }}</h6>
                                            <p class="text-gray-700">{{ $quiz->question }}</p>
                                        </div>
                                        @for ($i = 1; $i <= 4; $i++)
                                            <div class="mb-2">
                                                <input type="radio" 
                                                    id="option{{ $i }}-{{ $quiz->id }}"
                                                    name="selectedOptions[{{ $quiz->id }}]"
                                                    value="option{{ $i }}"
                                                    wire:model="selectedOptions.{{ $quiz->id }}"
                                                    class="hidden peer quiz-option">
                                                <label for="option{{ $i }}-{{ $quiz->id }}"
                                                    class="inline-flex items-center gap-3 w-full px-4 py-2 text-sm font-medium border rounded-lg cursor-pointer bg-gray-50 border-gray-300 peer-checked:bg-blue-500 peer-checked:text-white">
                                                    {{ $quiz->{'option' . $i} ?? 'N/A' }}
                                                </label>
                                            </div>
                                        @endfor
                                    </div>
                                @endforeach
                            @else
                                <p>No quizzes available for this exam.</p>
                            @endif
                        </div>

                        <div class="mt-6 flex justify-between">
                            <button type="button" id="prev-btn"
                                    class="hidden bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">Previous</button>
                            <button type="button" id="next-btn"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hidden">Next</button>
                            <button type="submit" id="submit-btn"
                                    class="bg-green-500 text-white px-4 py-2 rounded-lg hidden">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    function initializeQuiz() {
        const fullscreenBtn = document.getElementById('fullscreen-btn');
        const quizzesContainer = document.getElementById('quizzes');
        const questions = document.querySelectorAll('.quiz-question');
        const navButtons = document.querySelectorAll('.quiz-nav-button');
        const prevBtn = document.getElementById('prev-btn');
        const nextBtn = document.getElementById('next-btn');
        const submitBtn = document.getElementById('submit-btn');
        const options = document.querySelectorAll('.quiz-option');
        const quizForm = document.getElementById('quiz-form');
        let currentQuestionIndex = 0;
        let tabSwitchCount = 0;
        let examCompleted = false;
        let isSubmitting = false;
        let initialZoomLevel = window.devicePixelRatio || 1;

        if (!fullscreenBtn || !quizzesContainer || !quizForm) {
            console.error('Critical elements not found.');
            return false;
        }

        console.log('Quiz elements found, initializing...');

        quizzesContainer.style.display = 'none';
        navButtons.forEach(button => {
            button.setAttribute('disabled', 'true');
            button.classList.add('disabled');
        });

        fullscreenBtn.addEventListener('click', () => {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen()
                    .then(() => console.log('Fullscreen enabled'))
                    .catch(err => console.error(`Failed to enable fullscreen: ${err.message}`));
            } else {
                document.exitFullscreen()
                    .then(() => console.log('Fullscreen exited'))
                    .catch(err => console.error(`Failed to exit fullscreen: ${err.message}`));
            }
        });

        document.addEventListener('fullscreenchange', () => {
            const isFullscreen = !!document.fullscreenElement;
            console.log('Fullscreen state:', isFullscreen);
            quizzesContainer.style.display = isFullscreen ? 'block' : 'none';
            navButtons.forEach(button => {
                button.toggleAttribute('disabled', !isFullscreen);
                button.classList.toggle('disabled', !isFullscreen);
            });
            if (isFullscreen && questions.length > 0) {
                questions[currentQuestionIndex].classList.remove('hidden');
                toggleButtonsVisibility();
            }
        });

        window.addEventListener('resize', () => {
            const currentZoom = window.devicePixelRatio || 1;
            if (Math.abs(currentZoom - initialZoomLevel) > 0.1 && !examCompleted) {
                console.warn('Zoom level changed:', currentZoom);
                alert('Warning: Zooming is not allowed during the exam.');
                document.body.style.zoom = `${initialZoomLevel * 100}%`;
            }
        });

        function updateNavButtonStatus(index) {
            const button = navButtons[index];
            const answered = isQuestionAnswered(index);
            button.classList.toggle('bg-green-500', answered);
            button.classList.toggle('bg-red-500', !answered);
            button.classList.toggle('text-white', true);
            button.classList.remove('bg-gray-50');
        }

        function isQuestionAnswered(index) {
            return !!questions[index].querySelector('input[type="radio"]:checked');
        }

        function toggleButtonsVisibility() {
            prevBtn.classList.toggle('hidden', currentQuestionIndex === 0);
            nextBtn.classList.toggle('hidden', currentQuestionIndex >= questions.length - 1);
            submitBtn.classList.toggle('hidden', currentQuestionIndex < questions.length - 1);
        }

        ['cut', 'copy', 'paste'].forEach(event => {
            document.addEventListener(event, e => e.preventDefault());
        });

        options.forEach(option => {
            option.addEventListener('change', () => {
                const questionId = option.closest('.quiz-question').id.split('-')[1];
                const quizIndex = Array.from(questions).findIndex(q => q.id === `question-${questionId}`);
                updateNavButtonStatus(quizIndex);
            });
        });

        navButtons.forEach((button, index) => {
            button.addEventListener('click', () => {
                if (!button.disabled) {
                    const targetQuestionId = button.getAttribute('data-target');
                    const targetQuestion = document.getElementById(targetQuestionId);
                    questions.forEach(q => q.classList.add('hidden'));
                    targetQuestion.classList.remove('hidden');
                    currentQuestionIndex = index;
                    toggleButtonsVisibility();
                }
            });
        });

        nextBtn.addEventListener('click', () => {
            if (currentQuestionIndex < questions.length - 1) {
                updateNavButtonStatus(currentQuestionIndex);
                questions[currentQuestionIndex].classList.add('hidden');
                currentQuestionIndex++;
                questions[currentQuestionIndex].classList.remove('hidden');
                toggleButtonsVisibility();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentQuestionIndex > 0) {
                questions[currentQuestionIndex].classList.add('hidden');
                currentQuestionIndex--;
                questions[currentQuestionIndex].classList.remove('hidden');
                toggleButtonsVisibility();
            }
        });

        function submitQuiz() {
            if (isSubmitting) {
                console.log('Submission already in progress, ignoring.');
                return;
            }
            isSubmitting = true;
            examCompleted = true;
            console.log('Submitting quiz...');
            Livewire.dispatch('submitQuiz');
            submitBtn.disabled = true;
            alert('Exam submitted successfully!');
        }

        let tabSwitchTimeout;
        document.addEventListener('visibilitychange', () => {
            if (document.hidden && !examCompleted && !isSubmitting) {
                tabSwitchCount++;
                clearTimeout(tabSwitchTimeout);
                tabSwitchTimeout = setTimeout(() => {
                    if (tabSwitchCount === 1) {
                        alert('Warning: Do not switch tabs during the exam.');
                    } else if (tabSwitchCount >= 2) {
                        alert('Too many tab switches. Submitting exam now.');
                        submitQuiz();
                    }
                }, 300);
            }
        });

        window.onbeforeunload = () => (examCompleted || isSubmitting) ? null : 'Are you sure you want to leave the exam?';

        submitBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (!isSubmitting && confirm('Are you sure you want to submit the exam?')) {
                submitQuiz();
            }
        });

        toggleButtonsVisibility();
        return true;
    }

    // Run initialization only after passcode is verified
    document.addEventListener('livewire:init', () => {
        console.log('Livewire initialized');
    });

    // Listen for the passcode-verified event from Livewire
    Livewire.on('passcode-verified', () => {
        console.log('Passcode verified, initializing quiz...');
        setTimeout(() => {
            if (initializeQuiz()) {
                console.log('Quiz initialized successfully');
            } else {
                console.error('Failed to initialize quiz');
            }
        }, 100); // Small delay to ensure DOM is updated
    });
</script>
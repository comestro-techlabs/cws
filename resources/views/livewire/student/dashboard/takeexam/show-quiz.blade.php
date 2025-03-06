<div>
    <button id="fullscreen-btn" class="bg-gray-800 text-white p-2 rounded-lg fixed top-18 right-4 z-50">
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
</div>
<script>
    // Function to initialize quiz functionality
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

        // Check if critical elements are available
        if (!fullscreenBtn || !quizzesContainer) {
            console.error('Fullscreen button or quizzes container not found yet.');
            return false; // Signal initialization failed
        }

        console.log('Elements found, setting up quiz...');

        // Initially hide quiz content and disable navigation
        quizzesContainer.style.display = 'none';
        navButtons.forEach(button => {
            button.setAttribute('disabled', 'true');
            button.classList.add('disabled');
        });

        // Fullscreen toggle functionality
        fullscreenBtn.addEventListener('click', () => {
            console.log('Fullscreen button clicked');
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().then(() => {
                    console.log('Fullscreen enabled successfully');
                }).catch(err => {
                    console.error(`Failed to enable fullscreen: ${err.message}`);
                });
            } else {
                document.exitFullscreen().then(() => {
                    console.log('Fullscreen exited successfully');
                }).catch(err => {
                    console.error(`Failed to exit fullscreen: ${err.message}`);
                });
            }
        });

        // Handle fullscreen change
        document.addEventListener('fullscreenchange', () => {
            console.log('Fullscreen state changed:', !!document.fullscreenElement);
            if (document.fullscreenElement) {
                quizzesContainer.style.display = 'block';
                navButtons.forEach(button => {
                    button.removeAttribute('disabled');
                    button.classList.remove('disabled');
                });
                if (questions.length > 0 && questions[currentQuestionIndex].classList.contains('hidden')) {
                    questions[currentQuestionIndex].classList.remove('hidden');
                }
                toggleButtonsVisibility();
            } else {
                quizzesContainer.style.display = 'none';
                navButtons.forEach(button => {
                    button.setAttribute('disabled', 'true');
                    button.classList.add('disabled');
                });
            }
        });

        // Check initial fullscreen state
        if (document.fullscreenElement) {
            console.log('Page loaded in fullscreen mode');
            quizzesContainer.style.display = 'block';
            navButtons.forEach(button => {
                button.removeAttribute('disabled');
                button.classList.remove('disabled');
            });
            if (questions.length > 0) {
                questions[currentQuestionIndex].classList.remove('hidden');
            }
            toggleButtonsVisibility();
        }

        // Ensure the fullscreen state is correct when the page is refreshed
        document.addEventListener('DOMContentLoaded', () => {
            if (document.fullscreenElement) {
                quizzesContainer.style.display = 'block';
                navButtons.forEach(button => {
                    button.removeAttribute('disabled');
                    button.classList.remove('disabled');
                });
                if (questions.length > 0) {
                    questions[currentQuestionIndex].classList.remove('hidden');
                }
                toggleButtonsVisibility();
            } else {
                quizzesContainer.style.display = 'none';
                navButtons.forEach(button => {
                    button.setAttribute('disabled', 'true');
                    button.classList.add('disabled');
                });
            }
        });

        // Navigation and quiz logic (unchanged from previous)
        function updateNavButtonStatus(index) {
            const button = navButtons[index];
            const answered = isQuestionAnswered(index);
            if (answered) {
                button.classList.add('bg-green-500', 'text-white');
                button.classList.remove('bg-gray-50', 'bg-red-500');
            } else {
                button.classList.add('bg-red-500', 'text-white');
                button.classList.remove('bg-gray-50', 'bg-green-500');
            }
        }

        function isQuestionAnswered(index) {
            return questions[index].querySelector('input[type="radio"]:checked') !== null;
        }

        function toggleButtonsVisibility() {
            prevBtn.classList.toggle('hidden', currentQuestionIndex === 0);
            nextBtn.classList.toggle('hidden', currentQuestionIndex >= questions.length - 1);
            submitBtn.classList.toggle('hidden', currentQuestionIndex < questions.length - 1);
        }

        document.addEventListener('cut', e => e.preventDefault());
        document.addEventListener('copy', e => e.preventDefault());
        document.addEventListener('paste', e => e.preventDefault());

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

        document.addEventListener('visibilitychange', () => {
            if (document.hidden && !examCompleted) {
                tabSwitchCount++;
                if (tabSwitchCount < 2) {
                    alert('Warning: Do not switch tabs during the exam.');
                } else {
                    alert('You have switched tabs too many times. The exam will be submitted now.');
                    examCompleted = true;
                    quizForm.submit();
                }
            }
        });

        window.onbeforeunload = () => {
            if (!examCompleted) {
                return "You are in the middle of the exam. Are you sure you want to leave?";
            }
        };

        submitBtn.addEventListener('click', () => {
            examCompleted = true;
            alert("You have completed the exam.");
        });

        toggleButtonsVisibility();
        return true; // Signal initialization succeeded
    }

    // Poll until elements are ready or Livewire initializes
    function waitForElements() {
        const maxAttempts = 10;
        let attempts = 0;

        const interval = setInterval(() => {
            attempts++;
            console.log(`Attempt ${attempts} to initialize quiz...`);

            if (initializeQuiz()) {
                clearInterval(interval);
                console.log('Quiz initialized successfully');
            } else if (attempts >= maxAttempts) {
                clearInterval(interval);
                console.error('Failed to initialize quiz after max attempts. Elements not found.');
            }
        }, 500); // Check every 500ms
    }

    document.addEventListener('livewire:init', () => {
        setTimeout(() => initializeQuiz(), 100);
    });

    document.addEventListener('livewire:navigated', () => {
        setTimeout(() => initializeQuiz(), 100);
    });
</script>

@extends('studentdashboard.include.base')



@section('content')
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
                                class="w-24 md:w-16 h-10 flex items-center justify-center font-medium border rounded-lg bg-gray-50 hover:bg-gray-100 quiz-nav-button"
                                data-target="question-{{ $quiz->id }}">
                                {{ $loop->iteration }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mt-6">


            <!-- Quiz Content Area -->
            <div class="md:col-span-3 bg-white  rounded-lg">
                <form id="quiz-form" action="{{ route('student.storeAnswer') }}" method="POST" class="p-6">
                    @csrf
                    <div id="quiz-container">
                        @foreach ($courses->exams as $exam)
                            @if ($exam->status)
                                <h5 class="text-xl font-bold mb-4">{{ $exam->exam_name }}</h5>

                                {{-- @php
                                    $quizzes = $exam->quizzes->where('status', 1)->shuffle()->take(10);
                                @endphp --}}

                                @foreach ($quizzes as $quiz)
                                    @if ($quiz->status)
                                        <div class="quiz-question hidden" id="question-{{ $quiz->id }}">
                                            <div class="mb-4">
                                                <h6 class="text-lg font-semibold">Question {{ $loop->iteration }}</h6>
                                                <p class="text-gray-700">{{ $quiz->question }}</p>
                                            </div>
                                            @for ($i = 1; $i <= 4; $i++)
                                                <div class="mb-2">
                                                    <input type="radio" id="option{{ $i }}-{{ $quiz->id }}"
                                                        name="selected_option[{{ $quiz->id }}]"
                                                        value="option{{ $i }}" class="hidden peer quiz-option">
                                                    <label for="option{{ $i }}-{{ $quiz->id }}"
                                                        class="inline-flex items-center gap-3 w-full px-4 py-2 text-sm font-medium border rounded-lg cursor-pointer bg-gray-50 border-gray-300 peer-checked:bg-blue-500 peer-checked:text-white">
                                                        {{ $quiz->{'option' . $i} }}
                                                    </label>
                                                </div>
                                            @endfor
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                    </div>

                    <div class="mt-6 flex justify-between">
                        <button type="button" id="prev-btn"
                            class="hidden bg-gray-200 text-gray-800 px-4 py-2 rounded-lg">Previous</button>
                        <button type="button" id="next-btn"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg">Next</button>
                        <button type="submit" id="submit-btn"
                            class="hidden bg-green-500 text-white px-4 py-2 rounded-lg">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questions = document.querySelectorAll('.quiz-question');
            const prevBtn = document.getElementById('prev-btn');
            const nextBtn = document.getElementById('next-btn');
            const submitBtn = document.getElementById('submit-btn');
            const navButtons = document.querySelectorAll('.quiz-nav-button');
            const options = document.querySelectorAll('.quiz-option');
            const quizForm = document.getElementById('quiz-form');
            let currentQuestionIndex = 0;
            let tabSwitchCount = 0;
            let examCompleted = false;

             // Initially disable navigation and content
             navButtons.forEach(button => {
                button.setAttribute('disabled', 'true');
                button.classList.add('disabled');
            });

            // Initially hide quiz content
            document.getElementById('quizzes').style.display = 'none';

            // Fullscreen toggle functionality
            const fullscreenBtn = document.getElementById('fullscreen-btn');
            fullscreenBtn.addEventListener('click', function() {
                if (!document.fullscreenElement) {
                    document.documentElement.requestFullscreen();
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    }
                }
            });
            // Event listener for when the user enters fullscreen mode
            document.addEventListener('fullscreenchange', function() {
                if (document.fullscreenElement) {
                    // Enable quiz content and navigation once fullscreen is activated
                    document.getElementById('quizzes').style.display = 'block';
                    navButtons.forEach(button => {
                        button.removeAttribute('disabled');
                        button.classList.remove('disabled');
                    });

                    // Display the first question
                    if (questions.length > 0) {
                        questions[currentQuestionIndex].classList.remove('hidden');
                    }
                }
            });

            // if (questions.length > 0) {
            //     questions[currentQuestionIndex].classList.remove('hidden');
            // }

             
            // Update navigation button status when a question is answered
            function updateNavButtonStatus(index) {
                const button = navButtons[index];
                const answered = isQuestionAnswered(index);

                if (answered) {
                    button.classList.add('bg-green-500', 'text-white');
                    button.classList.remove('bg-gray-50', 'text-gray-800', 'bg-red-500');
                } else {
                    button.classList.add('bg-red-500', 'text-white');
                    button.classList.remove('bg-gray-50', 'text-gray-800', 'bg-green-500');
                }
            }

            function isQuestionAnswered(index) {
                const currentQuestion = questions[index];
                return currentQuestion.querySelector('input[type="radio"]:checked') !== null;
            }

            function toggleButtonsVisibility() {
                prevBtn.style.display = currentQuestionIndex > 0 ? 'inline-block' : 'none';
                nextBtn.style.display = currentQuestionIndex < questions.length - 1 ? 'inline-block' : 'none';
                submitBtn.style.display = currentQuestionIndex === questions.length - 1 ? 'inline-block' : 'none';
            }

            // Prevent cut, copy, and paste
            document.addEventListener('cut', function(e) {
                e.preventDefault();
            });

            document.addEventListener('copy', function(e) {
                e.preventDefault();
            });

            document.addEventListener('paste', function(e) {
                e.preventDefault();
            });
            // Update navigation button status when options change
            options.forEach(option => {
                option.addEventListener('change', function() {
                    const questionId = this.closest('.quiz-question').id.split('-')[1];
                    const quizIndex = Array.from(questions).findIndex(q => q.id ===
                        `question-${questionId}`);
                    updateNavButtonStatus(quizIndex);
                });
            });

            // Update the navigation buttons on page load for all available questions
            navButtons.forEach((button, index) => {
                button.addEventListener('click', function() {
                    const targetQuestionId = button.getAttribute('data-target');
                    const targetQuestion = document.getElementById(targetQuestionId);
                    questions.forEach(q => q.classList.add('hidden')); // Hide all questions
                    targetQuestion.classList.remove('hidden'); // Show the target question
                    currentQuestionIndex = Array.from(questions).indexOf(
                        targetQuestion); // Update the current index
                    toggleButtonsVisibility(); // Update the visibility of prev/next/submit buttons
                });
            });

            // Navigation buttons functionality
            nextBtn.addEventListener('click', function() {
                const currentQuestion = questions[currentQuestionIndex];
                updateNavButtonStatus(currentQuestionIndex);

                currentQuestion.classList.add('hidden');
                currentQuestionIndex++;

                if (currentQuestionIndex < questions.length) {
                    questions[currentQuestionIndex].classList.remove('hidden');
                }

                toggleButtonsVisibility();
            });

            prevBtn.addEventListener('click', function() {
                const currentQuestion = questions[currentQuestionIndex];
                currentQuestion.classList.add('hidden');
                currentQuestionIndex--;

                if (currentQuestionIndex >= 0) {
                    questions[currentQuestionIndex].classList.remove('hidden');
                }

                toggleButtonsVisibility();
            });

            toggleButtonsVisibility();

            // Tab change warning
            document.addEventListener('visibilitychange', function() {
                if (document.hidden && !examCompleted) {
                    tabSwitchCount++;
                    if (tabSwitchCount < 2) {
                        alert(`Warning: Do not switch tabs during the exam.`);
                    } else {
                        alert(`You have switched tabs too many times. The exam will be submitted now.`);
                        examCompleted = true;
                        quizForm.submit();
                    }
                }
            });

            // Warn user on page reload
            window.onbeforeunload = function() {
                if (!examCompleted) {
                    return "You are in the middle of the exam. Are you sure you want to leave?";
                }
            };

            // Submit exam
            submitBtn.addEventListener('click', function() {
                examCompleted = true;
                alert("You have completed the exam.");
            });
        });
    </script>
@endsection




{{-- @section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const questions = document.querySelectorAll('.quiz-question');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    const navButtons = document.querySelectorAll('.quiz-nav-button');
    const options = document.querySelectorAll('.quiz-option');
    const quizForm = document.getElementById('quiz-form');
    const maxAttempts = 3;
    let currentQuestionIndex = 0;
    let tabSwitchCount = 0; // Track the number of tab switches
    let examCompleted = false; // To track if the exam is completed

    // Show the first question
    if (questions.length > 0) {
        questions[currentQuestionIndex].style.display = 'block';
    }

    // Update navigation button status
    function updateNavButtonStatus(index) {
        const button = navButtons[index];
        const answered = isQuestionAnswered(index);

        if (answered) {
            button.classList.add('btn-success');
            button.classList.remove('btn-light', 'btn-danger');
        } else {
            button.classList.add('btn-danger');
            button.classList.remove('btn-light', 'btn-success');
        }
    }

    // Check if the current question is answered
    function isQuestionAnswered(index) {
        const currentQuestion = questions[index];
        return currentQuestion.querySelector('input[type="radio"]:checked') !== null;
    }

    // Toggle visibility of navigation buttons
    function toggleButtonsVisibility() {
        prevBtn.style.display = currentQuestionIndex > 0 ? 'inline-block' : 'none';
        nextBtn.style.display = currentQuestionIndex < questions.length - 1 ? 'inline-block' : 'none';
        submitBtn.style.display = currentQuestionIndex === questions.length - 1 ? 'inline-block' : 'none';
    }

    // Event listener for Next button
    nextBtn.addEventListener('click', function () {
        const currentQuestion = questions[currentQuestionIndex];
        updateNavButtonStatus(currentQuestionIndex);

        currentQuestion.style.display = 'none';
        currentQuestionIndex++;

        if (currentQuestionIndex < questions.length) {
            questions[currentQuestionIndex].style.display = 'block';
        }

        toggleButtonsVisibility();
    });

    // Event listener for Previous button
    prevBtn.addEventListener('click', function () {
        const currentQuestion = questions[currentQuestionIndex];
        currentQuestion.style.display = 'none';
        currentQuestionIndex--;

        if (currentQuestionIndex >= 0) {
            questions[currentQuestionIndex].style.display = 'block';
        }

        toggleButtonsVisibility();
    });

    // Event listener for selecting an option
    options.forEach(option => {
        option.addEventListener('change', function () {
            const questionIndex = this.getAttribute('data-question-index');
            updateNavButtonStatus(questionIndex);
        });
    });

    // Initial button visibility setup
    toggleButtonsVisibility();

    // Prevent tab switch: detect if the user switches tabs or minimizes
    let isTabChanged = false;

    document.addEventListener('visibilitychange', function () {
        if (document.hidden && !examCompleted) {
            tabSwitchCount++;
            if (tabSwitchCount < 2) {
                alert(`Warning: You are not allowed to switch tabs during the exam. If you switch tabs again, the exam will be automatically submitted.`);
            } else {
                alert(`You have switched tabs too many times. The exam will be submitted now.`);
               
                examCompleted = true;
                quizForm.submit();
            }
        }
    });

    // Prevent the user from closing the tab or refreshing the page during the exam
    window.onbeforeunload = function (e) {
        if (!examCompleted) {
            return "You are in the middle of the exam. Are you sure you want to leave?";
        }
    };

    // Disable copy, cut, and paste operations
    document.addEventListener('copy', function (e) {
        e.preventDefault();
    });

    document.addEventListener('cut', function (e) {
        e.preventDefault();
    });

    document.addEventListener('paste', function (e) {
        e.preventDefault();
    });

    // Mark the exam as completed after submission
    submitBtn.addEventListener('click', function () {
        examCompleted = true;
        alert("You have completed the exam.");
    });
});
</script>
@endsection --}}

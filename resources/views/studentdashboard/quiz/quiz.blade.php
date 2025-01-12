@extends('studentdashboard.include.base')

@section('content')

<div class="container-fluid page__container mt-24">
    <div class="row">
       
        <!-- Quiz Content Area -->
        <div class="col-md-9">
            <div class="card">
               
                <form id="quiz-form" action="{{ route('student.storeAnswer') }}" method="POST">
                    @csrf
                    <div class="card-body" id="quiz-container">
                        {{-- @foreach ($courses as $course) --}}
                       
                            @foreach ($courses->exams as $exam)
                                @if ($exam->status)
                                    <h5 class="card-title">{{ $exam->exam_name }}</h5>
                                    
                                    @php
                                    $quizzes = $exam->quizzes->where('status', 1)->shuffle()->take(3);
                                    @endphp
                                    @foreach ($quizzes as $quiz)
                                        @if ($quiz->status)
                                            <div class="quiz-question" id="question-{{ $quiz->id }}" style="display: none;">
                                                <div class="mb-3">
                                                    <h6>Question {{ $loop->iteration }}</h6>
                                                    <p><strong>{{ $quiz->question }}</strong></p>
                                                </div>
                                                @for ($i = 1; $i <= 4; $i++)
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" 
                                                               id="option{{ $i }}-{{ $quiz->id }}" 
                                                               name="selected_option[{{ $quiz->id }}]" 
                                                               value="option{{ $i }}" 
                                                               class="custom-control-input quiz-option"
                                                               data-question-index="{{ $loop->parent->iteration - 1 }}">
                                                        <label class="custom-control-label" 
                                                               for="option{{ $i }}-{{ $quiz->id }}">
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

                        {{-- @endforeach --}}
                    </div>

                    <div class="card-footer">
                        <button type="button" id="prev-btn" class="btn btn-secondary" style="display: none;">Previous</button>
                        <button type="button" id="next-btn" class="btn btn-primary">Next</button>
                        <button type="submit" id="submit-btn" class="btn btn-success float-right" style="display: none;">Submit</button>
                    </div>
                </form>
              
            </div>
        </div>

        <!-- Sidebar for quiz navigation -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h6>Quiz Navigation</h6>
                </div>
                <div class="card-body">
                    <div class="quiz-navigation">
                            @foreach ($courses->exams as $exam)
                                @if ($exam->status)
                                @php
                                    $quizzes = $exam->quizzes->where('status', 1)->shuffle()->take(3);
                                    @endphp
                                    @foreach ($quizzes as $quiz)
                                        @if ($quiz->status)
                                            <button type="button" 
                                                    class="btn btn-light btn-block mb-1 quiz-nav-button" 
                                                    data-target="question-{{ $quiz->id }}">
                                                Question {{ $loop->iteration }}
                                            </button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>

@endsection

@section('scripts')
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
@endsection

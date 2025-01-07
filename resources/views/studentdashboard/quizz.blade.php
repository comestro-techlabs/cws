@extends('studentdashboard.include.base')

@section('content')


<div class="container-fluid page__container mt-24">
    <div class="row">

       

        <!-- Quiz Content Area -->
        <div class="col-md-9">
            <div class="card">
                <form action="{{ route('student.storeAnswer') }}" method="POST">
                    @csrf
                    <div class="card-body" id="quiz-container">
                        @foreach ($courses as $course)
                            @foreach ($course->exams as $exam)
                                @if ($exam->status)
                                    <h5 class="card-title">{{ $exam->exam_name }}</h5>
                                    <p><strong>Course:</strong> {{ $course->title }}</p>

                                    @foreach ($exam->quizzes as $quiz)
                                        @if ($quiz->status)
                                            <div class="quiz-question" id="question-{{ $quiz->id }}" style="display: none;">
                                                <div class="mb-3">
                                                    <h6>Question {{ $loop->iteration }}</h6>
                                                    <p><strong>{{ $quiz->question }}</strong></p>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option1-{{ $quiz->id }}" name="selected_option[{{ $quiz->id }}]" value="option1" class="custom-control-input">
                                                    <label class="custom-control-label" for="option1-{{ $quiz->id }}">{{ $quiz->option1 }}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option2-{{ $quiz->id }}" name="selected_option[{{ $quiz->id }}]" value="option2" class="custom-control-input">
                                                    <label class="custom-control-label" for="option2-{{ $quiz->id }}">{{ $quiz->option2 }}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option3-{{ $quiz->id }}" name="selected_option[{{ $quiz->id }}]" value="option3" class="custom-control-input">
                                                    <label class="custom-control-label" for="option3-{{ $quiz->id }}">{{ $quiz->option3 }}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option4-{{ $quiz->id }}" name="selected_option[{{ $quiz->id }}]" value="option4" class="custom-control-input">
                                                    <label class="custom-control-label" for="option4-{{ $quiz->id }}">{{ $quiz->option4 }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                    <div class="card-footer">
                        <button type="button" id="skip-btn" class="btn btn-warning">Skip</button>
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
                        @foreach ($courses as $course)
                            @foreach ($course->exams as $exam)
                                @if ($exam->status)
                                    @foreach ($exam->quizzes as $quiz)
                                        @if ($quiz->status)
                                            <button type="button" class="btn btn-light btn-block mb-1 quiz-nav-button" data-target="question-{{ $quiz->id }}">
                                                Question {{ $loop->iteration }}
                                            </button>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('obtained_marks'))
        <div class="alert alert-success mt-4">
            <strong>Congratulations!</strong> You have scored {{ session('obtained_marks') }} marks.
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const questions = document.querySelectorAll('.quiz-question');
    const skipBtn = document.getElementById('skip-btn');
    const nextBtn = document.getElementById('next-btn');
    const submitBtn = document.getElementById('submit-btn');
    const navButtons = document.querySelectorAll('.quiz-nav-button');

    let currentQuestionIndex = 0;

    // Show the first question
    if (questions.length > 0) {
        questions[currentQuestionIndex].style.display = 'block';
    }

    // Update the navigation button's style
    function updateNavButtonStatus(index, answered) {
        const button = navButtons[index];
        if (answered) {
            button.classList.add('btn-success');
            button.classList.remove('btn-light');
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

    // Event listener for navigation buttons
    navButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            questions[currentQuestionIndex].style.display = 'none';
            currentQuestionIndex = index;
            questions[currentQuestionIndex].style.display = 'block';
        });
    });

    // Event listener for Next button
    nextBtn.addEventListener('click', function () {
        const currentQuestion = questions[currentQuestionIndex];
        const answered = isQuestionAnswered(currentQuestionIndex);
        updateNavButtonStatus(currentQuestionIndex, answered);

        currentQuestion.style.display = 'none';
        currentQuestionIndex++;

        if (currentQuestionIndex < questions.length) {
            questions[currentQuestionIndex].style.display = 'block';
        }

        // Toggle buttons visibility
        if (currentQuestionIndex === questions.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-block';
        }
    });

    // Event listener for Skip button
    skipBtn.addEventListener('click', function () {
        const currentQuestion = questions[currentQuestionIndex];
        updateNavButtonStatus(currentQuestionIndex, false);

        currentQuestion.style.display = 'none';
        currentQuestionIndex++;

        if (currentQuestionIndex < questions.length) {
            questions[currentQuestionIndex].style.display = 'block';
        }

        // Toggle buttons visibility
        if (currentQuestionIndex === questions.length - 1) {
            nextBtn.style.display = 'none';
            submitBtn.style.display = 'inline-block';
        }
    });

    // Event listener for form submission
    submitBtn.addEventListener('click', function () {
        questions.forEach((question, index) => {
            const answered = isQuestionAnswered(index);
            updateNavButtonStatus(index, answered);
        });
    });
});
</script>
@endsection


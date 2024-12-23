@extends('studentdashboard.include.base')

@section('content')
<div class="container-fluid page__container">
    <div class="row">

        <div class="col-md-8 mt-20">
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
                                            <div class="quiz-question" data-quiz-id="{{ $quiz->id }}" style="display: none;">
                                                <label for="question-{{ $quiz->id }}"><strong>{{ $loop->iteration }}. {{ $quiz->question }}</strong></label>
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

    let currentQuestionIndex = 0;
    const unansweredQuestions = new Set();

    // Show the first question
    if (questions.length > 0) {
        questions[currentQuestionIndex].style.display = 'block';
    }

    function markUnanswered(index) {
        const questionId = questions[index].getAttribute('data-quiz-id');
        unansweredQuestions.add(questionId);
    }

    // Event listener for Next button
    nextBtn.addEventListener('click', function () {
        const currentQuestion = questions[currentQuestionIndex];
        const selectedOption = currentQuestion.querySelector('input[type="radio"]:checked');

        if (!selectedOption) {
            alert('You didn\'t answer this question.');
            markUnanswered(currentQuestionIndex);
        }

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
        alert('You skipped this question.');
        markUnanswered(currentQuestionIndex);

        questions[currentQuestionIndex].style.display = 'none';
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
});
</script>
@endsection

@extends('studentdashboard.include.base')

@section('content')
<div class="container-fluid page__container">
    <div class="row">

        <div class="col-md-8 mt-20">
            <div class="card">
               
                <form action="{{ route('student.storeAnswer') }}" method="POST">
                    @csrf
                    @foreach ($courses as $course)
                        @foreach ($course->exams as $exam)
                            @if ($exam->status)
                                <div class="card-body">
                                    <h5 class="card-title">{{ $exam->exam_name }}</h5>
                                    <p><strong>Course:</strong> {{ $course->title }}</p>

                                    @foreach ($exam->quizzes as $quiz)
                                        @if ($quiz->status)
                                            <div class="form-group">
                                                <label for="question-{{ $quiz->id }}"><strong>{{ $loop->iteration }}. {{ $quiz->question }}</strong></label>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option1-{{ $quiz->id }}" name="answer[{{ $quiz->id }}]" value="option1" class="custom-control-input">
                                                    <label class="custom-control-label" for="option1-{{ $quiz->id }}">{{ $quiz->option1 }}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option2-{{ $quiz->id }}" name="answer[{{ $quiz->id }}]" value="option2" class="custom-control-input">
                                                    <label class="custom-control-label" for="option2-{{ $quiz->id }}">{{ $quiz->option2 }}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option3-{{ $quiz->id }}" name="answer[{{ $quiz->id }}]" value="option3" class="custom-control-input">
                                                    <label class="custom-control-label" for="option3-{{ $quiz->id }}">{{ $quiz->option3 }}</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="option4-{{ $quiz->id }}" name="answer[{{ $quiz->id }}]" value="option4" class="custom-control-input">
                                                    <label class="custom-control-label" for="option4-{{ $quiz->id }}">{{ $quiz->option4 }}</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    @endforeach

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success float-right">Submit <i class="material-icons btn__icon--right">arrow_forward</i></button>
                    </div>
                </form>
            </div>
        </div>

        
    </div>

    <!-- Display obtained marks after quiz submission -->
    @if(session('obtained_marks'))
        <div class="alert alert-success mt-4">
            <strong>Congratulations!</strong> You have scored {{ session('obtained_marks') }} marks.
        </div>
    @endif
</div>
@endsection

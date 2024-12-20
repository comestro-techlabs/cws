@extends('studentdashboard.include.base')



@section('content')
    <div class="container">
        <h1>Your Quizzes</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @foreach ($courses as $course)
            <h2>{{ $course->name }}</h2>
            @foreach ($course->exams as $exam)
                @if($exam->status)
                    <h3>{{ $exam->title }}</h3>
                    @foreach ($exam->quizzes as $quiz)
                        @if($quiz->status)
                            <div>
                                <p><strong>Question:</strong> {{ $quiz->question }}</p>
                                <p><strong>Marks:</strong> {{ $quiz->marks }}</p>
                                <form action="{{ route('student.storeAnswer') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                                    <div>
                                        <input type="radio" name="answer" value="option1" required> {{ $quiz->option1 }}
                                    </div>
                                    <div>
                                        <input type="radio" name="answer" value="option2" required> {{ $quiz->option2 }}
                                    </div>
                                    <div>
                                        <input type="radio" name="answer" value="option3" required> {{ $quiz->option3 }}
                                    </div>
                                    <div>
                                        <input type="radio" name="answer" value="option4" required> {{ $quiz->option4 }}
                                    </div>
                                    <button type="submit">Submit Answer</button>
                                </form>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endforeach
        @endforeach
    </div>
@endsection
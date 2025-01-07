@extends('studentdashboard.include.base')

@section('content')

<div class="container mx-auto mt-10 px-4 py-8">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Your Courses</h1>

    @foreach ($courses as $course)
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ $course->title }}</h2>
            <div class="flex justify-between">
            <a href="{{ route('student.quiz', ['courseId' => $course->id]) }}">Take quiz</a>
            <a href="{{ route('student.allAttempts', $course->id) }}">See Result</a>
        </div>
            
        </div>
    @endforeach

</div>

@endsection
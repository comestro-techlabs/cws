{{-- @extends('studentdashboard.include.base')

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

@endsection --}}

@extends('studentdashboard.include.base')

@section('content')

<div class="container mx-auto mt-10 px-4 py-8">

    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Your Courses</h1>

    {{-- Display Error Message if there are no courses --}}
    @if($courses->isEmpty())
        <div class="alert alert-warning mb-4 bg-yellow-100 text-yellow-800 p-4 rounded-lg">
            You are not enrolled in any courses. Please check back later.
        </div>
    @endif

    {{-- Display success or error message if available --}}
    @if(session('error'))
        <div class="alert alert-danger mb-4 bg-red-100 text-red-800 p-4 rounded-lg">
            {{ session('error') }}
        </div>
    @elseif(session('success'))
        <div class="alert alert-success mb-4 bg-green-100 text-green-800 p-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    {{-- Loop through each course --}}
    @foreach ($courses as $course)
        <div class="bg-white shadow-md rounded-lg p-6 mb-4">
            <h2 class="text-xl font-bold text-gray-800">{{ $course->title }}</h2>
            
            <div class="flex justify-between mt-4">
                {{-- Check if the course has an active quiz and show corresponding links --}}
                @if($course->exams->isNotEmpty())
                    <a href="{{ route('student.showquiz', ['courseId' => $course->id]) }}" class="text-blue-500 hover:text-blue-700">Take quiz</a>
                    <a href="{{ route('student.allAttempts', $course->id) }}" class="text-blue-500 hover:text-blue-700">See Result</a>
                @else
                    <span class="text-red-500">No quiz available yet</span>
                @endif
            </div>
        </div>
    @endforeach

</div>

@endsection

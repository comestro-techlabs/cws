@extends('admin.base')

@section('title', 'Add Quiz  ')

@section('content')

<div class="max-w-2xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Add a Quiz Question</h1>
    
    <form action="{{ route('quiz.store') }}" method="POST" >
        @csrf
        <div>
            <label for="course_id" class="block text-gray-700 font-medium mb-2">Select Course</label>
            <select name="course_id"  class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" required>
                <option value="" disabled selected>Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="question" class="block text-gray-700 font-medium mb-2">Quiz Question</label>
            <textarea name="question" rows="4" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>
        <div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 mt-4 rounded hover:bg-blue-700 transition">
                Add Question
            </button>
        </div>
    </form>
    
</div>

@endsection
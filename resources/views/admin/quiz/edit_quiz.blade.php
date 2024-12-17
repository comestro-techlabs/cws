@extends('admin.base')

@section('title', 'Edit Quiz Question')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Quiz Question</h1>

    <form action="{{ route('quiz.update', $quiz->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label for="course_id" class="block text-gray-700 font-medium mb-2">Select Course</label>
            <select name="course_id" class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-500" required>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $quiz->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="question" class="block text-gray-700 font-medium mb-2">Quiz Question</label>
            <textarea name="question" rows="4" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $quiz->question }}</textarea>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Options</label>
            <input type="text" name="option1" value="{{ $quiz->option1 }}" class="w-full mb-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Option 1" required>
            <input type="text" name="option2" value="{{ $quiz->option2 }}" class="w-full mb-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Option 2" required>
            <input type="text" name="option3" value="{{ $quiz->option3 }}" class="w-full mb-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Option 3" required>
            <input type="text" name="option4" value="{{ $quiz->option4 }}" class="w-full mb-2 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Option 4" required>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Correct Answer</label>
            <select name="correct_answer" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" required>
                <option value="option1" {{ $quiz->correct_answer == 'option1' ? 'selected' : '' }}>Option 1</option>
                <option value="option2" {{ $quiz->correct_answer == 'option2' ? 'selected' : '' }}>Option 2</option>
                <option value="option3" {{ $quiz->correct_answer == 'option3' ? 'selected' : '' }}>Option 3</option>
                <option value="option4" {{ $quiz->correct_answer == 'option4' ? 'selected' : '' }}>Option 4</option>
            </select>
        </div>

        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1" {{ $quiz->status ? 'checked' : '' }} class="rounded">
                <span class="ml-2 text-gray-700">Publish</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Update Quiz
            </button>
        </div>
    </form>
</div>
@endsection

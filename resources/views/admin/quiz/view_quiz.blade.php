
@extends('admin.base')

@section('content')
<div class="container mx-auto mt-10">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <h1 class="text-2xl font-bold mb-6">Quiz Question Details</h1>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="course">
                Exam Name:
            </label>
            <p class="text-gray-900">{{ $quiz->exam->exam_name }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="question">
                Question:
            </label>
            <p class="text-gray-900">{{ $quiz->question }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="options">
                Options:
            </label>
            <ul class="list-disc pl-5 text-gray-900">
                <li>{{ $quiz->option1 }}</li>
                <li>{{ $quiz->option2 }}</li>
                <li>{{ $quiz->option3 }}</li>
                <li>{{ $quiz->option4 }}</li>
            </ul>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="correct_answer">
                Correct Answer:
            </label>
            <p class="text-gray-900">{{ $quiz->{$quiz->correct_answer} }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="time">
               Time
            </label>
            <p class="text-gray-900">{{ $quiz->{$quiz->time} }}</p>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="options">
                Status:
            </label>
            <p class="text-gray-900">{{ $quiz->status ? 'Published' : "Unpublished" }}</p>
        </div>
        <div class="flex gap-2 ">
            <a href="{{ route('quiz.edit', ['quiz' => $quiz->id]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>
            <form action="{{ route('quiz.destroy', ['quiz' => $quiz->id]) }}" method="POST" class="inline-block">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="{{ route('quiz.show') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>

        </div>
    </div>
</div>
@endsection

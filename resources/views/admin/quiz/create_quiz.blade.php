@extends('admin.base')

@section('content')
@if (session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-6">Add a Quiz Question</h1>
    <form action="{{ route('quiz.store') }}" method="POST">
        @csrf
        <div>
            <label class="block text-gray-700 mb-2">Course</label>
            <select name="course_id" class="w-full border px-3 py-2 rounded" required>
                <option value="" disabled selected>Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Question</label>
            <textarea name="question" class="w-full border px-3 py-2 rounded" rows="4" required></textarea>
        </div>
        <div class="mt-4 grid grid-cols-2 gap-4">
            <input type="text" name="option1" placeholder="Option 1" class="w-full border px-3 py-2 rounded" required>
            <input type="text" name="option2" placeholder="Option 2" class="w-full border px-3 py-2 rounded" required>
            <input type="text" name="option3" placeholder="Option 3" class="w-full border px-3 py-2 rounded" required>
            <input type="text" name="option4" placeholder="Option 4" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Correct Answer</label>
            <select name="correct_answer" class="w-full border px-3 py-2 rounded" required>
                <option value="option1">Option 1</option>
                <option value="option2">Option 2</option>
                <option value="option3">Option 3</option>
                <option value="option4">Option 4</option>
            </select>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Status</label>
            <input type="checkbox" name="status" value="1" class="mr-2"> Active
        </div>
        <button class="mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save Quiz</button>
    </form>
</div>
@endsection

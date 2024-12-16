@extends('admin.base')

@section('title', 'Quiz Questions')

@section('content')

<div class="w-full mx-auto mt-10 bg-white p-6  ">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Quiz Questions</h1>

    <table class="w-full border-collapse border border-gray-300 overflow-x-auto">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Course</th>
                <th class="border border-gray-300 px-4 py-2">Question</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr class="w-full">
                    <td class="border border-gray-300 px-4 py-2">{{ $quiz->id }}</td>
                    <td class="border border-gray-300 px-4 py-2 max-w-24 truncate">{{ $quiz->course->title }}</td>
                    <td class="border border-gray-300 px-4 py-2 max-w-80  truncate">{{ $quiz->question }}</td>
                    <td class="border border-gray-300 px-4 max-w-12 py-2 ">

                    <div class="gap-4 flex ">
                        <a href="{{ route('quiz.edit', $quiz->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Edit
                        </a>

                        <!-- Delete Form -->
                        <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700 transition"
                                onclick="return confirm('Are you sure you want to delete this question?')">
                                Delete
                            </button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

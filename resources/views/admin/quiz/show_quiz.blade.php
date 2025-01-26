@extends('admin.base')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Manage Quizzes</h1>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search..." class="border px-3 py-2 rounded w-full" value="{{ request('search') }}">
    </form>

    <table class="w-full border-collapse border">
        <thead>
            <tr>
                <th class="border px-4 py-2">ID</th>
                {{-- <th class="border px-4 py-2">Course</th> --}}
                <th class="border px-4 py-2">Exam</th>
                <th class="border px-4 py-2">Question</th>
                <th class="border px-4 py-2">Time</th>
                <th class="border px-4 py-2">status</th>

                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($quizzes as $quiz)
                <tr>
                    <td class="border px-4 py-2">{{ $quiz->id }}</td>
                    {{-- <td class="border px-4 py-2">{{ $quiz->course->title }}</td> --}}
                    <td class="border px-4 py-2">{{ $quiz->exam->exam_name }}</td>
                    <td class="border px-4 py-2">{{ $quiz->question }}</td>
                    <td class="border px-4 py-2">{{ $quiz->time }}</td>
                    <td class="border px-4 py-2">
                    <form action="{{ route('quiz.toggleStatus', ['quiz' => $quiz->id]) }}" method="POST" class="inline-block">
                        @csrf
                        @method('PATCH')
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="status" class="sr-only peer" onchange="this.form.submit()" {{ $quiz->status ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-green-300  peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                        </label>
                    </form>
                    </td>
                    <td class="border px-4 py-2">
                        <div class="flex gap-2">
                       <a href="{{ route('quiz.view', $quiz->id) }}" class="bg-green-500 text-white py-2 px-4 rounded">View</a>
                        <a href="{{ route('quiz.edit', $quiz->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded">Edit</a>
                        <form action="{{ route('quiz.destroy', $quiz->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</div>
@endsection

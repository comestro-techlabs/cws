@extends('admin.base')

@section('content')
<div class="max-w-6xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center  mb-6">
        <h1 class="text-2xl font-bold">Users for Exam: {{ $exam->exam_name }}</h1>
        <button onclick="history.back()" class="px-4 py-2 ml-4 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
            Go Back
        </button>
    </div>
    @if ($examuser->isEmpty())
        <p class="text-xl text-gray-500">No users have taken this exam yet.</p>
    @else
    <div class="overflow-x-auto">
        <table class=" min-w-full mx-auto border-collapse border p-4  border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2 bg-gray-100">ID</th>
                    <th class="border px-4 py-2 bg-gray-100">User Name</th>
                    <th class="border px-4 py-2 bg-gray-100">Email</th>
                    <th class="border px-4 py-2 bg-gray-100">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($examuser as $entry)
                    <tr>
                        <td class="border px-4 py-2 text-center">{{ $entry->id }}</td>
                        <td class="border px-4 py-2">{{ $entry->user->name }}</td>
                        <td class="border px-4 py-2">{{ $entry->user->email }}</td>
                        <td class="border px-4 py-2 text-center">
                            <a href="{{ route('attempt.results', ['examId' => $exam->id, 'userId' => $entry->user_id]) }}" 
                               class="bg-blue-500 text-white px-2 py-1 hover:bg-blue-700 rounded inline-block text-center">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

@endsection

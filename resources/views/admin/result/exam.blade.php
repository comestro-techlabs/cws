@extends('admin.base')

@section('content')
<div class="max-w-6xl mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-6">Manage Exam Details</h1>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif
 
    <form method="GET" class="mb-4">
        <input type="text" name="search" placeholder="Search..." class="border px-3 py-2 rounded w-full" value="{{ request('search') }}">
    </form>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($exams as $exam)
            <div class="border rounded-lg p-4 bg-white">
                <h2 class="text-xl font-bold mb-2">{{ $exam->course->title }}</h2>
                <p class="text-gray-700 mb-4">{{ $exam->exam_name }}</p>
                <a href="{{ route('exam.user.results', ['exam' => $exam->id]) }}" class="bg-blue-500 text-white py-2 px-4 rounded inline-block text-center">
                    View
                </a>
            </div>
        @endforeach
    </div>
    


</div>
@endsection

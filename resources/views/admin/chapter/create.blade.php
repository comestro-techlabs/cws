@extends('admin.base')

@section('title', 'Add Chapter | ')

@section('content')
    <div class="flex flex-col px-[2%] py-5">
        <h2 class="text-2xl font-semibold text-slate-700">Add Chapter to "{{ $course->title }}"</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('chapter.store', $course->id) }}" method="POST" class="flex flex-col gap-4">
            @csrf

            <div class="flex flex-col gap-2">
                <label for="title" class="text-lg font-medium text-slate-600">Chapter Title</label>
                <input type="text" name="title" id="title" class="border px-3 py-2 rounded-lg" placeholder="Enter chapter title" required>
            </div>

            <div class="flex gap-2 mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Chapter</button>
                <a href="{{ route('course.show', $course->id) }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection

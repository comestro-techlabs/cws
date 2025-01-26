@extends('admin.base')

@section('title', 'Edit Chapter | ' . $chapter->title)

@section('content')
    <div class="flex px-[2%] py-0 flex-col">
        <div class="flex gap-3 my-5 flex-row justify-between items-center">
            <div class="flex flex-1 flex-col border-s-4 border-s-orange-400 pl-3">
                <h2 class="md:text-xl text-lg font-normal  text-slate-500 ">
                    Edit Chapter: {{ $chapter->title }}</h2>
            </div>
            <div class="inline-flex flex-row md:items-center gap-2" role="group">
                <a href="{{ route('course.show', $chapter->course_id) }}"
                    class="px-3 py-2 bg-teal-600 rounded-lg text-white self-start">
                    Back to Course
                </a>
            </div>
        </div>

        <div class="bg-white p-5 rounded shadow">
            <form action="{{ route('chapter.update', $chapter->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Chapter Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $chapter->title) }}"
                           class="border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('title')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Add other chapter fields here as needed --}}

                <div class="flex gap-4">
                    <button type="submit" class="bg-teal-600 text-white px-3 py-2 rounded">Save Changes</button>
                    <a href="{{ route('course.show', $chapter->course_id) }}" class="bg-gray-500 text-white px-3 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection

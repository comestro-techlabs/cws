@extends('admin.base')

@section('title', 'Add assigment | ')

@section('content')
<div class="bg-gray-100 py-10 min-h-screen">
    <div class="max-w-4xl mx-auto px-6">
        <h2 class="text-4xl font-semibold text-center text-gray-800 mb-8">Create Assignment</h2>
         <!-- Success and Error Messages -->
         @if (session('success'))
         <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
             <strong class="font-bold">Success!</strong>
             <span class="block sm:inline">{{ session('success') }}</span>
         </div>
         @endif
 
         @if (session('error'))
         <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
             <strong class="font-bold">Error!</strong>
             <span class="block sm:inline">{{ session('error') }}</span>
         </div>
         @endif
 
        <div class="bg-white shadow-lg rounded-lg p-8">
            <form action="{{ route('assignment.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Assignment Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Assignment Title</label>
                    <input type="text" name="title" id="title"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter assignment name" required>
                    @error('title')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Instructions -->
                <div>
                    <label for="editor" class="block text-sm font-medium text-gray-700 mb-2">Instructions (Optional)</label>
                    <textarea name="description" id="editor"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 h-32 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        placeholder="Enter instructions"></textarea>
                    @error('description')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Course Dropdown -->
                <div>
                    <label for="course_id" class="block text-sm font-medium text-gray-700 mb-2">Select Course</label>
                    <select name="course_id" id="course_id"
                        class="w-full bg-gray-50 border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
                        required>
                        <option value="" disabled selected>Select a course</option>
                        @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit"
                        class="bg-blue-500 text-white px-6 py-3 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Create Assignment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

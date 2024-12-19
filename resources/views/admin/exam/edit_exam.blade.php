@extends('admin.base')

@section('title', 'Edit Exam Details')

@section('content')
<div class="max-w-3xl mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Exam details</h1>

    <form action="{{ route('exam.update', $exam->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div>
            <label class="block text-gray-700 mb-2">Course</label>
            <select name="course_id" class="w-full border px-3 py-2 rounded" required>
                <option value="" disabled selected>Select a course</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ $exam->course_id == $course->id ? 'selected' : '' }}>
                        {{ $course->title }}
                    </option> 
                @endforeach
            </select>
        </div>
        <div class="mt-4">
            <label for="" class="block text-gray-700">Exam Name</label>
            <input type="text" name="exam_name" value="{{$exam->exam_name}}" class="w-full border px-3 py-2 rounded"required>

        </div>
       
        <div class="mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1" {{ $exam->status ? 'checked' : '' }} class="rounded">
                <span class="ml-2 text-gray-700">Publish</span>
            </label>
        </div>

        <div class="mt-6">
            <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition">
                Update Exam
            </button>
        </div>
    </form>
</div>
@endsection

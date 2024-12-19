@extends('admin.base')

@section('title','Inseting Exam Details')



@section('content')
@if (session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-6">Add a Exam Question</h1>
    <form action="{{ route('exam.store') }}" method="POST">
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
            <label for="" class="block text-gray-700">Exam Name</label>
            <input type="text" name="exam_name" class="w-full border px-3 py-2 rounded"required>

        </div>
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Status</label>
            <input type="checkbox" name="status" value="1" class="mr-2"> Active
        </div>
        <button class="mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save Exam</button>
    </form>
</div>
@endsection


@extends('admin.base')

@section('title', 'Insert Exam Details')

@section('content')
@if (session('success'))
<div class="bg-green-100 text-green-700 p-4 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="max-w-4xl mx-auto mt-10 p-6 bg-white rounded shadow-md">
    <h1 class="text-2xl font-bold mb-6">Add an Exam Question</h1>
    <form action="{{ route('exam.create') }}" method="GET">
        @csrf
        <div>
            <label class="block text-gray-700 mb-2">Course</label>
            <select name="course_id" id="course_id" class="w-full border px-3 py-2 rounded" onchange="this.form.submit()" required>
                <option value="" {{ request('course_id') == '' ? 'selected' : '' }}>Select a Course</option>
                @foreach ($courses as $course)
                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                    {{ $course->title }}
                </option>
                @endforeach
            </select>
            @error('course_id')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>
    </form>

    <form action="{{ route('exam.store') }}" method="POST">
        @csrf
        <input type="hidden" name="course_id" value="{{ request('course_id') }}">
        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Batch</label>
            <select name="batch_id" id="batch_id" class="w-full border px-3 py-2 rounded" required>
                <option value="" {{ old('batch_id') == '' ? 'selected' : '' }}>Select a Batch</option>
                @if (isset($batches))
                    @foreach ($batches as $batch)
                    <option value="{{ $batch->id }}" {{ old('batch_id') == $batch->id ? 'selected' : '' }}>
                        {{ $batch->batch_name }}
                    </option>
                    @endforeach
                @endif
            </select>
            @error('batch_id')
            <span class="text-sm text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Exam Name</label>
            <input type="text" name="exam_name" value="{{ old('exam_name') }}" class="w-full border px-3 py-2 rounded" required>
            @error('exam_name')
            <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Exam Date</label>
            <input type="date" name="exam_date" value="{{ old('exam_date') }}" class="w-full border px-3 py-2 rounded" required>
            @error('exam_date')
            <p class="text-xs text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-4">
            <label class="block text-gray-700 mb-2">Status</label>
            <input type="checkbox" name="status" value="1" class="mr-2" {{ old('status') ? 'checked' : '' }}> Active
        </div>

        <button class="mt-6 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Save Exam</button>
    </form>
</div>
@endsection

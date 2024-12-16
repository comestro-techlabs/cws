@extends('admin.base')

@section('title', 'Add assigment | ')

@section('content')
<div class="bg-gray-100 h-screen">
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Assignment Details</h2>
        
        <!-- Display Assignment Title -->
        <div class="mb-4">
            <label class="block text-gray-700">Title</label>
            <p class="text-lg">{{ $assignment->title }}</p>
        </div>

        <!-- Display Assignment Description -->
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <p>{!! $assignment->description !!}</p>
        </div>

        <!-- Display Assignment Course -->
        <div class="mb-4">
            <label class="block text-gray-700">Course</label>
            <p>{{ $assignment->course->title }}</p>
        </div>

        <!-- Display Assignment Status -->
        <div class="mb-4">
            <label class="block text-gray-700">Status</label>
            <p>{{ $assignment->status ? 'Active' : 'Inactive' }}</p>
        </div>

        <!-- Display Date Created -->
        <div class="mb-4">
            <label class="block text-gray-700">Date Created</label>
            <p>{{ $assignment->created_at->format('Y-m-d') }}</p>
        </div>

        <!-- Display Date Updated -->
        <div class="mb-4">
            <label class="block text-gray-700">Last Updated</label>
            <p>{{ $assignment->updated_at->format('Y-m-d') }}</p>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('assignment.index') }}"
                class="text-blue-500 hover:underline">Back to Assignments List</a>
        </div>
    </div>
</div>
@endsection
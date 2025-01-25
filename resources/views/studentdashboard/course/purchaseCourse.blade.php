@extends('studentdashboard.include.base')
@section('content')
<div class="page mt-16  min-h-screen">
    <!-- Page Heading -->
    <div class="border-b border-gray-300 py-4">
        <div class="container mx-auto px-6 flex items-center">
            <h1 class="text-2xl font-bold text-gray-800">Courses</h1>
            <a href="{{route('student.course')}}"
                class="ml-auto bg-indigo-600 hover:bg-indigo-500 text-white py-2 px-4 rounded flex items-center shadow">
                New Course
            </a>
        </div>
    </div>

    
    <!-- Courses Section -->
    <div class="container mx-auto px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($courses as $course)
            <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300">
                <div class="flex">
                    <!-- Course Image -->
                    <div class="w-1/3">
                        <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                             alt="{{ $course->title }}"
                             class="w-full h-full object-cover">
                    </div>

                    <!-- Course Details -->
                    <div class="w-2/3 p-6 flex flex-col">
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-gray-800 mb-3 truncate">
                            <a href="#" class="hover:text-blue-600 transition-colors duration-200">{{ $course->title }}</a>
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 mb-4">
                            {{ Str::limit($course->description, 100) }}
                        </p>

                        <!-- Instructor & Price -->
                        <div class="flex justify-between items-center mt-auto">
                            <span class="text-sm text-gray-700">
                                <strong>Instructor:</strong> {{ $course->instructor }}
                            </span>
                            <span class="bg-blue-100 text-blue-600 py-1 px-3 rounded text-sm font-medium">
                                ₹{{ $course->discounted_fees }}
                            </span>
                        </div>

                        <!-- Batch Section -->
                        <div class="mt-4">
                            @if ($course->pivot && $course->pivot->batch_id)
                            <div class="text-sm text-gray-700">
                                <strong>Batch:</strong>
                                {{ $course->batches->firstWhere('id', $course->pivot->batch_id)->batch_name }}
                            </div>
                            @else
                            <form action="{{ route('course.updateBatch', $course->id) }}" method="POST" class="mt-3">
                                @csrf
                                @method('PUT')
                                <select name="batch_id" id="batch_{{ $course->id }}"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-400 focus:outline-none">
                                    <option value="">-- Select a Batch --</option>
                                    @foreach ($course->batches as $batch)
                                    <option value="{{ $batch->id }}"
                                            {{ $course->pivot && $course->pivot->batch_id == $batch->id ? 'selected' : '' }}>
                                        {{ $batch->batch_name }}
                                    </option>
                                    @endforeach
                                </select>
                                <button type="submit"
                                        class="mt-3 w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-500 transition-colors duration-200">
                                    Update Batch
                                </button>
                            </form>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4">
                            <a href="{{ route('course.show', $course->id) }}"
                               class="block w-full text-center bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-500 transition-colors duration-200 shadow-md">
                                Start Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach
        </div>
    </div>
</div>
@endsection

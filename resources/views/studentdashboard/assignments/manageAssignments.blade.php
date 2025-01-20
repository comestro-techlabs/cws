@extends('studentdashboard.include.base')

@section('title', 'Upload Assignment File')

@section('content')
    <div class="container mx-auto py-8 mt-12">
        <h1 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Manage Assignments</h1>

        <!-- Check if Courses Exist -->
        @if ($courses->isNotEmpty())
            @foreach ($courses as $course)
                <div class="mb-8">
                    <!-- Course Title -->
                    <div class="bg-teal-600 text-white px-6 py-3 rounded-t-lg">
                        <h2 class="text-lg font-semibold">{{ $course->title }}</h2>
                    </div>

                    <!-- Assignments Table -->
                    <div class="bg-white shadow-md rounded-b-lg overflow-x-auto">
                        <table class="min-w-full border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-3 border text-left text-sm font-medium text-gray-700">ID</th>
                                    <th class="px-4 py-3 border text-left text-sm font-medium text-gray-700">Title</th>
                                    <th class="px-4 py-3 border text-left text-sm font-medium text-gray-700">Description</th>
                                    <th class="px-4 py-3 border text-center text-sm font-medium text-gray-700">Status</th>
                                    <th class="px-4 py-3 border text-center text-sm font-medium text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->assignments as $key => $assignment)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3 border text-sm text-gray-800">{{ $key + 1 }}</td>
                                        <td class="px-4 py-3 border text-sm text-gray-800">{{ $assignment->title }}</td>
                                        <td class="px-4 py-3 border text-sm text-gray-600">
                                            {!! Str::limit($assignment->description, 50) !!}
                                        </td>
                                        <td class="px-4 py-3 border text-center">
                                            @if ($assignment->uploads->isNotEmpty())
                                                @foreach ($assignment->uploads as $upload)
                                                    <span class="px-2 py-1 rounded-lg text-white
                                                        @if ($upload->status == 'submitted') bg-green-500
                                                        @elseif($upload->status == 'graded') bg-blue-500
                                                        @else bg-gray-500 @endif">
                                                        {{ ucfirst($upload->status) }}
                                                    </span><br>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">No uploads</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 border text-center">
                                            <a href="{{ route('student.assignment-upload', $assignment->id) }}"
                                               class="text-blue-600 hover:underline">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-3 border text-center text-gray-500">
                                            No assignments available for this course.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">No courses available for the logged-in student.</p>
        @endif
    </div>
@endsection

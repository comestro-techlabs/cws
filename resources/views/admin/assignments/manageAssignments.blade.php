@extends('admin.base')

@section('title', 'Add assignment | ')

@section('content')
    <div class="bg-gray-100 h-screen">
        <div class="flex justify-between p-6">
            <div class="w-full bg-white p-6 shadow-md rounded-lg">
                <div class="flex justify-between">
                    <div class="flex">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Manage Assignments</h2>

                        <!-- Button to Create a New Assignment -->
                        <a href="{{ route('assignment.create') }}"
                            class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 mb-4">
                            Create New Assignment
                        </a>
                    </div>
                    <div>
                        <!-- Form for Course Dropdown -->
                        <form method="GET" action="{{ route('assignment.index') }}" id="courseFilterForm">
                            <select name="course_id" onchange="this.form.submit()" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="" disabled selected>Select a course</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            {{-- <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-md mt-4">Filter</button> --}}
                        </form>
                        
                    </div>
                </div>

                <!-- Table displaying existing assignments -->
                <table class="min-w-full table-auto mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Title</th>
                            <th class="px-4 py-2 text-left">Description</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Date</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td class="px-4 py-2 truncate max-w-20">{{ $assignment->title }}</td>
                                <td class="px-4 py-2 truncate max-w-80">{!! $assignment->description !!}</td>
                                <td class="px-4 py-2">{{ $assignment->status ? 'Published' : 'Unpublished' }}</td>
                                <td class="px-4 py-2">{{ $assignment->created_at->format('Y-m-d') }}</td>

                                <td class="px-4 py-2 flex space-x-2">
                                    <a href="{{ route('assignment.show', $assignment) }}" class="text-blue-500">View</a>
                                    <a href="{{ route('assignment.edit', $assignment->id) }}" class="text-blue-500">Edit</a>
                                    <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                
            </div>
        </div>
    </div>
@endsection

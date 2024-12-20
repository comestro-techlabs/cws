@extends('admin.base')

@section('title', 'Add assignment | ')

@section('content')
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-2 ">
            Manage Assignments
        </h2>
        <a href="{{ route('assignment.create') }}"
            class="bg-blue-500 text-white px-4 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 sm:mb-0">
            Create New Assignment
            <i class="bi bi-arrow-down-short font-bold"></i>
        </a>
    </div>

    <div class="flex justify-between p-2">
        <div class="w-full bg-white p-6 shadow-md rounded-lg">
             <div class="flex justify-between">
                <div>
                    <!-- Form for Course Dropdown -->
                    <form method="GET" action="{{ route('assignment.index') }}" id="courseFilterForm">
                        <select name="course_id" onchange="this.form.submit()"
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" disabled selected>Select a course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                    </form>

                </div>
            </div> 
            

            <!-- Table displaying existing assignments -->
            <div class="overflow-x-auto flex-wrap">
                <table class="min-w-full table-auto mt-4">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left border">Title</th>
                            <th class="px-4 py-2 text-left  border">Description</th>
                            <th class="px-4 py-2 text-left  border">Status</th>
                            <th class="px-4 py-2 text-left  border">Date</th>
                            <th class="px-4 py-2 text-left  border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td class="px-4 py-2 truncate max-w-20 border">{{ $assignment->title }}</td>
                                <td class="px-4 py-2 truncate max-w-80 border">{!! $assignment->description !!}</td>
                                <td class="px-4 py-2 border">{{ $assignment->status ? 'Published' : 'Unpublished' }}</td>
                                <td class="px-4 py-2 border">{{ $assignment->created_at->format('Y-m-d') }}</td>

                                {{-- <td class="px-4 py-2 flex space-x-2 border"> --}}
                                <td class="px-4 py-2 border">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('assignment.show', $assignment) }}"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-teal-500 transition">View
                                            <i class="bi bi-eye-fill font-bold"></i></a>
                                        <a href="{{ route('assignment.edit', $assignment->id) }}"
                                            class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-blue-500 transition">Edit
                                              <i class="bi bi-pencil-square"></i></a>
                                            <form action="{{ route('assignment.destroy', $assignment->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this assignment?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-2 text-xs rounded-xl font-medium text-white bg-red-500 ">Delete
                                                    <i class="bi bi-trash3-fill font-bold"></i></button>
                                            </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->



        </div>
    </div>
    </div>
@endsection

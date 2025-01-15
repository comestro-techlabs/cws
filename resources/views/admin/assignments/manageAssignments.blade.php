@extends('admin.base')

@section('title', 'Add assignment | ')

@section('content')
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-2 ">
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
                            class="w-full mt-1 p-2 border border-gray-300 rounded-md ">
                            <option value="" {{ request('course_id') ? '' : 'selected' }}>Select a course</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }}
                                </option>
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
                            {{-- <th class="px-4 py-2 text-left  border">Description</th> --}}
                            <th class="px-4 py-2 text-left  border">isPublished</th>
                            <th class="px-4 py-2 text-left  border">Status</th>
                            <th class="px-4 py-2 text-left  border">course</th>
                            <th class="px-4 py-2 text-left  border">Date</th>
                            <th class="px-4 py-2 text-left  border">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignments as $assignment)
                            <tr>
                                <td class="px-4 py-2 truncate max-w-64 border">{{ $assignment->title }}</td>
                                {{-- <td class="px-4 py-2 truncate max-w-80 border">{!! $assignment->description !!}</td> --}}
                                <td class="px-4 py-2 border">{{ $assignment->status ? 'Published' : 'Unpublished' }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('assignment.toggleStatus', ['assignment' => $assignment->id]) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('PATCH')
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="status" class="sr-only peer" onchange="this.form.submit()" {{ $assignment->status ? 'checked' : '' }}>
                                            <div class="w-11 h-6 bg-gray-200 rounded-full peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                                        </label>
                                    </form>
                                    </td>   
                                    <td class="px-4 py-2 truncate max-w-80 border">{!! $assignment->course->title !!}</td>

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

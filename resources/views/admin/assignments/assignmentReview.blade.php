@extends('admin.base')

@section('title', 'Add assignment | ')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex space-x-6">
                        <!-- Navbar Links -->
                        <a href="#" class="text-gray-900 font-medium hover:underline"
                            onclick="showContent('classwork')">Classwork</a>
                        <a href="#" class="text-gray-900 font-medium hover:underline"
                            onclick="showContent('people')">People</a>
                        <a href="#" class="text-gray-900 font-medium hover:underline"
                            onclick="showContent('grades')">Grades</a>
                    </div>
                    <!-- Right icons -->
                    <div class="flex space-x-4">
                        <button class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                        <button class="text-gray-600 hover:text-gray-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M3 14h18" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </nav>
        {{-- classwork content --}}
        <div class="max-w-3xl mx-auto mt-20 p-6 bg-white hidden" id="classwork">
            <div class="space-y-4">
                @foreach ($assignments as $assignment)
                    <div class="flex flex-col items-start border-b py-4">
                        <!-- Assignment Title -->
                        <div class="w-full flex justify-between items-center">
                            <p class="text-lg font-medium flex items-center cursor-pointer"
                                onclick="toggleDescription('{{ $assignment->id }}')">
                                {{ \Illuminate\Support\Str::words($assignment->title, 5) }}
                            </p>
                            <p class="text-gray-500 font-medium">{{$assignment->created_at->format('Y-m-d')}}</p>
                        </div>

                        <div id="description-{{ $assignment->id }}"
                            class="text-sm bg-gray-100 w-full border shadow text-gray-500 mt-2 hidden">
                            <p>{!! $assignment->description !!}</p>

                            <a href="{{ route('assignment.reviewWork', $assignment->id) }}"
                                class="bg-teal-300 text-white px-2 py-2 inline-block text-center rounded">
                                Review Work
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!--pepole Content -->
        <div class="max-w-7xl mx-auto my-8 px-4 sm:px-6 lg:px-8 hidden" id="people">
            <!-- Teachers Section -->
            <div class="mb-8">
                <h2 class="text-lg font-bold mb-4">Teachers</h2>
                <div class="flex items-center space-x-4 p-4 border rounded-lg shadow-sm bg-white">
                    <div
                        class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold uppercase">
                        S
                    </div>
                    <p class="font-medium">{{ $course->instructor }}</p>
                </div>
            </div>

            <!-- Students Section -->
            <div>

                <h2 class="text-lg font-bold mb-4">Students</h2>

                @foreach ($students as $student)
                    <div class="border rounded-lg overflow-hidden bg-white">
                        <!-- Student Row -->
                        <div class="flex items-center justify-between p-4">
                            <div class="flex items-center space-x-4">
                                <input type="checkbox" class="h-5 w-5 text-teal-600 border-gray-300 ">
                                <div class="w-10 h-10">
                                    <img src="https://via.placeholder.com/40" alt="Student" class="rounded-full">
                                </div>
                                <p class="font-medium">
                                    <a href="{{ route('assignments.singleStudent.assignment', $student['user']->id) }}">

                                        {{-- <a href="{{route('assignments.singleStudent.assignment')}}"> --}}
                                        {{ $student['user']->name }}</a> <span
                                        class="text-sm text-gray-600">({{ $student['upload_count'] }} assignments
                                        uploaded)</span>
                                </p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>




        {{-- Grades --}}
        <div class="max-w-7xl mx-auto my-8 px-4 sm:px-6 lg:px-8 hidden" id="grades">
            <!-- Teachers Section -->
            <div class="mb-8">
                <h2 class="text-lg font-bold mb-4">Teachers</h2>
                <div class="flex items-center space-x-4 p-4 border rounded-lg shadow-sm bg-white">
                    <div
                        class="w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center text-white font-bold uppercase">
                        S
                    </div>
                    <p class="font-medium">{{ $course->instructor }}</p>
                </div>
            </div>

            <!-- Students Section -->
            <div>

                <h2 class="text-lg font-bold mb-4">Students</h2>



                <div class="overflow-x-auto">
                    <table class="min-w-full border-collapse border border-gray-300 bg-white rounded-lg">
                        <thead>
                            <tr class="text-black">
                                <th class="px-6 py-3 border border-gray-300 text-left text-sm font-medium uppercase">Student
                                </th>
                                @foreach ($assignments as $assignment)
                                    <th class="px-6 py-3 border border-gray-300 text-center text-sm font-medium uppercase">
                                        {{ \Illuminate\Support\Str::words($assignment->title, 5) }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Example Student Row -->
                            @foreach ($students as $student)
                                <tr class="border border-gray-300 hover:bg-gray-50">
                                    <td class="px-6 py-4 border border-gray-300 text-left flex items-center space-x-4">
                                        {{-- <div class="w-10 h-10">
                                            <img src="https://via.placeholder.com/40" alt="Student" class="rounded-full">
                                        </div> --}}
                                        <p class="font-medium">
                                            <a href="{{ route('assignments.singleStudent.assignment', $student['user']->id) }}"
                                                class="text-teal-600 hover:underline">
                                                {{ $student['user']->name }}
                                            </a>
                                        </p>
                                    </td>

                                    <!-- Loop through assignments and show grade -->
                                    @foreach ($assignments as $assignment)
                                        <td class="px-6 py-4 border border-gray-300 text-center">
                                            @php
                                                $upload = $student['user']->uploads->firstWhere(
                                                    'assignment_id',
                                                    $assignment->id,
                                                );
                                            @endphp
                                            @if ($upload)
                                            <span class="text-sm font-medium">
                                                @if ($upload->grade)
                                                    <p class="text-gray-500 font-medium group relative inline-block">
                                                        {{ $upload->grade }}
                                                        <span class="opacity-0 group-hover:opacity-100 transition-opacity text-gray-400">
                                                            /100
                                                        </span>
                                                    </p>
                                                @else
                                                    <span class="text-gray-500">No Grade</span>
                                                @endif
                                            </span>
                                        
                                                 @else
                                                <span class="text-sm text-gray-500">Not Submitted</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>

    </div>
    <script>
        function showContent(sectionId) {
            // Hide all sections
            document.querySelectorAll("div[id]").forEach(section => {
                section.classList.add("hidden");
            });
            // Show the clicked section
            document.getElementById(sectionId).classList.remove("hidden");
        }

        // Default to show "People" section
        showContent('classwork');

        function toggleDescription(assignmentId) {
            var description = document.getElementById('description-' + assignmentId);
            description.classList.toggle('hidden');
        }
    </script>

@endsection

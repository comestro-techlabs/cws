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
                        <a href="#" class="text-teal-600 font-medium hover:underline"
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
                    <p class="font-medium">{{$course->instructor}}</p>
                </div>
            </div>

            <!-- Students Section -->
            <div>
                
                <h2 class="text-lg font-bold mb-4">Students</h2>
                {{-- <div class="flex justify-between items-center mb-4">
                    <p class="text-sm text-gray-600">{{ $students->count() }} student</p>
                    <button class="text-teal-600 flex items-center hover:underline">
                       
                        pending Student
                    </button>
                </div> --}}
                @foreach ($students as $student)

                <div class="border rounded-lg overflow-hidden bg-white">
                    <!-- Student Row -->
                    <div class="flex items-center justify-between p-4">
                        <div class="flex items-center space-x-4">
                            <input type="checkbox"
                                class="h-5 w-5 text-teal-600 border-gray-300 ">
                            <div class="w-10 h-10">
                                <img src="https://via.placeholder.com/40" alt="Student" class="rounded-full">
                            </div>
                            <p class="font-medium">
                                <a href="{{ route('assignments.singleStudent.assignment', $student['user']->id) }}">

                                {{-- <a href="{{route('assignments.singleStudent.assignment')}}"> --}}
                                    {{ $student['user']->name }}</a> <span class="text-sm text-gray-600">({{ $student['upload_count'] }} assignments uploaded)</span>
                            </p>
                        </div>
                        
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- classwork content --}}
        <div class="max-w-3xl mx-auto mt-20 p-6 bg-white hidden" id="classwork">
            <div class="space-y-4">
                @foreach ($assignments as $assignment)
                    <div class="flex flex-col items-start border-b py-4">
                        <!-- Assignment Title -->
                        <div class="w-full flex justify-between items-center">
                            <p class="text-lg font-medium flex items-center cursor-pointer" onclick="toggleDescription('{{ $assignment->id }}')">
                                {{ \Illuminate\Support\Str::words($assignment->title, 5) }}
                            </p>
                            <p class="text-gray-500 font-medium">posted yesterday</p>
                        </div>
            
                        <div id="description-{{ $assignment->id }}" class="text-sm bg-gray-100 w-full border shadow text-gray-500 mt-2 hidden">
                            <p>{!! $assignment->description !!}</p>

                            <button class="bg bg-teal-300 text-white px-2 py-2"><a href="{{ route('assignments.reviewWork') }}">Review work</a></button>
                        </div>
                    </div>
                @endforeach
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

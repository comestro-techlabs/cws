@extends('studentdashboard.include.base')
@section('content')


    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page"
        style="">
        @if ($courses->isEmpty())
            <div class="flex flex-col items-center justify-center md:mt-16 lg:mt-20 text-center px-6 md:px-4 space-y-2">
                <img src="{{ asset('assets/welcome.png') }}" class="w-56 md:w-64 lg:w-72 ">
                <h4 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">
                    Welcome! Please purchase a course to access your dashboard.
                </h4>
                <a href="{{ route('student.course') }}">
                    <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 text-sm md:text-lg">
                        Browse Courses
                    </button>

                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <!-- Courses Section -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg lg:col-span-2">
                    <h2 class="text-xl font-bold mb-4 text-gray-600">My Courses</h2>
                    <ul class="space-y-4">
                        @foreach ($courses as $course)
                            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
                                <span class="text-white text-bold">💻{{ $course->title }}</span>
                                <?php
                                
                                $daysElapsed = Carbon\Carbon::now()->diffInWeeks($course->created_at);
                                if ($course->duration > 0) {
                                    $course->progress_percentage = min(max(($daysElapsed / $course->duration) * 100, 0), 100);
                                } else {
                                    $course->progress_percentage = 0;
                                }
                                ?>
                                <span class="text-sm text-gray-300"> <span class="text-green-400 font-bold">
                                        {{ number_format($course->progress_percentage, 2) }}%</span></span>
                            </li>
                        @endforeach


                        {{-- <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span class="text-white text-bold">📊 Data Structures</span>
              <span class="text-sm text-gray-300">Progress: <span class="text-yellow-400 font-bold">60%</span></span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span class="text-white text-bold">🌐 Web Development</span>
              <span class="text-sm text-gray-300">Progress: <span class="text-blue-400 font-bold">90%</span></span>
            </li> --}}
                    </ul>
                </div>

                <!-- Assignments Section -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-lg lg:col-span-1">
                    <h2 class="text-xl font-bold mb-4 text-gray-600">Assignments</h2>
                    <ul class="space-y-4">
                        @foreach ($assignments as $assignment)
                            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
                                <span class="text-white text-bold">📜 {{ $assignment->title }}</span>
                                <span class="text-green-400 font-bold">
                                    @if ($assignment->uploads->isNotEmpty())
                                        @foreach ($assignment->uploads as $upload)
                                            <span
                                                class="px-2 py-1 rounded-lg text-white
                        @if ($upload->status == 'submitted') bg-green-500
                        @elseif($upload->status == 'graded') bg-blue-500
                        @else bg-gray-500 @endif">
                                                {{ ucfirst($upload->status) }}
                                            </span><br>
                                        @endforeach
                                    @else
                                        <span class="text-gray-500">No uploads</span>
                                    @endif
                                </span>
                            </li>
                        @endforeach

                        {{-- <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span class="text-white text-bold">📜 Assignment 2 - Data Structures</span>
              <span class="text-red-400 font-bold">Pending</span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span class="text-white text-bold">📜 Assignment 3 - Web Project</span>
              <span class="text-yellow-400 font-bold">In Progress</span>
            </li> --}}
                    </ul>
                </div>

                <!-- Notifications Section -->
                <div class="p-6 bg-gray-50 rounded-lg shadow-lg lg:col-span-1">
                    <h2 class="text-xl font-bold mb-4 text-gray-600">Notifications</h2>
                    <ul class="space-y-4">
                        <li class="bg-gray-700 p-4 rounded-lg shadow-md text-white">🔔 New quiz available for "Data
                            Structures".</li>
                        <li class="bg-gray-700 p-4 rounded-lg shadow-md text-white">🔔 Assignment 2 deadline extended.</li>
                        <li class="bg-gray-700 p-4 rounded-lg shadow-md text-white">🔔 Web Dev project submissions start
                            next week.</li>
                    </ul>
                </div>

                <!-- Quiz Scores -->
                <div class="text-gray-700 bg-gray-50 p-6 rounded-lg shadow-lg lg:col-span-1">
                    <h2 class="text-xl font-bold mb-4 text-gray-600">Last Quiz Scores</h2>
                    <ul class="space-y-4">
                        @foreach ($exams as $exam)
                            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
                                <span class="text-white text-bold">📝 {{ $exam->exam_name }}</span>
                                <span class="text-blue-400 font-bold">{{$exam->total_marks}}%</span>
                            </li>
                        @endforeach

                        {{-- <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span class="text-white text-bold">📝 Quiz 2: Data Structures</span>
              <span class="text-blue-400 font-bold">78%</span>
            </li> --}}
                    </ul>
                </div>


            </div>
    </div>
    @endif
@endsection

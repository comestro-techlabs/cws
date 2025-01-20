@extends('studentdashboard.include.base')
@section('content')


    <!-- Header Layout Content -->
    <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page" style="padding-top: 60px;">
        @if ($courses->isEmpty())

        <div class="flex flex-col items-center justify-center mt-12 md:mt-16 lg:mt-20 text-center px-6 md:px-4 space-y-2">
            <img src="{{ asset('assets/welcome.png') }}" class="w-56 md:w-64 lg:w-72 ">
            <h4 class="text-xl md:text-2xl font-semibold text-gray-800 mb-2">
                Welcome! Please purchase a course to access your dashboard.
            </h4>
            <a href="{{route('student.course')}}" >
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700 text-sm md:text-lg">
                    Browse Courses
                </button>

            </a>
        </div>

    @else
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
        <!-- Courses Section -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-500 p-6 rounded-lg shadow-lg lg:col-span-2">
          <h2 class="text-xl font-semibold mb-4 text-white">My Courses</h2>
          <ul class="space-y-4">
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>💻 Introduction to Programming</span>
              <span class="text-sm text-gray-300">Progress: <span class="text-green-400 font-bold">80%</span></span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>📊 Data Structures</span>
              <span class="text-sm text-gray-300">Progress: <span class="text-yellow-400 font-bold">60%</span></span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>🌐 Web Development</span>
              <span class="text-sm text-gray-300">Progress: <span class="text-blue-400 font-bold">90%</span></span>
            </li>
          </ul>
        </div>

        <!-- Assignments Section -->
        <div class="bg-gradient-to-r from-pink-500 to-purple-500 p-6 rounded-lg shadow-lg lg:col-span-1">
          <h2 class="text-xl font-semibold mb-4 text-white">Assignments</h2>
          <ul class="space-y-4">
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>📜 Assignment 1 - Basics</span>
              <span class="text-green-400 font-bold">Submitted</span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>📜 Assignment 2 - Data Structures</span>
              <span class="text-red-400 font-bold">Pending</span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>📜 Assignment 3 - Web Project</span>
              <span class="text-yellow-400 font-bold">In Progress</span>
            </li>
          </ul>
        </div>

        <!-- Notifications Section -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg lg:col-span-1">
          <h2 class="text-xl font-semibold mb-4 text-indigo-400">Notifications</h2>
          <ul class="space-y-4">
            <li class="bg-gray-700 p-4 rounded-lg shadow-md">🔔 New quiz available for "Data Structures".</li>
            <li class="bg-gray-700 p-4 rounded-lg shadow-md">🔔 Assignment 2 deadline extended.</li>
            <li class="bg-gray-700 p-4 rounded-lg shadow-md">🔔 Web Dev project submissions start next week.</li>
          </ul>
        </div>

        <!-- Quiz Scores -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg lg:col-span-1">
          <h2 class="text-xl font-semibold mb-4 text-indigo-400">Last Quiz Scores</h2>
          <ul class="space-y-4">
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>📝 Quiz 1: Programming Basics</span>
              <span class="text-blue-400 font-bold">85%</span>
            </li>
            <li class="bg-gray-700 p-4 rounded-lg flex justify-between items-center shadow-md">
              <span>📝 Quiz 2: Data Structures</span>
              <span class="text-blue-400 font-bold">78%</span>
            </li>
          </ul>
        </div>

        <!-- Attendance Graph -->
        <div class="bg-gray-800 p-6 rounded-lg shadow-lg lg:col-span-3">
          <h2 class="text-xl font-semibold mb-4 text-indigo-400">Attendance Overview</h2>
          <div class="flex items-center justify-between">
            <canvas id="attendanceChart" class="w-full h-72"></canvas>
            <div class="ml-6 text-center">
              <p class="text-4xl font-extrabold text-green-400">92%</p>
              <p class="text-gray-300">Attendance Percentage</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');
        new Chart(ctx, {
          type: 'doughnut',
          data: {
            labels: ['Present', 'Absent'],
            datasets: [{
              data: [92, 8],
              backgroundColor: ['#4CAF50', '#FF5252'],
              hoverOffset: 4
            }]
          },
          options: {
            responsive: true,
            plugins: {
              legend: { display: true, position: 'bottom' }
            }
          }
        });
      </script>

@endif
@endsection

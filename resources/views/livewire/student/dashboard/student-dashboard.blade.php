@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#2563EB'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#2563EB'
        });
    </script>
@endif

<div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">
   
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            <!-- Gems -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Gems</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $gems }}</h3>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="bg-gradient-to-br from-blue-100 via-purple-100 to-pink-100 p-3 rounded-full">
                            <svg class="w-7 h-7" viewBox="0 0 24 24">
                                <defs>
                                    <linearGradient id="gemGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#60A5FA" />
                                        <stop offset="50%" style="stop-color:#8B5CF6" />
                                        <stop offset="100%" style="stop-color:#EC4899" />
                                    </linearGradient>
                                </defs>
                                <path fill="url(#gemGradient)" d="M12 1L3 9l9 13l9-13l-9-8zm0 3.5L6.5 9h11L12 4.5zM5 10l7 10l7-10H5z"/>
                                <path fill="currentColor" opacity="0.2" d="M12 14L5 10h14l-7 4z"/>
                            </svg>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Tasks -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Tasks</p>
                        <h3 class="text-2xl font-bold text-gray-900 mt-1">{{ $completedTasks }}/{{ $totalTasks }}</h3>
                    </div>
                    <div class="bg-gradient-to-br from-green-100 via-emerald-100 to-teal-100 p-3 rounded-full">
                        <svg class="w-7 h-7" viewBox="0 0 24 24">
                            <defs>
                                <linearGradient id="taskGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#34D399" />
                                    <stop offset="50%" style="stop-color:#059669" />
                                    <stop offset="100%" style="stop-color:#0F766E" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#taskGradient)" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Attendance -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Attendance</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $attendancePercentage }}%</h3>
                    </div>
                    <div class="bg-gradient-to-br from-amber-100 via-orange-100 to-yellow-100 p-3 rounded-full">
                        <svg class="w-7 h-7" viewBox="0 0 24 24">
                            <defs>
                                <linearGradient id="attendanceGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#F59E0B" />
                                    <stop offset="50%" style="stop-color:#EA580C" />
                                    <stop offset="100%" style="stop-color:#EAB308" />
                                </linearGradient>
                            </defs>
                            <path fill="url(#attendanceGradient)" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Course Assignments -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-900">Course Assignments</h2>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($courses as $course)
                            <div class="p-6">
                                <h3 class="text-md font-semibold text-blue-600 mb-4">{{ $course->title }}</h3>
                                @if($course->assignments->count() > 0)
                                    <ul class="space-y-3">
                                        @foreach($course->assignments as $assignment)
                                            <li class="p-4 rounded-lg border border-gray-100 hover:border-blue-200 transition duration-200">
                                                <div class="flex justify-between items-start">
                                                    <div class="flex items-center space-x-3">
                                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                        </svg>
                                                        <div>
                                                            <h4 class="text-gray-900 font-medium">{{ $assignment->title }}</h4>
                                                            <p class="text-sm text-gray-500 mt-1">Due: {{ $assignment->due_date }}</p>
                                                        </div>
                                                    </div>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $assignment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                        {{ ucfirst($assignment->status) }}
                                                    </span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <div class="text-center py-6">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No assignments yet</h3>
                                        <p class="mt-1 text-sm text-gray-500">Assignments for this course will appear here.</p>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No courses available</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by enrolling in a course.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Weekly Attendance -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-900">Last Week</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-7 gap-2 justify-between">
                            @foreach($weekDays as $day)
                                <div class="flex flex-col  items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center mb-1
                                        {{ $day['present'] ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            @if($day['present'])
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            @endif
                                        </svg>
                                    </div>
                                    <span class="text-xs font-medium text-gray-500">{{ substr($day['name'], 0, 3) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Rewards Progress -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-900">Rewards Progress</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-gray-700">Current Gems</span>
                                <span class="text-lg font-bold text-blue-600">{{ $gems }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($gems / $nextMilestone) * 100 }}%"></div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">{{ $nextMilestone - $gems }} gems until next reward</p>
                        </div>
                        <button class="w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            View Available Rewards
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

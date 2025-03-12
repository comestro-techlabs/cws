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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Gems -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Gems</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $gems }}</h3>
                    </div>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        Redeem
                    </button>
                </div>
            </div>

            <!-- Points -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Points</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $points }}</h3>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
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
                    <div class="bg-gray-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Attendance -->
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-700">Attendance</p>
                        <h3 class="text-2xl font-bold text-blue-600 mt-1">{{ $attendance }}%</h3>
                    </div>
                    <div class="bg-blue-50 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
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
                        @foreach($courses as $course)
                            <div class="p-6">
                                <h3 class="text-md font-semibold text-blue-600 mb-4">{{ $course->title }}</h3>
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
                            </div>
                        @endforeach
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

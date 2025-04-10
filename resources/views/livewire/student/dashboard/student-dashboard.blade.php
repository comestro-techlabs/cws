@if (session('welcome'))
    <script>
        Swal.fire({
            title: 'Welcome!',
            text: "{{ session('welcome') }}",
            icon: 'success',
            confirmButtonText: 'Get Started',
            confirmButtonColor: '#2563EB',
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        });
    </script>
@endif

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

<div
    class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page">

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
                                <path fill="url(#gemGradient)"
                                    d="M12 1L3 9l9 13l9-13l-9-8zm0 3.5L6.5 9h11L12 4.5zM5 10l7 10l7-10H5z" />
                                <path fill="currentColor" opacity="0.2" d="M12 14L5 10h14l-7 4z" />
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
                            <path fill="url(#taskGradient)"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
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
                            <path fill="url(#attendanceGradient)"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-900">Enrolled Courses</h2>
                        </div>
                    </div>
                    <div class="divide-y divide-gray-200">
                        @forelse($courses as $course)
                            <div class="p-6">
                                <h3 class="text-md font-semibold text-blue-600 mb-4">{{ $course->title }}</h3>
                                <div
                                    class="p-4 rounded-lg border border-gray-100 hover:border-blue-200 transition duration-200">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                            </svg>
                                            <div>
                                                <h4 class="text-gray-900 font-medium">Course Details</h4>

                                            </div>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{$course->course_type}}
                                        </span>

                                    </div>

                                    @if($course->meeting_link || $course->meeting_id)
                                        <div class="mt-4 pl-8">
                                            <div class="space-y-2">
                                                <h5 class="text-sm font-medium text-gray-700">Meeting Details</h5>

                                                @if($course->meeting_link)
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                                        </svg>
                                                        <a href="{{ $course->meeting_link }}" target="_blank"
                                                            class="text-sm text-blue-600 hover:text-blue-800 hover:underline">
                                                            Join Meeting
                                                        </a>
                                                    </div>
                                                @endif

                                                @if($course->meeting_id)
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                                        </svg>
                                                        <p class="text-sm text-gray-600">
                                                            Meeting ID: <span class="font-medium">{{ $course->meeting_id }}</span>
                                                        </p>
                                                    </div>
                                                @endif

                                                @if($course->meeting_password)
                                                    <div class="flex items-center space-x-2">
                                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                                        </svg>
                                                        <p class="text-sm text-gray-600">
                                                            Password: <span
                                                                class="font-medium">{{ $course->meeting_password }}</span>
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="mt-4 pl-8">
                                            <p class="text-sm text-gray-500">Venue : {{$course->venue}}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No courses available</h3>
                                <p class="mt-1 text-sm text-gray-500">Get started by enrolling in a course.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <!-- Course Assignments -->
            {{-- <div class="lg:col-span-2">
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
                                @foreach($course->assignments->take(2) as $assignment)
                                <li
                                    class="p-4 rounded-lg border border-gray-100 hover:border-blue-200 transition duration-200">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-center space-x-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <div>
                                                <h4 class="text-gray-900 font-medium">{{ $assignment->title }}</h4>
                                                <p class="text-sm text-gray-500 mt-1">Due: {{ $assignment->due_date }}
                                                </p>
                                            </div>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $assignment->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($assignment->status) }}
                                        </span>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                            @else
                            <div class="text-center py-6">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No assignments yet</h3>
                                <p class="mt-1 text-sm text-gray-500">Assignments for this course will appear here.</p>
                            </div>
                            @endif
                        </div>
                        @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No courses available</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by enrolling in a course.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>--}}

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- gems top scrorer -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="px-6 py-4 flex items-center">
                        <h2 class="text-lg font-semibold text-gray-900">Top Scorers</h2>
                        <span class="text-sm text-gray-500 ml-auto">Gems</span>
                    </div>


                    <!-- Top Scorers List -->
                    <div class="px-6 py-4">
                        @if($topScorers->isEmpty())
                            <p>No top scorers available.</p>
                        @else
                                            <ul class="space-y-3">
                                            @foreach($topScorers as $scorer)
    <li class="flex items-center">
        <div class="w-10 h-10 flex items-center rounded-full overflow-hidden">
            <img class="w-11 h-11 rounded-full ring-2 ring-purple-600 ring-offset-2 transition-all duration-200 group-hover:ring-purple-500 group-hover:scale-105 object-cover"
                 src="{{ $scorer->displayImage ?? 'https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png' }}"
                 alt="{{ $scorer->name }}'s Profile" 
                 loading="lazy"
                 onerror="this.src='https://www.zica.co.zm/wp-content/uploads/2021/02/dummy-profile-image.png'" />
        </div>
        <span class="ml-3 text-sm text-gray-900">{{ $scorer->name }}</span>
        <span class="flex items-center gap-2 ml-auto text-sm text-gray-500">{{ $scorer->gem }} 
        <svg class="w-5 h-5" viewBox="0 0 24 24">
                                                        <defs>
                                                            <linearGradient id="gemGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                                                <stop offset="0%" style="stop-color:#60A5FA" />
                                                                <stop offset="50%" style="stop-color:#8B5CF6" />
                                                                <stop offset="100%" style="stop-color:#EC4899" />
                                                            </linearGradient>
                                                        </defs>
                                                        <path fill="url(#gemGradient)"
                                                            d="M12 1L3 9l9 13l9-13l-9-8zm0 3.5L6.5 9h11L12 4.5zM5 10l7 10l7-10H5z" />
                                                        <path fill="currentColor" opacity="0.2" d="M12 14L5 10h14l-7 4z" />
                                                    </svg>
        </span>
    </li>
@endforeach
                                            </ul>
                        @endif
                    </div>
                </div>
                <!-- Student Barcode -->
                @if($barcodeImage)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <div class="border-b border-gray-200">
                            <div class="px-6 py-4 flex justify-between items-center">
                                <h2 class="text-lg font-semibold text-gray-900">My Barcode</h2>
                                <span class="text-sm text-gray-500">ID: {{ Auth::user()->id }}</span>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-col items-center space-y-4">
                                <!-- Barcode Image -->
                                <div class="bg-white p-4 rounded-lg shadow-inner w-full">
                                    <div class="flex justify-center">
                                        <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Student Barcode"
                                            class="max-w-[200px]">
                                    </div>
                                    <p class="text-center mt-2 font-mono text-sm text-gray-700">{{ Auth::user()->barcode }}
                                    </p>
                                </div>

                                <!-- Instructions -->
                                <div class="text-center">
                                    <p class="text-sm text-gray-600">Scan this barcode for attendance</p>
                                    <div class="mt-2 flex items-center justify-center text-xs text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm0-2a6 6 0 100-12 6 6 0 000 12z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Keep this code private
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else

                @endif



                <!-- Weekly Attendance -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-900">Last Week</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        @if($onlineWeekDays->isNotEmpty())
                            <div class="mb-1">
                                <h3 class="text-md font-medium text-gray-700 mb-2">Online Courses</h3>
                                <div class="grid grid-cols-7 gap-2 justify-between">
                                    @foreach($onlineWeekDays as $day)
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-8 h-8 rounded-full flex items-center justify-center mb-1
                                                                                                                                                                {{ $day['present'] ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($day['present'])
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    @endif
                                                </svg>
                                            </div>
                                            <span
                                                class="text-xs font-medium text-gray-500">{{ substr($day['name'], 0, 3) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        @if($offlineWeekDays->isNotEmpty())
                            <div class="">
                                <h3 class="text-md font-medium text-gray-700 mb-2">Offline Courses</h3>
                                <div class="grid grid-cols-7 gap-2 justify-between">
                                    @foreach($offlineWeekDays as $day)
                                        <div class="flex flex-col items-center">
                                            <div
                                                class="w-8 h-8 rounded-full flex items-center justify-center mb-1
                                                                                                                                                                {{ $day['present'] ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($day['present'])
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    @else
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M6 18L18 6M6 6l12 12" />
                                                    @endif
                                                </svg>
                                            </div>
                                            <span
                                                class="text-xs font-medium text-gray-500">{{ substr($day['name'], 0, 3) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
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
                                <div class="bg-blue-600 h-2 rounded-full"
                                    style="width: {{ $nextMilestone > 0 ? min(($gems / $nextMilestone) * 100, 100) : 0 }}%">
                                </div>
                            </div>
                            <div class="flex items-center mt-2">
                                @if($nextProductImage)
                                    <img src="{{ asset('storage/' . $nextProductImage) }}" alt="{{ $nextProductName }}"
                                        class="w-8 h-8 object-cover rounded-full mr-2">
                                @endif

                                <p class="text-sm text-gray-500">
                                    @if($gems > 0)
                                        You can redeem {{ $nextProductName }} for {{ $nextMilestone }} gems
                                    @else
                                        Earn your first gems to unlock rewards!
                                    @endif
                                </p>
                            </div>
                        </div>
                        <button
                            class="w-full px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                            View Available Rewards
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
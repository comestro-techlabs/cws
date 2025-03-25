<div>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-purple-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Welcome Header -->
            <div class="relative mb-8">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Welcome Card -->
                    <div class="flex-1 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-start justify-between">
                            <div class="space-y-1">
                                <span class="text-sm text-gray-500">Welcome back,</span>
                                <h2 class="text-2xl font-bold text-gray-900">Admin Dashboard</h2>
                                <p class="text-sm text-gray-600">{{ now()->format('l, F j, Y') }}</p>
                            </div>
                            <div class="p-3 bg-purple-50 rounded-xl">
                                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions Bar -->
                    <div class="flex-1 bg-white rounded-2xl shadow-sm p-6 border border-gray-100">
                        <div class="flex items-center justify-between gap-4">
                            <a href="{{ route('admin.placedstudent.index') }}" wire:navigate
                               class="flex flex-col items-center p-3 rounded-xl hover:bg-gray-50 transition-all group">
                                <div class="p-2 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors">
                                    <svg class="lg:w-6 w-4 lg:h-6 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-700 mt-2">Placed Student</span>
                            </a>

                            <a href="{{ route('admin.course') }}" wire:navigate
                               class="flex flex-col items-center p-3 rounded-xl hover:bg-gray-50 transition-all group">
                                <div class="p-2 bg-green-50 rounded-lg group-hover:bg-green-100 transition-colors">
                                    <svg class="lg:w-6 w-4 lg:h-6 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-700 mt-2">Add Course</span>
                            </a>

                            <a href="{{ route('admin.attendance') }}" wire:navigate
                               class="flex flex-col items-center p-3 rounded-xl hover:bg-gray-50 transition-all group">
                                <div class="p-2 bg-indigo-50 rounded-lg group-hover:bg-indigo-100 transition-colors">
                                    <svg class="lg:w-6 w-4 lg:h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-700 mt-2">Attendance</span>
                            </a>

                            <a href="{{ route('admin.exam') }}" wire:navigate
                               class="flex flex-col items-center p-3 rounded-xl hover:bg-gray-50 transition-all group">
                                <div class="p-2 bg-yellow-50 rounded-lg group-hover:bg-yellow-100 transition-colors">
                                    <svg class="lg:w-6 w-4 lg:h-6 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <span class="text-xs font-medium text-gray-700 mt-2">Exams</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Quick Stats - Now 3 cards with animations -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Active Students Card -->
                <div class="relative  border border-gray-100 shadow-sm  bg-white rounded-2xl p-6 overflow-hidden group animate-fade-in-up"
                     style="animation-delay: 100ms">
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-transparent"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 1.857h10M9 7a3 3 0 106 0 3 3 0 00-6 0z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm font-medium">Active Students</p>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900">{{ $studentsCount }}</h2>
                                <p class="text-sm text-gray-600">Total enrolled students</p>
                            </div>
                        </div>
                        <div class="hidden md:block opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <svg class="w-24 h-24 text-indigo-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 14c-3.313 0-6-2.687-6-6s2.687-6 6-6 6 2.687 6 6-2.687 6-6 6zm0-10c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 to-indigo-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>

                <!-- Active Courses Card -->
                <div class="relative  border border-gray-100 shadow-sm  bg-white rounded-2xl p-6 overflow-hidden group animate-fade-in-up"
                     style="animation-delay: 200ms">
                    <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-transparent"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-lg bg-purple-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm font-medium">Active Courses</p>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-gray-900">{{ $coursesCount }}</h2>
                                <p class="text-sm text-gray-600">Available courses</p>
                            </div>
                        </div>
                        <div class="hidden md:block opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <svg class="w-24 h-24 text-purple-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V4a2 2 0 00-2-2zm-2 8H7V8h10v2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-purple-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>

                <!-- Monthly Revenue Card -->
                <div class="relative border border-gray-100 bg-white rounded-2xl p-6 overflow-hidden group animate-fade-in-up"
                     style="animation-delay: 300ms">
                    <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-transparent"></div>
                    <div class="relative flex items-start justify-between">
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 rounded-lg bg-green-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <p class="text-gray-500 text-sm font-medium">Monthly Revenue</p>
                            </div>
                            <div>
                                <div class="flex items-baseline">
                                    <span class="text-lg font-semibold text-gray-600 mr-1">₹</span>
                                    <h2 class="text-3xl font-bold text-gray-900">{{ number_format($currentMonthAmount, 2) }}</h2>
                                </div>
                                <p class="text-sm text-gray-600">This month's earnings</p>
                            </div>
                        </div>
                        <div class="hidden md:block opacity-10 group-hover:opacity-20 transition-opacity duration-300">
                            <svg class="w-24 h-24 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M11.8 10.9c-2.27-.59-3-1.2-3-2.15 0-1.09 1.01-1.85 2.7-1.85 1.78 0 2.44.85 2.5 2.1h2.21c-.07-1.72-1.12-3.3-3.21-3.81V3h-3v2.16c-1.94.42-3.5 1.68-3.5 3.61 0 2.31 1.91 3.46 4.7 4.13 2.5.6 3 1.48 3 2.41 0 .69-.49 1.79-2.7 1.79-2.06 0-2.87-.92-2.98-2.1h-2.2c.12 2.19 1.76 3.42 3.68 3.83V21h3v-2.15c1.95-.37 3.5-1.5 3.5-3.55 0-2.84-2.43-3.81-4.7-4.4z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 to-green-300 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500"></div>
                </div>
            </div>

            <!-- Quick Actions Grid with animations -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <a href="{{ route('admin.attendance') }}" wire:navigate
                   class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100 group
                          transform hover:-translate-y-1 duration-300 animate-fade-in-up"
                   style="animation-delay: 400ms">
                    <div class="p-3 bg-indigo-50 rounded-full w-12 h-12 flex items-center justify-center mb-4 group-hover:bg-indigo-100">
                        <svg class="w-6 h-6 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Take Attendance</h3>
                    <p class="text-sm text-gray-500 mt-1">Mark student attendance</p>
                </a>

                <a href="{{ route('admin.student') }}" wire:navigate
                   class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100 group
                          transform hover:-translate-y-1 duration-300 animate-fade-in-up"
                   style="animation-delay: 500ms">
                    <div class="p-3 bg-purple-50 rounded-full w-12 h-12 flex items-center justify-center mb-4 group-hover:bg-purple-100">
                        <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Manage Students</h3>
                    <p class="text-sm text-gray-500 mt-1">View and edit students</p>
                </a>

                <a href="{{ route('admin.assignment.manage') }}" wire:navigate
                   class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100 group
                          transform hover:-translate-y-1 duration-300 animate-fade-in-up"
                   style="animation-delay: 600ms">
                    <div class="p-3 bg-green-50 rounded-full w-12 h-12 flex items-center justify-center mb-4 group-hover:bg-green-100">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Assignments</h3>
                    <p class="text-sm text-gray-500 mt-1">Review assignments</p>
                </a>

                <a href="{{ route('admin.exam') }}" wire:navigate
                   class="bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100 group
                          transform hover:-translate-y-1 duration-300 animate-fade-in-up"
                   style="animation-delay: 700ms">
                    <div class="p-3 bg-yellow-50 rounded-full w-12 h-12 flex items-center justify-center mb-4 group-hover:bg-yellow-100">
                        <svg class="w-6 h-6 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900">Exams</h3>
                    <p class="text-sm text-gray-500 mt-1">Manage exams</p>
                </a>
            </div>

            <!-- Recent Activities Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 animate-fade-in-up" style="animation-delay: 800ms">
                <!-- Recent Courses -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-900">Recent Courses</h2>
                            <a wire:navigate href="{{ route('admin.course.manage') }}"
                               class="inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 transition-colors">
                                <span class="mr-1">View All</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($courses as $course)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-colors group">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-sm font-semibold text-gray-900">{{ $course->title }}</h3>
                                            <p class="text-xs text-gray-500">{{ $course->duration }} Weeks • {{ $course->category->cat_title ?? 'Uncategorized' }}</p>
                                        </div>
                                    </div>
                                    <a wire:navigate href="{{ route('admin.course.update', $course->id) }}"
                                       class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-medium text-purple-600 bg-purple-50 hover:bg-purple-100 transition-colors">
                                        View Details
                                        <svg class="w-4 h-4 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">No courses yet</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new course.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Recent Course Activity -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-900">Recent Notifications</h2>
                    </div>
                    <div class="divide-y divide-gray-100">
                        @if ($enquiries->isEmpty())
                            <div class="p-4 flex items-center justify-center text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 18.5a1.5 1.5 0 01-1.5-1.5h3a1.5 1.5 0 01-1.5 1.5zM12 3a9 9 0 00-9 9v3.5l-1.5 1.5h21l-1.5-1.5V12a9 9 0 00-9-9z" />
                                </svg>
                                No notifications
                            </div>
                        @else
                            @foreach ($enquiries as $enquiry)
                                <div class="p-4 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start">
                                        <span class="flex-shrink-0 w-8 h-8 flex items-center justify-center bg-yellow-100 rounded-full">
                                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                            </svg>
                                        </span>
                                        <div class="ml-3">
                                            <p class="text-sm font-medium text-gray-900">{{ $enquiry->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $enquiry->message }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</div>

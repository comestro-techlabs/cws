<div x-data="{ expanded: true }" class="h-screen bg-white border-r border-gray-200">
    @php
        $categoryCount = App\Models\Category::get()->count();
        $courseCount = App\Models\Course::get()->count();
        $assignmentCount = App\Models\Assignments::get()->count();
        $assignmentUploadCount = App\Models\Assignment_upload::get()->count();
        $studentCount = App\Models\User::where('isAdmin', 0)->count();
        $placestudentCount = App\Models\PlacedStudent::get()->count();
        $examCount = App\Models\Exam::get()->count();
        $workshopCount = App\Models\Workshop::get()->count();
        $notificationCount = App\Models\Enquiry::get()->count();
        $paymentCount = App\Models\Payment::with(['student', 'course'])
        ->where('status', 'captured')->count();
        $postCourseCount = App\Models\PostCourse::get()->count();
    @endphp
    
    <!-- Branding & Toggle -->
    <div class="flex items-center justify-between p-4 border-b">
        <div class="flex items-center space-x-3">
            <span x-show="expanded" class="text-lg font-bold text-gray-800">Admin</span>
        </div>
        <button @click="expanded = !expanded" class="p-1.5 rounded-lg hover:bg-gray-100">
            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <div class="overflow-y-auto overflow-x-hidden flex-1">
        <nav class="p-3 space-y-2">
            <!-- Dashboard -->
            <a wire:navigate href="{{ route('admin.dashboard') }}"
                class="flex items-center px-3 py-2.5 rounded-lg font-medium transition-all hover:bg-purple-50 hover:text-purple-700
                {{ request()->routeIs('admin.dashboard') ? 'bg-purple-600 text-white hover:bg-purple-700 hover:text-white' : 'text-gray-600' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span x-show="expanded" class="ml-3 text-sm">Dashboard</span>
            </a>

            <!-- Core Features Group -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Core Features</h3>
                </div>
                
                <!-- Course Management -->
                <div class="space-y-1">
                    <a wire:navigate href="{{ route('admin.course.manage') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Courses</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $courseCount }}</span>
                        </div>
                    </a>
                    
                    <a wire:navigate href="{{ route('admin.category') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Categories</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $categoryCount }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Assignment Management -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Assignments</h3>
                </div>
                
                <div class="space-y-1">
                    <a wire:navigate href="{{ route('admin.assignment.manage') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25a3.75 3.75 0 1 0-7.5 0V9M3 9h18m-2.25 0a2.25 2.25 0 0 1 2.25 2.25v8.25a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 19.5v-8.25A2.25 2.25 0 0 1 5.25 9h13.5Z" />
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Assignments</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $assignmentCount }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Student Management -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Students</h3>
                </div>
                
                <div class="space-y-1">
                    <a wire:navigate href="{{ route('admin.student') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/>
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Students</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $studentCount }}</span>
                        </div>
                    </a>
                    
                    <a wire:navigate href="{{ route('admin.attendance') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span class="ml-3 text-sm">Attendance</span>
                    </a>
                </div>
            </div>

            <!-- Exam Management -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Exams</h3>
                </div>
                
                <div class="space-y-1">
                    <a wire:navigate href="{{ route('admin.exam') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z"/>
                            <path d="M9 8.25h6M9 12h6M9 15.75h3"/>
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Exam</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $examCount }}</span>
                        </div>
                    </a>
                    
                    <a wire:navigate href="{{ route('results') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z"/>
                            <path d="M9 8.25h6M9 12h6M9 15.75h3"/>
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Result</span>
                        </div>
                    </a>
                    
                    <a wire:navigate href="{{ route('admin.mocktest') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z"/>
                            <path d="M9 8.25h6M9 12h6M9 15.75h3"/>
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage MockTest</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Workshop Management -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Workshops</h3>
                </div>
                
                <div class="space-y-1">
                    <a wire:navigate href="{{ route('admin.workshops.index') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-4 h-4 shrink-0" xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="currentColor"
                            class="bi bi-stickies" viewBox="0 0 16 16">
                            <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                            <path
                                d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z" />
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Workshop</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $workshopCount }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Blog Management -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Blog Management</h3>
                </div>
                
                <div class="space-y-1">
                    <a wire:navigate href="{{ route('admin.blog.post-course') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Post Course</span>
                            <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $postCourseCount }}</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Store Management -->
            <div class="pt-2">
                <div x-show="expanded" class="px-3 mb-2">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase">Store Management</h3>
                </div>
                
                <div class="space-y-1">
                    <a wire:navigate href=""
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Products</span>
                        </div>
                    </a>
                    
                    <a wire:navigate href="{{ route('v2.student.manageOrders') }}"
                        class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 transition-all hover:bg-purple-50 hover:text-purple-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" class="w-5 h-5" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V19.5a2.25 2.25 0 002.25 2.25h.75M4.5 4.5h3" />
                        </svg>
                        <div class="flex items-center justify-between flex-1 ml-3">
                            <span class="text-sm">Manage Orders</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Logout -->
            <div class=" border-t bg-white p-3">
                <a wire:navigate href="{{ route('admin.logout') }}"
                    class="flex items-center px-3 py-2.5 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-700 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span x-show="expanded" class="ml-3 text-sm">Logout</span>
                </a>
            </div>
        </nav>
    </div>
</div>

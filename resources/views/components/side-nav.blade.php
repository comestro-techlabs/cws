<div x-data="{ expanded: true, showMobileNav: false }" class="h-auto bg-white border-r border-gray-200">
    <!-- Mobile Toggle Button -->
    <button @click="showMobileNav = !showMobileNav" class="md:hidden p-2 m-2 rounded-lg bg-purple-600 text-white">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <!-- Side Navigation -->
    <div :class="{'hidden': !showMobileNav, 'block': showMobileNav}" class="md:block h-auto bg-white border-r border-gray-200">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
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
                        <path
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
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
                                <path
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                            <div class="flex items-center justify-between flex-1 ml-3">
                                <span class="text-sm">Courses</span>
                                <span
                                    class="px-2 py-0.5 text-xs bg-purple-100 text-purple-700 rounded-full">{{ $courseCount }}</span>
                            </div>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="overflow-y-auto overflow-x-hidden flex-grow bg-gray-50 h-screen">
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
    <a wire:navigate href="{{ route('admin.dashboard') }}"
        class="relative flex flex-row items-center h-12 focus:outline-none bg-purple-700 hover:bg-purple-800 text-white border-l-4 border-transparent pr-6 transition duration-200">
        <span class="inline-flex justify-center items-center ml-4">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                </path>
            </svg>
        </span>
        <span class="ml-2 text-sm font-medium tracking-wide truncate">Dashboard</span>
    </a>

    <ul class="flex flex-col py-4 space-y-1">
        <li class="px-5">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-semibold tracking-wide text-purple-700">Courses</div>
            </div>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.category') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                </span>
                <div class="flex items-center justify-between w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Category</span>
                    <x-admin.count :count="$categoryCount" />
                </div>
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('admin.course.manage') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </span>
                <div class="flex items-center justify-between w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Courses</span>
                    <x-admin.count :count="$courseCount"/>
                </div>
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('admin.assignment.manage') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25a3.75 3.75 0 1 0-7.5 0V9M3 9h18m-2.25 0a2.25 2.25 0 0 1 2.25 2.25v8.25a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 19.5v-8.25A2.25 2.25 0 0 1 5.25 9h13.5Z" />
                    </svg>
                </span>
                <div class="flex items-center justify-between w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Assignment</span>
                    <x-admin.count :count="$assignmentCount"/>
                </div>
            </a>
        </li>  
        <li class="px-5">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-semibold tracking-wide text-purple-700">Students</div>
            </div>
        </li>

        <li>
            <a wire:navigate href="{{ route('admin.student') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </span>
                <div class="flex items-center justify-between w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Student</span>
                    <x-admin.count :count="$studentCount"/>
                </div>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{route('admin.attendance')}}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        quiz
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm font-medium tracking-wide truncate">Attendence</span>

            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.placedstudent.index') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                </span>
                <div class="flex justify-between items-center w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Placed Student</span>
                    <x-admin.count :count="$placestudentCount"/>
                </div>
            </a>
        </li>

        <li class="px-5">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-semibold tracking-wide text-purple-700">Exams</div>
            </div>
        </li>

        <li>
            <a wire:navigate href="{{ route('admin.exam') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25h6M9 12h6M9 15.75h3" />
                    </svg>
                </span>
                <div class="flex justify-between items-center w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Exam</span>
                    <x-admin.count :count="$examCount"/>
                </div>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('results') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25h6M9 12h6M9 15.75h3" />
                    </svg>
                </span>
                <div class="flex justify-between items-center w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Result</span>
                   
                </div>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.mocktest') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25h6M9 12h6M9 15.75h3" />
                    </svg>
                </span>
                <div class="flex justify-between items-center w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage MockTest</span>
                    
                </div>
            </a>
        </li>
       

        <li>
            <a wire:navigate href="{{ route('admin.workshops.index') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="currentColor"
                        class="bi bi-stickies" viewBox="0 0 16 16">
                        <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z" />
                        <path
                            d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z" />
                    </svg>
                </span>

                <div class="flex justify-between items-center w-full">
                <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Workshop</span>
                    <x-admin.count :count="$workshopCount"/>
                </div>
            </a>
        </li>

        <li class="px-5">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-semibold tracking-wide text-purple-700">Notifications</div>
            </div>
        </li>
        
        
        <li>
            <a wire:navigate href="{{route('admin.manage.enquiry')}}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </span>
                <div class="flex justify-between items-center w-full">
                    <span class="ml-2 text-sm font-medium tracking-wide truncate">Notifications</span>
                    <x-admin.count :count="$notificationCount"/>
                </div>
            </a>
        </li>

        <li>
            <a wire:navigate href="{{ route('admin.logout') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm font-medium tracking-wide truncate">Logout</span>
            </a>
        </li>

        <li class="px-5">
            <div class="flex flex-row items-center h-8">
                <div class="text-sm font-semibold tracking-wide text-purple-700">Blog</div>
            </div>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.blog.post-course') }}"
                class="relative flex flex-row items-center h-11 focus:outline-none hover:bg-purple-50 text-gray-600 hover:text-purple-700 border-l-4 border-transparent hover:border-purple-700 pr-6 transition duration-200">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </span>
                <div class="flex justify-between items-center w-full">
                <span class="ml-2 text-sm font-medium tracking-wide truncate">Manage Post Course</span>
                <x-admin.count :count="$postCourseCount"/>
                </div>
            </a>
        </li>
    </ul>
</div>

<div class="overflow-y-auto overflow-x-hidden flex-grow bg-gray-100 h-screen">
    <ul class="flex flex-col py-4 space-y-1">
        <li class="px-3">
            <div class="flex flex-row items-center">
                <div class="text-sm font-light tracking-wide text-gray-500">Menu</div>
            </div>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.dashboard') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Dashboard</span>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.message.index') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                        <path
                            d="M 10.5 5 C 6.92 5 4 7.92 4 11.5 L 4 30.5 C 4 34.08 6.92 37 10.5 37 L 22.150391 37 C 22.050391 36.35 22 35.68 22 35 C 22 34.66 22.010781 34.33 22.050781 34 L 10.5 34 C 8.57 34 7 32.43 7 30.5 L 7 16.015625 L 23.287109 24.820312 A 1.50015 1.50015 0 0 0 24.712891 24.820312 L 41 16.015625 L 41 23.470703 C 42.1 24.040703 43.11 24.770859 44 25.630859 L 44 11.5 C 44 7.92 41.08 5 37.5 5 L 10.5 5 z M 10.5 8 L 37.5 8 C 39.43 8 41 9.57 41 11.5 L 41 12.605469 L 24 21.794922 L 7 12.605469 L 7 11.5 C 7 9.57 8.57 8 10.5 8 z M 35 24 C 28.925 24 24 28.925 24 35 C 24 41.075 28.925 46 35 46 C 41.075 46 46 41.075 46 35 C 46 28.925 41.075 24 35 24 z M 35 27 C 35.552 27 36 27.448 36 28 L 36 34 L 42 34 C 42.552 34 43 34.448 43 35 C 43 35.552 42.552 36 42 36 L 36 36 L 36 42 C 36 42.552 35.552 43 35 43 C 34.448 43 34 42.552 34 42 L 34 36 L 28 36 C 27.448 36 27 35.552 27 35 C 27 34.448 27.448 34 28 34 L 34 34 L 34 28 C 34 27.448 34.448 27 35 27 z">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Message</span>                
            </a>            
        </li>
        <li class="px-3">
            <div class="flex flex-row items-center h-5">
                <div class="text-sm font-light tracking-wide text-gray-500">Courses</div>
            </div>
        </li>
        <li>
            <a wire:navigate href="{{route('admin.category')}}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Manage Category</span>

            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.course.manage') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Manage Courses</span>                
            </a>            
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.assignment.manage') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25a3.75 3.75 0 1 0-7.5 0V9M3 9h18m-2.25 0a2.25 2.25 0 0 1 2.25 2.25v8.25a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 19.5v-8.25A2.25 2.25 0 0 1 5.25 9h13.5Z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Assignment</span>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.assignment.course') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 9V5.25a3.75 3.75 0 1 0-7.5 0V9M3 9h18m-2.25 0a2.25 2.25 0 0 1 2.25 2.25v8.25a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 19.5v-8.25A2.25 2.25 0 0 1 5.25 9h13.5Z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">View Assignment</span>
            </a>
        </li>
        <li class="px-3">
            <div class="flex flex-row items-center h-5">
                <div class="text-sm font-light tracking-wide text-gray-500">Students</div>
            </div>
        </li>
        <li>
            <a wire:navigate href="{{route('admin.student')}}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        quiz
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Manage Student</span>

            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.placedstudent.index') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Placed Student</span>
            </a>
        </li>

        <li class="px-3">
            <div class="flex flex-row items-center h-5">
                <div class="text-sm font-light tracking-wide text-gray-500">Exams</div>
            </div>
        </li>

        <li>
            <a wire:navigate href="{{ route('admin.exam') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25h6M9 12h6M9 15.75h3" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Manage Exam</span>                
            </a>            
        </li>
        <li>
            <a wire:navigate href="{{route('admin.quiz')}}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18.75v1.5M12 6.75a3 3 0 0 0-3 3h1.5a1.5 1.5 0 1 1 3 0c0 1.5-3 2.25-3 4.5h1.5m.75-1.5v3" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 1 9-9 9 9 0 0 1-9 9Z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Manage Quiz</span>
                
            </a>           
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.workshops.index') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="14" height="16" fill="currentColor"
                        class="bi bi-stickies" viewBox="0 0 16 16">
                        <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1z" />
                        <path
                            d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z" />
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Manage Workshop</span>                
            </a>            
        </li>

        <li class="px-3">
            <div class="flex flex-row items-center h-5">
                <div class="text-sm font-light tracking-wide text-gray-500">Notifications</div>
            </div>
        </li>  
        <li>
            <a wire:navigate href="{{ route('admin.paymnet-manage') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6 w-full">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>

                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Payment</span>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{route('admin.manage.enquiry')}}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Notifications</span>
                <span
                    class="px-2 py-0.5 ml-auto text-xs font-medium tracking-wide text-red-500 bg-red-50 rounded-full">1.2k</span>
            </a>
        </li>
        <li>
            <a wire:navigate href="{{ route('admin.logout') }}"
                class="relative flex flex-row items-center h-8 focus:outline-none hover:bg-gray-50 text-gray-600 hover:text-gray-800 border-l-4 border-transparent hover:border-indigo-500 pr-6">
                <span class="inline-flex justify-center items-center ml-4">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                </span>
                <span class="ml-2 text-sm tracking-wide truncate">Logout</span>
            </a>
        </li>
    </ul>
</div>
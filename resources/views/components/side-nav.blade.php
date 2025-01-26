<div class="py-4 overflow-y-auto">
    <ul class=" font-lighter text-sm flex flex-col">
        {{-- dashboard --}}
        <li>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>

                <span class="ms-3">Dashboard</span>
            </a>
        </li>

        {{-- //student --}}
        <li>
            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="student" data-collapse-toggle="student">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    quiz
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">
                    <a href="{{ route('student.manage') }}" class=" ">Manage
                        Students</a>
                </span>

            </button>

        </li>
         {{-- Category --}}
        <li>
            <a href="{{ route('category.index') }}"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 9h3.75m-4.5 2.625h4.5M12 18.75 9.75 16.5h.375a2.625 2.625 0 0 0 0-5.25H9.75m.75-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>


                <span class="flex-1 ms-3 whitespace-nowrap">Manage Categories</span>
            </a>
          </li>
        {{-- Course --}}
        <li>
            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Courses</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <ul id="dropdown-example" class="hidden py-2 space-y-2">
                <li>
                    <a href="{{ route('course.create') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Insert
                        Course</a>
                </li>
                <li>
                    <a href="{{ route('course.index') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Manage
                        Course</a>
                </li>

            </ul>
        </li>

         {{-- Assignment --}}
         <li>
            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="assignment" data-collapse-toggle="assignment">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25a3.75 3.75 0 1 0-7.5 0V9M3 9h18m-2.25 0a2.25 2.25 0 0 1 2.25 2.25v8.25a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 19.5v-8.25A2.25 2.25 0 0 1 5.25 9h13.5Z" />
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Assignments</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <ul id="assignment" class="hidden py-2 space-y-2">
                <li>
                    <a href="{{ route('assignment.create') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">create
                        Assignments</a>
                </li>
                <li>
                    <a href="{{ route('assignment.index') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Manage
                        Assignments</a>
                </li>

                <li>
                    <a href="{{ route('assignments.course') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">show
                        course
                    </a>
                </li>
                {{-- <li>
                    <a href="{{ route('assignment-submit.index') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">upload
                        Assignments</a>
                </li> --}}
            </ul>
        </li>

        {{-- Exam --}}
        <li>
            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="payment" data-collapse-toggle="exam">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25h6M9 12h6M9 15.75h3" />
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Exam</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <ul id="exam" class="hidden py-2 space-y-2">
                <li>
                    <a href="{{ route('exam.create') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Insert
                        Exam</a>
                </li>
                <li>
                    <a href="{{ route('exam.show') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Manage
                        Exam
                    </a>
                </li>
            </ul>
        </li>

        {{-- Quiz --}}
        <li>
            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="quiz" data-collapse-toggle="quiz">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 18.75v1.5M12 6.75a3 3 0 0 0-3 3h1.5a1.5 1.5 0 1 1 3 0c0 1.5-3 2.25-3 4.5h1.5m.75-1.5v3" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 1 1 9-9 9 9 0 0 1-9 9Z" />
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Quiz</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>
            <ul id="quiz" class="hidden py-2 space-y-2">
                <li>
                    <a href="{{ route('quiz.create') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Insert
                        Quiz</a>
                </li>
                <li>
                    <a href="{{ route('quiz.show') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Manage
                        Quiz</a>
                </li>
            </ul>
        </li>



        {{-- Portfolio --}}
        <li>
            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="portfolio-dropdown" data-collapse-toggle="portfolio-dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4.5 3h15a1.5 1.5 0 011.5 1.5v15a1.5 1.5 0 01-1.5 1.5h-15a1.5 1.5 0 01-1.5-1.5v-15A1.5 1.5 0 014.5 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25h6M9 12h6M9 15.75h3" />
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Portfolio</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <ul id="portfolio-dropdown" class="hidden py-2 space-y-2">

                <li>
                    <a href="{{ route('portfolio.create') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Create
                        Portfolio</a>
                </li>
                <li>
                    <a href="{{ route('portfolio.admin.index') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">Manage
                        Portfolio

                    </a>
                </li>
            </ul>
        </li>

        {{-- Workshop --}}
        <li>

            <button type="button"
                class="flex items-center w-full p-2  text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 "
                aria-controls="workshop-dropdown" data-collapse-toggle="workshop-dropdown">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stickies" viewBox="0 0 16 16">
                    <path d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1z"/>
                    <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293z"/>
                  </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Workshop</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 4 4 4-4" />
                </svg>
            </button>

            <ul id="workshop-dropdown" class="hidden py-2 space-y-2">
                <li>
                    <a href="{{ route('workshops.create') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">
                        Create Workshop
                    </a>
                </li>
                <li>
                    <a href="{{ route('workshops.admin.index') }}"
                        class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 ">
                        Manage Workshop
                    </a>
                </li>
            </ul>
        </li>



        <li>
            <a href="{{route('placedStudent.create')}}"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>

                <span class="flex-1 ms-3 whitespace-nowrap">Insert Placements</span>
            </a>
        </li>
         <li>
            <a href="{{route('placedStudent.index')}}"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                </svg>

                <span class="flex-1 ms-3 whitespace-nowrap">calling Placed Student</span>
            </a>
        </li>



            {{-- payments --}}
            <li>
                <a href="{{ route('admin.manage-payment') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Manage Payments</span>
                </a>
            </li>
         {{-- results --}}
            <li>
                <a href="{{ route('exam.results') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6h16.5M3.75 12h16.5M3.75 18h10.5" />
                    </svg>
                    <span class="flex-1 ms-3 whitespace-nowrap">Manage Result</span>
                </a>
            </li>


         {{-- Enquiries --}}
                <li>
                <a href="{{ route('admin.manage.enquiry') }}"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 9h3.75m-4.5 2.625h4.5M12 18.75 9.75 16.5h.375a2.625 2.625 0 0 0 0-5.25H9.75m.75-9H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>


                    <span class="flex-1 ms-3 whitespace-nowrap">Manage Enquiries</span>
                </a>
                </li>
                {{-- message --}}
                <li>

                    <button type="button"
                        class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                        aria-controls="message-dropdown" data-collapse-toggle="message-dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 48 48">
                            <path d="M 10.5 5 C 6.92 5 4 7.92 4 11.5 L 4 30.5 C 4 34.08 6.92 37 10.5 37 L 22.150391 37 C 22.050391 36.35 22 35.68 22 35 C 22 34.66 22.010781 34.33 22.050781 34 L 10.5 34 C 8.57 34 7 32.43 7 30.5 L 7 16.015625 L 23.287109 24.820312 A 1.50015 1.50015 0 0 0 24.712891 24.820312 L 41 16.015625 L 41 23.470703 C 42.1 24.040703 43.11 24.770859 44 25.630859 L 44 11.5 C 44 7.92 41.08 5 37.5 5 L 10.5 5 z M 10.5 8 L 37.5 8 C 39.43 8 41 9.57 41 11.5 L 41 12.605469 L 24 21.794922 L 7 12.605469 L 7 11.5 C 7 9.57 8.57 8 10.5 8 z M 35 24 C 28.925 24 24 28.925 24 35 C 24 41.075 28.925 46 35 46 C 41.075 46 46 41.075 46 35 C 46 28.925 41.075 24 35 24 z M 35 27 C 35.552 27 36 27.448 36 28 L 36 34 L 42 34 C 42.552 34 43 34.448 43 35 C 43 35.552 42.552 36 42 36 L 36 36 L 36 42 C 36 42.552 35.552 43 35 43 C 34.448 43 34 42.552 34 42 L 34 36 L 28 36 C 27.448 36 27 35.552 27 35 C 27 34.448 27.448 34 28 34 L 34 34 L 34 28 C 34 27.448 34.448 27 35 27 z"></path>
                            </svg>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Manage Message</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
        
                    <ul id="message-dropdown" class="hidden py-2 space-y-2">
                        <li>
                            <a href="{{ route('messages.create') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                Send Messages
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('messages.manage') }}"
                                class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                Manage Messages
                            </a>
                        </li>
                    </ul>
                </li>
              
     

        {{-- logout --}}
        <li>
            <a href="{{ route('auth.logout') }}"
                class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100group">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                </svg>
                <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
            </a>
        </li>


    </ul>


</div>

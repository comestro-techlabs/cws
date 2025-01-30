<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="layout-default">

    <!-- Header Layout -->





    <aside id="default-sidebar"
        class="fixed top-0 bg-gray-50 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
        aria-label="Sidebar">


        <div class=" bg-gray-50">

            <div class="flex flex-col items-center pb-2 mt-3">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{asset("user.png")}}"
                    alt="Bonnie image" />
                <h5 class="mb-1 text-xl text-lighter uppercase text-gray-900">@if(auth()->check())
                    {{ auth()->user()->name }}
                @endif</h5>
                @if(auth()->check() && auth()->user()->is_member) 
            <span class="px-3 py-1 text-sm font-semibold text-blue-700 bg-blue-200 rounded-full">
                Member
            </span>
        @endif

            </div>
        </div>

        <div class="px-3 py-4 bg-gray-50">
            <ul class="space-y-2 font-light">
                <li>
                    <a href="{{ route('student.dashboard') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                          </svg>

                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.course') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5M9 11.25v1.5M12 9v3.75m3-6v6" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Explorer Courses</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('student.billing') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 8.25H9m6 3H9m3 6-3-3h1.5a3 3 0 1 0 0-6M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Billing</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.messages') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg class="w-5 h-5"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Message</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.coursePurchase') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">My Courses</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('student.assignments-view') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Manage Assignments</span>
                    </a>
                </li>
                @if(isset($hasCompleted) && $hasCompleted)
                <li>
                    <a href="{{ route('student.course.result') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">My Result</span>
                    </a>
                </li>
                @endif
                <li>
                    <a href="{{ route('student.course.quiz') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 0 1-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 0 1 4.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0 1 12 15a9.065 9.065 0 0 0-6.23-.693L5 14.5m14.8.8 1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0 1 12 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Take Examinations</span>
                    </a>
                </li>

                @if(isset($hasCompleted) && $hasCompleted)
                <li>
                    <a href="{{ route('student.certificate', ['userId' => Auth::id()]) }}"
                        class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-100  group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75  group-hover:text-gray-900 "
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 20 18">
                            <path
                                d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Certificate</span>
                    </a>
                </li>
                @endif

                <li>
                    <a href="{{ route('student.editProfile') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Profile Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('auth.logout') }}"
                        class="flex items-center p-2 text-gray-900 hover:text-indigo-900 bg-transparent rounded-sm hover:bg-blue-200 group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                          </svg>

                        <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>

                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="p-4 sm:ml-64">
        @include('studentdashboard.include.header')

        @section('content')

        @show


    </div>

    </div>



    @yield('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>

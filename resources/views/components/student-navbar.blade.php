@props(['hasCompleted' => false, 'main' => ''])

<div x-data="{ sidebarOpen: false }"
     @toggle-sidebar.window="sidebarOpen = !sidebarOpen"
     class="relative">
    <!-- Backdrop for mobile -->
    <div x-show="sidebarOpen"
         x-cloak
         class="fixed inset-0 bg-gray-900/50 sm:hidden z-30"
         @click="sidebarOpen = false"></div>

    <aside id="default-sidebar"
        x-cloak
        class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform duration-300 bg-white border-r border-gray-100 transform"
        :class="{
            'translate-x-0': sidebarOpen,
            '-translate-x-full': !sidebarOpen,
            'sm:translate-x-0': true
        }">
        <div class="h-full px-3 py-4 overflow-y-auto bg-white border-r border-gray-100">
            <div class="flex flex-col items-center pb-3 border-b border-gray-100">
                <div class="relative flex items-center w-full px-2">
                    <div class="flex items-center space-x-3">
                        <div class="relative group">
                            <div class="relative">
                            @if(auth()->check())
                                <img class="w-11 h-11 rounded-full ring-2 ring-purple-600 ring-offset-2 transition-all duration-200 group-hover:ring-purple-500 group-hover:scale-105"
                                    src="{{ session('user_avatar') ?? asset('user.png') }}"
                                    alt="User Profile" />
                            @else
                                <img class="w-11 h-11 rounded-full ring-2 ring-purple-600 ring-offset-2 transition-all duration-200 group-hover:ring-purple-500 group-hover:scale-105"
                                    src="{{ asset('user.png') }}"
                                    alt="User Profile" />
                            @endif

                                <div class="absolute -bottom-0.5 -right-0.5 bg-green-500 border-2 border-white rounded-full w-3 h-3"></div>
                            </div>
                        </div>

                        <div class="flex flex-col min-w-0">
                            <h5 class="text-sm font-semibold text-gray-900 truncate group-hover:text-purple-600 transition-colors duration-200">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @endif
                            </h5>
                            @if (auth()->check() && auth()->user()->is_member)
                                <span class="inline-flex items-center mt-1 text-xs font-medium text-purple-700">
                                    <span class="w-1.5 h-1.5 mr-1.5 bg-purple-600 rounded-full"></span>
                                    Member
                                </span>
                            @elseif(auth()->check() && auth()->user()->isAdmin==1)
                                <span class="text-xs text-gray-500">Admin</span>
                            @else
                                <span class="text-xs text-gray-500">Student</span>
                            @endif
                        </div>
                    </div>
                </div>

                @if(auth()->check() && auth()->user()->hasActiveSubscription())
                    @php
                        $currentSubscription = auth()->user()->currentSubscription()->first();
                        $daysUntilExpiry = (int) now()->diffInDays($currentSubscription->ends_at, false); 
                    @endphp
                    
                    @if($daysUntilExpiry >= 1 && $daysUntilExpiry <= 5)
                        <div class="w-full mt-2 p-2 bg-yellow-50 rounded-lg border border-yellow-200">
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-yellow-700">Plan Expires in {{ $daysUntilExpiry }} Day{{ $daysUntilExpiry > 1 ? 's' : '' }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-yellow-600">Valid till:</span>
                                    <span class="text-xs font-medium text-yellow-600">
                                        {{ $currentSubscription->ends_at->format('M d, Y') }}
                                    </span>
                                </div>
                                <div class="flex items-center justify-between space-x-2">
                                    <a wire:navigate href="{{ route('student.exploreCourses') }}"
                                    class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded hover:bg-purple-200">
                                        Buy Course
                                    </a>
                                    <a wire:navigate href="{{ route('student.subscriptions.plans') }}"
                                    class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200">
                                        Renew Plan
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="w-full mt-2 p-2 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex flex-col space-y-1">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-green-700">Active Subscription</span>
                                    <span class="text-xs font-medium text-green-600">Premium</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-green-600">Valid till:</span>
                                    <span class="text-xs font-medium text-green-600">
                                        {{ $currentSubscription->ends_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif(auth()->check() && auth()->user()->is_member)
                    <div class="w-full mt-2 p-2 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex flex-col space-y-1">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-blue-700">Course Member</span>
                                <span class="text-xs font-medium text-blue-600">Active</span>
                            </div>
                            <div class="flex items-center justify-between mt-1">
                                <a href="{{ route('student.subscriptions.plans') }}"
                                class="text-xs text-purple-600 hover:text-purple-800">
                                    Upgrade to Premium
                                </a>
                            </div>
                        </div>
                    </div>
                @elseif(auth()->check() && auth()->user()->subscriptions()->exists())
                    @php
                        $latestSubscription = auth()->user()->subscriptions()->latest('ends_at')->first();
                        $endsAt = $latestSubscription->ends_at;
                        $isPast = $endsAt->isPast();
                        
                        if ($isPast) {
                            $daysAgo = (int) $endsAt->diffInDays(now(), false);
                            $message = $daysAgo === 0 ? 'Plan Expired Today' : "Plan Expired $daysAgo Day" . ($daysAgo > 1 ? 's' : '') . " Ago";
                            $bgColor = 'bg-red-50';
                            $borderColor = 'border-red-200';
                            $textColor = 'text-red-700';
                        } else {
                            $message = null; // No message if not past and not in active subscription block
                        }

                       
                    @endphp
                    
                    @if($message)
                        <div class="w-full mt-2 p-2 {{ $bgColor }} rounded-lg border {{ $borderColor }}">
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm {{ $textColor }}">{{ $message }}</span>
                                </div>
                                <div class="flex items-center justify-between space-x-2">
                                    <a wire:navigate href="{{ route('student.exploreCourses') }}"
                                    class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded hover:bg-purple-200">
                                        Buy Course
                                    </a>
                                    <a wire:navigate href="{{ route('student.subscriptions.plans') }}"
                                    class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200">
                                        Renew Plan
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                       @php
                        $atleastOneCourse = auth()->user()->courses()->exists();
                    @endphp
                    @if($atleastOneCourse)
                        <div class="w-full mt-2 p-2 bg-yellow-50 rounded-lg border border-yellow-200">
                            <div class="flex flex-col space-y-2">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-yellow-700">No Active Plan</span>
                                </div>
                                <div class="flex items-center justify-between space-x-2">
                                    <a wire:navigate href="{{ route('student.exploreCourses') }}"
                                    class="text-xs bg-purple-100 text-purple-700 px-2 py-1 rounded hover:bg-purple-200">
                                        Buy Course
                                    </a>
                                    <a wire:navigate href="{{ route('student.subscriptions.plans') }}"
                                    class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded hover:bg-green-200">
                                        Subscribe
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        
                    @endif
                @endif

            <nav class="space-y-1 mt-2">
                <!-- Main Navigation -->
                <div class="pb-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Overview</p>

                    <!-- Dashboard -->
                    <a wire:navigate href="{{ route('student.dashboard') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('student.dashboard') ? 'text-purple-700 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-700' }} rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M13.5 21H6.75A2.25 2.25 0 014.5 18.75V7.5a2.25 2.25 0 012.25-2.25H13.5a2.25 2.25 0 012.25 2.25v11.25a2.25 2.25 0 01-2.25 2.25zm0 0h6.75a2.25 2.25 0 002.25-2.25V10.5a2.25 2.25 0 00-2.25-2.25H15M13.5 21V9"/>
                        </svg>
                        <span class="ml-3">Dashboard</span>
                    </a>

                    <!-- Rewards -->
                    <a wire:navigate href="{{ route('student.rewards.gems') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium {{ (request()->routeIs('student.rewards.gems') ? 'text-purple-700 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-700') }} rounded-lg transition duration-200">
                        @if(!auth()->user()->hasAccess())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1.5l3 6 7.5.75-5.5 4.75L18.5 21l-6.5-4-6.5 4 1.5-7.75L1.5 8.25l7.5-.75z"/>
                            </svg>
                        @endif
                        <span class="ml-3">Rewards & Points</span>
                    </a>
                </div>

                <!-- Learning Section -->
                <div class="py-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Learning</p>

                    <!-- My Courses -->
                    <a wire:navigate href="{{ route('v2.student.mycourses') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('v2.student.mycourses') ? 'text-purple-700 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-700' }} rounded-lg transition duration-200">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                        </svg>
                        <span class="ml-3">My Learning</span>
                    </a>

                    <!-- Assignments -->
                    <a wire:navigate href="{{ route('student.assignments-view') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('student.assignments-view') ? 'text-purple-700 bg-purple-50' : 'text-gray-700 hover:bg-purple-50 hover:text-purple-700' }} rounded-lg transition duration-200">
                        @if(!auth()->user()->hasAccess())
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5  text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"/>
                        </svg>
                    @endif
                        <span class="ml-3">Tasks & Assignments</span>
                    </a>

                    <a wire:navigate href="{{ route('student.exploreCourses') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                        <svg class="w-6 h-6" viewBox="0 0 24 24">
                            <defs>
                                <linearGradient id="courseGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" style="stop-color:#34D399"/>
                                    <stop offset="100%" style="stop-color:#059669"/>
                                </linearGradient>
                            </defs>
                            <path fill="url(#courseGradient)" d="M11.7 2.805a.75.75 0 01.6 0A60.65 60.65 0 0122.83 8.72a.75.75 0 01-.231 1.337 49.949 49.949 0 00-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 01-.707 0A50.88 50.88 0 007.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 014.653-2.52.75.75 0 00-.65-1.352 56.123 56.123 0 00-4.78 2.589 1.858 1.858 0 00-.859 1.228 49.803 49.803 0 00-4.634-1.527.75.75 0 01-.231-1.337A60.653 60.653 0 0111.7 2.805Z"/>
                        </svg>
                        <span class="ml-3">Explore Courses</span>
                    </a>
                </div>

                <!-- Assessment Section -->
                <div class="py-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Assessment</p>

                    <!-- Mock Tests -->
                    <a wire:navigate href="{{ route('v2.student.mocktest') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 bg-purple-50  hover:bg-purple-50 hover:text-purple-700 rounded-lg transition duration-200">
                        @if(!auth()->user()->hasAccess())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        @else
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                            </svg>
                        @endif
                        <span class="ml-3">Practice Tests</span>
                    </a>

                    <a wire:navigate href="{{ route('student.takeExam') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                        @if(!auth()->user()->hasAccess())
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-5 h-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6 fill-pink-600">
                            <path fill-rule="evenodd"
                                d="M10.5 3.798v5.02a3 3 0 0 1-.879 2.121l-2.377 2.377a9.845 9.845 0 0 1 5.091 1.013 8.315 8.315 0 0 0 5.713.636l.285-.071-3.954-3.955a3 3 0 0 1-.879-2.121v-5.02a23.614 23.614 0 0 0-3 0Zm4.5.138a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                                clip-rule="evenodd" />
                        </svg>
                        @endif
                        Take Examinations
                    </a>


                    <a wire:navigate href="{{ route('student.marksheet')}}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                        @if(!auth()->user()->hasAccess())
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-5 h-5 mr-3 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    @else
                        <svg class="flex-shrink-0 w-5 h-5 mr-3 text-rose-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                        </svg>
                    @endif
                       Marksheet
                    </a>



                    <a href="{{ route('student.certificates')}}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                        @if(!auth()->user()->hasAccess())
                        <svg xmlns="http://www.w3.org/2000/svg" class="flex-shrink-0 w-5 h-5  text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6 fill-orange-600">
                            <path fill-rule="evenodd"
                                d="M5.166 2.621v.858c-1.035.148-2.059.33-3.071.543a.75.75 0 0 0-.584.859 6.753 6.753 0 0 0 6.138 5.6 6.73 6.73 0 0 0 2.743 1.346A6.707 6.707 0 0 1 9.279 15H8.54c-1.036 0-1.875.84-1.875 1.875V19.5h-.75a2.25 2.25 0 0 0-2.25 2.25c0 .414.336.75.75.75h15a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-2.25-2.25h-.75v-2.625c0-1.036-.84-1.875-1.875-1.875h-.739a6.706 6.706 0 0 1-1.112-3.173 6.73 6.73 0 0 0 2.743-1.347 6.753 6.753 0 0 0 6.139-5.6.75.75 0 0 0-.585-.858 47.077 47.077 0 0 0-3.07-.543V2.62a.75.75 0 0 0-.658-.744 49.22 49.22 0 0 0-6.093-.377c-2.063 0-4.096.128-6.093.377a.75.75 0 0 0-.657.744Zm0 2.629c0 1.196.312 2.32.857 3.294A5.266 5.266 0 0 1 3.16 5.337a45.6 45.6 0 0 1 2.006-.343v.256Zm13.5 0v-.256c.674.1 1.343.214 2.006.343a5.265 5.265 0 0 1-2.863 3.207 6.72 6.72 0 0 0 .857-3.294Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    @endif
                        <span class="flex-1 ms-3 whitespace-nowrap">Certificate</span>
                    </a>

                </div>

                <!-- Account Section -->
                <div class="py-2">
                    <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Account</p>


                    <a wire:navigate href="{{ route('v2.student.products') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium {{   'text-gray-700 hover:bg-purple-50 hover:text-purple-700' }} group transition duration-200">
                        @if(!auth()->user()->hasAccess())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 fill-green-600">
                                <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                            </svg>
                        @endif
                        <span class="flex-1 ms-3">Our Store</span>
                    </a>

                    @if (auth()->check() && auth()->user()->courses()->exists())
                            @php
                                $course = auth()->user()->courses()->first();
                                $batch = $course->pivot->batch_id 
                                    ? $course->batches()->find($course->pivot->batch_id) 
                                    : $course->batches()->first();
                                $batchActive = !$batch->end_date || \Carbon\Carbon::parse($batch->end_date)->isFuture();
                            @endphp

                            @if ($batchActive)
                                <a wire:navigate href="{{ route('student.my-attendance') }}"
                                    class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path d="M12 11.993a.75.75 0 0 0-.75.75v.006c0 .414.336.75.75.75h.006a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75H12ZM12 16.494a.75.75 0 0 0-.75.75v.005c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H12ZM8.999 17.244a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.006ZM7.499 16.494a.75.75 0 0 0-.75.75v.005c0 .414.336.75.75.75h.005a.75.75 0 0 0 .75-.75v-.005a.75.75 0 0 0-.75-.75H7.5ZM13.499 14.997a.75.75 0 0 1 .75-.75h.006a.75.75 0 0 1 .75.75v.005a.75.75 0 0 1-.75.75h-.006a.75.75 0 0 1-.75-.75v-.005ZM14.25 16.494a.75.75 0 0 0-.75.75v.006c0 .414.335.75.75.75h.005a.75.75 0 0 0 .75-.75v-.006a.75.75 0 0 0-.75-.75h-.005ZM15.75 14.995a.75.75 0 0 1 .75-.75h.005a.75.75 0 0 1 .75.75v.006a.75.75 0 0 1-.75.75H16.5a.75.75 0 0 1-.75-.75v-.006ZM13.498 12.743a.75.75 0 0 1 .75-.75h2.25a.75.75 0 1 1 0 1.5h-2.25a.75.75 0 0 1-.75-.75ZM6.748 14.993a.75.75 0 0 1 .75-.75h4.5a.75.75 0 0 1 0 1.5h-4.5a.75.75 0 0 1-.75-.75Z" />
                                        <path fill-rule="evenodd" d="M18 2.993a.75.75 0 0 0-1.5 0v1.5h-9V2.994a.75.75 0 0 0-1.5 0v1.497h-.752a3 3 0 0 0-3 3v11.252a3 3 0 0 0 3 3h13.5a3 3 0 0 0 3-3V7.492a3 3 0 0 0-3-3H18V2.993ZM3.748 18.743v-7.5a1.5 1.5 0 0 1 1.5-1.5h13.5a1.5 1.5 0 0 1 1.5 1.5v7.5a1.5 1.5 0 0 1-1.5 1.5h-13.5a1.5 1.5 0 0 1-1.5-1.5Z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="flex-1 ms-3 whitespace-nowrap">My Attendance</span>
                                </a>
                            @endif
                        @endif
                        <a wire:navigate href="{{ route('student.v2edit.profile') }}"
                        class="flex items-center px-4 py-2.5 text-sm font-medium {{   'text-gray-700 hover:bg-purple-50 hover:text-purple-700' }} group transition duration-200">
                        @if(!auth()->user()->hasAccess())
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <circle cx="12" cy="7" r="4" fill="#4FC3F7"/>
                            <path d="M4 20c0-2.5 2.5-4.5 6-4.5h4c3.5 0 6 2 6 4.5v1H4v-1z" fill="#0288D1"/>
                            <path d="M14.5 8.5l1-1 3 3-1 1-3-3z" fill="#FFB300"/>
                            <path d="M13.5 9.5l1-1 3 3-1 1-3-3z" fill="#F57C00"/>
                            <path d="M12.5 10.5l1-1 3 3-1 1-3-3z" fill="#6D4C41"/>
                          </svg>
                          
                        @endif
                        <span class="flex-1 ms-3">Profile</span>
                    </a>       
                    <form method="POST" action="{{ route('auth.logout') }}" class="inline-block">
                        @csrf
                        <button type="submit"
                                class="flex w-full items-center px-4 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-purple-50 hover:text-purple-700 group transition duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6 fill-red-600">
                                <path fill-rule="evenodd"
                                    d="M12 2.25a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM6.166 5.106a.75.75 0 0 1 0 1.06 8.25 8.25 0 1 0 11.668 0 .75.75 0 1 1 1.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 0 1 1.06 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </aside>

    <!-- Close button for mobile -->
    <button x-show="sidebarOpen"
            x-cloak
            @click="sidebarOpen = false"
            class="sm:hidden fixed top-3 right-3 z-50 rounded-full bg-gray-100/95 p-2 text-gray-700 hover:bg-gray-200">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>

    <div :class="{'sm:ml-64': !sidebarOpen}" class="transition-all duration-300">
        {{ $main ?? '' }}
    </div>
</div>

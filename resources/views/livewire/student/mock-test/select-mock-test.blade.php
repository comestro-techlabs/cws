<div>
    <x-access-restriction-modal />
    <div class="py-6 px-6 md:px-8 max-w-7xl mx-auto">

        <div class="mb-8 px-4">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 text-center md:text-left">Mock Tests</h1>
            <p class="mt-2 text-gray-600 text-center md:text-left">Practice and improve your skills with our mock tests
            </p>
        </div>

        <div class="mb-8 px-4">
            <div class="flex items-center justify-center flex-wrap gap-4 md:gap-8">
                <div class="flex items-center min-w-[120px]">
                    <span
                        class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $selectedCourseId ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }}">1</span>
                    <span
                        class="ml-2 text-sm font-medium {{ $selectedCourseId ? 'text-blue-600' : 'text-gray-600' }}">Select
                        Course</span>
                </div>

                <div
                    class="flex-1 h-0.5 min-w-[20px] {{ $selectedCourseId ? 'bg-blue-600' : 'bg-gray-200' }} hidden sm:block">
                </div>

                <div class="flex items-center min-w-[120px]">
                    <span
                        class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $selectedLevel ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }}">2</span>
                    <span
                        class="ml-2 text-sm font-medium {{ $selectedLevel ? 'text-blue-600' : 'text-gray-600' }}">Choose
                        Level</span>
                </div>

                <div
                    class="flex-1 h-0.5 min-w-[20px] {{ $selectedLevel ? 'bg-blue-600' : 'bg-gray-200' }} hidden sm:block">
                </div>

                <div class="flex items-center min-w-[120px]">
                    <span
                        class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ ($selectedCourseId && $selectedLevel) ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }}">3</span>
                    <span
                        class="ml-2 text-sm font-medium {{ ($selectedCourseId && $selectedLevel) ? 'text-blue-600' : 'text-gray-600' }}">Take
                        Test</span>
                </div>
            </div>
        </div>

        @if($selectedCourseId || $selectedLevel)
            <div class="flex justify-end mb-6">
                <button wire:click="resetSelection"
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                        </path>
                    </svg>
                    Reset Selection
                </button>
            </div>
        @endif

        
        <!-- Main Content -->
        <div class="grid grid-cols-1 gap-8 {{ !$hasAccess ? 'opacity-50 pointer-events-none' : '' }}">
            <!-- Courses Section -->
            @if(!$selectedCourseId)
                <div class="animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Select Your Course</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($courses as $course)
                            <div wire:click="selectCourse({{ $course->id }})"
                                class="cursor-pointer group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-blue-500">
                                <div class="p-5">
                                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-blue-600">{{ $course->title }}
                                    </h3>
                                    <p class="mt-2 text-sm text-gray-600">Click to select this course and view available tests
                                    </p>
                                    <div class="mt-4 flex justify-end">
                                        <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-8">
                                <p class="text-gray-500">No courses available at the moment.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif

            <!-- Levels Section -->
            @if($selectedCourseId && !$selectedLevel)
                <div class="animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Select Difficulty Level</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @foreach($levels as $level)
                            <div wire:click="selectLevel('{{ $level }}')"
                                class="cursor-pointer group bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-blue-500">
                                <div class="p-5">
                                    <h3 class="text-lg font-medium text-gray-900 group-hover:text-blue-600 capitalize">
                                        {{ $level }}</h3>
                                    <p class="mt-2 text-sm text-gray-600">{{ ucfirst($level) }} difficulty tests</p>
                                    <div class="mt-4 flex justify-end">
                                        <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Mock Tests Section -->
            @if($selectedCourseId && $selectedLevel)
                <div class="animate-fade-in">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Available Tests</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @forelse($mockTests as $test)
                            <div
                                class="bg-white rounded-xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100">
                                <div class="p-5">
                                    <h3 class="text-lg font-medium text-gray-900">{{ $test->test_title }}</h3>
                                    <div class="mt-4 space-y-2">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>Duration: 60 minutes</span>
                                        </div>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ count($test->questions ?? []) }} Questions</span>
                                        </div>
                                    </div>
                                    <div class="mt-6">
                                        @if(\App\Models\MockTestResult::where('user_id', auth()->id())->where('mock_test_id', $test->id)->exists())
                                            <a href="{{ route('v2.student.mocktest.result', $test->id) }}"
                                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                </svg>
                                                View Results
                                            </a>
                                        @else
                                            <a href="{{ route('v2.student.mocktest.take', $test->id) }}"
                                                class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                                Start Test
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full flex flex-col items-center justify-center py-12">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="mt-4 text-gray-600">No tests available for this selection.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</div>
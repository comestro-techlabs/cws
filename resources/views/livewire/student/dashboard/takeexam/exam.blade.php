<div>
    <x-loader />
    <x-access-restriction-modal />

    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900">My Quizzes</h1>
            <a href="{{ route('student.dashboard') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-md text-sm font-medium hover:bg-blue-100 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
        </div>

        @if ($courses->isEmpty())
            <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-lg font-medium text-gray-700">No courses available</p>
                <p class="text-gray-500 mt-1">You are not enrolled in any courses with quizzes.</p>
                <a href="{{ route('v2.student.mycourses') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Explore Courses
                </a>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($courses as $course)
                    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:border-blue-200">
                        <div class="p-5">
                            <!-- Course Title -->
                            <h2 class="text-lg font-semibold text-gray-900 mb-2">{{ $course->title }}</h2>

                            <!-- Quiz Status -->
                            @php
                                $quizAvailable = false;
                                $todayExam = null;
                                $hasAttempts = false;
                            @endphp

                            @foreach ($course->exams as $exam)                              
                                    @php
                                        $quizAvailable = true;
                                        $todayExam = $exam;
                                        $attemptCount = $attempts[$exam->id] ?? 0;
                                        $hasAttempts = $attemptCount >= 1;
                                    @endphp                              
                            @endforeach

                            <div class="mt-3 mb-4">
                                @if ($quizAvailable)
                                    <div class="flex items-center">
                                        <span class="w-2 h-2 mr-2 rounded-full {{ $hasAccess ? 'bg-green-500' : 'bg-yellow-500' }}"></span>
                                        <span class="text-sm {{ $hasAccess ? 'text-gray-700' : 'text-yellow-700' }}">
                                            Quiz available today
                                            @if ($hasAttempts)
                                                <span class="text-red-600 ml-1">(Attempted)</span>
                                            @endif
                                        </span>
                                    </div>
                                    @if (!$hasAccess)
                                        <p class="mt-2 p-2 rounded-md  text-sm border-l-2 border-red-600 bg-red-100 text-red-600">Action required to take quiz or view result</p>
                                    @endif
                                @else
                                    <div class="flex items-center">
                                        <span class="w-2 h-2 mr-2 rounded-full bg-gray-400"></span>
                                        <span class="text-sm text-gray-500">No quiz available today</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-2 mt-auto pt-3 border-t border-gray-100">
                                @if ($quizAvailable && !$hasAttempts)
                                    @if ($hasAccess)
                                        <a href="{{ route('v2.student.quiz', ['courseId' => $course->id]) }}" class="flex-1">
                                            <button class="w-full inline-flex items-center justify-center px-3 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700">
                                                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                </svg>
                                                Take Quiz
                                            </button>
                                        </a>
                                    @else
                                        <button 
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-gray-100 text-gray-500 rounded-md text-sm font-medium cursor-not-allowed"
                                            @click="$dispatch('openModal')"
                                        >
                                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Quiz Locked
                                        </button>
                                    @endif
                                @endif

                                @if ($todayExam && in_array($todayExam->id, $completedExams))
                                    @if ($hasAccess)
                                        <a href="{{ route('v2.student.examResult', ['examId' => $todayExam->id]) }}" class="flex-1">
                                            <button class="w-full inline-flex items-center justify-center px-3 py-2 bg-white border border-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50">
                                                View Results
                                            </button>
                                        </a>
                                    @else
                                        <button 
                                            class="flex-1 inline-flex items-center justify-center px-3 py-2 bg-gray-100 text-gray-500 rounded-md text-sm font-medium cursor-not-allowed"
                                            @click="$dispatch('openModal')"
                                        >
                                            <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                            </svg>
                                            Results Locked
                                        </button>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
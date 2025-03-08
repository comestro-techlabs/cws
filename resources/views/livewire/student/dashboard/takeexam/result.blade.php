<div>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header with back button -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900">Quiz Results</h1>
            <a href="{{ route('v2.student.exam') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-md text-sm font-medium hover:bg-blue-100 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Quizzes
            </a>
        </div>

        <!-- Error Message -->
        @if (session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-red-700">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Result Summary Card -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 mb-6">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">Attempt {{ $attempt }} Results</h2>
                    <p class="text-sm text-gray-500">{{ now()->format('F j, Y') }}</p>
                </div>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between border-t border-gray-100 pt-4 mt-4">
                <div class="mb-4 sm:mb-0">
                    <p class="text-sm text-gray-500 mb-1">Total Score</p>
                    <div class="flex items-center">
                        <span class="text-2xl font-bold text-gray-900">{{ $totalMarks }}</span>
                        <span class="text-sm text-gray-500 ml-1">points</span>
                    </div>
                </div>
                
                <div class="flex items-center">
                    @if ($totalMarks >= 70)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <svg class="mr-1.5 h-2 w-2 text-green-500" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3" />
                            </svg>
                            Passed
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <svg class="mr-1.5 h-2 w-2 text-red-500" fill="currentColor" viewBox="0 0 8 8">
                                <circle cx="4" cy="4" r="3" />
                            </svg>
                            Needs Improvement
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <!-- Detailed Feedback Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Feedback & Recommendations</h3>
            
            <div class="border-l-4 border-blue-500 pl-4 py-2 mb-4">
                @if ($attempt == 1)
                    <p class="text-gray-700">
                        <span class="font-medium">First attempt completed.</span> 
                        @if ($totalMarks >= 70)
                            Great job on passing your first attempt! You can still take your second attempt to improve your score.
                        @else
                            You have one more attempt available. Review your answers and try again to improve your score.
                        @endif
                    </p>
                @else
                    <p class="text-gray-700">
                        <span class="font-medium">Final attempt completed.</span> 
                        @if ($totalMarks >= 70)
                            Congratulations on passing the quiz! Continue to the next section of your course.
                        @else
                            We recommend reviewing the course material again before moving forward.
                        @endif
                    </p>
                @endif
            </div>
            
            <!-- Study Recommendations -->
            <div class="mt-6">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Study Recommendations</h4>
                <ul class="space-y-2">
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span class="text-gray-700">Review course materials for any topics you struggled with</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-gray-700">Schedule time to practice with additional exercises</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="h-5 w-5 text-blue-500 mr-2 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                        <span class="text-gray-700">Reach out to your instructor if you have specific questions</span>
                    </li>
                </ul>
            </div>
            
            <!-- Action Buttons -->
            <div class="mt-8 flex flex-col sm:flex-row sm:space-x-4">
                @if ($attempt == 1)
                    <a href="{{ route('v2.student.quiz', ['courseId' => request()->route('courseId')]) }}" class="w-full sm:w-auto mb-3 sm:mb-0 inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Take Second Attempt
                    </a>
                @endif
                
                <a href="{{ route('v2.student.allAttempts', request()->route('courseId')) }}" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    View All Attempts
                </a>
            </div>
        </div>
    </div>
</div>
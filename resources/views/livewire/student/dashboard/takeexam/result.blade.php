<div>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header with back button -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold text-gray-900">Quiz Results</h1>
            <a href="{{ route('student.takeExam') }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-md text-sm font-medium hover:bg-blue-100 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
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
                    @if ($totalMarks >7)
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

    <!-- Header Section -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Result for Attempt {{ $attempt }}</h2>
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Total Question {{ $totalQuestions }}</h2>
        <p class="text-lg text-gray-600"><strong class="text-gray-900">Total Marks:</strong> <span class="text-indigo-600 font-semibold">{{ $totalMarks }}</span></p>
    </div>

    <!-- Detailed Feedback Section -->
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h4 class="text-xl font-semibold text-gray-800 mb-4">Detailed Feedback</h4>
        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-indigo-500">
            @if ($totalMarks >= 7)
                <p class="text-lg text-gray-700">
                    <strong class="text-green-600">Congratulations!</strong> 
                    <span class="text-gray-500">You have passed the quiz.</span>
                </p>
            
                
            @else
                <p class="text-lg text-gray-700">
                    <strong class="text-indigo-600">We recommend reviewing your results.</strong> 
                    <span class="text-gray-500">Please check for any improvement areas.</span>
                </p>
            @endif
        </div>
    </div>
</div>
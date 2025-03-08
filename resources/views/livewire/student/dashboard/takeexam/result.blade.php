<div class="container mx-auto mt-24 px-4 sm:px-6 lg:px-8">
    <!-- Error Message -->
    @if (session('error'))
        <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded-lg shadow-md">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

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
            @if ($attempt == 1)
                <p class="text-lg text-gray-700">
                    <strong class="text-indigo-600">Your first attempt was evaluated.</strong> 
                    <span class="text-gray-500">Good luck on your second attempt!</span>
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
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Result Summary Card -->
        <div class="bg-white rounded-2xl  p-6 mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Exam Results</h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Percentage Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100">Percentage</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['percentage'] }}%</h3>
                        </div>
                        <div class="bg-blue-400/30 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Marks Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100">Total Marks</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['marks'] }}</h3>
                        </div>
                        <div class="bg-green-400/30 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Correct Answers Card -->
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-emerald-100">Correct</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['correct'] }}</h3>
                        </div>
                        <div class="bg-emerald-400/30 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Incorrect Answers Card -->
                <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-red-100">Incorrect</p>
                            <h3 class="text-3xl font-bold mt-1">{{ $stats['incorrect'] }}</h3>
                        </div>
                        <div class="bg-red-400/30 rounded-full p-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Answer Sheet -->
        <div class="space-y-6">
            @foreach($answers as $index => $answer)
                <div class="bg-white rounded-xl  overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-4">
                                <h3 class="text-lg font-semibold text-gray-800">Question {{ $index + 1 }}</h3>
                                <span class="text-sm text-gray-600">
                                    (Marks: {{ $answer->quiz->marks ?? '0' }} | Obtained: {{ $answer->obtained_marks }})
                                </span>
                            </div>
                            <span class="px-4 py-1 rounded-full text-sm font-semibold {{ $answer->obtained_marks > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $answer->obtained_marks > 0 ? 'Correct' : 'Incorrect' }}
                            </span>
                        </div>

                        <div class="prose max-w-none">
                            <p class="text-gray-600 mb-4">{{ $answer->quiz->question ?? 'Question not available' }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            @foreach(['option1', 'option2', 'option3', 'option4'] as $option)
                                <div class="relative">
                                    <div class="p-4 rounded-lg border {{ $answer->quiz->correct_answer === $option ? 'bg-green-50 border-green-200' : ($answer->selected_option === $option ? 'bg-red-50 border-red-200' : 'border-gray-200') }}">
                                        <div class="flex items-center">
                                            @if($answer->quiz->correct_answer === $option)
                                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @elseif($answer->selected_option === $option)
                                                <svg class="w-5 h-5 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                            <span class="{{ $answer->quiz->correct_answer === $option ? 'text-green-800' : ($answer->selected_option === $option ? 'text-red-800' : 'text-gray-700') }}">
                                                {{ $answer->quiz->$option ?? 'N/A' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
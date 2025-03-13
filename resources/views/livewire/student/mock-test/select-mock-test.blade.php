<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Select Mock Test</h2>
        @if($selectedCourseId || $selectedLevel)
            <button 
                wire:click="resetSelection" 
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-semibold rounded-lg shadow-md transition duration-300"
            >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
                Reset Selection
            </button>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Courses Section -->
        <div>
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Courses</h3>
            <div class="space-y-4">
                @forelse($courses as $course)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 {{ $selectedCourseId === $course->id ? 'ring-2 ring-blue-500' : 'hover:shadow-lg' }}">
                        <div class="p-4">
                            <h5 class="text-lg font-medium text-gray-700 mb-3">{{ $course->title }}</h5>
                            <button 
                                wire:click="selectCourse({{ $course->id }})"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
                            >
                                Select Course
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-lg shadow-md p-4">
                        <p class="text-gray-600 text-center">No courses available.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Levels Section -->
        <div>
            @if($selectedCourseId)
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Levels</h3>
                <div class="space-y-4">
                    @foreach($levels as $level)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 {{ $selectedLevel === $level ? 'ring-2 ring-blue-500' : 'hover:shadow-lg' }}">
                            <div class="p-4">
                                <h5 class="text-lg font-medium text-gray-700 mb-3">{{ ucfirst($level) }}</h5>
                                <button 
                                    wire:click="selectLevel('{{ $level }}')"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
                                >
                                    Select Level
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
           
            @endif
        </div>

        <!-- Mock Tests Section -->
        <div>
            @if($selectedCourseId && $selectedLevel)
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Available Tests</h3>
                <div class="space-y-4">
                    @forelse($mockTests as $test)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                            <div class="p-4">
                                <h5 class="text-lg font-medium text-gray-700 mb-3">{{ $test->test_title }}</h5>
                                @if(\App\Models\MockTestResult::where('user_id', auth()->id())->where('mock_test_id', $test->id)->exists())
                                    <a 
                                        href="{{ route('v2.student.mocktest.result', $test->id) }}"
                                        class="w-full block text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
                                    >
                                        View Results
                                    </a>
                                @else
                                    <a 
                                        href="{{ route('v2.student.mocktest.take', $test->id) }}"
                                        class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300"
                                    >
                                        Take Test
                                    </a>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <p class="text-gray-600 text-center">No tests available for this selection.</p>
                        </div>
                    @endforelse
                </div>
           
            @endif
        </div>
    </div>
</div>
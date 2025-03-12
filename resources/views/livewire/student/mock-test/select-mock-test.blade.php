<!-- resources/views/livewire/student/test-selector.blade.php -->
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-end mb-4">
        <button wire:click="resetSelection" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition duration-300">
            Reset Selection
        </button>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Courses Section -->
        <div>
            <h3 class="text-2xl font-bold mb-4 text-gray-800">Courses</h3>
            <div class="space-y-4">
                @foreach($courses as $course)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden {{ $selectedCourseId === $course->id ? 'ring-2 ring-blue-500' : '' }}">
                        <div class="p-4">
                            <h5 class="text-lg font-semibold text-gray-700">{{ $course->title }}</h5>
                            <button 
                                wire:click="selectCourse({{ $course->id }})"
                                class="mt-2 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300"
                            >
                                Select
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Levels Section -->
        <div>
            @if($selectedCourseId)
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Levels</h3>
                <div class="space-y-4">
                    @foreach($levels as $level)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden {{ $selectedLevel === $level ? 'ring-2 ring-blue-500' : '' }}">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold text-gray-700">{{ ucfirst($level) }}</h5>
                                <button 
                                    wire:click="selectLevel('{{ $level }}')"
                                    class="mt-2 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300"
                                >
                                    Select
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
                <h3 class="text-2xl font-bold mb-4 text-gray-800">Available Tests</h3>
                <div class="space-y-4">
                    @foreach($mockTests as $test)
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <div class="p-4">
                                <h5 class="text-lg font-semibold text-gray-700">{{ $test->test_title }}</h5>
                                <a 
                                    href="{{ route('v2.student.mocktest.take', $test->id) }}"
                                    class="mt-2 w-full block text-center bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300"
                                >
                                    Take Test
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
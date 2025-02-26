<div>
    <div class="p-6 bg-white shadow-lg rounded-lg">
        {{-- Header with Back Button --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Course Details</h1>
            <a href="{{ route('admin.course.manage') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Back to Courses
            </a>
        </div>

        {{-- Course Information --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">Title</h3>
                <p>{{ $course->title }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">Course Code</h3>
                <p>{{ $course->course_code }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">Instructor</h3>
                <p>{{ $course->instructor }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">Duration</h3>
                <p>{{ $course->duration }} Weeks</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">Fees</h3>
                <p>₹{{ number_format($course->fees, 2) }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="font-semibold text-gray-700">Discounted Fees</h3>
                <p>₹{{ number_format($course->discounted_fees, 2) }}</p>
            </div>
        </div>

        {{-- Course Image --}}
        @if($course->course_image)
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Course Image</h2>
            <img src="{{ asset('storage/' . $course->course_image) }}" alt="{{ $course->title }}" class="w-64 h-64 object-cover rounded-lg shadow-md">
        </div>
        @endif

        {{-- Course Description --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Description</h2>
            <div class="bg-gray-50 p-4 rounded-lg">
                {{ $course->description }}
            </div>
        </div>

        {{-- Batches Section --}}
        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-4">Batches</h2>
            @if($batches->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-300 shadow-sm rounded-lg">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-4 text-left">Batch Name</th>
                                <th class="py-3 px-4 text-left">Start Date</th>
                                <th class="py-3 px-4 text-left">End Date</th>
                                <th class="py-3 px-4 text-left">Total Seats</th>
                                <th class="py-3 px-4 text-left">Available Seats</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($batches as $batch)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4">{{ $batch->batch_name }}</td>
                                <td class="py-3 px-4">{{ $batch->start_date->format('M d, Y') }}</td>
                                <td class="py-3 px-4">{{ $batch->end_date->format('M d, Y') }}</td>
                                <td class="py-3 px-4">{{ $batch->total_seats }}</td>
                                <td class="py-3 px-4">{{ $batch->available_seats }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500 italic">No batches available for this course.</p>
            @endif
        </div>

        {{-- Chapters and Lessons Section --}}
        <div>
            <h2 class="text-xl font-semibold mb-4">Chapters and Lessons</h2>
            @if($chapters->count() > 0)
                <div class="space-y-4">
                    @foreach($chapters as $chapter)
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold mb-2">{{ $chapter->title }}</h3>
                            @if($chapter->lessons->count() > 0)
                                <div class="ml-4">
                                    <h4 class="text-md font-medium mb-2">Lessons:</h4>
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($chapter->lessons as $lesson)
                                            <li class="text-gray-700">{{ $lesson->title }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <p class="text-gray-500 italic ml-4">No lessons available for this chapter.</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 italic">No chapters available for this course.</p>
            @endif
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8 mt-12">
    <h1 class="text-2xl font-bold mb-6 text-gray-800">Manage Assignments</h1>

    <!-- Check if Courses Exist -->
    @if ($courses->isNotEmpty())
        <div class="grid grid-cols-1 gap-8">
            @foreach ($courses as $course)
                <div class="rounded-lg overflow-hidden shadow-md">
                    <!-- Course Title -->
                    <div class="bg-purple-400 text-white px-6 py-4 rounded-t-lg">
                        <h2 class="text-lg font-semibold">{{ $course->title }}</h2>
                    </div>

                    <!-- Assignments List -->
                    <div class="bg-white rounded-b-lg">
                        @forelse($course->assignments as $key => $assignment)
                            <div class="border-t border-gray-200 hover:bg-gray-50 transition-colors">
                                <div class="p-4 md:p-6">
                                    <div class="flex flex-col md:flex-row md:items-center">
                                        <!-- ID and Title - Always visible -->
                                        <div class="flex items-center mb-3 md:mb-0">
                                            <span class="bg-purple-100 text-purple-700 rounded-full h-8 w-8 flex items-center justify-center mr-3 flex-shrink-0">
                                                {{ $key + 1 }}
                                            </span>
                                            <h3 class="font-medium text-gray-800">{{ $assignment->title }}</h3>
                                        </div>

                                        <!-- Spacer for desktop -->
                                        <div class="md:flex-grow"></div>

                                        <!-- Status - Desktop view inline, mobile view below -->
                                        <div class="my-3 md:my-0 md:mr-4">
                                            @if ($assignment->uploads->isNotEmpty())
                                                <div class="flex flex-wrap gap-2">
                                                    @foreach ($assignment->uploads as $upload)
                                                        <span class="px-3 py-1 rounded-lg text-white text-sm
                                                            @if ($upload->status == 'submitted') bg-green-500
                                                            @elseif($upload->status == 'graded') bg-blue-500
                                                            @else bg-gray-500 @endif">
                                                            {{ ucfirst($upload->status) }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @else
                                                <span class="text-gray-500 text-sm">No uploads</span>
                                            @endif
                                        </div>

                                        <!-- Action Button -->
                                        <a href="{{ route('student.v2view.assigment', $assignment->id) }}"
                                           class="inline-flex items-center justify-center px-4 py-2 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition-colors">
                                            <span>View</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>

                                    <!-- Description - Always below -->
                                    <div class="mt-3 text-gray-600 text-sm">
                                        {!! Str::limit($assignment->description, 50) !!}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="px-4 py-8 flex flex-col items-center">
                                <img src="https://tse4.mm.bing.net/th?id=OIP.fqgd7Ij7CDhGwPwro_SsiQAAAA&pid=Api&P=0&h=180" alt="No Assignments"
                                     class="w-24 h-24 md:w-32 md:h-32 mb-4">
                                <p class="text-lg md:text-xl font-semibold text-gray-600 text-center">No assignments available for this course.</p>
                                <p class="text-gray-500 text-center">Stay tuned for upcoming assignments.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <p class="text-gray-500">No courses available for the logged-in student.</p>
        </div>
    @endif
</div>

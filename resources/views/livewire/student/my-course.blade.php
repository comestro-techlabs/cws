<div>
<div class="py-6 px-4 sm:px-6 lg:px-8">
    <!-- SweetAlert Notifications -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-xl font-bold text-gray-900">My Courses</h1>
        <a href="{{ route('student.course') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Explore New Courses
        </a>
    </div>

    <!-- Courses Section -->
    @if(empty($courses))
        <div class="bg-white rounded-lg border border-gray-200 p-8 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            <p class="text-lg font-medium text-gray-700">No courses available</p>
            <p class="text-gray-500 mt-1">You are not enrolled in any courses at the moment.</p>
            <a href="{{ route('student.course') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Browse Courses
            </a>
        </div>
    @else
        <div class="grid gap-4">
            @foreach ($courses as $course)
                <div class="bg-white border border-gray-200 rounded-lg overflow-hidden transition-all duration-300 hover:border-blue-200">
                    <div class="flex flex-col md:flex-row">
                        <!-- Course Image -->
                        <div class="md:w-1/4 lg:w-1/5 flex-shrink-0">
                            <img src="{{ asset('storage/course_images/' . $course['course_image']) }}"
                                alt="{{ $course['title'] }}"
                                class="h-48 w-full md:h-full object-cover">
                        </div>

                        <!-- Course Details -->
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        {{ $course['title'] }}
                                    </h3>
                                    <span class="text-sm text-gray-600 mt-1 block">
                                        <span class="inline-flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $course['instructor'] }}
                                        </span>
                                    </span>
                                </div>

                                <div class="mt-3 sm:mt-0">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-800 border border-blue-100">
                                        ₹{{ $course['discounted_fees'] }}
                                    </span>
                                </div>
                            </div>

                            <p class="text-gray-600 text-sm mt-3 line-clamp-2">
                                {{ strip_tags($course['description']) }}
                            </p>

                            <!-- Batch Section -->
                            <div class="mt-auto pt-4">
                                <div class="border-t border-gray-100 pt-4">
                                    <h4 class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-2">Batch Information</h4>

                                    @if (!empty($course['pivot']['batch_id']) && !empty($course['batches']))
                                        @php
                                            $selectedBatch = collect($course['batches'])->firstWhere('id', $course['pivot']['batch_id']);
                                        @endphp

                                        @if($selectedBatch)
                                            <div class="flex items-center bg-gray-50 rounded-md p-3 border border-gray-200">
                                                <span class="w-2 h-2 mr-2 rounded-full bg-green-500"></span>
                                                <span class="text-sm text-gray-700">
                                                    Enrolled in: <span class="font-medium">{{ $selectedBatch['batch_name'] }}</span>
                                                </span>
                                            </div>
                                            <div class="mt-3 flex space-x-2">
                                                <a href="#" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    View Course
                                                </a>
                                                <button class="inline-flex items-center px-3 py-1.5 border border-gray-200 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    Schedule
                                                </button>
                                            </div>
                                        @endif

                                    @elseif (!empty($course['batches']))
                                        <div class="space-y-3">
                                            <div class="relative">
                                                <select wire:change.live="updateBatch({{ $course->id }}, $event.target.value)"
                                                    class="w-full px-3 py-2 border border-gray-200 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200 appearance-none pr-10">
                                                    <option value="">-- Select a Batch --</option>
                                                    @foreach ($course->batches as $batch)
                                                        <option value="{{ $batch->id }}"
                                                            {{ $course->pivot && $course->pivot->batch_id == $batch->id ? 'selected' : '' }}>
                                                            {{ $batch->batch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>

                                            <button type="submit"
                                                class="w-full inline-flex items-center justify-center px-3 py-2 bg-blue-600 text-white rounded-md text-sm font-medium hover:bg-blue-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Update Batch
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

</div>
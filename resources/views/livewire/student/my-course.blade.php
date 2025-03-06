<div class="bg-gray-50 min-h-screen mt-5">
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
    <div class="bg-white shadow">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-6 flex flex-col sm:flex-row sm:items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800">My Courses</h1>
                <a href="{{ route('student.course') }}" class="mt-4 sm:mt-0 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white py-2 px-6 rounded-lg flex items-center justify-center shadow-md transition duration-300 ease-in-out">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    New Course
                </a>
            </div>
        </div>
    </div>

    <!-- Courses Section -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(empty($courses))
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <p class="text-xl text-gray-600">No courses found.</p>
                <p class="mt-2 text-gray-500">Enroll in courses to see them here.</p>
            </div>
        @else
            <div class="grid gap-6">
                @foreach ($courses as $course)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 hover:shadow-lg">
                        <div class="flex flex-col md:flex-row">
                            <!-- Course Image -->
                            <div class="md:w-1/4 lg:w-1/6">
                                <img src="{{ asset('storage/course_images/' . $course['course_image']) }}"
                                    alt="{{ $course['title'] }}"
                                    class="h-48 w-full md:h-full object-cover">
                            </div>

                            <!-- Course Details -->
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 hover:text-indigo-600 transition-colors">
                                            <a href="#">{{ $course['title'] }}</a>
                                        </h3>
                                        <span class="text-sm text-gray-700 mt-1 block">
                                            <span class="inline-flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $course['instructor'] }}
                                            </span>
                                        </span>
                                    </div>

                                    <div class="mt-3 sm:mt-0">
                                        <span class="bg-gradient-to-r from-blue-50 to-purple-50 text-indigo-600 py-2 px-4 rounded-full text-sm font-medium inline-block border border-indigo-100">
                                            ₹{{ $course['discounted_fees'] }}
                                        </span>
                                    </div>
                                </div>

                                <p class="text-gray-600 mt-4">
                                    {{ Str::limit($course['description'], 150) }}
                                </p>

                                <!-- Batch Section -->
                                <div class="mt-auto pt-6">
                                    <div class="border-t border-gray-100 pt-4">
                                        <h4 class="text-sm font-semibold text-gray-800 mb-2">Batch Information</h4>

                                        @if (!empty($course['pivot']['batch_id']) && !empty($course['batches']))
                                            @php
                                                $selectedBatch = collect($course['batches'])->firstWhere('id', $course['pivot']['batch_id']);
                                            @endphp

                                            @if($selectedBatch)
                                                <div class="flex items-center bg-green-50 rounded-lg p-3 border border-green-100">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="text-green-800">
                                                        Enrolled in: <strong>{{ $selectedBatch['batch_name'] }}</strong>
                                                    </span>
                                                </div>
                                            @endif

                                        @elseif (!empty($course['batches']))
                                            <div class="space-y-3">
                                                <select wire:change.live="updateBatch({{ $course->id }}, $event.target.value)"
                                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 focus:outline-none transition duration-200">
                                                    <option value="">-- Select a Batch --</option>
                                                    @foreach ($course->batches as $batch)
                                                        <option value="{{ $batch->id }}"
                                                            {{ $course->pivot && $course->pivot->batch_id == $batch->id ? 'selected' : '' }}>
                                                            {{ $batch->batch_name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <button type="submit"
                                                    class="w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white py-2 px-4 rounded-lg hover:from-green-600 hover:to-emerald-600 transition-colors duration-200 shadow-sm flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
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
</div>

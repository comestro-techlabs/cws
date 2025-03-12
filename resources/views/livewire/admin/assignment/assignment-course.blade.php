<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <h1 class="text-xl font-semibold text-gray-800">Courses Overview</h1>
                    <button onclick="window.history.back()"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="bi bi-arrow-left mr-2"></i>
                        Back
                    </button>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($courses as $course)
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow duration-200">
                    <!-- Course Header -->
                    <div class="p-5 border-b border-gray-100">
                        <div class="flex items-start justify-between">
                            <div>
                                <h2 class="text-lg font-semibold text-gray-800 line-clamp-2">{{ $course->title }}</h2>
                                <p class="text-sm text-gray-500 mt-1">Code: {{ $course->course_code }}</p>
                            </div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $course->assignments->count() }} Assignments
                            </span>
                        </div>
                    </div>

                    <!-- Statistics -->
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-sm text-gray-500">Total Students</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $course->total_users }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-3">
                                <p class="text-sm text-gray-500">Submissions</p>
                                <p class="text-2xl font-semibold text-gray-800">{{ $course->unique_user_count }}</p>
                            </div>
                        </div>

                        <!-- Progress Bar -->
                        <div class="mt-4">
                            <div class="flex justify-between text-sm text-gray-600 mb-1">
                                <span>Submission Rate</span>
                                <span>{{ $course->total_users > 0 ? round(($course->unique_user_count / $course->total_users) * 100) : 0 }}%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-600 h-2 rounded-full"
                                     style="width: {{ $course->total_users > 0 ? ($course->unique_user_count / $course->total_users) * 100 : 0 }}%">
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4">
                            <a href="{{ route('assignment.review', $course->slug) }}"
                               class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="bi bi-eye-fill mr-2"></i>
                                Review Assignments
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($courses->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg">
                <i class="bi bi-journal-x text-4xl text-gray-400"></i>
                <p class="mt-2 text-gray-500">No courses available</p>
            </div>
        @endif
    </div>
</div>

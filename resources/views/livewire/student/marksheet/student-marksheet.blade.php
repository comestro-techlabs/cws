<div class="p-6 bg-gray-100 min-h-screen">
    @if(!$selectedCourse)
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">My Courses Marksheet</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($courses as $course)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ $course->title }}</h3>
                        <button wire:click="selectCourse({{ $course->id }})"
                            class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            View Marksheet
                        </button>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 bg-white rounded-lg">
                        <p class="text-gray-500">No courses found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @else
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-6">
                <button wire:click="selectCourse(null)" class="flex items-center text-gray-600 hover:text-gray-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Courses
                </button>
            </div>

            @if($marksheetData)
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-2xl font-bold mb-6">{{ $marksheetData['course_name'] }}</h2>

                    <!-- Assignments Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Assignments</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">Title</th>
                                        <th class="px-4 py-2 text-center">Status</th>
                                        <th class="px-4 py-2 text-center">Submission Date</th>
                                        <th class="px-4 py-2 text-right">Grade</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($marksheetData['assignments'] as $assignment)
                                        <tr>
                                            <td class="px-4 py-3">{{ $assignment['title'] }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $assignment['status'] === 'Submitted' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                    {{ $assignment['status'] }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-center text-sm">
                                                {{ $assignment['submission_date'] ? Carbon\Carbon::parse($assignment['submission_date'])->format('M d, Y') : '-' }}
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                {{ $assignment['grade'] ? $assignment['grade'] . '%' : 'Not graded' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 font-semibold">Average Assignment Score</td>
                                        <td class="px-4 py-3 text-right font-semibold">
                                            {{ number_format($marksheetData['assignment_avg'], 2) }}%
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Exams Section -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-4 pb-2 border-b">Exams</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left">Title</th>
                                        <th class="px-4 py-2 text-center">Status</th>
                                        <th class="px-4 py-2 text-right">Marks</th>
                                        <th class="px-4 py-2 text-right">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @foreach($marksheetData['exams'] as $exam)
                                        <tr>
                                            <td class="px-4 py-3">{{ $exam['title'] }}</td>
                                            <td class="px-4 py-3 text-center">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    {{ $exam['status'] === 'Completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                    {{ $exam['status'] }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                {{ $exam['marks'] }}/{{ $exam['total_marks'] }}
                                            </td>
                                            <td class="px-4 py-3 text-right">
                                                {{ number_format($exam['percentage'], 2) }}%
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-gray-50">
                                    <tr>
                                        <td colspan="3" class="px-4 py-3 font-semibold">Average Exam Score</td>
                                        <td class="px-4 py-3 text-right font-semibold">
                                            {{ number_format($marksheetData['exam_avg'], 2) }}%
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- Overall Result -->
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600">Assignment Weight: 50%</p>
                                <p class="text-sm text-gray-600">Exam Weight: 50%</p>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium">Overall Status</p>
                                <p class="text-2xl font-bold {{ $marksheetData['overall_percentage'] ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $marksheetData['status'] }}
                                </p>
                                @if($marksheetData['overall_percentage'])
                                    <p class="text-3xl font-bold text-gray-900">
                                        {{ number_format($marksheetData['overall_percentage'], 2) }}%
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>

<div>
    <div class="min-h-screen bg-gray-50">
        <!-- Full Page Loader -->
        <x-loader />

        <div class="flex flex-col h-screen">
            <!-- Header -->
            <div class="bg-white  px-4 py-3">
                <!-- Tabs -->
                <div class="flex space-x-4 border-b">
                    <button wire:click="switchTab('review')"
                        class="px-4 py-2 -mb-px {{ $activeTab === 'review' ? 'border-b-2 border-teal-500 text-teal-600' : 'text-gray-500 hover:text-gray-700' }}">
                        Review Submissions
                    </button>
                    <button wire:click="switchTab('all-submissions')"
                        class="px-4 py-2 -mb-px {{ $activeTab === 'all-submissions' ? 'border-b-2 border-teal-500 text-teal-600' : 'text-gray-500 hover:text-gray-700' }}">
                        All Students
                    </button>
                </div>
            </div>

            <!-- Assignment Details Card -->
            <div class="bg-white">
                <div class="p-6">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">{{ $assignment->title }}</h1>
                            <div class="mt-2 text-sm text-gray-600 space-y-1">
                                <p><span class="font-medium">Course:</span> {{ $assignment->course->title }}</p>
                                <p><span class="font-medium">Batch:</span> {{ $assignment->batch->batch_name }}</p>
                                <p><span class="font-medium">Due Date:</span>
                                    <span
                                        class="{{ Carbon\Carbon::parse($assignment->due_date) < now() ? 'text-red-600' : 'text-gray-600' }}">
                                        {{ Carbon\Carbon::parse($assignment->due_date)->format('M d, Y h:i A') }}
                                    </span>
                                </p>
                            </div>
                            @if($assignment->description)
                                <div class="mt-4">
                                    <h3 class="text-sm font-medium text-gray-900">Description</h3>
                                    <p class="mt-1 text-sm text-gray-600">{{ $assignment->description }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="text-right">
                            <span
                                class="inline-flex items-center rounded-full px-3 py-0.5 text-sm font-medium {{ $assignment->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $assignment->status ? 'Active' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Statistics -->
                <div class="border-t border-gray-200 px-6 py-4">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Total Students</dt>
                            <dd class="mt-1 text-2xl font-semibold text-gray-900">
                                {{ $assignmentStats['total_students'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Submissions</dt>
                            <dd class="mt-1 text-2xl font-semibold text-teal-600">{{ $assignmentStats['submitted'] }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Pending Review</dt>
                            <dd class="mt-1 text-2xl font-semibold text-yellow-600">{{ $assignmentStats['pending'] }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Graded</dt>
                            <dd class="mt-1 text-2xl font-semibold text-green-600">{{ $assignmentStats['graded'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Late Submissions</dt>
                            <dd class="mt-1 text-2xl font-semibold text-red-600">
                                {{ $assignmentStats['late_submissions'] }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Average Grade</dt>
                            <dd class="mt-1 text-2xl font-semibold text-blue-600">
                                {{ number_format($assignmentStats['average_grade'], 1) }}</dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Main Content -->
            @if($activeTab === 'review')
                <div class="p-6 flex flex-col lg:flex-row gap-6 bg-gray-50">
                    <!-- File Preview Section -->
                    <div class="lg:flex-1">
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden h-[calc(100vh-20rem)]">
                            <div class="bg-gray-100 px-4 py-2 flex items-center justify-between">
                                <h3 class="font-medium text-gray-700">Document Preview</h3>
                                @if($selectedFileId)
                                    <button wire:click="closePreview" class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                @endif
                            </div>

                            <div class="h-full bg-gray-800">
                                @if($selectedFileId)
                                    @if(str_ends_with($selectedFileId, '.pdf'))
                                        <iframe src="{{ $selectedFileId }}" class="w-full h-full"></iframe>
                                    @elseif(str_ends_with($selectedFileId, '.docx') || str_ends_with($selectedFileId, '.doc'))
                                        <iframe
                                            src="https://docs.google.com/viewer?url={{ urlencode($selectedFileId) }}&embedded=true"
                                            class="w-full h-full"></iframe>
                                    @elseif(str_ends_with($selectedFileId, '.jpg') || str_ends_with($selectedFileId, '.png') || str_ends_with($selectedFileId, '.jpeg'))
                                        <img src="{{ $selectedFileId }}" alt="Preview" class="w-full h-full object-contain">
                                    @else
                                        <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            <p class="mt-4 text-lg">Unsupported file type for preview</p>
                                        </div>
                                    @endif
                                @else
                                    <div class="flex flex-col items-center justify-center h-full text-gray-400">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p class="mt-4 text-lg">Select a submission to preview</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Student Info & Grading Section -->
                    <div class="lg:w-96">
                        <div class="bg-white rounded-lg shadow-sm">
                            @if($currentStudent)
                                <div class="border-b px-4 py-3 flex items-center justify-between bg-gray-50">
                                    <div class="flex items-center gap-2">
                                        <h3 class="font-medium text-gray-900">Student Review</h3>
                                        <span
                                            class="text-sm text-gray-500">({{ $currentStudentIndex + 1 }}/{{ count($students) }})</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <button wire:click="previousStudent"
                                            class="p-1 rounded hover:bg-gray-200 {{ !$hasPreviousStudent ? 'opacity-50 cursor-not-allowed' : '' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 19l-7-7 7-7" />
                                            </svg>
                                        </button>
                                        <button wire:click="nextStudent"
                                            class="p-1 rounded hover:bg-gray-200 {{ !$hasNextStudent ? 'opacity-50 cursor-not-allowed' : '' }}">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                <div class="p-4 space-y-6">
                                    <!-- Student Details -->
                                    <div class="space-y-4">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-700">Student Name</h4>
                                            <p class="mt-1 text-base font-semibold text-gray-900">{{ $currentStudent['name'] }}
                                            </p>
                                        </div>

                                        <div>
                                            <h4 class="text-sm font-medium text-gray-700">Submission Status</h4>
                                            <p
                                                class="mt-1 {{ $currentStudent['submitted_at'] > $assignment->due_date ? 'text-red-600' : 'text-gray-900' }}">
                                                {{ Carbon\Carbon::parse($currentStudent['submitted_at'])->format('M d, Y h:i A') }}
                                                @if($currentStudent['submitted_at'] > $assignment->due_date)
                                                    <span class="text-sm text-red-500 block">Late submission (-10 marks)</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Submissions List -->
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Submitted Files</h4>
                                        <div class="space-y-2 max-h-40 overflow-y-auto">
                                            @foreach($currentStudent['uploads'] as $index => $upload)
                                                <button wire:click="previewFile('{{ $upload->file_path }}')"
                                                    class="w-full px-3 py-2 text-left text-sm flex items-center gap-2 {{ $selectedFileId === $upload->file_path ? 'bg-teal-50 text-teal-700 border-teal-500' : 'bg-gray-50 hover:bg-gray-100 text-gray-700' }} border rounded-md">
                                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                    </svg>
                                                    <span class="flex-1">Submission {{ $index + 1 }}</span>
                                                    <span class="text-xs text-gray-500">
                                                        {{ Carbon\Carbon::parse($upload->submitted_at)->format('M d, H:i') }}
                                                    </span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Grading -->
                                    <div class="pt-4 border-t">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Grade</label>
                                        <div class="flex items-center space-x-4 mb-4">
                                            <input type="number" wire:model.defer="grade.{{ $currentStudent['id'] }}"
                                                wire:keydown.enter="insertGrade('{{ $currentStudent['id'] }}')"
                                                class="block w-24 px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm"
                                                min="0" max="100" placeholder="Grade">
                                            <span class="text-gray-500">/100</span>
                                            <button wire:click="insertGrade('{{ $currentStudent['id'] }}')"
                                                class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 flex items-center">
                                                <span>Save & Next</span>
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 5l7 7-7 7" />
                                                </svg>
                                            </button>
                                        </div>
                                        @error("grade.{$currentStudent['id']}")
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror

                                        <div class="mt-6 flex justify-end">
                                            <a href="{{ route('admin.assignment.manage') }}"
                                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 inline-flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                                </svg>
                                                Return to Assignments
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="p-6 text-center text-gray-500">
                                    <p>No submissions to review</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <!-- All Students Table -->
                <div class="flex-1 p-6 overflow-auto">
                    <div class="bg-white rounded-lg shadow">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student Name
                                    </th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submission
                                        Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($allStudents as $student)
                                                    <tr class="hover:bg-gray-50">
                                                        <td class="px-6 py-4 whitespace-nowrap">{{ $student['name'] }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="px-2 py-1 text-xs rounded-full 
                                                                    {{ $student['status'] === 'late' ? 'bg-red-100 text-red-800' :
                                    ($student['status'] === 'submitted' ? 'bg-green-100 text-green-800' :
                                        'bg-gray-100 text-gray-800') }}">
                                                                {{ ucfirst($student['status']) }}
                                                                @if($student['status'] === 'late')
                                                                    (-10)
                                                                @endif
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                            {{ $student['submitted_at'] ? Carbon\Carbon::parse($student['submitted_at'])->format('M d, Y H:i') : 'Not submitted' }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                            {{ $student['grade'] ?? 'Not graded' }}
                                                        </td>
                                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Common form control styles that can be added to your CSS -->
    <style>
        .form-input {
            @apply block w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm;
        }

        .form-select {
            @apply block w-full px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm bg-white;
        }
    </style>

</div>
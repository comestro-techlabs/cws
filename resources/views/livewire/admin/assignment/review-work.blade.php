<div>
<div class="min-h-screen bg-gray-50">
    <!-- Full Page Loader -->
    <div wire:loading.flex class="fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white p-4 rounded-lg shadow-lg flex items-center space-x-4">
            <div class="animate-spin rounded-full h-8 w-8 border-4 border-teal-500 border-t-transparent"></div>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>

    <div class="flex flex-col h-screen">
        <!-- Header -->
        <div class="bg-white border-b px-4 py-3">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $assignment->title }}</h2>
                    <p class="text-sm text-gray-500">{{ $assignment->course->title }} - {{ $assignment->batch->batch_name }}</p>
                </div>
                <button onclick="window.history.back()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                    Back
                </button>
            </div>

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

        <!-- Main Content -->
        @if($activeTab === 'review')
            <!-- Existing review interface -->
            <div class="flex-1 flex overflow-hidden">
                <!-- Left Side - File Preview -->
                <div class="w-2/3 bg-gray-800 overflow-hidden">
                    @if($selectedFileId)
                        <iframe src="https://drive.google.com/file/d/{{ $selectedFileId }}/preview"
                            class="w-full h-full border-0"></iframe>
                    @else
                        <div class="flex flex-col items-center justify-center h-full">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="mt-4 text-gray-400 text-lg">Select a submission file to preview</p>
                            <p class="mt-2 text-gray-500 text-sm">Click on any submission from the right panel</p>
                        </div>
                    @endif
                </div>

                <!-- Right Side - Student Info & Grading -->
                <div class="w-1/3 bg-white border-l overflow-y-auto">
                    @if($currentStudent)
                    
                        <div class="p-6">
                            <!-- Student Navigation -->
                            <div class="flex items-center justify-between mb-6">
                                <button wire:click="previousStudent" 
                                    class="p-2 text-gray-600 hover:text-gray-900 {{ $hasPreviousStudent ? '' : 'opacity-50 cursor-not-allowed' }}"
                                    {{ $hasPreviousStudent ? '' : 'disabled' }}>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <span class="text-sm text-gray-600">Student {{ $currentStudentIndex + 1 }} of {{ count($students) }}</span>
                                <button wire:click="nextStudent" 
                                    class="p-2 text-gray-600 hover:text-gray-900 {{ $hasNextStudent ? '' : 'opacity-50 cursor-not-allowed' }}"
                                    {{ $hasNextStudent ? '' : 'disabled' }}>
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>

                            <!-- Student Details -->
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Student Name</label>
                                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $currentStudent['name'] }}</p>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Submission Date</label>
                                    <p class="mt-1 {{ $currentStudent['submitted_at'] > $assignment->due_date ? 'text-red-600 font-medium' : 'text-gray-900' }}">
                                        {{ $currentStudent['submitted_at'] }}
                                        @if($currentStudent['submitted_at'] > $assignment->due_date)
                                            <span class="text-sm text-red-500 ml-2">(Late submission: -10 marks)</span>
                                        @endif
                                    </p>
                                </div>

                                <!-- Submissions List -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Submitted Files</label>
                                    <div class="space-y-2">
                                        @foreach($currentStudent['uploads'] as $index => $upload)
                                            <button wire:click="previewFile('{{ $upload->file_path }}')"
                                                class="w-full px-4 py-2 text-left text-sm {{ $selectedFileId === $upload->file_path ? 'bg-teal-50 text-teal-700 border-teal-500' : 'bg-gray-50 text-gray-700 border-gray-200' }} border rounded-lg hover:bg-gray-100">
                                                Submission {{ $index + 1 }}
                                                <span class="text-xs text-gray-500 ml-2">
                                                    {{ \Carbon\Carbon::parse($upload->submitted_at)->format('M d, H:i') }}
                                                </span>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Grading -->
                                <div class="border-t pt-6">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Grade</label>
                                    <div class="flex items-center space-x-4 mb-4">
                                        <input type="number" 
                                            wire:model.defer="grade.{{ $currentStudent['id'] }}"
                                            wire:keydown.enter="insertGrade('{{ $currentStudent['id'] }}')"
                                            class="block w-24 px-4 py-3 text-base border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 shadow-sm"
                                            min="0"
                                            max="100"
                                            placeholder="Grade">
                                        <span class="text-gray-500">/100</span>
                                        <button wire:click="insertGrade('{{ $currentStudent['id'] }}')"
                                            class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 flex items-center">
                                            <span>Save & Next</span>
                                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                            </svg>
                                            Return to Assignments
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <!-- All Students Table -->
            <div class="flex-1 p-6 overflow-auto">
                <div class="bg-white rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Student Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Submission Date</th>
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
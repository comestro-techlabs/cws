<div class="min-h-screen bg-gray-50">
    <div class="flex flex-col h-screen">
        <!-- Header -->
        <div class="bg-white border-b px-4 py-3 flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-900">{{ $assignment->title }}</h2>
                <p class="text-sm text-gray-500">Review Student Submissions</p>
            </div>
            <button onclick="window.history.back()" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                Back
            </button>
        </div>

        <!-- Main Content -->
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
                                <p class="mt-1 text-gray-900">{{ $currentStudent['submitted_at'] }}</p>
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
                                <div class="flex items-center space-x-4">
                                    <input type="number" 
                                        wire:model.defer="grade.{{ $currentStudent['id'] }}"
                                        class="w-20 rounded-lg border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500"
                                        min="0"
                                        max="100">
                                    <span class="text-gray-500">/100</span>
                                    <button wire:click="insertGrade('{{ $currentStudent['id'] }}')"
                                        class="ml-4 px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                                        Save Grade
                                    </button>
                                </div>
                                @error("grade.{$currentStudent['id']}") 
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

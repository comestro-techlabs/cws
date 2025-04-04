<div>
    <x-loader />
    <x-access-restriction-modal />
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg border border-gray-200">
            <!-- Header with status badge -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <h1 class="text-xl font-bold text-white mb-2 md:mb-0">{{ $assignment?->title }}</h1>
                    @if($hasAccess && $uploadedFile)
                        @php
                            $statusColors = [
                                'submitted' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-800', 'dot' => 'bg-blue-400'],
                                'graded' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'dot' => 'bg-green-400'],
                                'late' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'dot' => 'bg-red-400'],
                                'not_graded' => ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'dot' => 'bg-gray-400'],
                            ];
                            $status = $uploadedFile->status ?? 'not_graded';
                            $colors = $statusColors[$status] ?? $statusColors['not_graded'];
                        @endphp
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $colors['bg'] }} {{ $colors['text'] }}">
                            <span class="w-2 h-2 mr-2 rounded-full {{ $colors['dot'] }}"></span>
                            {{ ucfirst($status) }}
                        </span>
                    @elseif($hasAccess)
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <span class="w-2 h-2 mr-2 rounded-full bg-yellow-400 animate-pulse"></span>
                            Not Submitted
                        </span>
                    @endif
                </div>
            </div>

            <div class="p-6">
                @if($hasAccess)
                    <!-- Full assignment content when user has access -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Left Column - Assignment Details -->
                        <div class="lg:col-span-1 space-y-6">
                            <div class="bg-white rounded-lg border border-gray-200">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h2 class="font-semibold text-gray-900">Assignment Details</h2>
                                </div>
                                <div class="p-4 space-y-4">
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Title</h3>
                                        <p class="mt-1 text-base font-medium text-gray-900">{{ $assignment?->title }}</p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Due Date</h3>
                                        <p class="mt-1 text-base font-medium text-gray-900">{{ $assignment?->due_date ?? 'Not specified' }}</p>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-500">Points</h3>
                                        <p class="mt-1 text-base font-medium text-gray-900">{{ $assignment?->points ?? '100' }} points</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-white rounded-lg border border-gray-200 mb-6">
                                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                    <h2 class="font-semibold text-gray-900">Assignment Description</h2>
                                </div>
                                <div class="p-4 text-gray-800 prose max-w-none">
                                    {!! $assignment?->description !!}
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Submission Details and Upload Form -->
                        <div class="lg:col-span-2">
                            @if ($uploadedFile)
                                <div class="bg-white rounded-lg border border-gray-200">
                                    <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                        <h2 class="font-semibold text-gray-900">Submission Details</h2>
                                    </div>
                                    <div class="p-4 space-y-4">
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500">Submitted on</h3>
                                            <p class="mt-1 text-base font-medium text-gray-900">{{ $uploadedFile->submitted_at }}</p>
                                        </div>
                                        @if($uploadedFile->grade)
                                            <div>
                                                <h3 class="text-sm font-medium text-gray-500">Grade</h3>
                                                <div class="mt-2">
                                                    <span class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white text-2xl font-bold">
                                                        {{ $uploadedFile->grade }}
                                                    </span>
                                                </div>
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="text-sm font-medium text-gray-500">File</h3>
                                            <div class="mt-2 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                </svg>
                                                @if ($previewUrl)
                                                    <iframe src="{{ $previewUrl }}" class="w-full h-64 border border-gray-300 rounded-lg"></iframe>
                                                @else
                                                    <div class="text-gray-500 text-center">
                                                        <p>No file uploaded or preview not available.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (!$uploadedFile)
                                <!-- Upload form when no file has been submitted -->
                                <form wire:submit.prevent="submit" class="space-y-6">
                                    <div class="bg-white rounded-lg border border-gray-200">
                                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                            <h2 class="font-semibold text-gray-900">Submit Your Work</h2>
                                        </div>
                                        <div class="p-5">
                                            <div class="w-full"
                                                x-data="{ isUploading: false, progress: 0, filename: '' }"
                                                x-on:livewire-upload-start="isUploading = true"
                                                x-on:livewire-upload-finish="isUploading = false; progress = 0"
                                                x-on:livewire-upload-error="isUploading = false"
                                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-500 transition-colors duration-200 relative">
                                                    <input type="file" wire:model="file" class="hidden" id="file-upload" 
                                                        x-on:change="filename = $event.target.files[0].name">
                                                    <label for="file-upload" class="cursor-pointer block">
                                                        <template x-if="!filename">
                                                            <div>
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                                </svg>
                                                                <p class="mt-4 text-base font-medium text-gray-700">
                                                                    Drop your file here or click to browse
                                                                </p>
                                                            </div>
                                                        </template>
                                                        <template x-if="filename">
                                                            <div class="flex items-center justify-center space-x-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                                </svg>
                                                                <span class="text-sm font-medium text-gray-900" x-text="filename"></span>
                                                            </div>
                                                        </template>
                                                    </label>
                                                    <div x-show="isUploading" class="mt-4">
                                                        <div class="h-2 bg-gray-200 rounded-full overflow-hidden">
                                                            <div class="h-full bg-blue-600 rounded-full transition-all duration-300"
                                                                :style="'width: ' + progress + '%'"></div>
                                                        </div>
                                                        <div class="text-sm font-medium text-gray-600 mt-2" x-text="progress + '%'"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('file')
                                                <div class="mt-2 flex items-center text-red-500 text-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            wire:loading.attr="disabled"
                                            wire:loading.class="opacity-50 cursor-not-allowed"
                                            class="inline-flex items-center px-6 py-2 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                                            <svg wire:loading.remove xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                            </svg>
                                            <svg wire:loading class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Submit Assignment
                                        </button>
                                    </div>
                                </form>
                            @endif

                            <!-- Flash messages -->
                            @if (session()->has('success'))
                                <div class="bg-green-500 text-white p-3 rounded mb-2 mt-4">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('warning'))
                                <div class="bg-yellow-500 text-white p-3 rounded mb-2 mt-4">
                                    {{ session('warning') }}
                                </div>
                            @endif
                            @if (session()->has('error'))
                                <div class="bg-red-500 text-white p-3 rounded mb-2 mt-4">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- Restriction message when user has no access -->
                    <div class="bg-white rounded-lg border border-gray-200 p-6">
                        <div class="alert alert-warning">
                            <h3 class="text-lg font-semibold text-red-600 mb-2">Access Restricted</h3>
                            <p class="text-gray-700 mb-4">You cannot view or submit this assignment due to the following reasons:</p>
                            <ul class="list-disc list-inside text-gray-600 mb-4">
                                @foreach($accessStatus['reasons'] as $reason)
                                    <li>{{ $reason }}</li>
                                @endforeach
                            </ul>
                            <div class="flex space-x-4">
                              
                                <a href="{{ route('student.assignments-view') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm font-medium hover:bg-gray-50 transition-colors">
                                    Back to Assignments
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
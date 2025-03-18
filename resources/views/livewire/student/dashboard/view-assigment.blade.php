<div class="py-6 px-4 sm:px-6 lg:px-8">
    <!-- Main Container -->
    <div class="bg-white rounded-lg border border-gray-200">
        <!-- Header -->
        <div class="bg-blue-600 px-6 py-5">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <h1 class="text-xl font-bold text-white mb-2 md:mb-0">Assignment Submission</h1>
                @if (!$uploadedFile)
                <span
                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                    <span class="w-2 h-2 mr-2 rounded-full bg-gray-500"></span>
                    Pending Submission
                </span>
                @else
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium 
                        @if($uploadedFile->status == 'submitted') bg-gray-100 text-gray-800
                        @elseif($uploadedFile->status == 'graded') bg-gray-100 text-gray-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                    <span class="w-2 h-2 mr-2 rounded-full 
                            @if($uploadedFile->status == 'submitted') bg-blue-600
                            @elseif($uploadedFile->status == 'graded') bg-green-600
                            @else bg-red-600
                            @endif"></span>
                    {{ ucfirst($uploadedFile->status) }}
                </span>
                @endif
            </div>
        </div>

        <div class="p-6">
            <!-- Two Column Layout for Desktop -->
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
                                <p class="mt-1 text-base font-medium text-gray-900">
                                    {{ $assignment?->due_date ?? 'Not specified' }}
                                </p>
                            </div>

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Points</h3>
                                <p class="mt-1 text-base font-medium text-gray-900">
                                    {{ $assignment?->points ?? '100' }} points
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($uploadedFile)
                    <div class="bg-white rounded-lg border border-gray-200">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h2 class="font-semibold text-gray-900">Submission Details</h2>
                        </div>
                        <div class="p-4 space-y-4">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Submitted on</h3>
                                <p class="mt-1 text-base font-medium text-gray-900">{{ $uploadedFile->submitted_at }}
                                </p>
                            </div>

                            @if($uploadedFile->grade)
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Grade</h3>
                                <div class="mt-2">
                                    <span
                                        class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-600 text-white text-2xl font-bold">
                                        {{ $uploadedFile->grade }}
                                    </span>
                                </div>
                            </div>
                            @endif

                            <div>
                                <h3 class="text-sm font-medium text-gray-500">File</h3>
                                <div class="mt-2 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600 mr-2"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                            clip-rule="evenodd" />
                                    </svg>

                                    @if ($previewUrl)
                                    <iframe src="{{ $previewUrl }}"
                                        class="w-full h-64 border border-gray-300 rounded-lg"></iframe>
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
                </div>

                <!-- Right Column - Description and Upload Form -->
                <div class="lg:col-span-2">
                    <!-- Assignment Description -->
                    <div class="bg-white rounded-lg border border-gray-200 mb-6">
                        <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                            <h2 class="font-semibold text-gray-900">Assignment Description</h2>
                        </div>
                        <div class="p-4 text-gray-800 prose max-w-none">
                            {!! $assignment?->description !!}
                        </div>
                    </div>

                    @if (!$uploadedFile)
                    <!-- Upload Form -->
                    <form wire:submit.prevent="submit" class="space-y-6">
                        <div class="bg-white rounded-lg border border-gray-200">
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                                <h2 class="font-semibold text-gray-900">Upload Your Assignment</h2>
                            </div>

                            <div class="p-5">
                                <div class="w-12/12">
                                    <div
                                        class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:bg-gray-50 transition-colors duration-200">
                                        <input type="file" wire:model="file" class="hidden" id="file-upload">
                                        <label for="file-upload" class="cursor-pointer block">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                            </svg>
                                            <p class="mt-4 text-base font-medium text-gray-700">
                                                Drag and drop your file here or click to browse
                                            </p>
                                            <p class="mt-2 text-sm text-gray-500">
                                                PDF, DOC, DOCX up to 10MB
                                            </p>
                                        </label>
                                    </div>
                                </div>

                                <!-- Validation Error -->
                                @error('file')
                                <div class="mt-2 flex items-center text-red-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </div>
                                @enderror

                                <!-- Loading State -->
                                <div wire:loading wire:target="file"
                                    class="mt-3 flex items-center text-gray-600 text-sm">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-gray-600"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                            stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor"
                                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                        </path>
                                    </svg>
                                    Uploading...
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 border border-transparent text-base font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                                Submit Assignment
                            </button>
                        </div>
                    </form>
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

                    @endif
                </div>
            </div>

            <!-- Notifications -->
            @if (session()->has('msg'))
            <div class="mt-6 bg-gray-50 border border-gray-200 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-700">
                            {{ session('msg') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif

            @if (session()->has('error'))
            <div class="mt-6 bg-gray-50 border border-gray-200 p-4 rounded-md">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-gray-700">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
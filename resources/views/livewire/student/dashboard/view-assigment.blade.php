<div class="py-12 max-w-4xl mx-auto px-4">
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-5">
            <h1 class="text-2xl font-bold text-white">Upload Assignment</h1>
        </div>

        <div class="p-6">
            <!-- Assignment Details -->
            <div class="space-y-6 mb-8">
                <div class="bg-gray-50 rounded-lg overflow-hidden">
                    <div class="bg-purple-100 px-4 py-3 border-l-4 border-purple-500">
                        <h2 class="font-semibold text-purple-800">Assignment Title</h2>
                    </div>
                    <div class="p-4 text-gray-800">
                        {{ $assignment?->title }}
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg overflow-hidden">
                    <div class="bg-purple-100 px-4 py-3 border-l-4 border-purple-500">
                        <h2 class="font-semibold text-purple-800">Assignment Description</h2>
                    </div>
                    <div class="p-4 text-gray-800 prose max-w-none">
                        {!! $assignment?->description !!}
                    </div>
                </div>
            </div>

            <!-- Submission Section -->
            @if ($uploadedFile)
                <div class="bg-green-50 rounded-lg overflow-hidden border border-green-200">
                    <div class="bg-green-100 px-4 py-3 border-l-4 border-green-500 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-green-600" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <h2 class="font-semibold text-green-800">Submission Details</h2>
                    </div>

                    <div class="p-5 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <span class="font-medium text-gray-700 w-40">Submitted on:</span>
                            <span class="text-gray-800">{{ $uploadedFile->submitted_at }}</span>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center">
                            <span class="font-medium text-gray-700 w-40">Status:</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($uploadedFile->status == 'submitted') bg-green-100 text-green-800
                                @elseif($uploadedFile->status == 'graded') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                <span class="w-2 h-2 mr-2 rounded-full
                                    @if($uploadedFile->status == 'submitted') bg-green-500
                                    @elseif($uploadedFile->status == 'graded') bg-blue-500
                                    @else bg-red-500
                                    @endif"></span>
                                {{ ucfirst($uploadedFile->status) }}
                            </span>
                        </div>

                        <div class="flex flex-col sm:flex-row">
                            <span class="font-medium text-gray-700 w-40 sm:mt-1">Grade:</span>
                            @if($uploadedFile->grade)
                                <div class="bg-yellow-100 text-yellow-800 px-4 py-2 rounded-lg font-semibold text-xl text-center w-20">
                                    {{ $uploadedFile->grade }}
                                </div>
                            @else
                                <div class="flex items-center text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Your grade is being processed. Please check back later.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="submit" class="space-y-6">
                    <div class="bg-gray-50 rounded-lg overflow-hidden">
                        <div class="bg-blue-100 px-4 py-3 border-l-4 border-blue-500">
                            <h2 class="font-semibold text-blue-800">Attach File</h2>
                        </div>

                        <div class="p-5">
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:bg-gray-50 transition-colors">
                                <input type="file" wire:model="file" class="hidden" id="file-upload">
                                <label for="file-upload" class="cursor-pointer block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="mt-2 text-sm font-medium text-gray-600">
                                        Click to browse files
                                    </p>
                                    <p class="mt-1 text-xs text-gray-500">
                                        PDF, DOC, DOCX up to 10MB
                                    </p>
                                </label>
                            </div>

                            <!-- Validation Error -->
                            @error('file')
                                <div class="mt-2 flex items-center text-red-500 text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                    {{ $message }}
                                </div>
                            @enderror

                            <!-- Loading State -->
                            <div wire:loading wire:target="file" class="mt-3 flex items-center text-blue-500 text-sm">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Uploading...
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                            Upload File
                        </button>
                    </div>
                </form>
            @endif

            <!-- Notifications -->
            @if (session()->has('msg'))
                <div class="mt-6 bg-green-50 border-l-4 border-green-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                {{ session('msg') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mt-6 bg-red-50 border-l-4 border-red-500 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ session('error') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

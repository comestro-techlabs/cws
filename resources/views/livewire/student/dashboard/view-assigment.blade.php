<div>
    <div class="py-12">
        <div class="mx-auto bg-white rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6 text-gray-800">Upload Assignment</h1>

            <div class="mb-6">
                <label class="block bg-gray-100 text-gray-600 w-full py-2 px-3 font-medium rounded-t-md">Assignment
                    Title</label>
                <p class="bg-gray-50 border border-gray-200 rounded-b-md py-3 px-4 text-gray-800">
                    {{ $assignment?->title }}</p>
            </div>

            <div class="mb-6">
                <label class="block bg-gray-100 text-gray-600 w-full py-2 px-3 font-medium rounded-t-md">Assignment
                    Description</label>
                <div class="bg-gray-50 border border-gray-200 rounded-b-md py-3 px-4 text-gray-800">
                    {!! $assignment?->description !!}
                </div>
            </div>

            @if ($uploadedFile)
                <div class="mb-6">
                    <label class="block bg-green-100 text-green-600 w-full py-2 px-3 font-medium rounded-t-md">Submission
                        Details</label>
                    <div class="bg-green-50 border border-green-200 rounded-b-md p-4">
                        <p class="text-gray-800"><strong>Submitted on:</strong> {{ $uploadedFile->submitted_at }}</p>
                        <p class="text-gray-800 mt-2"><strong>Status:</strong>
                            <span class="
                                @if($uploadedFile->status == 'submitted') text-green-500
                                @elseif($uploadedFile->status == 'graded') text-blue-500
                                @else text-red-500
                                @endif
                            ">
                                {{ ucfirst($uploadedFile->status) }}
                            </span>
                        </p>
                        <p class="text-gray-800 mt-2"><strong>Grade:</strong>
                            @if($uploadedFile->grade)
                                <span class="text-yellow-500">{{ $uploadedFile->grade }}</span>
                            @else
                                <span class="text-gray-500">Your grade is being processed. Please check back later.</span>
                            @endif
                        </p>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="submit">
                    <div class="mb-6">
                        <label class="block bg-gray-100 text-gray-600 w-full py-2 px-3 font-medium rounded-t-md">
                            Attach File
                        </label>
                        <div class="bg-gray-50 border border-gray-200 rounded-b-md p-4">
                            <!-- File Input -->
                            <input type="file" wire:model="file" class="block w-full border border-gray-300 rounded-md p-2">
                            <!-- Validation Error -->
                            @error('file')
                                <span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Loading State -->
                    <div wire:loading wire:target="file" class="text-blue-500">Uploading...</div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 cursor-pointer text-white font-medium px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-300 transition duration-200">
                            Upload File
                        </button>
                    </div>
                </form>
            @endif

            <!-- Success Message -->
            @if (session()->has('msg'))
                <div class="mt-4 text-green-600">
                    {{ session('msg') }}
                </div>
            @endif

            <!-- Error Message -->
            @if (session()->has('error'))
                <div class="mt-4 text-red-600">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
</div>
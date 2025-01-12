@extends('studentDashboard.include.base')

@section('title', 'Upload Assignment File')

@section('content')
<div class="bg-gray-100 p-6 mt-12">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Upload Assignment</h2>

        <!-- Display Assignment Details -->
        <div class="mb-6">
            <label class="block bg-gray-100 w-full py-2 px-3 rounded-sm font-medium mb-2">Assignment Title</label>
            <p class="text-lg p-3 rounded-md">{{ $assignment->title }}</p>
        </div>

        <div class="">
            <label class="block bg-gray-100 w-full py-2 px-3 rounded-sm font-medium">Assignment Description</label>
            <p class="px-3 rounded-md">{!! $assignment->description !!}</p>
        </div>

        <!-- Check if file is already uploaded -->
        @if ($uploadedFile)
            <!-- Show Uploaded File Information -->
            <div class="mb-6">
                {{-- <label class="block bg-gray-100 w-full py-2 px-3 rounded-sm font-medium">Uploaded File</label> --}}
                <p class="p-3 rounded-md text-green-600">You have  uploaded this assignment.</p>
                {{-- <a href="{{ asset('storage/uploads/' . $uploadedFile->file_path) }}" 
                    target="_blank" 
                    class="text-blue-500 hover:underline inline-flex items-center mt-4">
                     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image mr-2" viewBox="0 0 16 16">
                         <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                         <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z"/>
                     </svg>
                     View Assignment
                 </a> --}}
                <p class="text-gray-600 mt-2">Submitted on: {{ $uploadedFile->submitted_at }}</p>
              
            
            <p class="text-gray-600 mt-1">Status: 
                <span class="
                    @if($uploadedFile->status == 'submitted') text-green-500
                    @elseif($uploadedFile->status == 'graded') text-blue-500 
                    @else text-red-500 
                    @endif
                ">
                    {{ ucfirst($uploadedFile->status) }}
                </span>
            </p>
            
            <p class="text-gray-600 mt-1">Grade: 
                @if($uploadedFile->grade)
                    <span class="text-yellow-500">{{ $uploadedFile->grade }}</span>
                @else
                    <span class="text-gray-500">Your grade is being processed. Please check back later.</span>
                @endif
            </p>
            
            
          
                            
            </div>
        @else
            <!-- Show Upload Form -->
            <form action="{{ route('assignments.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4 border-2 px-5 rounded-lg py-5">
                    <label for="attach" class="block text-gray-700">Attach</label>
                    <div class="flex flex-1 justify-center items-center gap-7">
                        <div>
                            <div class="flex items-center space-x-2">
                                <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                                <input type="file" name="file_path" id="file-upload" required />
                            </div>
                            <span class="text-gray-600 ml-2">Drive</span>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    @error('file_path')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <button type="submit"
                            class="bg-green-500 text-white font-medium px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                        Upload File
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@extends('studentDashboard.include.base')

@section('title', 'Upload Assignment File')

@section('content')
<div class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Upload Assignment</h2>

        <!-- Display Assignment Details -->
       @foreach ($assignments as $assignment)
       <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2">Assignment Title</label>
        <p class="text-lg bg-gray-100 p-3 rounded-md">{{ $assignment->title }}</p>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2">Assignment Description</label>
        <p class="bg-gray-100 p-3 rounded-md">{!! $assignment->description !!}</p>
    </div>
       @endforeach

        <!-- Upload File Form -->
        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- File Upload -->
            {{-- <div class="mb-6">
                <label for="file" class="block text-gray-700 font-medium mb-2">Upload File</label>
                <input type="file" name="file" id="file" 
                       class="w-full h-12 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-300" 
                       required>
                @error('file')
                <span class="text-sm text-red-500">{{ $message }}</span>
                @enderror
            </div> --}}
            <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

                <div class="mb-4 border-2 px-5 rounded-lg py-5">
                    <label for="attach" class="block text-gray-700">Attach</label>
                    <div class="flex flex-1 justify-center items-center gap-7 ">
                        <div>
                            <div class="flex items-center space-x-2">
                                <input type="file" name="file_path" id="file-upload"  />
                                {{-- <label for="file-upload"
                                    class="flex items-center space-x-2 cursor-pointer border-2 border-gray-300 rounded-full px-2 py-2 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>

                                </label> --}}

                            </div>
                            <span class="text-gray-600 ml-2">Upload</span>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <input type="file" id="file-upload" class="hidden" />
                                <label for="file-upload"
                                    class="flex items-center space-x-2 cursor-pointer border-2 border-gray-300 rounded-full px-2 py-2 hover:bg-gray-100">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-link" viewBox="0 0 16 16">
                                        <path d="M6.354 5.5H4a3 3 0 0 0 0 6h3a3 3 0 0 0 2.83-4H9q-.13 0-.25.031A2 2 0 0 1 7 10.5H4a2 2 0 1 1 0-4h1.535c.218-.376.495-.714.82-1z"/>
                                        <path d="M9 5.5a3 3 0 0 0-2.83 4h1.098A2 2 0 0 1 9 6.5h3a2 2 0 1 1 0 4h-1.535a4 4 0 0 1-.82 1H12a3 3 0 1 0 0-6z"/>
                                      </svg>
                                </label>

                            </div>
                            <span class="text-gray-600 ml-2">Link</span>
                        </div>
                        <div>
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('assignments.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <input type="file" name="file_path" id="file-upload" />
                                <button type="submit">upload</button>
                                @error('file_path')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                {{-- <label for="file-upload"
                                    class="flex items-center space-x-2 cursor-pointer border-2 border-gray-300 rounded-full px-2 py-2 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                        viewBox="0 0 48 48">
                                        <path fill="#FFC107" d="M17 6L31 6 45 30 31 30z"></path>
                                        <path fill="#1976D2" d="M9.875 42L16.938 30 45 30 38 42z"></path>
                                        <path fill="#4CAF50" d="M3 30.125L9.875 42 24 18 17 6z"></path>
                                    </svg>

                                </label> --}}
                            </form>

                            </div>
                            <span class="text-gray-600 ml-2">Drive</span>
                        </div>
                    </div>
                    
                </div>


            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-500 text-white font-medium px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    Upload File
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

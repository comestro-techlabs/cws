@extends('studentDashboard.include.base')

@section('title', 'Upload Assignment File')

@section('content')
<div class="bg-gray-100 p-6">
    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg p-6">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">Upload Assignment</h2>

        <!-- Display Assignment Details -->
       {{-- @foreach ($assignments as $assignment) --}}
       <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2">Assignment Title</label>
        <p class="text-lg bg-gray-100 p-3 rounded-md">{{ $assignment->title }}</p>
    </div>

    <div class="mb-6">
        <label class="block text-gray-700 font-medium mb-2">Assignment Description</label>
        <p class="bg-gray-100 p-3 rounded-md">{!! $assignment->description !!}</p>
    </div>
       {{-- @endforeach --}}

        <!-- Upload File Form -->
        <form action="{{ route('assignments.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

           

                <div class="mb-4 border-2 px-5 rounded-lg py-5">
                    <label for="attach" class="block text-gray-700">Attach</label>
                    <div class="flex flex-1 justify-center items-center gap-7 ">
                       
                        
                        <div>
                            <div class="flex items-center space-x-2">
                                   
                                    <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

                                <input type="file" name="file_path" id="file-upload" />
                                {{-- <button type="submit">upload</button> --}}
                               
                               
                           

                            </div>
                            <span class="text-gray-600 ml-2">Drive</span>
                        </div>
                    </div>
                    
                </div>


            <!-- Submit Button -->
            <div class="flex justify-end">
                @error('file_path')
                <span class="text-danger">{{$message}}</span>
            @enderror
                <button type="submit"
                        class="bg-green-500 text-white font-medium px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:ring-2 focus:ring-blue-300">
                    Upload File
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

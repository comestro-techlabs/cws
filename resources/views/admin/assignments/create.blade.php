@extends('admin.base')

@section('title', 'Add assigment | ')

@section('content')
    <div class="bg-gray-100  min-h-screen">
        <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-9/12 mt-12 p-6 bg-white mx-4 md:mx-6 shadow-md rounded-lg">
                <div class="max-w-xl mx-auto p-6 bg-white shadow-md rounded-lg">
                    <h2 class="text-2xl font-bold mb-6 text-gray-800">Create Assignment</h2>
                    <form action="{{ route('assignment.store') }}" method="POST">
                        @csrf
                
                        <!-- Assignment Title -->
                        <div class="mb-4">
                            <input type="text" name="title" id="title"
                                class="w-full mt-1 bg-gray-50 h-14 border-gray-100 p-2 border-0 border-b-2 focus:outline-none focus:ring-2 focus:ring-blue-300"
                                placeholder="Enter Assignment name" required>
                            @error('title')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Instructions -->
                        <div class="mb-4">
                            <textarea name="description" id="editor"
                                class="w-full h-32 mt-1 p-2 border-0 border-b-2 border-gray-300 rounded-md"
                                placeholder="Enter instructions (optional)"></textarea>
                            @error('description')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Course Dropdown -->
                        <div class="mb-4">
                            <select name="course_id" id="course_id"
                                class="w-full h-14 bg-gray-50 p-2 border-0 border-b-2 border-gray-300 "
                                required>
                                <option value="" disabled selected>Select a course</option>
                                @foreach ($courses as $course)
                                <option value="{{$course->id}}">{{ $course->title }}</option>
                                @endforeach
                            </select>
                            @error('course_id')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                
                        <!-- Submit Button -->
                        
                        <div class="flex">
                            <button type="submit"
                                class="bg-blue-500 text-white px-6 py-2 rounded-md shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                Create Assignment
                            </button>
                        </div>
                    </form>
                </div>
                
                {{-- <div class="mb-4 border-2 px-5 rounded-lg py-5">
                    <label for="attach" class="block text-gray-700">Attach</label>
                    <div class="flex flex-1 justify-center items-center gap-7 ">
                        <div>
                            <div class="flex items-center space-x-2">
                                <input type="file" id="file-upload" class="hidden" />
                                <label for="file-upload"
                                    class="flex items-center space-x-2 cursor-pointer border-2 border-gray-300 rounded-full px-2 py-2 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>

                                </label>

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
                                <input type="file" id="file-upload" class="hidden" />
                                <label for="file-upload"
                                    class="flex items-center space-x-2 cursor-pointer border-2 border-gray-300 rounded-full px-2 py-2 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25"
                                        viewBox="0 0 48 48">
                                        <path fill="#FFC107" d="M17 6L31 6 45 30 31 30z"></path>
                                        <path fill="#1976D2" d="M9.875 42L16.938 30 45 30 38 42z"></path>
                                        <path fill="#4CAF50" d="M3 30.125L9.875 42 24 18 17 6z"></path>
                                    </svg>

                                </label>

                            </div>
                            <span class="text-gray-600 ml-2">Drive</span>
                        </div>
                    </div>
                </div> --}}



            </div>
            {{-- <div class="w-3/12 mx-auto p-6 bg-white shadow-md rounded-lg">
                <!-- Title Section -->
                <div class="mb-4">
                    <label for="title" class="block text-gray-700">Title</label>
                    <input type="text" id="title"
                        class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter title">
                </div>

                <!-- Instructions Section -->
                <div class="mb-4">
                    <label for="instructions" class="block text-gray-700">Instructions (optional)</label>
                    <textarea id="instructions" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter instructions"></textarea>
                </div>




            </div> --}}

        </div>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

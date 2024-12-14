@extends('admin.base')

@section('title', 'Add assigment | ')

@section('content')
    <div class="bg-gray-100 h-screen">
        <div class="flex flex-1">
            <div class="w-9/12  p-6 bg-white mx-12 shadow-md rounded-lg">
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
                    <textarea id="editor" class="w-full mt-1 p-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter instructions"></textarea>
                </div>
                <div class="mb-4">
                    <label for="attach" class="block text-gray-700">attach</label>
                    <div class="flex flex-1">
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
                                    

                                </label>

                            </div>
                            <span class="text-gray-600 ml-2">Upload</span>
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
                            <span class="text-gray-600 ml-2">Upload</span>
                        </div>
                    </div>
                </div>



            </div>
            <div class="w-3/12 mx-auto p-6 bg-white shadow-md rounded-lg">
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




            </div>

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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar Design</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <!-- Navbar -->
    <p class="text-sm font-medium bg-white text-gray-700">{{ $assignment->title }}</p>
    <div class="flex  items-center justify-between px-6 py-3 bg-white shadow-md">
        <!-- Left Section -->
        <div class="relative space-y-2">
            <div class="flex items-center space-x-3">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-orange-500 text-white">
                    S
                </div>
                {{-- {{$students}} --}}


                <div class="bg-gray-100 w-64 px-2 flex justif y-between py-2 cursor-pointer" onclick="toggleContent()">
                    <div id="upload-container">
                        @if ($assignment->uploads->isNotEmpty())
                            @foreach ($assignment->uploads as $index => $item)
                                <p onclick="showStudentData({{ $index }}) class="text-sm font-medium text-black"
                                    id="student-{{ $index }}" style="display: none;">
                                    {{ $item->user->name }}
                                </p>
                            @endforeach
                        @else
                            <p>No students found for this assignment.</p>
                        @endif
                    </div>

                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-arrow-down transition-transform transform" id="toggle-icon"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z" />
                        </svg>
                    </div>
                </div>
                <!-- Hidden content -->

            </div>
            <div id="toggle-content" class="hidden absolute bg-gray-50 border w-80 border-gray-300 rounded-lg p-4 z-10">
                @foreach ($students as $studentData)
                    <p class="text-sm text-gray-700">{{ $studentData['name'] }}</p>
                @endforeach
            </div>

        </div>



        <!-- Center Section -->
        <div class="text-gray-500">

            {{-- <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
            </button>

            <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                </svg>
            </button> --}}
            <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300" id="prev-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
            </button>

            <!-- Next Button -->
            <button class="p-2 bg-gray-200 rounded-full hover:bg-gray-300" id="next-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                </svg>
            </button>
        </div>

        <!-- Right Section -->
        <div class="flex items-center space-x-4">
            <!-- Icon 1 -->


            <!-- Profile Icon -->
            <div class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold">
                S
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Sarita Kumari</p>
                <p class="text-xs text-green-500">Turned in</p>
            </div>
        </div>
    </div>



    <div class="flex w-full">
        {{-- <div class="w-9/12 bg-yellow-100 h-screen">
            <div class="w-full h-full border rounded-lg mt-4">
                @if ($assignment->uploads->isNotEmpty())
                    @foreach ($assignment->uploads as $item)
                        <iframe src="https://drive.google.com/file/d/{{ $item->file_path }}/preview"
                            class="w-full h-[500px] border rounded-lg">
                        </iframe>
                    @endforeach
                @else
                    <p>No uploads found for this assignment.</p>
                @endif
            </div>
        </div> --}}
        <div class="w-9/12 bg-yellow-100 h-screen">
            <div class="w-full h-full border rounded-lg mt-4">
                <div id="upload-container">
                    @if ($assignment->uploads->isNotEmpty())
                        @foreach ($assignment->uploads as $index => $item)
                            <iframe id="upload-{{ $index }}"
                                src="https://drive.google.com/file/d/{{ $item->file_path }}/preview"
                                class="w-full h-[500px] border rounded-lg" style="display: none;">
                            </iframe>
                        @endforeach
                    @else
                        <p>No uploads found for this assignment.</p>
                    @endif
                </div>
            </div>
        </div>



        <div class="w-3/12  mt-7">
            <div class="h-screen bg-white shadow-md rounded-lg p-4">
                <!-- File Section -->
                <div id="image-container" class="border-b pb-4">
                    <h2 class="text-gray-700 text-lg font-medium">Files</h2>
                    <p class="text-sm text-gray-500 mt-1">Turned in on Dec 24, 1:19 PM</p>
                
                    @foreach ($assignment->uploads as $index => $item)
                    <div id="image-{{ $index }}" class="mt-4 flex items-center" style="{{ $index === 0 ? 'display: flex;' : 'display: none;' }}">
                        <p class="text-sm font-medium text-gray-700">
                            <a href="https://drive.google.com/file/d/{{ $item->file_path }}/view" target="_blank" class="text-blue-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                    <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0" />
                                    <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54L1 12.5v-9a.5.5 0 0 1 .5-.5z" />
                                </svg>
                            </a>
                            {{ $item->file_name }}
                        </p>
                        {{-- <button class="ml-auto text-gray-500 hover:text-gray-700" id="next-btn">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button> --}}
                    </div>
                    @endforeach
                </div>

                <!-- Grade Section -->
                <div id="grade-container">
                    @foreach ($students as $index => $student)
                        <div class="mt-4 grade-form" id="grade-{{ $index }}" style="display: none;">
                            <form
                                action="{{ route('assignments.insertGrade', ['assignmentId' => $assignment->id, 'studentId' => $student['uploads']->first()->student_id]) }}"
                                method="POST">
                                @csrf
                                <h3 class="text-gray-700 text-sm font-medium">Grade</h3>
                                <div class="flex items-center mt-2">

                                    <input type="text" name="grade" required placeholder="/100"
                                        class="w-16 text-gray-700 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none px-2 py-1 text-center" />
                                    <button type="submit" class="ml-auto text-gray-500 hover:text-gray-700">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 12h14m-7-7v14" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>



                <!-- Private Comments Section -->
                {{-- <div class="mt-4">
              <h3 class="text-gray-700 text-sm font-medium">Private comments</h3>
              <textarea
                class="w-full mt-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:outline-none px-2 py-1 text-sm text-gray-700"
                placeholder="Add private comment..."
              ></textarea>
              <button class="mt-2 bg-blue-500 text-white text-sm font-medium rounded-md px-4 py-2 hover:bg-blue-600">
                Post
              </button>
            </div> --}}
            </div>

        </div>
    </div>

    </div>
</body>

</html>
<script>
    function toggleContent() {
        const content = document.getElementById('toggle-content');
        const icon = document.getElementById('toggle-icon');
        content.classList.toggle('hidden');
        icon.classList.toggle('rotate-180');

    }
</script>

<script>
    let currentIndex = 0; // Start at the first file

    const uploads = document.querySelectorAll('#upload-container iframe');
    const students = document.querySelectorAll('#upload-container p');
    const gradeForms = document.querySelectorAll('.grade-form');
    const uploadContainers = document.querySelectorAll('#image-container > div.mt-4');

    const prevButton = document.getElementById('prev-btn');
    const nextButton = document.getElementById('next-btn');

    // Display the first iframe
    if (uploads.length > 0) {
        uploads[currentIndex].style.display = 'block';
        students[currentIndex].style.display = 'block';
        gradeForms[currentIndex].style.display = 'block';
        uploadContainers[currentIndex].style.display = 'block';

    }

    // Show previous file
    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            uploads[currentIndex].style.display = 'none';
            students[currentIndex].style.display = 'none';
            gradeForms[currentIndex].style.display = 'none';
            uploadContainers[currentIndex].style.display = 'none';
            

            currentIndex--;
            uploads[currentIndex].style.display = 'block';
            students[currentIndex].style.display = 'block';
            gradeForms[currentIndex].style.display = 'block';
            uploadContainers[currentIndex].style.display = 'block';

        }
    });

    // Show next file
    nextButton.addEventListener('click', () => {
        if (currentIndex < uploads.length - 1) {
            uploads[currentIndex].style.display = 'none';
            students[currentIndex].style.display = 'none';
            gradeForms[currentIndex].style.display = 'none';
            uploadContainers[currentIndex].style.display = 'none';

            currentIndex++;
            uploads[currentIndex].style.display = 'block';
            students[currentIndex].style.display = 'block';
            gradeForms[currentIndex].style.display = 'block';
            uploadContainers[currentIndex].style.display = 'block';

        }
    });
    //   
</script>

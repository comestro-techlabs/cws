@extends('studentdashboard.include.base')
@section('content')
    <!-- Header Layout Content -->
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error!',
                text: "{{ session('error') }}",
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    <div class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page"
        style="">

        @if ($courses->isEmpty())
            <div class="flex flex-col items-center justify-center md:mt-16 lg:mt-20 px-6 md:px-4 space-y-6">

                <!-- Card Container -->
                <div class="bg-white rounded-lg p-6 md:p-8 w-full text-center">

                    <!-- Welcome Heading -->
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        🎉 Welcome to Learn Syntax!
                    </h2>

                    <!-- Subheading -->
                    <p class="text-gray-600 text-md md:text-lg mt-2">
                        Get access to premium courses and start learning today!
                    </p>
                    <h3 class="text-lg font-semibold mt-5">🔥 Exclusive Membership Offer!</h3>
                    <p class="text-gray-600 text-md md:text-lg mt-2">
                        Get <strong>unlimited access</strong> to <strong>any course</strong> for just
                        <span class="text-xl font-bold text-red-600">₹700/month</span>!
                        Save big and accelerate your learning.
                    </p>

                    <!-- Call-to-Action Button -->
                    <a href="{{ route('student.course') }}" class="mt-4 inline-block">
                        <button
                            class="px-6 py-3 bg-sky-700 text-white text-md font-semibold rounded-lg hover:bg-purple-700 transition-all duration-500">
                            Explore Courses
                        </button>
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">
                <!-- Courses Section -->
                <div class="px-6 py-3 rounded-lg border border-slate-200 lg:col-span-2">
                    <h2 class="text-md font-medium mb-4 text-gray-600">My Courses</h2>
                    <ul class="space-y-4">
                        @foreach ($payments as $payment)
                            <li class="bg-slate-50 p-4 rounded-lg flex justify-between items-center gap-4">
                                <!-- Course Image -->
                                <div class="flex items-center gap-4">
                                    <img src="{{ asset('storage/course_images/' . $payment->course->course_image) }}"
                                        alt="Course Image" class="w-16 h-16 rounded-full object-cover shadow-sm">

                                    <!-- Course Details -->
                                    <div>
                                        <span
                                            class="text-slate-700 font-semibold text-lg">{{ $payment->course->title }}</span>
                                        <p class="text-sm text-gray-500">Duration: {{ $payment->course->duration }} hours
                                        </p>
                                        <p class="text-sm text-gray-500">Batch: </p>
                                    </div>
                                </div>

                                <!-- Progress Bar -->
                                <div class="flex flex-col items-end">
                                    <div class="w-40 bg-gray-200 rounded-full overflow-hidden h-4">
                                        <div class="bg-blue-500 h-4" style="width: {{ $payment->progress }}%;"></div>
                                    </div>
                                    <span class="text-sm text-gray-500 mt-2">
                                        Progress: <span class="text-green-500 font-medium">{{ $payment->progress }}%</span>
                                    </span>
                                </div>
                            </li>
                        @endforeach


                    </ul>
                </div>


                <!-- Assignments Section -->
                <div class="border border-slate-200 px-6 py-3 rounded-lg lg:col-span-1">
                    <h2 class="text-md font-medium mb-4 text-gray-600">Assignments</h2>
                    <ul class="space-y-4">
                        @if ($assignments->isNotEmpty())
                            @foreach ($assignments as $assignment)
                                <li class="p-4 rounded-lg flex justify-between items-center shadow-sm">
                                    <!-- Assignment Title -->
                                    <span class="text-gray-800 font-semibold">📜 {{ $assignment->title }}</span>

                                    <!-- Upload Status -->
                                    <span class="flex flex-col items-end">
                                        @if ($assignment->uploads->isNotEmpty())
                                            @foreach ($assignment->uploads as $upload)
                                                <span
                                                    class="px-3 py-1 rounded-lg text-white text-sm font-medium
                                                    @if ($upload->status == 'submitted') bg-green-500
                                                    @elseif($upload->status == 'graded') bg-blue-500
                                                    @else bg-gray-500 @endif">
                                                    {{ ucfirst($upload->status) }}
                                                </span>
                                            @endforeach
                                        @else
                                            <span class="text-gray-500 text-sm">No uploads</span>
                                        @endif
                                    </span>
                                </li>
                            @endforeach
                        @else
                            <p class="text-center text-gray-500">No Assignments available</p>
                        @endif
                    </ul>
                </div>


                <!-- Notifications Section -->
                <div class="px-6 py-3  rounded-lg border border-slate-200 lg:col-span-1 h-[300px]">
                    <h2 class="text-md font-medium mb-4 text-gray-600">Notifications</h2>
                    <ul class="space-y-4 overflow-y-scroll">
                        <li class="bg-gray-50 p-4 rounded-lg text-slate-700">New quiz available for "Data
                            Structures".</li>
                        <li class="bg-gray-50 p-4 rounded-lg text-slate-700">Assignment 2 deadline extended.</li>
                        <li class="bg-gray-50 p-4 rounded-lg text-slate-700">Web Dev project submissions start
                            next week.</li>

                    </ul>
                </div>

                <!-- Quiz Scores -->
                <div class="text-gray-700 px-6 py-3 rounded-lg border border-slate-200 lg:col-span-1">
                    <h2 class="text-md font-medium mb-4 text-gray-600">Last Quiz Scores</h2>
                    <ul class="space-y-4">
                        @forelse ($exams as $exam)
                            <li class="bg-gray-50 p-4 rounded-lg flex justify-between items-center">
                                <span class="text-white text-bold">📝 {{ $exam->exam->exam_name }}</span>
                                {{-- {{ dd($exam) }} --}}
                                <span class="text-blue-400 font-medium">{{ $exam->total_marks }}%</span>
                            </li>
                        @empty
                            <p class="text-center text-gray-500">No Exam available</p>
                        @endforelse
                    </ul>
                </div>

                <!-- membership button -->


            </div>
    </div>
    @endif
@endsection

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonText: 'OK',
            confirmButtonColor: '#662d91'
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: "{{ session('error') }}",
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#662d91'
        });
    </script>
@endif

<div
    class="mdk-header-layout__content mdk-header-layout__content--fullbleed mdk-header-layout__content--scrollable page pt-6 pb-12">
    @if ($courses->isEmpty())
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-purple-700 to-purple-800 px-6 py-8 text-white">
                    <h2 class="text-3xl font-bold">🎉 Welcome to Learn Syntax!</h2>
                    <p class="text-lg mt-2 text-purple-50">Get access to premium courses and start learning today!</p>
                </div>

                <div class="p-6 md:p-8">
                    <div class="mb-6 bg-orange-50 border-l-4 border-orange-500 p-4 rounded-r-lg">
                        <h3 class="text-xl font-semibold text-gray-800">🔥 Exclusive Membership Offer!</h3>
                        <p class="text-gray-700 mt-2">
                            Get <strong>unlimited access</strong> to <strong>any course</strong> for just
                            <span class="text-xl font-bold text-orange-600">₹700/month</span>!
                            Save big and accelerate your learning.
                        </p>
                    </div>

                    <div class="text-center">
                        <a wire:navigate href="{{ route('v2.student.mycourses') }}">
                            <button
                                class="px-6 py-3 bg-orange-500 text-white font-semibold rounded-lg hover:bg-orange-600 focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition duration-200">
                                Explore Courses
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Courses Section -->
                <div class="lg:col-span-2 bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4 flex items-center justify-between">
                            <h2 class="text-lg font-semibold text-gray-800">My Courses</h2>
                            <a wire:navigate href="{{ route('v2.student.mycourses') }}"
                                class="text-sm text-purple-700 hover:text-purple-800 font-medium">View All</a>
                        </div>
                    </div>

                    <div class="p-6">
                        <ul class="space-y-4">
                            @foreach ($payments as $payment)
                                <li
                                    class="bg-gray-50 p-4 rounded-lg flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 border border-gray-100 hover:border-purple-200 transition duration-200">
                                    <!-- Course Image and Details -->
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0 bg-purple-100">
                                            <img src="{{ asset('storage/course_images/' . $payment->course->course_image) }}"
                                                alt="{{ $payment->course->title }}" class="w-full h-full object-cover">
                                        </div>

                                        <!-- Course Details -->
                                        <div>
                                            <h3 class="text-gray-900 font-semibold">{{ $payment->course->title }}</h3>
                                            <div class="flex flex-wrap gap-x-4 text-sm text-gray-500 mt-1">
                                                <p>Duration: {{ $payment->course->duration }} hours</p>
                                                <p>Batch: {{$payment->course->batches[0]->batch_name ?? "Not assigned"}}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Progress Bar -->
                                    <div class="flex flex-col items-end w-full sm:w-auto mt-3 sm:mt-0">
                                        <div class="w-full sm:w-40 bg-gray-200 rounded-full overflow-hidden h-2.5">
                                            <div class="bg-purple-600 h-2.5 rounded-full"
                                                style="width: {{ $payment->progress }}%;"></div>
                                        </div>
                                        <span class="text-sm text-gray-600 mt-1.5">
                                            Progress: <span class="text-purple-700 font-medium">{{ $payment->progress }}%</span>
                                        </span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Assignments Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-800">Assignments</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        
                         <ul class="space-y-3">
                            @if ($assignments->isNotEmpty())
                                    @foreach ($assignments->groupBy('batch_name') as $batch_name => $batchAssignments)
                                            <div class="border-b border-gray-300 pb-4">
                                                <h2 class="text-lg font-semibold text-purple-700">Batch {{ $batch_name }}</h2>
                                                <ul class="space-y-3 mt-2">
                                                    @foreach ($batchAssignments as $assignment)
                                                        <li
                                                            class="p-3 rounded-lg border border-gray-100 hover:border-purple-200 transition duration-200">
                                                            <div class="flex justify-between items-center">
                                                                 <div class="flex items-center">
                                                                    <span class="text-purple-700 mr-2">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                                            viewBox="0 0 24 24" stroke="currentColor">
                                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                                 stroke-width="2"
                                                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                                         </svg>
                                                                     </span>
                                                                                <span class="text-gray-800 font-medium">{{ $assignment->title }}</span>
                                                                </div>

                                                                 <div>
                                                                    @if ($assignment->uploads->isNotEmpty())
                                                                         @php
                                                                             $latestUpload = $assignment->uploads->sortByDesc('submitted_at')->first();
                                                                        @endphp
                                                                        <span
                                                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                                 @if ($latestUpload->status == 'submitted') bg-green-100 text-green-800
                                                                                @elseif($latestUpload->status == 'graded') bg-blue-100 text-blue-800
                                                                                 @else bg-gray-100 text-gray-800 @endif">
                                                                            {{ ucfirst($latestUpload->status) }}
                                                                        </span>
                                                                    @else
                                                                        <span
                                                                             class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                                             Pending
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                             </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                    @endforeach
                            @else
                                <div class="text-center py-6 text-gray-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="mt-2">No assignments available</p>
                                </div>
                            @endif
                        </ul>

                    </div>
                </div>

                <!-- Notifications Section -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-800">Notifications</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($messages->isEmpty())
                            <div class="text-center py-6 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                <p class="mt-2">No new messages</p>
                            </div>
                        @else
                            <ul class="space-y-3">
                                @foreach($messages as $message)
                                    <li>
                                        <a wire:navigate href="{{ route('v2.student.message.view', $message) }}"
                                            class="flex items-center p-3 rounded-lg border border-gray-100 hover:border-purple-200 transition duration-200">
                                            <div class="flex-shrink-0 mr-3">
                                                <span
                                                    class="{{ $message->type == 'info' ? 'text-blue-500' : ($message->type == 'warning' ? 'text-yellow-500' : 'text-red-500') }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div>
                                                <h3 class="text-sm font-medium text-gray-800">{{ $message->title }}</h3>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}
                                                </p>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>

                <!-- Quiz Scores -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="border-b border-gray-200">
                        <div class="px-6 py-4">
                            <h2 class="text-lg font-semibold text-gray-800">Recent Quiz Scores</h2>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($exams->isNotEmpty())
                                <ul class="space-y-3">
                                    @foreach ($exams as $exam)
                                                <li
                                                    class="p-3 rounded-lg border border-gray-100 hover:border-purple-200 transition duration-200">
                                                    <div class="flex justify-between items-center">
                                                        <div class="flex items-center">
                                                            <span class="text-purple-700 mr-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                                </svg>
                                                            </span>
                                                            <span class="text-gray-800 font-medium">{{ $exam->exam->exam_name }}</span>
                                                        </div>

                                                        <div>
                                                            <span
                                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                                                                                                                                                                    {{ $exam->total_marks >= 70 ? 'bg-green-100 text-green-800' :
                                        ($exam->total_marks >= 40 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                                                {{ $exam->total_marks }}%
                                                            </span>
                                                        </div>
                                                    </div>
                                                </li>
                                    @endforeach
                                </ul>
                        @else
                            <div class="text-center py-6 text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                <p class="mt-2">No quiz results available</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
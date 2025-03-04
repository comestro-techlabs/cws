<div>
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-8 mt-10">
        <!-- If No Courses -->
        @if ($courses->isEmpty())
            <div class="col-span-3 flex flex-col items-center justify-center mt-10 p-8  text-center">
                <h2 class="text-5xl font-bold text-gray-800">🎉 Welcome to Learn Syntax!</h2>
                <p class="text-gray-600 mt-2 text-lg">Get access to premium courses and start learning today!</p>
                <h3 class="text-xl font-semibold mt-5">🔥 Exclusive Membership Offer!</h3>
                <p class="text-gray-600 mt-2 text-lg">
                    Get <strong>unlimited access</strong> to <strong>any course</strong> for just
                    <span class="text-2xl font-bold text-red-600">₹700/month</span>!
                </p>
                <a wire:navigate href="{{ route('student.exploreCourses') }}" class="mt-6">
                    <button class="px-6 py-3 bg-blue-600 text-white text-lg font-semibold rounded-lg hover:bg-blue-700 transition-all">
                        Explore Courses
                    </button>
                </a>
            </div>
        @else
            <!-- My Courses Section -->
            <div class="lg:col-span-2 p-6 bg-white shadow-md rounded-xl">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">📚 My Courses</h2>
                <ul class="space-y-4">
                    @foreach ($payments as $payment)
                        <li class="p-4 bg-gray-50 rounded-lg flex justify-between items-center shadow">
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('storage/course_images/' . $payment->course->course_image) }}" class="w-16 h-16 rounded-lg object-cover shadow-sm">
                                <div>
                                    <h3 class="text-gray-800 font-semibold">{{ $payment->course->title }}</h3>
                                    <p class="text-sm text-gray-500">Duration: {{ $payment->course->duration }} hours</p>
                                    <p class="text-sm text-gray-500">Batch: {{ $payment->course->batches[0]->batch_name ?? "Not Set" }}</p>
                                </div>
                            </div>
                            <div class="w-40 bg-gray-200 rounded-full h-4">
                                <div class="bg-blue-500 h-4 rounded-full" style="width: {{ $payment->progress }}%"></div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Assignments Section -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">📝 Assignments</h2>
                @if ($assignments->isNotEmpty())
                    <ul class="space-y-4">
                        @foreach ($assignments as $assignment)
                            <li class="p-4 bg-gray-50 rounded-lg flex justify-between items-center shadow">
                                <span class="text-gray-800 font-semibold">📜 {{ $assignment->title }}</span>
                                <span class="text-sm font-medium px-3 py-1 rounded-lg text-white {{ $assignment->uploads->isNotEmpty() ? 'bg-green-500' : 'bg-gray-500' }}">
                                    {{ $assignment->uploads->isNotEmpty() ? ucfirst($assignment->uploads[0]->status) : 'No Uploads' }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-center">No assignments available.</p>
                @endif
            </div>

            <!-- Notifications Section -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">🔔 Notifications</h2>
                @if($messages->isEmpty())
                    <p class="text-gray-500">No new messages.</p>
                @else
                    <div class="space-y-4">
                        @foreach($messages as $message)
                            <a href="{{ route('student.messages.show', $message) }}" class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <h3 class="text-gray-800 font-semibold">{{ $message->title }}</h3>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Quiz Scores Section -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h2 class="text-lg font-semibold text-gray-700 mb-4">📊 Last Quiz Scores</h2>
                <ul class="space-y-4">
                    @forelse ($exams as $exam)
                        <li class="p-4 bg-gray-50 rounded-lg flex justify-between items-center">
                            <span class="text-gray-800 font-semibold">📝 {{ $exam->exam->exam_name }}</span>
                            <span class="text-blue-600 font-medium">{{ $exam->total_marks }}%</span>
                        </li>
                    @empty
                        <p class="text-center text-gray-500">No Exam available</p>
                    @endforelse
                </ul>
            </div>
        @endif
    </div>

</div>

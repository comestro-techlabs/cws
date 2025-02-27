<div>
<div class="container mx-auto mt-10 px-4 py-8">
    <h1 class="text-3xl font-medium text-gray-800 mb-6">Your Courses</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($courses as $course)
            <div class="bg-white rounded-lg overflow-hidden border border-slate-200 hover:shadow-sm transition">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">{{ $course->title }}</h2>
                    <div class="mt-4 flex justify-between items-center">
                        @php
                            $quizAvailable = false;
                        @endphp
                        @foreach ($course->exams as $exam)
                            @if ($exam->exam_date === now()->toDateString())
                                @php
                                    $quizAvailable = true;
                                @endphp
                                <a href="{{ route('student.quiz', ['courseId' => $course->id]) }}">
                                    <button id="start-quiz-btn" class="bg-blue-500 text-white font-medium px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">
                                        Take Quiz
                                    </button>
                                </a>
                                @break
                            @endif
                        @endforeach

                        @if (!$quizAvailable)
                            <span class="text-sm text-gray-500 italic">No quiz available today</span>
                        @endif

                        <a href="{{ route('student.allAttempts', $course->id) }}">
                            <button class="bg-green-600 text-white font-medium px-4 py-2 rounded-lg shadow hover:bg-green-700 transition">
                                See Results
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-600 col-span-full text-center">You are not enrolled in any courses yet.</p>
        @endforelse
    </div>
</div>
</div>

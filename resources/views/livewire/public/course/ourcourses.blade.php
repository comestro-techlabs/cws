<div>
<div class="flex justify-center from-indigo-500 to-blue-700 bg-gradient-to-l px-3 py-8 mt-0 relative">
    <div class="md:w-10/12 w-full flex items-center flex-col-reverse pt-16 md:flex-row">
        <!-- Left Section (Course Details) -->
        <div class="md:w-8/12 w-full text-white">
            <!-- Breadcrumb -->
            <nav class="text-sm mb-4">
                <ol class="list-reset flex text-gray-200">
                    <li>
                        <a href="{{ route('public.index') }}" class="hover:text-gray-300">Home</a>
                    </li>
                    <li><span class="mx-2">&raquo;</span></li>
                    <li>
                        <a href="#" class="hover:text-gray-300">{{ $course->category->cat_title }}</a>
                    </li>
                    <li><span class="mx-2">&raquo;</span></li>
                    <li class="text-gray-300 ">{{ $course->title }}</li>
                </ol>
            </nav>

            <!-- Course Title and Description -->
            <h1 class="text-4xl font-bold text-white mb-4 capitalize">{{ $course->title }}</h1>
            <p class="text-lg text-gray-200 mb-4">{{ $course->description }}</p>

            <!-- Instructor and Ratings -->
            <div class="flex items-center mb-4">
                <div class="mr-6">
                    <span class="text-gray-100">Created by</span>
                    <a href="#" class="text-yellow-300 hover:underline">{{ $course->instructor }}</a>
                </div>
            </div>

            <!-- Last Updated and Language -->
            <div class="text-sm text-gray-300">
                <span>Last updated {{ \Carbon\Carbon::parse($course->updated_at)->format('m/Y') }}</span>
                <span class="mx-2">•</span>
                <span>Duration: {{ $course->duration }} Weeks</span>
            </div>
        </div>

        <!-- Right Section (Fixed Card) -->
        <div class="flex-1 md:w-3/12 md:ml-8 relative">
            <div class="bg-white rounded-lg shadow-lg p-4 md:fixed md:top-32 mt-12 md:mt-0 md:right-32 w-full md:w-96 z-50"
                style="transform: translateY(-50px);">
                <!-- Course Preview Image -->
                <div class="overflow-hidden rounded-lg mb-4">
                    <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                        alt="{{ $course->title }}" class="w-full h-auto object-cover rounded-lg">
                </div>

                <!-- Course Price -->
                <div class="text-center mb-4">
                    @if ($course->discounted_fees > 0)
                        <span class="text-3xl font-bold text-gray-900">₹{{ $course->discounted_fees }}</span>
                        <span class="text-gray-500 line-through ml-2">₹{{ $course->fees }}</span>
                        <span
                            class="text-green-600 ml-2">({{ round((($course->fees - $course->discounted_fees) / $course->fees) * 100, 2) }}%
                            off)</span>
                    @else
                        <p class="text-green-600 font-semibold text-lg">Free</p>
                    @endif
                </div>

                @auth
                    @if ($payment_exist)
                        <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-3 flex flex-col items-center justify-center"
                            role="alert">
                            <p class="font-bold">Already Enrolled</p>
                            <p class="text-sm"><a href="{{ route('student.dashboard') }}"
                                    class="text-sm underline text-blue-700">Go to Dashboard</a></p>
                        </div>
                    @else
                        <button id="pay-button"
                            class="flex items-center justify-center w-full bg-blue-600 text-white font-medium rounded-full mt-2 shadow-lg px-6 py-3 transition duration-300 ease-in-out transform hover:scale-105 hover:bg-blue-700">
                            <span class="text-lg">Enroll Now</span>
                        </button>
                    @endif
                @endauth

                @guest
                    <a href="{{ route('auth.login') }}"
                        class="block bg-indigo-600 text-white text-center py-3 rounded-full hover:bg-indigo-700 font-medium">
                        Proceed Now
                    </a>
                @endguest

                <!-- 30-Day Money-Back Guarantee -->
                <div class="flex flex-col justify-between items-center">
                    <p class="text-gray-600 text-sm text-center mt-4">30-Day Money-Back Guarantee</p>
                </div>
            </div>
        </div>
    </div>
</div>


    <div class="flex  md:px-[10%] bg-white">
        <div class="md:w-8/12 p-4 flex  flex-col gap-6">
            <!-- Features Card -->
            <div class="bg-white  rounded-lg p-6 border-l-4 border-t border-b border-r border-slate-300">
                <h2 class="text-2xl font-bold text-purple-600 mb-4">This Course include:</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <!-- Feature Item 1 -->
                    @foreach ($course->features as $feature)
                        <div class="flex items-center space-x-1">
                            <svg class="w-5 h-5 text-purple-500 mr-1" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M10 15.172l-3.707-3.707a1 1 0 00-1.414 1.414l4.414 4.414a1 1 0 001.414 0l8.414-8.414a1 1 0 10-1.414-1.414L10 15.172z">
                                </path>
                            </svg>
                            <span class="text-gray-700">{{ $feature->name }}</span>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="bg-white  rounded-lg p-6 border-l-4 border-t border-b border-r border-slate-300">
                <h2 class="text-2xl font-bold text-purple-600 mb-4">Course Content</h2>
                <div id="accordion-open" data-accordion="collapse">
                    @foreach ($course->chapters as $chapter)
                        <h2 id="accordion-open-heading-{{ $loop->index }}">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium  text-gray-800 border border-b-0 border-gray-200 bg-slate-200   {{ $loop->index == 0 ? 'rounded-t-xl' : '' }} gap-3"
                                data-accordion-target="#accordion-open-body-{{ $loop->index }}" aria-expanded="true"
                                aria-controls="accordion-open-body-{{ $loop->index }}">
                                <span class="flex items-center">{{ $chapter->title }}</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-open-body-{{ $loop->index }}" class="hidden"
                            aria-labelledby="accordion-open-heading-{{ $loop->index }}">

                            <div class="w-full px-5 text-sm font-normal text-gray-900 border  bg-white">

                                @foreach ($chapter->lessons as $lesson)
                                    <a href="#" class="flex gap-2  items-center w-full px-4 py-2 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-4 text-slate-400">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m5.25 4.5 7.5 7.5-7.5 7.5m6-15 7.5 7.5-7.5 7.5" />
                                        </svg>
                                        {{ $lesson->title }}
                                    </a>
                                @endforeach


                            </div>

                        </div>
                    @endforeach


                </div>

            </div>

            <div class="bg-gray-50">
                <!-- Course Batches Section -->
                <div class="bg-white  rounded-lg p-6 mb-4 border-l-4 border-t border-b border-r border-slate-300">
                    <h2 class="text-2xl font-bold text-purple-600 mb-4">Course Batches</h2>
                    @if ($course->batches->isNotEmpty())
                        <ul class="space-y-2">
                            @foreach ($course->batches as $batch)
                                <li
                                    class="flex items-center justify-between p-3 bg-white rounded shadow border border-gray-200">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-800">{{ $batch->batch_name }}</span>
                                        <span class="text-sm text-gray-600">
                                            {{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }} to
                                            {{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $batch->available_seats }}/{{ $batch->total_seats }} Seats
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-500 ">No batches available for this course.</p>
                    @endif
                </div>
            </div>
            <div class="bg-gray-50">
                <!-- Course Batches Section -->
                <div class="bg-white  rounded-lg p-6 mb-4 border-l-4 border-t border-b border-r border-slate-300">
                    <h2 class="text-2xl font-bold text-purple-600 mb-4">Requirements</h2>
                    <ul class="space-y-1 text-sm list-disc list-inside">
                        <li class="">No programming experience needed - I'll teach you everything you need to know
                        </li>
                        <li class="">A computer with access to the internet</li>
                        <li class="">No paid software required</li>
                        <li class="">I'll walk you through, step-by-step how to get all the software installed and
                            set
                            up</li>

                    </ul>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg  border-t-4 border-x border-b border-gray-300">
                <!-- Instructor Header -->
                <div class="flex items-center mb-6">
                    <a href="/user/4b4368a3-b5c8-4529-aa65-2056ec31f37e/" class="flex-shrink-0">
                        <img src="{{ asset('assets/sadique.jpg') }}" alt="Syed Sadique Hussain"
                            class="w-16 h-16 rounded-full shadow-md" loading="lazy">
                    </a>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-purple-600">
                            <a href="/user/4b4368a3-b5c8-4529-aa65-2056ec31f37e/" class="hover:underline">Syed Sadique
                                Hussain</a>
                        </h2>
                        <p class="text-purple-400 font-medium">Developer and Lead Instructor</p>
                    </div>
                </div>

                <!-- Instructor Stats -->
                <ul class="flex flex-wrap space-x-4 mb-6">
                    <li class="flex items-center gap-1 text-purple-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                        </svg>

                        <span>4.9 Instructor Rating</span>
                    </li>

                    <li class="flex items-center text-purple-800 gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>

                        <span>9650+ Students</span>
                    </li>
                    <li class="flex items-center text-purple-800 gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>

                        <span>19 Courses</span>
                    </li>
                </ul>

                <!-- Instructor Description -->
                <div class="text-gray-700">
                    <p class="mb-4">I'm <strong>Sadique Hassain</strong>, a passionate developer, educator, and entrepreneur dedicated to shaping the future of programming education. I am the <strong>Founder & Director</strong> of <strong>Comestro Techlabs Pvt. Ltd.</strong>, a premier IT training and development company based in Purnea, Bihar.</p>

                    <p class="mb-4">At <strong>Comestro Techlabs</strong>, we specialize in software development, web development, and industry-focused training. Our mission is to bridge the gap between theoretical knowledge and practical implementation, helping students and professionals excel in the ever-evolving tech industry.</p>

                    <p class="mb-4">I started my programming journey at the age of 16, building my first HTML-based web pages. Over the years, I have developed <strong>hundreds of websites, applications, and software solutions</strong> for various industries. However, I discovered that my greatest passion lies in teaching and mentoring aspiring developers.</p>

                    <p class="mb-4">Through Code with SadiQ, I have trained and mentored over <strong>10,000 students</strong>, many of whom are now working in top IT companies across India and abroad. We take pride in offering high-quality courses in <strong>web development, programming languages, database management, and emerging technologies</strong>, ensuring our students gain real-world skills.</p>

                    <p class="mb-4">At Comestro Techlabs, we believe in making <strong>learning to code fun and accessible</strong>. I constantly research and implement innovative teaching techniques to simplify complex concepts. My goal is to provide an engaging learning experience filled with <strong>hands-on projects, geeky humor, and deep explanations</strong>.</p>

                    <p><strong>Join me on this journey, and let’s build something incredible together!</strong></p>
                </div>

            </div>

        </div>

    </div></div>

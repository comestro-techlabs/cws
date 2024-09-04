@extends('public.layout')

@section('content')
    <div class="flex justify-center bg-gray-900 py-8 mt-5">
        <div class="w-10/12 flex items-center flex-col-reverse md:flex-row">
            <!-- Left Section (Course Details) -->
            <div class="w-8/12 text-white p-8">
                <!-- Breadcrumb -->
                <nav class="text-sm mb-4">
                    <ol class="list-reset flex text-gray-100">
                        <li>
                            <a href="{{ route('public.index') }}" class="hover:text-gray-800">Home</a>
                        </li>
                        <li><span class="mx-2">/</span></li>
                        <li>
                            <a href="#" class="hover:text-white">{{ $course->category->cat_title }}</a>
                        </li>
                        <li><span class="mx-2">/</span></li>
                        <li class="text-gray-100 ">{{ $course->title }}</li>
                    </ol>
                </nav>

                <!-- Course Title and Description -->
                <h1 class="text-4xl font-bold text-gray-100 mb-4 capitalize">{{ $course->title }}</h1>
                <p class="text-lg text-gray-300 mb-4">{{ $course->description }}</p>

                <!-- Instructor and Ratings -->
                <div class="flex items-center mb-4">
                    <div class="mr-6">
                        <span class="text-gray-100">Created by</span>
                        <a href="#" class="text-teal-600 hover:underline">{{ $course->instructor }}</a>
                    </div>

                </div>

                <!-- Last Updated and Language -->
                <div class="text-sm text-gray-300">
                    <span>Last updated {{ \Carbon\Carbon::parse($course->updated_at)->format('m/Y') }}</span>
                    <span class="mx-2">•</span>
                    <span>Duration: {{ $course->duration }} Weeks</span>
                </div>
            </div>

            <!-- Right Section (Course Sidebar) -->
            <div class="w-3/12 ml-8">
                <div class="bg-white rounded-lg shadow-lg p-4 sticky top-20">
                    <!-- Course Preview Image -->
                    <div class="overflow-hidden rounded-lg mb-4">
                        <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="{{ $course->title }}"
                            class="w-full h-auto object-cover">
                    </div>

                    <!-- Course Price -->
                    <div class="text-center mb-4">
                        <span class="text-3xl font-bold text-gray-900">₹{{ $course->discounted_fees }}</span>
                        <span class="text-gray-500 line-through ml-2">₹{{ $course->fees }}</span>
                        <span
                            class="text-teal-600 ml-2">({{ round((($course->fees - $course->discounted_fees) / $course->fees) * 100, 2) }}%
                            off)</span>
                    </div>


                    <!-- Add to Cart Button -->
                    <a href="" id="pay-button"
                        class="block bg-purple-600 text-white text-center py-2 rounded-full hover:bg-purple-700">
                        Proceed To Payment
                    </a>

                    <!-- 30-Day Money-Back Guarantee -->
                    <p class="text-gray-600 text-sm text-center mt-4">30-Day Money-Back Guarantee</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex px-[10%] bg-white">
        <div class="w-8/12 p-4 flex  flex-col gap-6">
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
                        <p class="text-gray-500 dark:text-gray-400">No batches available for this course.</p>
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
                        <li class="">I'll walk you through, step-by-step how to get all the software installed and set
                            up</li>

                    </ul>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg  border-t-4 border-x border-b border-gray-300">
                <!-- Instructor Header -->
                <div class="flex items-center mb-6">
                    <a href="/user/4b4368a3-b5c8-4529-aa65-2056ec31f37e/" class="flex-shrink-0">
                        <img src="{{asset('assets/sadique.jpg')}}"
                            alt="Syed Sadique Hussain"
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
                    <p class="mb-4">I'm Sadique Sir, a developer with a passion for teaching. I'm the <strong>lead
                            instructor</strong> at the Purnea (Bihar), Purnea's leading <strong>Programming
                            Training Center</strong>. I've helped hundreds of thousands of students learn to code and change their
                        lives by becoming developers.</p>
                    <p class="mb-4">My first foray into programming was when I was just 16 years old, wanting to build my
                        own HTML based Webpages. Since then, I've made <strong>hundreds of websites, apps, and
                            Softwares</strong>. But most importantly, I realized that my <strong>greatest passion</strong> is
                        teaching.</p>
                    <p class="mb-4">I spend most of my time researching how to make <strong>learning to code fun</strong>
                        and make <strong>hard concepts easy to understand</strong>. I apply everything I discover into my
                        bootcamp courses. In my courses, you'll find lots of geeky humor but also lots of
                        <strong>explanations and fun</strong> to make sure everything is easy to understand.</p>
                    <p><strong>I'll be there for you every step of the way.</strong></p>
                </div>
            </div>

        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <form action="{{route('save.course.payment')}}" method="post" role="form">
        @csrf
        <input type="hidden" name="token_no" value="{{ $course->token_no }}">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="">
        {{-- <div class="col-md-12 d-grid text-center mb-5">
            <button class="btn btn-dark m-0 d-block mx-auto px-2" type="button" id="pay-button">PayNow</button>
        </div> --}}
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            document.getElementById('pay-button').onclick = function(e) {
                e.preventDefault();
                var options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": "{{ $course->discounted_fees }}" * 100,
                    "currency": "INR",
                    "name": "Comestro",
                    "description": "Processing Fee",
                    "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                    "handler": function(response) {
                        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                        document.forms[0].submit();
                    },
                    "prefill": {
                        "name": "{{ $course->name }}",
                        "email": "{{ $course->email }}",
                        "contact": "{{ $course->contact }}"
                    },
                    "theme": {
                        "color": "#0a64a3"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            }
        </script>
    </form>
@endsection

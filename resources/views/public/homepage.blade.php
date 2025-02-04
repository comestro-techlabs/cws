@extends('public.layout')


@section('meta')
    <meta name="description"
        content="Join Learn Syntax Programming Classes and master coding with expert-led training in C, DBMS, Laravel, and Web Development. Learn hands-on programming techniques from beginner to advanced levels. Enroll now to enhance your coding skills and build a successful career in tech!" />
@endsection

@section('content')
    {{-- banner --}}
    <div class="w-full mt-12">
        <img src="{{ asset('assets/home/banner.png') }}" class="w-full h-full" alt="Banner">
    </div>


    {{-- latest course --}}
    <div class="">
        <div class="flex flex-col items-center mt-10 md:mt-20 text-center">
            <h2 class="text-3xl text-gray-900 font-sans font-bold mb-4">Our <span class="text-secondary">Latest</span> Courses
            </h2>
            <h1 class="text-xl font-semibold text-gray-800 mb-4">Master the Skills to Build Your Future</h1>
            <p class="text-base text-gray-700 mb-6 md:mx-64">
                Explore our curated courses designed to provide you with the latest industry insights and practical
                knowledge.
                From beginner to advanced levels, we aim to help you excel in your field with expert-led guidance and
                innovative
                content. Upgrade your skills and achieve your career goals with us!
            </p>


        </div>



     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:mb-20 mb-10 px-4 lg:px-32">
        @foreach ($courses as $item)
            <div class="max-w-md mx-auto bg-white rounded-lg border overflow-hidden flex flex-col h-full min-h-[450px]">

                <div class="w-full h-60">
                    <img class="w-full h-full object-cover" src="{{ asset('storage/course_images/' . $item->course_image) }}" alt="Course Image">
                </div>


                <div class="p-6 flex flex-col flex-grow">
                    <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">{{ $item->title }}</h2>
                    <p class="text-gray-600 text-sm mb-4 flex-grow min-h-[60px]">
                        {{ Str::limit($item->description, 122) }}
                    </p>
                    <div class="mb-4">
                        <p class="text-gray-700 text-sm font-medium">By: {{ $item->instructor }}</p>
                        <span class="text-gray-600 text-sm font-semibold">Duration: {{ $item->duration }} Weeks</span>
                    </div>


                    <div class="flex justify-between items-center mt-auto">
                        @if ($item->discounted_fees > 0)
                            <p class="text-sm font-semibold text-primary">
                                Fees: Rs. <span class="text-gray-600 line-through">{{ $item->fees }}</span> {{ $item->discounted_fees }}
                            </p>
                        @else
                            <p class="text-green-500 font-bold">Free</p>
                        @endif

                        <a href="{{ route('public.courseDetails', ['category_slug' => $item->category->cat_slug, 'slug' => $item->slug]) }}"
                            class="bg-primary text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:ring hover:bg-primary-dark transition">
                            Enroll Now
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

        <div class="flex justify-center items-center">

            <div class="bg-secondary flex items-center py-3 px-6 rounded-lg shadow gap-2 md:mb-20 mb-10">
                <a href="{{ route('public.training') }}" class=" text-white font-bold ">
                    View All Courses
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                    class="bi bi-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                </svg>
            </div>
        </div>

    </div>

    <img src="{{ asset('assets/home/banner1.png') }}" class="w-full object-cover object-left h-[230px] md:h-full" alt="Banner">

    {{-- {{static info}} --}}
    <div class="flex flex-col gap-2 p-2 md:p-8 mt-10 bg-gray-50 rounded-2xl mb-12 items-center md:px-[10%]">
        <h2 class="text-lg md:text-xl font-normal max-w-2xl text-gray-900  text-center mb-4 flex flex-col">
            <span class="font-semibold mb-1">Results that Speak for Themselves:</span>
            <span class="md:text-3xl text-xl font-semibold"> We’re a Top Software Devlopment Company in India</span>
        </h2>

        <div class="flex flex-col md:flex-row w-full gap-8">
            <div
                class="flex-1 p-6 text-orange-600 rounded-lg shadow-sm ring ring-slate-600  transform  transition-transform duration-300">
                <h3 class="count-number text-3xl md:text-5xl font-bold" data-target="600">0</h3>
                <p class="stat-title text-lg mt-4 text-gray-900">Total Projects</p>
            </div>
            <div
                class="flex-1 p-6  text-pink-700 rounded-lg shadow-sm ring ring-slate-600  transform  transition-transform duration-300">
                <h3 class="count-number text-3xl md:text-5xl font-bold" data-target="200000">0</h3>
                <p class="stat-title text-lg mt-4 text-gray-900">Web Pages</p>
            </div>
            <div
                class="flex-1 p-6 text-green-700 rounded-lg shadow-sm ring ring-slate-600  transform  transition-transform duration-300">
                <h3 class="count-number text-3xl md:text-5xl font-bold" data-target="100">0</h3>
                <p class="stat-title text-lg mt-4 text-gray-900">Technologies We Use</p>
            </div>
        </div>
    </div>


    <div class="bg-white py-12 pt-5 md:mt-20">
        <div class="text-center mb-8 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                Our <span class="text-secondary">Training</span> Services
            </h2>
            <p class="text-gray-600 mt-2">
                From Basic to Advanced...<br>We Offer Classroom, Online, Weekend, and Corporate Training on a Wide Range of
                Software Courses.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-7xl mx-auto px-4">
            <!-- Real-Time Projects -->
            <div
                class="flex flex-col md:flex-row items-center md:items-start md:space-x-6 border border-gray-400 rounded-lg p-4">
                <img src="{{ asset('assets/home/real_time.png') }}" alt="Real-Time Projects"
                    class="w-full md:w-1/2 object-cover rounded-lg">
                <div class="mt-4 md:mt-0">
                    <h3 class="text-xl font-semibold text-gray-800">Real-Time Projects</h3>
                    <p class="text-gray-600 mt-2">Learn by Doing: Real-World Projects for Practical Mastery.</p>
                    <a href="{{ route('public.training') }}" class="text-secondary mt-4 block">View more →</a>
                </div>
            </div>
            <!-- Internships -->
            <div
                class="flex flex-col md:flex-row items-center md:items-start md:space-x-6 border border-gray-400 rounded-lg p-4">
                <img src="{{ asset('assets/home/intern.jpg') }}" alt="Internships"
                    class="w-full md:w-1/2 object-cover rounded-lg">
                <div class="mt-4 md:mt-0">
                    <h3 class="text-xl font-semibold text-gray-800">Internships</h3>
                    <p class="text-gray-600 mt-2">Industry-Mentor Guided Internship. with skills trainning</p>
                    <a href="{{ route('public.training') }}" class="text-secondary mt-4 block">View more →</a>
                </div>
            </div>
            <!-- Workshops -->
            <div
                class="flex flex-col md:flex-row items-center md:items-start md:space-x-6 border border-gray-400 rounded-lg p-4">
                <img src="{{ asset('assets/home/workshop.png') }}" alt="Workshops"
                    class="w-full md:w-1/2 object-cover rounded-lg">
                <div class="mt-4 md:mt-0">
                    <h3 class="text-xl font-semibold text-gray-800">Workshops</h3>
                    <p class="text-gray-600 mt-2">Unlocking IT Excellence: Join Our Transformative Workshops.</p>
                    <a href="{{ route('public.training') }}" class="text-secondary mt-4 block">View more →</a>
                </div>
            </div>
            <!-- Weekend Training -->
            <div
                class="flex flex-col md:flex-row items-center md:items-start md:space-x-6 border border-gray-400 rounded-lg p-4">
                <img src="{{ asset('assets/home/Weekend.jpg') }}" alt="Weekend Training"
                    class="w-full md:w-1/2 object-cover rounded-lg">
                <div class="mt-4 md:mt-0">
                    <h3 class="text-xl font-semibold text-gray-800">Weekend Training</h3>
                    <p class="text-gray-600 mt-2">Supercharge Your Weekends with Our Training Programs.</p>
                    <a href="{{ route('public.training') }}" class="text-secondary mt-4 block">View more →</a>
                </div>
            </div>
        </div>

    </div>



    <div class="bg-gray-900 text-white py-12 md:mt-20 mt-8 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Text Section -->
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-blue-300 mb-4">
                    Corporate <span class="text-white">Software Training</span>
                </h2>
                <p class="text-gray-300 text-lg leading-relaxed mb-6">
                    Empower yourself with coding expertise at Learn Syntax Training Center. Our specialized programs are
                    designed to help individuals and teams master the art of programming syntax, ensuring efficiency and
                    accuracy in writing code. Stay ahead in the competitive tech world with our comprehensive, expert-led
                    training sessions tailored to meet your learning goals.
                </p>
                <a href="{{ route('public.contact') }}" class="text-blue-400 hover:underline inline-block mb-4">View more
                    →</a>
                <div>
                    <button class=" bg-secondary text-white font-semibold py-2 px-4 rounded shadow-lg">
                        <a href="{{ route('public.contact') }}">CONTACT US</a>
                    </button>
                </div>
            </div>

            <!-- Image Section -->
            <div class="">
                <img src="{{ asset('assets/home/banner-r.png') }}" alt="Corporate Training" class="">
            </div>
        </div>
    </div>


    {{-- Student List Section --}}
    <div class="flex flex-col items-center mt-20 mb-20 text-center">
        <h2 class="text-4xl font-bold text-gray-800"><span class="text-secondary">Our Alumni</span>  Our Pride</h2>
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Meet Our Achievers</h1>
        <p class="text-base text-gray-700 mb-6 md:mx-64">
            Celebrating the success and dedication of our students who have excelled in their respective fields. With their
            hard work and our expert guidance, they have achieved incredible milestones. Get inspired by their stories!
        </p>

        {{$title}}
        {{-- Student List --}}
        <div class="grid grid-cols-1 md:grid-cols-5 gap-3 px-24 mx-auto p-4">
            @foreach ($placedStudents as $item)
            <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-lg cursor-help" title="{{ $item->content }}">
                <div class="md:flex flex-col justify-center items-center">
                    <!-- Image Section -->
                    <div class="flex justify-center p-4">
                        <img class="h-24 w-24 object-cover rounded-full border-4 border-gray-200 shadow-md transition-transform duration-300 hover:scale-110"
                             src="https://loremflickr.com/g/320/240/team"
                             alt="{{ $item->name }} Image">
                    </div>
                    <!-- Content Section -->
                    <div class="px-4 py-3 text-center">
                        <div class="capitalize tracking-wide text-lg text-gray-800 font-semibold">
                            {{ $item->name }}
                        </div>
                        <span class="block mt-1 text-sm leading-tight text-purple-700">
                            {{ $item->position }}
                        </span>
                    </div>
                </div>
            </div>

                {{-- <div class="flex flex-col bg-secondary text-white shadow-lg rounded-lg overflow-hidden transition-transform transform hover:scale-105 hover:shadow-xl">
                    <!-- Student Image -->
                    <div class="w-full h-48 md:h-56 flex justify-center items-center bg-gray-800">
                        <img src="https://learnsyntax.com/storage/store/Gs8Oegn4Oy6wI5XwkdxEih8kDLeZrJvBznq4V5if.png" alt="{{ $item->name }} Image"
                            class="h-32 w-32 object-cover rounded-lg">
                    </div>
                    <!-- Student Details -->
                    <div class="p-3 flex flex-col">
                        <h3 class="text-xl font-bold mb-2">{{ $item->name }}</h3>
                        <p title="{{ $item->content }}" class="text-xs text-gray-300 mb-4 line-clamp-6">

                        </p>
                        <p class="text-sm md:text-base font-medium text-gray-100">
                            <strong>Position:</strong> {{ $item->position }}
                        </p>
                    </div>
                </div> --}}
            @endforeach
        </div>

    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.count-number');
            const speed = 60; // Adjust speed as needed

            const startCounting = (counter) => {
                const updateCount = () => {
                    const target = +counter.getAttribute('data-target');
                    const count = +counter.innerText;
                    const increment = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 50);
                    } else {
                        counter.innerText = target.toLocaleString(); // Add commas to number
                    }
                };

                updateCount();
            };

            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        startCounting(counter);
                        observer.unobserve(counter); // Stop observing after counting starts
                    }
                });
            }, {
                threshold: 0.5
            }); // Adjust threshold as needed

            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection

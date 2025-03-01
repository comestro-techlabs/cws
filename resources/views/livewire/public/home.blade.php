<div>
    <div class="">
        <div class="flex flex-col items-center mt-10 md:mt-12 text-center px-5 md:px-[10%]">
            <h2 class="text-2xl md:text-5xl text-gray-900 font-sans font-extrabold mb-4 tracking-tight">Our <span class="text-primary">Courses</span></h2>
            <p class="mt-3 mb-6 text-xl leading-7 text-gray-600 dark:text-gray-400 sm:mt-4">
                Discover curated courses that blend industry insights with practical knowledge.
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:mb-20 mb-10 px-4 lg:px-32">
            @foreach ($courses as $item)

            <div class=" bg-gray-100 flex items-center justify-center p-4">
                <div class="max-w-sm w-full bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all">
                    <div class="relative">
                        <img
                            src="{{ asset('storage/course_images/' . $item->course_image) }}" alt="Course Image"
                            class="w-full h-52 object-cover" />
                        <span class="absolute top-3 right-3 bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">
                            Sale
                        </span>
                    </div>

                    <div class="p-5 space-y-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $item->title }}</h3>
                            <p class="text-gray-500 mt-1">{{ Str::limit($item->description, 122) }}</p>
                            <p class="font-bold text-gray-400 mt-1">Duration: {{ $item->duration }} Weeks</p>
                        </div>

                        <div class="flex justify-between items-center">


                            <div class="space-y-1">
                                @if ($item->discounted_fees > 0)
                                <p class="text-2xl font-bold text-gray-900">Rs {{ $item->discounted_fees }}</p>
                                <p class="text-sm text-gray-500 line-through">Rs {{ $item->fees }}</p>
                                @else
                                <p class="text-green-500 font-bold">Free</p>
                                @endif
                            </div>

                            <div class="flex items-center gap-1">
                                <div class="text-yellow-400">★★★★★</div>
                            </div>
                        </div>
                        <a href="{{route('v2.public.courseDetail', ['slug' => $item->slug])}}" wire:navigate>
                            <button class="w-full mt-2 bg-primary hover:bg-indigo-700 text-white font-medium py-3 rounded-lg transition-colors">
                                Enroll Now
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            @endforeach
        </div>

        <div class="flex justify-center items-center">

            <div class="bg-primary flex items-center py-3 px-6 rounded-lg shadow gap-2 md:mb-20 mb-10">
                <a href="{{route('v2.public.viewallcourses.all-courses')}}" wire:navigate class=" text-white font-bold ">
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

    {{-- {{static info}} --}}
    <div class="bg-gradient-to-r from-purple-50 via-purple-300 to-purple-100  py-12">
        <div class="dark:bg-gray-900 ">
            <div class="pt-12 bg-gray-50 dark:bg-gray-900 sm:pt-20 bg-gradient-to-r from-purple-50 via-purple-300 to-purple-100">
                <div class="max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8 ">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-3xl font-extrabold leading-9 text-gray-900 dark:text-white sm:text-4xl sm:leading-10">
                            Why we’re a Top <span class="text-primary">Software Development</span> Company
                        </h2>
                        <p class="mt-3 text-xl leading-7 text-gray-600 dark:text-gray-400 sm:mt-4">
                            Results that Speak for Themselves </p>
                    </div>
                </div>
                <div class="pb-12 mt-10 dark:bg-gray-900 sm:pb-16 bg-gradient-to-r from-purple-50 via-purple-300 to-purple-100">
                    <div class="relative">
                        <div class="absolute inset-0 h-1/2  dark:bg-gray-900 bg-gradient-to-r from-purple-50 via-purple-300 to-purple-100"></div>
                        <div class="relative max-w-screen-xl px-4 mx-auto sm:px-6 lg:px-8">
                            <div class="max-w-4xl mx-auto">
                                <dl class="bg-white dark:bg-gray-800 rounded-lg shadow-lg sm:grid sm:grid-cols-3 bg-gradient-to-r from-purple-50 via-purple-300 to-purple-100">
                                    <div
                                        class="flex flex-col p-6 text-center border-b border-gray-100 dark:border-gray-700 sm:border-0 sm:border-r ">
                                        <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 dark:text-gray-400" id="item-1">
                                            Total Projects
                                        </dt>
                                        <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 dark:text-indigo-100"
                                            aria-describedby="item-1" id="totalprojects">
                                            0
                                        </dd>
                                    </div>
                                    <div
                                        class="flex flex-col p-6 text-center border-t border-b border-gray-100 dark:border-gray-700 sm:border-0 sm:border-l sm:border-r">
                                        <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 dark:text-gray-400">
                                            Web Pages
                                        </dt>
                                        <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 dark:text-indigo-100"
                                            id="webpages">
                                            0
                                        </dd>
                                    </div>
                                    <div
                                        class="flex flex-col p-6 text-center border-t border-gray-100 dark:border-gray-700 sm:border-0 sm:border-l">
                                        <dt class="order-2 mt-2 text-lg font-medium leading-6 text-gray-500 dark:text-gray-400">
                                            Technologies We Use
                                        </dt>
                                        <dd class="order-1 text-5xl font-extrabold leading-none text-indigo-600 dark:text-indigo-100"
                                            id="technologies">
                                            0
                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg-white py-12 pt-5 md:mt-20">
        <div class="text-center mb-8 px-4">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                Our <span class="text-primary">Training</span> Services
            </h2>
            <p class="mt-3 text-xl leading-7 text-gray-600 dark:text-gray-400 sm:mt-4">
                From Basic to Advanced...<br>We Offer Classroom, Online, Weekend, and Corporate Training on a Wide Range of
                Software Courses.
            </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-6 max-w-7xl mx-auto px-4 justify-center items-center">
    <div class="relative flex flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12 w-full sm:w-auto">
        <div class="group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
            <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-primary transition-all duration-300 group-hover:scale-[10]"></span>
            <div class="relative z-10 mx-auto max-w-md">
                <span class="grid h-20 w-20 place-items-center rounded-full bg-primary transition-all duration-300 group-hover:bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-white transition-all">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                </span>
                <div class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                    <p>Learn by Doing: Real-World Projects for Practical Mastery.</p>
                </div>
                <div class="pt-5 text-base font-semibold leading-7">
                    <p>
                        <a href="#" class="text-primary transition-all duration-300 group-hover:text-white">Read the docs &rarr;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12 w-full sm:w-auto">
        <div class="group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
            <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-primary transition-all duration-300 group-hover:scale-[10]"></span>
            <div class="relative z-10 mx-auto max-w-md">
                <span class="grid h-20 w-20 place-items-center rounded-full bg-primary transition-all duration-300 group-hover:bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-white transition-all">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                </span>
                <div class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                    <p>Industry-Mentor Guided Internship with skills training.</p>
                </div>
                <div class="pt-5 text-base font-semibold leading-7">
                    <p>
                        <a href="#" class="text-primary transition-all duration-300 group-hover:text-white">Read the docs &rarr;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="relative flex flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12 w-full sm:w-auto">
        <div class="group relative cursor-pointer overflow-hidden bg-white px-6 pt-10 pb-8 shadow-xl ring-1 ring-gray-900/5 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl sm:mx-auto sm:max-w-sm sm:rounded-lg sm:px-10">
            <span class="absolute top-10 z-0 h-20 w-20 rounded-full bg-primary transition-all duration-300 group-hover:scale-[10]"></span>
            <div class="relative z-10 mx-auto max-w-md">
                <span class="grid h-20 w-20 place-items-center rounded-full bg-primary transition-all duration-300 group-hover:bg-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-white transition-all">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
                    </svg>
                </span>
                <div class="space-y-6 pt-5 text-base leading-7 text-gray-600 transition-all duration-300 group-hover:text-white/90">
                    <p>Unlocking IT Excellence: Join Our Transformative Workshops.</p>
                </div>
                <div class="pt-5 text-base font-semibold leading-7">
                    <p>
                        <a href="#" class="text-primary transition-all duration-300 group-hover:text-white">Read the docs &rarr;</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


    </div>

    {{-- Student List Section --}}
    <div class="flex flex-col items-center mt-20 mb-5 text-center">
        <h2 class="text-4xl font-bold text-gray-800"><span class="text-secondary">Our Alumni</span> Our Pride</h2>
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Meet Our Achievers</h1>
        <p class="text-base text-gray-700 mb-6 md:mx-64">
            Celebrating the success and dedication of our students who have excelled in their respective fields. With their
            hard work and our expert guidance, they have achieved incredible milestones. Get inspired by their stories!
        </p>

        {{ $title }}
        {{-- Student List --}}

        <div class="relative overflow-hidden w-full glide-09">
            <!-- Slides -->
            <!-- <div data-glide-el="track">
                <ul
                    class="whitespace-no-wrap flex-no-wrap [backface-visibility: hidden] [transform-style: preserve-3d] [touch-action: pan-Y] [will-change: transform] relative flex w-full overflow-hidden p-0 pb-12">
                    @foreach ($placedStudents as $item)
                        <li>
                            <div class=" bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-lg cursor-help h-full"
                                title="{{ $item->content }}">
                                <div class="md:flex flex-col justify-center items-center">
                                    <div class="flex justify-center p-4">
                                        <img class="h-24 w-24 object-cover rounded-full border-4 border-gray-200 shadow-md transition-transform duration-300 hover:scale-110"
                                        src="{{ asset('storage/' . $item->image) }}"
                                            alt="{{ $item->name }} Image">
                                    </div>
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
                        </li>
                    @endforeach
                </ul>
            </div>
        </div> -->
        </div>

    </div>
    <script>
        const targets = [{
                element: document.getElementById('totalprojects'),
                count: 600,
                suffix: '+'
            },
            {
                element: document.getElementById('webpages'),
                count: 20000,
                suffix: '+'
            },
            {
                element: document.getElementById('technologies'),
                count: 50,
                suffix: '+'
            }
        ];

        // Find the maximum count among all targets
        const maxCount = Math.max(...targets.map(target => target.count));

        // Function to animate count-up effect
        function animateCountUp(target, duration) {
            let currentCount = 0;
            const increment = Math.ceil(target.count / (duration / 10));

            const interval = setInterval(() => {
                currentCount += increment;
                if (currentCount >= target.count) {
                    clearInterval(interval);
                    currentCount = target.count;
                    target.element.textContent = currentCount + target.suffix;
                } else {
                    target.element.textContent = currentCount;
                }
            }, 10);
        }

        // Animate count-up for each target with adjusted duration
        targets.forEach(target => {
            animateCountUp(target, maxCount / 100); // Adjust duration based on max count
        });
    </script>
</div>
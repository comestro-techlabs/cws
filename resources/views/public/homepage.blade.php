@extends('public.layout')


@section('meta')
    <meta name="description"
        content="Join LearnSyntax Programming Classes and master coding with expert-led training in C, DBMS, Laravel, and Web Development. Learn hands-on programming techniques from beginner to advanced levels. Enroll now to enhance your coding skills and build a successful career in tech!" />
@endsection

@section('content')
    <div class="bg-primary overflow-x-hidden">
        <x-hero />
    </div>


    {{-- latest course --}}
    <div class="">
        <div class="flex flex-col items-center mt-20 text-center">
            <h2 class="text-3xl text-gray-900 font-sans font-bold mb-4">Our <span class="text-secondary">Latest</span> Courses</h2>
            <h1 class="text-xl font-semibold text-gray-800 mb-4">Master the Skills to Build Your Future</h1>
            <p class="text-base text-gray-700 mb-6 max-w-4xl">
                Explore our curated courses designed to provide you with the latest industry insights and practical
                knowledge.
                From beginner to advanced levels, we aim to help you excel in your field with expert-led guidance and
                innovative
                content. Upgrade your skills and achieve your career goals with us!
            </p>


        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-20 px-4 lg:px-32">
            @foreach ($courses as $item)
                <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg border overflow-hidden">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/course_images/' . $item->course_image) }}"
                        alt="Course Image">

                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">{{ $item->title }}</h2>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ Str::limit($item->description, 122) }}
                        </p>
                        <div class="flex items-center mb-4">
                            <div class="">
                                <p class="text-gray-700 text-sm font-medium">By:{{ $item->instructor }}</p>
                                <span class="text-gray-600 text-sm font-semibold">
                                    Duration: {{ $item->duration * 7 }} Days
                                </span>
                                </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <p class="text-sm font-semibold text-primary">Fees:  Rs.
                                <span class="text-sm text-gray-600 line-through">{{ $item->fees }}</span>
                                {{ $item->discounted_fees }}</p>
                            
                            <a href="{{ route('public.courseDetails', ['category_slug' => $item->category->cat_slug, 'slug' => $item->slug]) }}"
                                class="bg-primary text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:ring">
                                Enroll Now
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center items-center">

            <div class="bg-secondary flex  items-center py-3 px-6 rounded-lg shadow gap-2 mb-20">
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
    {{-- {{static info}} --}}
    <div class="flex flex-col gap-2 p-8 bg-gray-50 rounded-2xl mb-12 items-center md:px-[10%]">
        <h2 class="text-lg md:text-xl font-normal max-w-2xl text-gray-900  text-center mb-4 flex flex-col">
            <span class="font-semibold mb-1">Results that Speak for Themselves:</span>
            <span class="text-3xl font-semibold"> We’re a Top Software Devlopment Company in India</span>
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


    <div class="bg-white py-12 mt-20">
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-gray-800">
                Our <span class="text-secondary">Training</span> Services
            </h2>
            <p class="text-gray-600 mt-2">
                From Basic to Advanced...<br>We Offer Classroom, Online, Weekend, and Corporate Training on a Wide Range of
                Software Courses.
            </p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-7xl mx-auto px-4">
            <!-- Real-Time Projects -->
            <div class="flex items-center space-x-6 border border-gray-400">
                <img src="https://img.freepik.com/free-photo/rear-view-programmer-working-all-night-long_1098-18697.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                    alt="Real-Time Projects" class="w-1/2 ">
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Real-Time Projects</h3>
                    <p class="text-gray-600 mt-2">Learn by Doing: Real-World Projects for Practical Mastery.</p>
                    <a href="#" class="text-secondary mt-4 block">View more →</a>
                </div>
            </div>
            <!-- Internships -->
            <div class="flex items-center space-x-6 border border-gray-400">
                <img src="https://img.freepik.com/premium-photo/girl-gazing-digital-display-data-information_329343-2867.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                    alt="Internships" class="w-1/2">
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">Internships</h3>
                    <p class="text-gray-600 mt-2">Industry-Mentor Guided Internship.</p>
                    <a href="#" class="text-secondary  mt-4 block">View more →</a>
                </div>
            </div>
            <!-- Workshops -->
            <div class="flex items-center space-x-6 border border-gray-400">
                <img src="https://img.freepik.com/premium-photo/cheerful-woman-speaking-microphone-workshop_53876-156971.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                    alt="Workshops" class="w-1/2">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Workshops</h3>
                    <p class="text-gray-600 mt-2">Unlocking IT Excellence: Join Our Transformative Workshops.</p>
                    <a href="#" class="text-secondary mt-4 block">View more →</a>
                </div>
            </div>
            <!-- Weekend Training -->
            <div class="flex items-center space-x-6 border border-gray-400">
                <img src="https://media.istockphoto.com/id/1328313970/photo/multi-ethnic-group-of-business-persons-during-a-conference.jpg?b=1&s=612x612&w=0&k=20&c=Qb0ZfE3ONgKIiZ6vkd6uUS1kpL5iS2_AwBk0OgNxcw8="
                    alt="Weekend Training" class="w-1/2">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">Weekend Training</h3>
                    <p class="text-gray-600 mt-2">Supercharge Your Weekends with Our Training Programs.</p>
                    <a href="#" class="text-secondary  mt-4 block">View more →</a>
                </div>
            </div>
        </div>
        <div class="text-center mt-12">
            <button class="px-6 py-3 bg-secondary text-white rounded-lg shadow-lg hover:bg-blue-700">Explore
                Services</button>
        </div>
    </div>


    <div class="bg-gray-900 text-white py-12 mt-20 px-6">
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
                <a href="#" class="text-blue-400 hover:underline inline-block mb-4">View more →</a>
                <div>
                    <button class=" bg-secondary text-white font-semibold py-2 px-4 rounded shadow-lg">
                        CONTACT US
                    </button>
                </div>
            </div>

            <!-- Image Section -->
            <div class="">
                <img src="https://img.freepik.com/premium-photo/woman-computer-screen_1404509-625.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                    alt="Corporate Training" class="">
            </div>
        </div>
    </div>



    {{-- who we are --}}
    <div class="flex-1 flex flex-col md:flex-row md:px-[8%] gap-10 mt-20 py-12">
        <div class="flex-1 p-5">
            <img src="{{ asset('assets/first_image.png') }}" class="w-full rounded-lg shadow-sm ring-slate-600 "
                alt="">
        </div>
        <div class="flex-1 p-5 md:p-10 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-3xl font-sans mb-4">Who We Are</h2>
            <h1 class="text-xl font-bold mb-4">Est. 2011 - Top Web Designing Company</h1>
            <p class="text-base text-gray-700 mb-6">
                With more than 15 years of expertise in the field, we've established ourselves as an evolving Software
                Company. Over the years, we have diversified according to market needs. We optimize website
                rankings, boost campaign performance, enhance brand names, create quality content, and popularize brands on
                social media...
            </p>
            <a href="#" class="text-gray-800 text-lg hover:underline font-bold mb-4 inline-block">
                Consider these steps for brand popularity in the Digital World...
            </a>
            <ul class="flex flex-col gap-2 text-gray-700">
                <li><i class="fas fa-check text-primary mr-2"></i><a href="#"
                        class="text-gray-800 font-semibold hover:text-primary">Define your goals</a></li>
                <li><i class="fas fa-check text-primary mr-2"></i><a href="#"
                        class="text-gray-800 font-semibold hover:text-primary">Identify your target audience</a></li>
                <li><i class="fas fa-check text-primary mr-2"></i><a href="#"
                        class="text-gray-800 font-semibold hover:text-primary">Choose the right channels</a></li>
                <li><i class="fas fa-check text-primary mr-2"></i><a href="#"
                        class="text-gray-800 font-semibold hover:text-primary">Create and implement your campaigns</a>
                </li>
            </ul>
        </div>
    </div>



    {{-- Student List Section --}}
    <div class="flex flex-col items-center mt-20 text-center">
        <h2 class="text-3xl text-primary font-sans font-bold mb-2">Our Proud Students</h2>
        <h1 class="text-xl font-semibold text-gray-800 mb-4">Meet Our Achievers</h1>
        <p class="text-base text-gray-700 mb-6 max-w-4xl">
            Celebrating the success and dedication of our students who have excelled in their respective fields. With their
            hard work and our expert guidance, they have achieved incredible milestones. Get inspired by their stories!
        </p>


        {{-- Student List --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-6xl">
            <!-- Student 1 -->
            <div class="flex flex-col md:flex-row bg-secondary text-white py-6 px-6  shadow gap-6">
                <!-- Student Image -->
                <div class="w-full md:w-1/3 flex justify-center items-center">
                    <img src="https://img.freepik.com/premium-photo/work-from-home_1246590-8920.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                        alt="Student 1 Image" class="rounded-lg shadow-lg w-full md:w-3/4">
                </div>
                <!-- Student Details -->
                <div class="w-full md:w-2/3 flex flex-col justify-center items-start text-left">
                    <h3 class="text-2xl font-bold mb-4">Kamana Kumari</h3>
                    <p class="text-base mb-4">
                        "John completed our Python programming course and secured a role as a Software Developer at a
                        leading
                        tech company."
                    </p>
                    <p class="text-base mb-2"><strong></strong>Django developer</p>
                    {{-- <p class="text-base"><strong>Contact:</strong> +1 123 456 7890</p> --}}
                </div>
            </div>

            <!-- Student 2 -->
            <div class="flex flex-col md:flex-row bg-secondary text-white py-6 px-6  shadow gap-6">
                <!-- Student Image -->
                <div class="w-full md:w-1/3 flex justify-center items-center">
                    <img src="https://img.freepik.com/premium-photo/work-from-home_1246590-8920.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                        alt="Student 1 Image" class="rounded-lg shadow-lg w-full md:w-3/4">
                </div>
                <!-- Student Details -->
                <div class="w-full md:w-2/3 flex flex-col justify-center items-start text-left">
                    <h3 class="text-2xl font-bold mb-4">Puja Kumari</h3>
                    <p class="text-base mb-4">
                        "John completed our Python programming course and secured a role as a Software Developer at a
                        leading
                        tech company."
                    </p>
                    <p class="text-base mb-2"><strong></strong>Laravel Developer</p>
                    {{-- <p class="text-base"><strong>Contact:</strong> +1 123 456 7890</p> --}}
                </div>
            </div>

            <!-- Student 3 -->
            <div class="flex flex-col md:flex-row bg-secondary text-white py-6 px-6  shadow gap-6">
                <!-- Student Image -->
                <div class="w-full md:w-1/3 flex justify-center items-center">
                    <img src="https://img.freepik.com/premium-photo/work-from-home_1246590-8920.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                        alt="Student 1 Image" class="rounded-lg shadow-lg w-full md:w-3/4">
                </div>
                <!-- Student Details -->
                <div class="w-full md:w-2/3 flex flex-col justify-center items-start text-left">
                    <h3 class="text-2xl font-bold mb-4">Neha</h3>
                    <p class="text-base mb-4">
                        "John completed our Python programming course and secured a role as a Software Developer at a
                        leading
                        tech company."
                    </p>
                    <p class="text-base mb-2"><strong></strong>Backend developer</p>
                    {{-- <p class="text-base"><strong>Contact:</strong> +1 123 456 7890</p> --}}
                </div>
            </div>
            <!-- Student 4 -->
            <div class="flex flex-col md:flex-row bg-secondary text-white py-6 px-6  shadow gap-6">
                <!-- Student Image -->
                <div class="w-full md:w-1/3 flex justify-center items-center">
                    <img src="https://img.freepik.com/premium-photo/work-from-home_1246590-8920.jpg?ga=GA1.1.1275289697.1728223870&semt=ais_incoming_vrsd"
                        alt="Student 1 Image" class="rounded-lg shadow-lg w-full md:w-3/4">
                </div>
                <!-- Student Details -->
                <div class="w-full md:w-2/3 flex flex-col justify-center items-start text-left">
                    <h3 class="text-2xl font-bold mb-4">Komal kumari</h3>
                    <p class="text-base mb-4">
                        "John completed our Python programming course and secured a role as a Software Developer at a
                        leading
                        tech company."
                    </p>
                    <p class="text-base mb-2"><strong></strong>Django Developer</p>
                    {{-- <p class="text-base"><strong>Contact:</strong> +1 123 456 7890</p> --}}
                </div>
            </div>



        </div>
    </div>

   
    

    <div class="bg-white py-12 mt-20 mb-20 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2">
            <!-- Left Side: Text Content -->
            <div>
                <h2 class="text-3xl font-bold text-black">
                    We <span class="text-primary">love</span> to help you
                </h2>
                <p class="text-gray-600 mt-2">Explore new and trending Learn syntax.</p>
                <div class="mt-6">
                    <div class="flex items-start space-x-4">
                        <span class="font-medium text-black">Phone:</span>
                        <p class="text-gray-700">+91-9546805580</p>
                    </div>
                    <div class="flex items-start space-x-4 mt-4">
                        <span class="font-medium text-black">Email:</span>
                        <a href="mailto:support@nareshit.com" class="text-blue-600 underline">info@learnSyntax.com</a>
                    </div>
                    <div class="flex items-start space-x-4 mt-4">
                        <span class="font-medium text-black">Location:</span>
                        <p class="text-gray-700">Purnea, Bihar, India</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Map -->
            <div class="">

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.6739424016805!2d87.46727227485653!3d25.781331207794718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff97822565985%3A0x8a37146a54d517d3!2sThana%20Chowk%2C%20Pratap%20Nagar%2C%20Purnia%2C%20Bihar%20854301!5e0!3m2!1sen!2sin!4v1737696546865!5m2!1sen!2sin"
                    width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
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

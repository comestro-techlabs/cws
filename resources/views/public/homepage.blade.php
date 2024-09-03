@extends('public.layout')
<style>
    .elementor-divider-separator {
        display: block;
        height: 3px;
        margin: 20px 0;
        width: 110px;
        background: linear-gradient(to right, #feb47b, #570250);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>

@section('content')
    <x-hero />


    <!-- Heading Section -->
    <div class="bg-white py-12 px-4 text-center">
        <h2 class="text-xl font-semibold uppercase text-purple-600 mb-2">
            Our Services
        </h2>
        <p class="text-3xl font-bold text-gray-800">
            Comestro TechLabs offer end to end 'Digital Solutions'
        </p>
        <p class="text-lg font-light text-gray-600 mt-4">
            Partner with us to transform your vision into reality. Your journey to innovation starts here!
        </p>
    </div>

    <div class="flex flex-1 justify-center my-5">
        <div class="relative overflow-hidden w-full md:w-10/12">
            <!-- Carousel Container -->
            <div id="carousel"
                class="flex my-3 justify-center items-stretch transition-transform duration-700 ease-in-out h-[300px]">
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div
                        class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Web Design</h3>
                            <p class="mt-2 text-sm">Crafting visually stunning and user-friendly websites to elevate your
                                brand.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read
                            More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div
                        class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Web Development</h3>
                            <p class="mt-2 text-sm">Building robust, scalable web applications tailored to your business
                                needs.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read
                            More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div
                        class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Mobile App Development</h3>
                            <p class="mt-2 text-sm">Creating high-performance mobile apps for both iOS and Android
                                platforms.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read
                            More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div
                        class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">SEO</h3>
                            <p class="mt-2 text-sm">Enhancing your online presence with cutting-edge SEO strategies.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read
                            More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div
                        class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Software Development</h3>
                            <p class="mt-2 text-sm">Delivering custom software solutions that drive efficiency and growth.
                            </p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read
                            More</a>
                    </div>
                </div>
            </div>



            <!-- Arrows -->
            <button id="prev"
                class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white/45 text-gray-700 px-5 py-2 text-xl">
                &lt;
            </button>
            <button id="next"
                class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white/45 text-gray-700 px-5 py-2 text-xl">
                &gt;
            </button>


        </div>
    </div>

    {{-- who we are --}}
    <div class="flex-1 flex flex-col md:flex-row md:px-[8%] gap-10 mb-10 mt-">
        <div class="flex-1 p-5">
            <img src="{{ asset('assets/first_image.png') }}" class="w-full rounded-lg shadow-sm" alt="">
        </div>
        <div class="flex-1 p-5 md:p-10 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-3xl font-sans mb-4">Who We Are</h2>
            <h1 class="text-xl font-bold mb-4">Est. 2011 - Top Web Designing Company</h1>
            <p class="text-base text-gray-700 mb-6">
                With more than 15 years of expertise in the field, we've established ourselves as an evolving Digital
                Marketing Agency. Over the years, we have diversified according to market needs. We optimize website
                rankings, boost campaign performance, enhance brand names, create quality content, and popularize brands on
                social media...
            </p>
            <a href="#" class="text-gray-800 text-lg hover:underline font-bold mb-4 inline-block">
                Consider these steps for brand popularity in the Digital World...
            </a>
            <ul class="flex flex-col gap-2 list-disc list-inside text-gray-700">
                <li><a href="#" class="text-gray-800 font-semibold hover:text-orange-500">Define your goals</a></li>
                <li><a href="#" class="text-gray-800 font-semibold hover:text-orange-500">Identify your target
                        audience</a></li>
                <li><a href="#" class="text-gray-800 font-semibold hover:text-orange-500">Choose the right
                        channels</a></li>
                <li><a href="#" class="text-gray-800 font-semibold hover:text-orange-500">Create and implement your
                        campaigns</a></li>
            </ul>
        </div>
    </div>


    {{-- {{static info}} --}}
    <div class="flex flex-col gap-10 p-8 bg-white rounded-2xl mb-12 ">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-900 text-center mb-10">
            Results that Speak for Themselves: Why We’re a Top Digital Marketing Company in India
        </h2>

        <div class="flex flex-col md:flex-row w-full gap-8">
            <div
                class="flex-1 p-6 bg-gradient-to-r from-slate-600 to-slate-800 text-white rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                <h3 class="count-number text-5xl md:text-6xl font-extrabold" data-target="51485985">0</h3>
                <p class="stat-title text-lg mt-4">Qualified Leads Generated</p>
            </div>
            <div
                class="flex-1 p-6 bg-gradient-to-r from-slate-600 to-slate-800 text-white rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                <h3 class="count-number text-5xl md:text-6xl font-extrabold" data-target="78901234">0</h3>
                <p class="stat-title text-lg mt-4">Website Visitors</p>
            </div>
            <div
                class="flex-1 p-6 bg-gradient-to-r from-slate-600 to-slate-800 text-white rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                <h3 class="count-number text-5xl md:text-6xl font-extrabold" data-target="67890234">0</h3>
                <p class="stat-title text-lg mt-4">Conversions Achieved</p>
            </div>
        </div>
    </div>


    <section class="py-16 px-4 sm:px-8 md:px-20 bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl text-orange-600 sm:text-3xl font-bold mb-5">Please Feedback!</h1>
            <p class="text-sm sm:text-base text-slate-700 text-center">Our digital marketing team is eager to assist you! For any suggestions, feel free to give us a Feedback.</p>

            <span class="elementor-divider-separator"></span>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4 md:px-20">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4 md:px-20">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('enquiry.store') }}" method="post" class="mt-5 md:px-20">
            @csrf
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-5 p-4 sm:p-8">
                <div class="flex flex-col">
                    <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Name"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Email (optional)"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>             
            </div>
            <div class="flex flex-col px-8 py-3">
                <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}"
                    placeholder="Mobile No."
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="px-4 sm:px-8">
                <textarea id="message" name="message" value="{{ old('message') }}" placeholder="Message (optional) "
                    rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="bg-orange-500 text-white px-8 py-2 rounded-full shadow-md font-medium hover:bg-orange-600 transition duration-300">Send
                    Message </button>
            </div>
        </form>

    </section>


@endsection


@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.count-number');
            const speed = 60; // Adjust speed as needed

            counters.forEach(counter => {
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
            });
        });

        const carousel = document.getElementById('carousel');
        const indicators = document.querySelectorAll('.indicator');
        let index = 0;



        function slide() {
            const cards = document.querySelectorAll('#carousel > div');
            const totalCards = cards.length;

            index++;

            if (index >= totalCards) {
                index = 0;
                carousel.style.transition = 'none';
                carousel.style.transform = `translateX(0)`;
            } else {
                carousel.style.transition = 'transform 0.7s ease-in-out';
                const offset = -index * (cards[0].offsetWidth + 16);
                carousel.style.transform = `translateX(${offset}px)`;
            }

        }

        document.getElementById('next').addEventListener('click', () => {
            slide();
            clearInterval(autoSlide); // Stops auto slide when clicking next/prev
        });

        document.getElementById('prev').addEventListener('click', () => {
            index = index <= 0 ? document.querySelectorAll('#carousel > div').length - 1 : index - 2;
            slide();
            clearInterval(autoSlide); // Stops auto slide when clicking next/prev
        });
        // Auto slide every 3 seconds
        let autoSlide = setInterval(slide, 3000);
        // Set initial indicator
        updateIndicators();
    </script>
@endsection

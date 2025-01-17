@extends('public.layout')

@section('title')
    About us
@endsection

@section('meta')
    <meta name="description" content="Discover Comestro, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies."/>
@endsection

@section('content')
    <div class="bg-white pB-12 overflow-x-hidden">

        <!-- Header Section -->
        <livewire:page-heading title="About Comestro"
            description="Our Learn Syntax services is one of top Software Devlopment Company in India. We provide 360º
                    techLab Solutions to businesses across the globe."
            image="about-header.png" />

        <!-- Content Section -->
        <section class="py-10 flex flex-col md:flex-row">
        <!-- Text Content Section -->
        <div class="mx-4 md:mx-10 px-4 md:px-6 w-full md:w-1/2">
            <h2 class="text-lg font-semibold mb-4 text-gray-700 text-center md:text-left">About Us</h2>
            <h2 class="text-2xl md:text-3xl font-bold mb-6 text-blue-900 text-center md:text-left">
                We’re Leaders In Innovative Software Solutions
            </h2>
            <p class="text-md text-gray-700 leading-relaxed mb-4">
                <a href="/">At <span class="font-bold text-orange-500">Com</span></a><span class="font-bold text-blue-600">estro</span>, we believe in the power of innovation and technology to transform businesses. Based in Purnea, Bihar, we specialize in developing high-quality web applications, mobile apps, and custom websites that help our clients achieve their digital goals. Our passion for building innovative solutions drives us to deliver projects that are not only functional but also scalable and user-friendly.
            </p>
            <p class="text-md text-gray-700 leading-relaxed mb-4">
                Our mission is to empower businesses by providing them with cutting-edge digital products that enhance efficiency, drive growth, and create meaningful user experiences. Whether you're a startup or an established company, we partner with you to build software solutions tailored to your unique needs and goals.
            </p>
            <p class="font-bold text-lg text-gray-700 mb-2">
                What We Do:
            </p>
            <p class="text-md text-gray-700 leading-relaxed mb-4">
                1. Web Application Development:
                Our web applications are designed to meet your specific business needs, ensuring scalability, reliability, and seamless user experience. From complex enterprise-level systems to SaaS platforms, we deliver robust web apps that are both user-friendly and efficient.


            </p>
            <p class="text-md text-gray-700 leading-relaxed mb-4">
                2. Mobile App Development:
                We create high-performance mobile apps for both iOS and Android platforms. Our apps are built with a focus on usability, performance, and sleek design to ensure users love interacting with your brand on the go.

            </p>
            <p class="text-md text-gray-700 leading-relaxed">

                3. Custom Website Development:
                Your website is the digital face of your business. We design and develop custom websites that are visually stunning, optimized for performance, security, and SEO. Whether it's a corporate website, e-commerce platform, or portfolio, we ensure your site is built to succeed.
            </p>
            <p class="font-bold text-lg text-gray-700 mt-4 mb-2">
          Our Location:
            </p>
            <p class="text-md text-gray-700 leading-relaxed">

                Comestro is located at Thana Chowk, a bustling part of Purnea, Bihar, near the well-known Dog Hospital. Our office is easily accessible, making it convenient for local businesses and clients to collaborate with us. Purnea, with its blend of history and modernization, is quickly becoming a hub for tech startups and innovation in Eastern India.

                Our presence in Purnea allows us to tap into local talent while delivering Software solutions that compete on a global scale. We are proud to contribute to the local economy, providing job opportunities and empowering businesses in the region with our state-of-the-art technology services.
            </p>
        </div>

        <!-- Stats Cards Section -->
        <div class="w-full md:w-1/2 flex flex-col gap-6 md:gap-10 px-4 md:px-10 mt-10 md:mt-0 shake">
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                <div class="text-3xl md:text-4xl font-bold text-orange-600">500+</div>
                <div class="text-gray-600 mt-2 mr-2">Happy Clients</div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center shake">
                <div class="text-3xl md:text-4xl font-bold text-green-600">2500+</div>
                <div class="text-gray-600 mt-2 mr-4">Software</div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center shake">
                <div class="text-3xl md:text-4xl font-bold text-orange-600">345+</div>
                <div class="text-gray-600 mt-2 mr-2">Leads Delivered</div>
            </div>
        </div>
    </section>
        
        <!-- Development Journey Section -->
        <div class="bg-white py-12 px-4 text-center">
            <h2 class="text-xl font-semibold uppercase text-purple-600 mb-2">
                Our Development Journey
            </h2>
            <p class="text-3xl font-bold text-gray-800">
                Learn Syntax offer end-to-end 'Software solutions'
            </p>
            <p class="text-lg font-light text-gray-600 mt-4">
                Partner with us to transform your vision into reality. Your journey to innovation starts here!
            </p>
        </div>

        <!-- Carousel Section -->
        <div class="flex flex-1 justify-center my-5">
            <div class="relative overflow-hidden w-full md:w-10/12 px-2">
                <!-- Carousel Container -->
                <div id="carousel" class="flex my-3 transition-transform duration-700 ease-in-out h-[300px]">
                    <!-- Carousel items -->
                    <div class="flex-shrink-0 w-full sm:w-1/2 lg:w-1/3 px-2 sm:px-4 lg:px-5 flex">
                        <div class="flex flex-col items-center">
                            <div class="bg-white shadow-lg border rounded-lg p-6 text-center mb-4">
                                <p class="text-gray-700">
                                    Team size grows to 60+ digital experts & a new office is acquired.
                                </p>
                            </div>
                            <hr class="border-t border-gray-300 w-full mb-4">
                            <p class="text-blue-500 font-semibold mb-4">2018</p>
                            <div class="w-32 h-32 rounded-full overflow-hidden mb-4">
                                <img src="/assets/ab-1.jpg" alt="Profile Image" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
        
                    <!-- Repeat the above block for additional carousel items -->
                    <div class="flex-shrink-0 w-full sm:w-1/2 lg:w-1/3 px-2 sm:px-4 lg:px-5 flex">
                        <div class="flex flex-col items-center">
                            <div class="bg-white shadow-lg border rounded-lg p-6 text-center mb-4">
                                <p class="text-gray-700">
                                    Expanded our services to include new Software technology services.
                                </p>
                            </div>
                            <hr class="border-t border-gray-300 w-full mb-4">
                            <p class="text-blue-500 font-semibold mb-4">2020</p>
                            <div class="w-32 h-32 rounded-full overflow-hidden mb-4">
                                <img src="/assets/ab-2.jpg" alt="Profile Image" class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>

                    <!-- Add more items as needed -->
                </div>
        
                <!-- Arrows -->
                <button id="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-white/45 text-gray-700 px-4 py-2 text-xl md:px-5 md:py-3">
                    &lt;
                </button>
                <button id="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-white/45 text-gray-700 px-4 py-2 text-xl md:px-5 md:py-3">
                    &gt;
                </button>
            </div>
        </div>
        
    </div>
@endsection

@section('js')
    <script>
        const carousel = document.getElementById('carousel');
        const items = document.querySelectorAll('#carousel > div');
        let index = 0;

        function slide() {
            const totalItems = items.length;
            const itemWidth = items[0].offsetWidth;
            const offset = -index * itemWidth;

            if (index >= totalItems) {
                index = 0;
                carousel.style.transition = 'none';
                carousel.style.transform = `translateX(0)`;
            } else {
                carousel.style.transition = 'transform 0.7s ease-in-out';
                carousel.style.transform = `translateX(${offset}px)`;
            }
        }

        document.getElementById('next').addEventListener('click', () => {
            index++;
            slide();
            clearInterval(autoSlide); // Stops auto slide when clicking next/prev
        });

        document.getElementById('prev').addEventListener('click', () => {
            index = index <= 0 ? items.length - 1 : index - 1;
            slide();
            clearInterval(autoSlide); // Stops auto slide when clicking next/prev
        });

        // Auto slide every 5 seconds
        let autoSlide = setInterval(() => {
            index++;
            slide();
        }, 5000);

        // Handle window resize
        window.addEventListener('resize', slide);

        // Set initial slide
        slide();
    </script>
@endsection

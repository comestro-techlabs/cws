@extends('public.layout')

@section('content')
    <div class="bg-white py-12 overflow-x-hidden">

        <!-- Header Section -->
        <livewire:page-heading title="About Comestro"
            description="Our Comestro TechLab services is one of top techLab services agency in India. We provide 360º
                    techLab Solutions to businesses across the globe."
            image="about-header.png" />

        <!-- Content Section -->
        <section class="py-10 flex flex-col md:flex-row">
            <!-- Text Content Section -->
            <div class="mx-4 md:mx-10 px-4 md:px-6 w-full md:w-1/2">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 text-center md:text-left">About Us</h2>
                <h2 class="text-2xl md:text-3xl font-bold mb-6 text-blue-900 text-center md:text-left">
                    We’re Leaders In Innovative Digital Marketing Solutions
                </h2>
                <p class="text-md text-gray-700 leading-relaxed mb-4">
                    <a href="/" class="font-bold text-orange-500">Com</a><span class="font-bold text-blue-600">estro</span>, a top-tier digital marketing agency headquartered in Mumbai, has been a beacon of innovative digital solutions since its inception in 2009. Over the last 15 years, we have carved out a significant niche in the digital marketing landscape, offering a comprehensive suite of 360º Digital Solutions to a diverse range of businesses globally. Our journey from a humble one-person office to a robust team of over 110 digital experts, spread across three global locations, underscores our relentless pursuit of excellence and growth.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mb-4">
                    In our commitment to delivering exceptional value to our clients, we focus on driving performance-based outcomes that bolster revenue and enhance brand presence. Our expansive service offerings encompass Web Designing, Web Development, Search Engine Optimization (SEO), Pay per Click (PPC) Advertising, Social Media Optimization and Management (SMO/SMM), and Online Reputation Management (ORM). Each service is tailored to meet the unique needs of our clients, ensuring that we act as true growth partners in their digital journey.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mb-4">
                    With a rich history of innovation and adaptation, we have consistently evolved to meet the dynamic demands of the digital marketing ecosystem. This adaptability is reflected in our diverse SEO strategies, which include Voice SEO, YouTube SEO, Local SEO, On-page SEO, Off-page SEO, and Technical SEO. These strategies have been honed over years of expertise to offer foolproof solutions that enhance a website’s ranking and drive significant traffic.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mb-4">
                    Our efforts have yielded impressive results, with over 3,000 businesses benefiting from our services. We have managed over 2,500 SEO projects, delivered 345 million leads, and garnered the satisfaction of 1,500+ happy customers. These metrics are a testament to our effectiveness and dedication to helping our clients succeed.
                </p>
                <p class="text-md text-gray-700 leading-relaxed">
                    At the core of our services is a profound understanding of the digital sphere and an unwavering focus on leveraging this knowledge to benefit our clients. We have spent billions on Google ads, achieving a remarkable improvement in campaign performance, typically boosting existing performance by 30 to 40%. Moreover, our expertise extends to monitoring online conversations about brands, ensuring their reputation remains stellar across digital platforms.
                </p>
            </div>
        
            <!-- Stats Cards Section -->
            <div class="w-full md:w-1/2 flex flex-col gap-6 md:gap-10 px-4 md:px-10 mt-10 md:mt-0 shake">
                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center">
                    <div class="text-3xl md:text-4xl font-bold text-orange-600">1500+</div>
                    <div class="text-gray-600 mt-2">Happy Clients</div>
                </div>
        
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center shake">
                    <div class="text-3xl md:text-4xl font-bold text-green-600">2500+</div>
                    <div class="text-gray-600 mt-2">SEO Managed Websites</div>
                </div>
        
                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col items-center text-center shake">
                    <div class="text-3xl md:text-4xl font-bold text-orange-600">345M</div>
                    <div class="text-gray-600 mt-2">Leads Delivered</div>
                </div>
            </div>
        </section>
        
        <!-- Development Journey Section -->
        <div class="bg-white py-12 px-4 text-center">
            <h2 class="text-xl font-semibold uppercase text-purple-600 mb-2">
                Our Development Journey
            </h2>
            <p class="text-3xl font-bold text-gray-800">
                Comestro TechLabs offer end-to-end 'Digital Solutions'
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
                                    Expanded our services to include new digital marketing strategies.
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

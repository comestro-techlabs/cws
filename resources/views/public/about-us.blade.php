@extends('public.layout')
<style>
    /* Keyframes for shaking animation */
    @keyframes shake {
        0%,
        100% {
            transform: translateY(0);
        }
        25% {
            transform: translateY(-8px);
        }
        50% {
            transform: translateY(8px);
        }
        75% {
            transform: translateY(-8px);
        }
    }

    .shake {
        animation: shake 2s infinite;
    }

    .bend-bottom {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%);
    }
</style>
@section('content')
    <div class="bg-white py-12 ">

        <!-- Header Section -->
        <section class="bg-blue-900 text-white py-12" style="padding-top: 6.5rem;">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
                <!-- Text Content -->
                <div class="text-start md:text-left mb-8 md:mb-0 w-1/2">
                    <h1 class="text-4xl font-bold mb-4">About Comestro</h1>
                    <p class="mb-6">
                        Our Comestro TechLab services is one of top techLab services agency in India. We provide 360º
                        techLab Solutions to businesses across the globe.
                    </p>
                    <div class="flex ">
                        <a href="#"
                            class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-5 rounded-full mr-4">
                            GET FREE TUTORIAL
                        </a>
                        <a href="tel:+919546805580"
                            class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-5 rounded-full">
                            Call: +91-9546-8055-80
                        </a>
                    </div>
                </div>
                <!-- Image -->
                <div class="flex justify-center md:w-1/2 px-8">
                    <img src="/assets/about-header.png" alt="TechLab Illustration" class="max-w-full h-auto">
                </div>
            </div>
        </section>
        <div class="bend-bottom bottom-0 left-0 w-full h-16 bg-blue-900"></div>


        <!-- Content Section -->
        <section class="py-10 flex">
            <div class=" mx-24 px-16 w-1/2">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 md:text-start w-1/2">About us
                </h2>
                <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start">We’re Leader In Innovative Digital
                    Marketing Solutions</h2>
                <span></span>
                <p class="text-md text-gray-700 leading-relaxed">
                    <a href="/" class="">
                        <span class="text-orange-500 font-bold">Com</span><span
                            class="text-blue-600 font-bold">estro</span></a>, a top-tier digital marketing agency
                    headquartered in Mumbai, has been a beacon of innovative digital solutions since its inception in 2009.
                    Over the last 15 years, we have carved out a significant niche in the digital marketing landscape,
                    offering a comprehensive suite of 360º Digital Solutions to a diverse range of businesses globally. Our
                    journey from a humble one-person office to a robust team of over 110 digital experts, spread across
                    three global locations, underscores our relentless pursuit of excellence and growth
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">In our commitment to delivering exceptional value to
                    our clients, we focus on driving performance-based outcomes that bolster revenue and enhance brand
                    presence. Our expansive service offerings encompass Web Designing, Web Development, Search Engine
                    Optimization (SEO), Pay per Click (PPC) Advertising, Social Media Optimization and Management (SMO/SMM),
                    and Online Reputation Management (ORM). Each service is tailored to meet the unique needs of our
                    clients, ensuring that we act as true growth partners in their digital journey.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">With a rich history of innovation and adaptation, we
                    have consistently evolved to meet the dynamic demands of the digital marketing ecosystem. This
                    adaptability is reflected in our diverse SEO strategies, which include Voice SEO, YouTube SEO, Local
                    SEO, On-page SEO, Off-page SEO, and Technical SEO. These strategies have been honed over years of
                    expertise to offer foolproof solutions that enhance a website’s ranking and drive significant traffic.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">Our efforts have yielded impressive results, with over
                    3,000 businesses benefiting from our services. We have managed over 2,500 SEO projects, delivered 345
                    million leads, and garnered the satisfaction of 1,500+ happy customers. These metrics are a testament to
                    our effectiveness and dedication to helping our clients succeed.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">At the core of our services is a profound
                    understanding of the digital sphere and an unwavering focus on leveraging this knowledge to benefit our
                    clients. We have spent billions on Google ads, achieving a remarkable improvement in campaign
                    performance, typically boosting existing performance by 30 to 40%. Moreover, our expertise extends to
                    monitoring online conversations about brands, ensuring their reputation remains stellar across digital
                    platforms.
                </p>

            </div>

            <div class=" text-center w-1/2 flex flex-col gap-10 px-44 mt-10">

                <!-- Card 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6   shake">
                    <div class="text-4xl font-bold text-orange-600">1500+</div>
                    <div class="text-gray-600 mt-2">Happy Clients</div>
                </div>
        
                <!-- Card 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6 shake">
                    <div class="text-4xl font-bold text-green-600">2500+</div>
                    <div class="text-gray-600 mt-2">SEO Managed Websites</div>
                </div>
        
                <!-- Card 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6 shake">
                    <div class="text-4xl font-bold text-orange-600">345M</div>
                    <div class="text-gray-600 mt-2">Leads Delivered</div>
                </div>
        
            </div>
    
    </section>

    <div class="bg-white py-12 px-4 text-center">
        <h2 class="text-xl font-semibold uppercase text-purple-600 mb-2">
            Our Development Journey
        </h2>
        <p class="text-3xl font-bold text-gray-800">
            Comestro TechLabs offer end to end 'Digital Solutions'
        </p>
        <p class="text-lg font-light text-gray-600 mt-4">
            Partner with us to transform your vision into reality. Your journey to innovation starts here!
        </p>
    </div>


    <div class="flex flex-1 justify-center my-5 ">
        <div class="relative overflow-hidden w-full md:w-10/12 px-2">
            <!-- Carousel Container -->
            <div id="carousel"
                class="flex my-3 justify-center items-stretch transition-transform duration-700 ease-in-out h-[300px]">

                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 px-5 flex">
                    <!-- Card Container -->
                    <div class="flex flex-col items-center">
                        <!-- Description Card -->
                        <div class="bg-white shadow-lg border rounded-lg  p-10 text-center mb-4">
                            <p class="text-gray-700">
                                Team size grows to 60+ digital experts & a new office is acquired.
                            </p>
                        </div>

                        <!-- Horizontal Line -->
                        <hr class="border-t border-gray-300 w-full mb-4">


                        <p class="text-blue-500 font-semibold mb-4">2018</p>

                        <!-- Profile Image -->
                        <div class="w-32 h-32 rounded-full overflow-hidden mb-4">
                            <img src="/assets/ab-1.jpg" alt="Profile Image" class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 px-5 flex">
                    <!-- Card Container -->
                    <div class="flex flex-col items-center">

                        <!-- Profile Image -->
                        <div class=" h-40 rounded-full overflow-hidden mb-4">
                            <img src="/assets/ab-2.jpg" alt="Profile Image" class=" h-full object-cover">
                        </div>

                        <!-- Year -->
                        <p class="text-blue-500 font-semibold mb-4">2018</p>

                        <!-- Timeline Dot -->
                        <!-- Horizontal Line -->
                        <hr class="border-t border-gray-300 w-full mb-4">


                        <!-- Description Card -->
                        <div class="bg-white shadow-lg  border-b-8 border-blue-800 rounded-lg p-10 text-center">
                            <p class="text-gray-700">
                                Team size grows to 60+ digital experts & a new office is acquired.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 px-5 flex">
                    <!-- Card Container -->
                    <div class="flex flex-col items-center">

                        <!-- Description Card -->
                        <div class="bg-white shadow-lg  border-t-8 border-yellow-400  rounded-lg p-10 text-center mb-4">
                            <p class="text-gray-700">
                                Team size grows to 60+ digital experts & a new office is acquired.
                            </p>
                        </div>

                        <!-- Horizontal Line -->
                        <hr class="border-t border-gray-300 w-full mb-4">


                        <p class="text-blue-500 font-semibold mb-4">2018</p>

                        <!-- Profile Image -->
                        <div class=" h-40 rounded-full overflow-hidden mb-4">
                            <img src="/assets/ab-3.jpg" alt="Profile Image" class="w-full h-full object-cover">
                        </div>


                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 px-5 flex">
                    <!-- Card Container -->
                    <div class="flex flex-col items-center">

                        <!-- Profile Image -->
                        <div class=" h-40 rounded-full overflow-hidden mb-4">
                            <img src="/assets/ab-4.jpg" alt="Profile Image" class="w-full h-full object-cover">
                        </div>

                        <!-- Year -->
                        <p class="text-blue-500 font-semibold mb-4">2018</p>

                        <!-- Timeline Dot -->
                        <!-- Horizontal Line -->
                        <hr class="border-t border-gray-300 w-full mb-4">


                        <!-- Description Card -->
                        <div class="bg-white shadow-lg border-b-8 border-green-500 rounded-lg p-10 text-center">
                            <p class="text-gray-700">
                                Team size grows to 60+ digital experts & a new office is acquired.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 px-5 flex">
                    <!-- Card Container -->
                    <div class="flex flex-col items-center">

                        <!-- Description Card -->
                        <div class="bg-white shadow-lg border-t-8 border-red-400 rounded-lg p-10 text-center mb-4">
                            <p class="text-gray-700">
                                Team size grows to 60+ digital experts & a new office is acquired.
                            </p>
                        </div>
                        <!-- Horizontal Line -->
                        <hr class="border-t border-gray-300 w-full mb-4">


                        <p class="text-blue-500 font-semibold mb-4">2018</p>

                        <!-- Profile Image -->
                        <div class=" h-40 rounded-full overflow-hidden mb-4">
                            <img src="/assets/ab-1.jpg" alt="Profile Image" class="w-full h-full object-cover">
                        </div>

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
</div>


@section('js')
    <script>
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
        let autoSlide = setInterval(slide, 5000);

        // Set initial indicator
        updateIndicators();
    </script>
@endsection

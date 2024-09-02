@extends('public.layout')

<style>
    .bend-bottom {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%);
    }
</style>

@section('content')
    <div class="bg-white py-12 ">

        <!-- Header Section -->
        <section class="bg-blue-900 h-[430px] text-white py-12" style="padding-top: 6.5rem;  clip-path: polygon(0 0, 100% 0%, 100% 81%, 0 100%);">
            <div class="container mx-auto px-4 flex flex-col md:flex-row items-center" >
                <!-- Text Content -->
                <div class="text-start md:text-left mb-8 md:mb-0 w-1/2">
                    <h1 class="text-4xl font-bold mb-4">Comestro TechLab Services</h1>
                    <p class="mb-6">
                        Our TechLab services in India enhance your brand’s online presence, attract new customers,
                        and drive conversions, providing a competitive edge and securing new revenue sources for your
                        business.
                    </p>
                    <div class="flex">
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
                <div class="flex justify-center md:w-1/2 px-8" >
                    <img src="/assets/service-header.png" alt="TechLab Illustration" class="max-w-full h-full" >
                </div>
                
            </div>
        </section>
        <div class="bend-bottom bottom-0 left-0 w-full h-16 bg-blue-900"></div>


        <!-- Content Section -->
        <section class="py-16">
            <div class="container mx-auto px-10">
                <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start w-1/2">Grow your company the digital way!
                </h2>
                <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start w-1/2">Market your company digitally.</h2>
                <span></span>
                <p class="text-md text-gray-700 leading-relaxed">
                    Business is sales. Period! No company can ever survive in the long-run without a considerable amount of
                    sales. The sales target is always increasing and businesses often find it difficult to cope with the
                    industry pace. Businesses are always on a hunt for new sources of revenue. Well, your hunt is over. Look
                    around and you will find yourself in just the perfect spot. Our <strong>TechLab
                        Services</strong> are here to aid you to grow your business exponentially by exposing you to
                    diverse, untapped sources of revenue and improve your sales multifold, while helping your company retain
                    customers and find new customers.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3"><a href="/" class="">
                        <span class="text-orange-500 font-bold">Com</span><span
                            class="text-blue-600 font-bold">estro</span></a> believes that every business has infinite
                    potential and all they need is the right partner to unleash their potential. Our TechLab
                    Agency in a one-stop solution for all your web marketing needs. 82% of the population tends to search
                    for a product online before making an actual purchase. No company, irrespective of its size, can afford
                    to miss out on such a gigantic opportunity.
                </p>
                <h2 class="text-3xl font-bold text-gray-800 mb-3 mt-4">Businesses are investing intensely towards</h2>
                <!-- Subheading -->
                <h3 class="text-sm font-semibold text-gray-800 mb-2">TechLab Services in India to stay the front-runner in their industry.</h3>
                <!-- Intro Text -->
                <p class="text-sm font-medium text-gray-700 mb-8">
                    Let us comprehend the ways Comestro assists company’s like yours to achieve their
                </p>
    
                <!-- Feature List -->
                <div class="space-y-8">
                    <!-- Feature Item -->
                    <div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Measurable results</h4>
                        <p class="text-gray-700">
                            All activities performed by Comestro on various digital platforms are recorded in real-time and is always available at the tips of your finger. Data like customer interaction, conversion rate, impressions, etc are saved automatically and are available on the various accounts created by our <a href="#" class="text-blue-600 hover:text-blue-800">TechLab Agency</a> for your reference and analysis.
                        </p>
                    </div>
                    
                    <!-- Feature Item -->
                    <div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Low cost</h4>
                        <p class="text-gray-700">
                            Small businesses predominantly find it difficult to compete with the industry giants in marketing due to the latter’s enormous marketing budget. At Comestro, we believe that every rupee saved is a rupee earned. Our TechLab Agency specializes in smart-spending, so that you can achieve the maximum out of any size of budget.
                        </p>
                    </div>
                    
                    <!-- Feature Item -->
                    <div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Target Marketing</h4>
                        <p class="text-gray-700">
                            An ad in an esteemed newspaper agency will be viewed by millions. But how many of them will be your target audience? Probably a petite fraction of it. It means that lakhs of rupees are down the drain. Comestro will not allow you to make the same mistake. We scrutinize the target audience for you from the vast range of demographics options available and ensure that only relevant people view your ads.
                        </p>
                    </div>
                </div>
            </div>
        </section>

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
                                <p class="mt-2 text-sm">Crafting visually stunning and user-friendly websites to elevate
                                    your
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
                                <p class="mt-2 text-sm">Delivering custom software solutions that drive efficiency and
                                    growth.</p>
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
        let autoSlide = setInterval(slide, 3000);

        // Set initial indicator
        updateIndicators();
    </script>

@endsection

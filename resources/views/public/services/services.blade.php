@extends('public.layout')

@section('title')
    Explore our Services
@endsection


@section('content')
<br>
<livewire:page-heading title="Comestro TechLab Services" description="Our TechLab services in India enhance your brand’s online presence, attract new customers,
                        and drive conversions." image="about-header.png"/>


        <!-- Content Section -->
        <section class="py-10">
            <div class="container mx-auto px-10">
                <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start w-1/2">Grow your company the digital way!
                </h2>
                <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start w-1/2">Market your company digitally.</h2>
                <span></span>
                <p class="text-md text-gray-700 leading-relaxed">
                    Business is sales. Period! No company can ever survive in the long-run without a considerable amount of
                    sales. The sales target is always increasing and businesses often find it difficult to cope with the
                    industry pace. Businesses are always on a hunt for new sources of revenue. Well, your hunt is over. Look
                    around and you will find yourself in just the perfect spot. Our <strong>TechLab Services</strong> are here to aid you to grow your business exponentially by exposing you to
                    diverse, untapped sources of revenue and improve your sales multifold, while helping your company retain
                    customers and find new customers.
                </p>
                <p class="text-sm md:text-md text-gray-700 leading-relaxed mt-3">
                    <a href="/" class="">
                        <span class="text-orange-500 font-bold">Com</span><span class="text-blue-600 font-bold">estro</span></a> believes that every business has infinite
                    potential and all they need is the right partner to unleash their potential. Our TechLab Agency is a one-stop solution for all your web marketing needs. 82% of the population tends to search
                    for a product online before making an actual purchase. No company, irrespective of its size, can afford
                    to miss out on such a gigantic opportunity.
                </p>
                <h2 class="text-xl md:text-3xl font-bold text-gray-800 mb-3 mt-4 text-center md:text-left">Businesses are investing intensely towards</h2>
                <!-- Subheading -->
                <h3 class="text-xs md:text-sm font-semibold text-gray-800 mb-2 text-center md:text-left">TechLab Services in India to stay the front-runner in their industry.</h3>
                <!-- Intro Text -->
                <p class="text-xs md:text-sm font-medium text-gray-700 mb-8 text-center md:text-left">
                    Let us comprehend the ways Comestro assists companies like yours to achieve their
                </p>

                <!-- Feature List -->
                <div class="space-y-8">
                    <!-- Feature Item -->
                    <div>
                        <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-2">Measurable results</h4>
                        <p class="text-gray-700">
                            All activities performed by Comestro on various digital platforms are recorded in real-time and are always available at the tips of your fingers. Data like customer interaction, conversion rate, impressions, etc. are saved automatically and are available on the various accounts created by our <a href="#" class="text-blue-600 hover:text-blue-800">TechLab Agency</a> for your reference and analysis.
                        </p>
                    </div>

                    <!-- Feature Item -->
                    <div>
                        <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-2">Low cost</h4>
                        <p class="text-gray-700">
                            Small businesses predominantly find it difficult to compete with the industry giants in marketing due to the latter’s enormous marketing budget. At Comestro, we believe that every rupee saved is a rupee earned. Our TechLab Agency specializes in smart-spending so that you can achieve the maximum out of any size of budget.
                        </p>
                    </div>

                    <!-- Feature Item -->
                    <div>
                        <h4 class="text-lg md:text-xl font-bold text-gray-800 mb-2">Target Marketing</h4>
                        <p class="text-gray-700">
                            An ad in an esteemed newspaper agency will be viewed by millions. But how many of them will be
                            your target audience? Probably a petite fraction of it. It means that lakhs of rupees are down
                            the drain. Comestro will not allow you to make the same mistake. We scrutinize the target
                            audience for you from the vast range of demographics options available and ensure that only
                            relevant people view your ads.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <div class="bg-white py-12 px-4 text-center">
            <h2 class="text-lg md:text-xl font-semibold uppercase text-purple-600 mb-2">
                Our Services
            </h2>
            <p class="text-2xl md:text-3xl font-bold text-gray-800">
                Comestro TechLabs offer end-to-end 'Digital Solutions'
            </p>
            <p class="text-base md:text-lg font-light text-gray-600 mt-4">
                Partner with us to transform your vision into reality. Your journey to innovation starts here!
            </p>
        </div>

        <div class="flex flex-1 justify-center my-5">
            <div class="relative overflow-hidden w-full md:w-10/12">
                <!-- Carousel Container -->
                <div id="carousel"
                    class="flex my-3 justify-center items-stretch transition-transform duration-700 ease-in-out h-[300px]">
    
                    {{-- service card area --}}
                    <livewire:service-card title="Web Designing" description="This is web design service"
                        iconClass="fas fa-laptop-code" />
                    <livewire:service-card title="Web Designing" description="This is web design service"
                        iconClass="fas fa-laptop-code" />
                    <livewire:service-card title="Web Designing" description="This is web design service"
                        iconClass="fas fa-laptop-code" />
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




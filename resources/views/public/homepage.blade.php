@extends('public.layout')


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
            <div id="carousel" class="flex my-3 justify-center items-stretch transition-transform duration-700 ease-in-out h-[300px]">
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Web Design</h3>
                            <p class="mt-2 text-sm">Crafting visually stunning and user-friendly websites to elevate your brand.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Web Development</h3>
                            <p class="mt-2 text-sm">Building robust, scalable web applications tailored to your business needs.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Mobile App Development</h3>
                            <p class="mt-2 text-sm">Creating high-performance mobile apps for both iOS and Android platforms.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">SEO</h3>
                            <p class="mt-2 text-sm">Enhancing your online presence with cutting-edge SEO strategies.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read More</a>
                    </div>
                </div>
                <div class="flex-shrink-0 w-1/2 sm:w-1/3 lg:w-1/3 mx-2 flex">
                    <div class="bg-white border p-6 hover:bg-sky-600 hover:text-white  rounded-lg shadow-lg h-full flex flex-col justify-between">
                        <div>
                            <h3 class="text-lg font-bold">Software Development</h3>
                            <p class="mt-2 text-sm">Delivering custom software solutions that drive efficiency and growth.</p>
                        </div>
                        <a href="#" class="mt-4 inline-block text-sm font-medium  transition duration-300">Read More</a>
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
    <div class="flex-1 flex">
        <div class="flex-1 min-w-[50%]"></div>
        <div class="flex-1">
            <h2>Who we are</h2>
            <h1>Est 2011 Top Web Designing Company</h1>
            <p>More than 15 years of expertise in the field has established us as an upgrading Digital Marketing Agency. Over the years we have diversified according to the needs of the market. We optimize ranking of websites, increase performance of campaigns, enhance brand name, create quality content, popularize brand on social media… 
            </p>
            <a href="">Consider these steps for brand popularity in the Digital World...</a>

            <ul>
                <li><a href="">Define your goals</a></li>
                <li><a href="">Identify your target audience</a></li>
                <li><a href="">Choose the right channels</a></li>
                <li><a href="">Create and implement your campaigns</a></li>
            </ul>
        </div>
    </div>

{{-- {{static info}} --}}
<div class="flex flex-1 flex-col gap-4">
    <h2>Results that speak for themselves: See why we’re a top digital marketing company in India</h2>

    <div class="flex w-full divide-x-2">
        <div class="flex-1">
            <h3 class="text-4xl">51,485,985</h3>
            <p>Qualified Lead Generated</p>
        </div>
        <div class="flex-1">
            <h3 class="text-4xl">51,485,985</h3>
            <p>Qualified Lead Generated</p>
        </div>
        <div class="flex-1">
            <h3 class="text-4xl">51,485,985</h3>
            <p>Qualified Lead Generated</p>
        </div>
    </div>
</div>

   
@endsection


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
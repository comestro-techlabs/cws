<div class="w-full">
    <section class="bg-[#662d91] text-white py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Text Content -->
            <div class="text-center max-w-3xl mx-auto">
                <h1 class="text-3xl md:text-4xl font-bold mb-4 text-white">{{$title}}</h1>
                <p class="text-lg mb-8 text-purple-50">
                    {{$description}}
                </p>
                <div class="flex justify-center">
                    <a href="{{route('public.contact')}}"
                        class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-6 rounded-lg inline-flex items-center justify-center gap-2 transition duration-200 focus:ring-2 focus:ring-orange-400 focus:ring-offset-2">
                        Get Started
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="bend-bottom bg-[#662d91] hidden md:flex"></div>
</div>

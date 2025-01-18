@extends('public.layout')


@section('meta')
    <meta name="description" content="Join LearnSyntax Programming Classes and master coding with expert-led training in C, DBMS, Laravel, and Web Development. Learn hands-on programming techniques from beginner to advanced levels. Enroll now to enhance your coding skills and build a successful career in tech!"/>
@endsection

@section('content')

    <div class="bg-primary overflow-x-hidden">
        <x-hero />
    </div>


    <div class="flex flex-1 justify-center my-5">
        <div class="relative overflow-hidden w-full md:w-10/12">
            <section class="py-5">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-primary mb-2">What We Offer</h2>
                        <p class="text-3xl font-bold text-gray-800">
                            Learn Syntax offer end to end 'Software Solutions'
                        </p>
                        <p class="text-gray-600 mt-4">Our comprehensive services are designed to meet your business needs.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <a href="" class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-16 w-16 text-[#090446]">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                                </svg>

                            </div>
                            <h3 class="text-2xl font-semibold text-[#090446] mb-4">Consulting</h3>
                            <p class="text-gray-600">Expert advice to help you navigate complex business challenges.</p>
                        </a>
                        <a href="{{ route('public.services.web-dev') }}"
                            class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-16 w-16 text-primary">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                                </svg>

                            </div>
                            <h3 class="text-2xl font-semibold text-primary mb-4">Web Development</h3>
                            <p class="text-gray-600">Custom software solutions that drive efficiency and growth.</p>
                        </a>
                        <a href="{{ route('public.services.mobile-app') }}"
                            class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-16 w-16 text-[#ff1d15]">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                </svg>

                            </div>
                            <h3 class="text-2xl font-semibold text-[#ff1d15] mb-4">App Development</h3>
                            <p class="text-gray-600">Strategic marketing campaigns that deliver measurable results.</p>
                        </a>
                        <a href="{{ route('public.services.seo-services') }}"
                            class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="h-16 w-16 text-green-600">
                                    <path fill-rule="evenodd"
                                        d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </div>
                            <h3 class="text-2xl font-semibold text-green-600 mb-4">SEO Optimization</h3>
                            <p class="text-gray-600">Enhance your online presence with our expert SEO services.</p>
                        </a>
                        <a href="{{ route('public.services.web-design') }}"
                            class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <div class="flex justify-center mb-4">
                                <svg class="w-16 h-16 text-[#2a9d8f]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                        d="M8.737 8.737a21.49 21.49 0 0 1 3.308-2.724m0 0c3.063-2.026 5.99-2.641 7.331-1.3 1.827 1.828.026 6.591-4.023 10.64-4.049 4.049-8.812 5.85-10.64 4.023-1.33-1.33-.736-4.218 1.249-7.253m6.083-6.11c-3.063-2.026-5.99-2.641-7.331-1.3-1.827 1.828-.026 6.591 4.023 10.64m3.308-9.34a21.497 21.497 0 0 1 3.308 2.724m2.775 3.386c1.985 3.035 2.579 5.923 1.248 7.253-1.336 1.337-4.245.732-7.295-1.275M14 12a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                                </svg>

                            </div>
                            <h3 class="text-2xl font-semibold text-[#2a9d8f] mb-4">Web Design</h3>
                            <p class="text-gray-600">High-quality content that engages and converts your audience.</p>
                        </a>
                        <a href="{{ route('public.services.invent-sol') }}"
                            class="bg-white p-6 rounded-lg shadow-lg text-center">
                            <div class="flex justify-center mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="h-16 w-16 text-[#033e63e8]">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                                </svg>

                            </div>
                            <h3 class="text-2xl font-semibold text-[#033e63e8] mb-4">Inventory Solutions</h3>
                            <p class="text-gray-600">Data-driven insights to help you make informed business decisions.</p>
                        </a>
                    </div>
                </div>
            </section>

        </div>
    </div>
       <div class="max-w-6xl mx-auto p-6">
        <h2 class="text-3xl text-center font-bold text-primary mb-4"> Admission to Certification</h2>
        <p class="text-3xl font-bold text-center text-gray-800">
            Explore available courses, check your eligibility
        </p>
        <p class="text-gray-600  text-center mt-2">prepare for a certificate that makes you stand out in the professional world.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-8">

             <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <p class="text-secondary font-bold text-xl mb-4">Step-1</p>
                <div class="flex items-center space-x-4 mb-4">
                    <svg class="w-10 h-10 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7c1.657 0 3 1.343 3 3v4c0 1.657-1.343 3-3 3H8c-1.657 0-3-1.343-3-3v-4c0-1.657 1.343-3 3-3h8zM12 5V3M16.5 9.5h-9m3.75-6h1.5" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-800">Admission Start Date</h3>
                </div>


                 <p class="text-gray-600  mb-6">
                    Mark your calendar! Admissions begin soon, so make sure to your register on time.
                </p>

                <div class="flex justify-between items-center">
                    <p class="text-gray-700 font-medium text-lg">January 10, 2025</p>
                    <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <p class="text-secondary font-bold text-xl mb-4">Step-2</p>
                <div class="flex items-center space-x-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-primary">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c3.866 0 7 2.686 7 6s-3.134 6-7 6-7-2.686-7-6 3.134-6 7-6zm0 12v6m-4 0h8" />
                      </svg>

                    <h3 class="text-2xl font-bold text-gray-800">Courses Available</h3>
                </div>


                <p class="text-gray-600  mb-6">
                    Empower your future with practical, expertly designed courses tailored to  goals.
                </p>

                <div class="flex justify-between items-center">
                    <p class="text-gray-700 font-medium text-lg">January 10, 2025</p>
                    <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>




            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <p class="text-secondary font-bold text-xl mb-4">Step-3</p>
                <div class="flex items-center space-x-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-green-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12l5 5L19 7" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2z" />
                      </svg>


                    <h3 class="text-2xl font-bold text-gray-800">Eligibility Criteria</h3>
                </div>


                <p class="text-gray-600  mb-6">
                    Candidates must meet minimum educational qualifications, and relevent skill.
                </p>

                <div class="flex justify-between items-center">
                    <p class="text-gray-700 font-medium text-lg">January 10, 2025</p>
                    <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <p class="text-secondary font-bold text-xl mb-4">Step-4</p>
                <div class="flex items-center space-x-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-red-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m6-6h-3m-6 0H6m12-5h-9m0 0V6M9 12V6" />
                      </svg>



                    <h3 class="text-2xl font-bold text-gray-800">Application Fee</h3>
                </div>


                <p class="text-gray-600  mb-6">
                    A non-refundable application fee is required to complete your registration the course.
                </p>

                <div class="flex justify-between items-center">
                    <p class="text-gray-700 font-medium text-lg">January 10, 2025</p>
                    <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>
          <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <p class="text-secondary font-bold text-xl mb-4">Step-5</p>
                <div class="flex items-center space-x-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-yellow-600">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 4h8M12 4v16m4-4l2 2 2-2m-6 0l-2 2-2-2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2z" />
                      </svg>


                    <h3 class="text-2xl font-bold text-gray-800">Certificate Provided</h3>
                </div>


                <p class="text-gray-600  mb-6">
                    Upon successful completion, a certificate will be awarded to recognize your achievements.
                </p>

                <div class="flex justify-between items-center">
                    <p class="text-gray-700 font-medium text-lg">January 10, 2025</p>
                    <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>





            <div class="bg-white border border-gray-300 rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow duration-300">
                <p class="text-secondary font-bold text-xl mb-4">Step-6</p>
                <div class="flex items-center space-x-4 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-purple-700">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2zm16 0V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 9h10M7 13h8" />
                    </svg>

                    <h3 class="text-2xl font-bold text-gray-800">Mode of Study</h3>
                </div>
                <p class="text-gray-600  mb-6">
                    Choose between online, on-campus, or hybrid  with learning options to suit your needs.
                </p>
                <div class="flex justify-between items-center">
                    <p class="text-gray-700 font-medium text-lg">Online / On-Campus / Hybrid</p>
                    <svg class="w-6 h-6 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>




        </div>
    </div>


    {{-- who we are --}}
    <div class="flex-1 flex flex-col md:flex-row md:px-[8%] gap-10 mt-10">
        <div class="flex-1 p-5">
            <img src="{{ asset('assets/first_image.png') }}" class="w-full rounded-lg shadow-sm ring-slate-600 "
                alt="">
        </div>
        <div class="flex-1 p-5 md:p-10 bg-gray-100 rounded-lg shadow-md">
            <h2 class="text-3xl font-sans mb-4">Who We Are</h2>
            <h1 class="text-xl font-bold mb-4">Est. 2011 - Top Web Designing Company</h1>
            <p class="text-base text-gray-700 mb-6">
                With more than 15 years of expertise in the field, we've established ourselves as an evolving Software Company. Over the years, we have diversified according to market needs. We optimize website
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



    {{-- {{static info}} --}}
    <div class="flex flex-col gap-2 p-8 bg-white rounded-2xl mb-12 items-center md:px-[10%]">
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
{{-- 
    <section class="py-16 px-4 sm:px-8 md:px-20 bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl text-orange-600 sm:text-3xl font-bold mb-5">Please Feedback!</h1>
            <p class="text-sm sm:text-base text-slate-700 text-center">Our Software Devlopment team is eager to assist you!
                For any suggestions, feel free to give us a Feedback.</p>

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
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm ring-slate-600  focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        placeholder="Email (optional)"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm ring-slate-600  focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
            <div class="flex flex-col px-8 py-3">
                <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}"
                    placeholder="Mobile No."
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm ring-slate-600  focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="px-4 sm:px-8">
                <textarea id="message" name="message" value="{{ old('message') }}" placeholder="Message (optional) "
                    rows="4"
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm ring-slate-600  focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <div class="mt-8 flex justify-center">
                <button type="submit"
                    class="bg-orange-500 text-white px-8 py-2 rounded-full shadow-md font-medium hover:bg-orange-600 transition duration-300">Send
                    Message </button>
            </div>
        </form>

    </section> --}}

    <div class="flex flex-col items-center text-center">
        <h2 class="text-3xl text-primary font-sans font-bold mb-4">Our Latest Courses</h2>
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Master the Skills to Build Your Future</h1>
        <p class="text-base text-gray-700 mb-6 max-w-4xl">
            Explore our curated courses designed to provide you with the latest industry insights and practical knowledge.
            From beginner to advanced levels, we aim to help you excel in your field with expert-led guidance and innovative
            content. Upgrade your skills and achieve your career goals with us!
        </p>
        
    </div>
    
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 px-4 lg:px-32">
        @foreach ($courses as $item)
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg border overflow-hidden">
            <img class="w-full h-48 object-cover" src="{{asset('storage/course_images/' . $item->course_image)}}" alt="Course Image">
            
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">{{$item->title}}</h2>
                <p class="text-gray-600 text-sm mb-4">
                    {{ Str::limit($item->description, 122) }}
                </p>
                <div class="flex items-center mb-4">
                    <div class="ml-3">
                        <p class="text-gray-700 text-sm font-medium">{{$item->instructor}}</p>
                    </div>
                </div>
                <div class="flex justify-between items-center">
                    <p class="text-lg font-bold text-primary">Rs.{{$item->discounted_fees}}</p>
                    <a href="{{route('public.courseDetails',['category_slug' => $item->category->cat_slug, 'slug' =>  $item->slug])}}" class="bg-secondary text-white font-bold py-2 px-4 rounded shadow focus:outline-none focus:ring">
                        Enroll Now
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="text-center mt-6">
        <a href="{{ route('public.training') }}" class="bg-secondary text-white font-bold py-2 px-6 rounded shadow">
            View All Courses 
        </a>
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

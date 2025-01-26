@extends('public.layout')

@section('title')
    Contact us
@endsection
@section('content')
    <div class="bg-white 
 overflow-x-hidden">
        <livewire:page-heading title="Our Contact"
        description="We’re here to help with all your software development needs. Whether you have inquiries, require technical support, or want to discuss a project idea, our dedicated team is here to assist you. Reach out to us today and let’s build something exceptional together." 

            image="about-header.png" />

        <section class="py-16 px-4 sm:px-8 lg:px-16 max-w-screen-xl mx-auto" id="contact-form">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">
                <div class="space-y-6">
                    <div class="flex flex-col items-center sm:items-start text-center sm:text-left">
                        <h1 class="text-lg font-semibold text-slate-600">Contact Us for Web Designing Services</h1>
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2">How To Contact Us?</h2>
                        <p class="text-sm md:text-base mt-4 text-slate-600 font-semibold">We have great, flexible support via live chat, email, and phone.</p>
                    </div>
                    
                    <div class="flex justify-center sm:justify-start my-4">
                        <span class="elementor-divider-separator block w-1/2 sm:w-full"></span>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 justify-center sm:justify-start">
                        <div class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/location.png" alt="Location Image" class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Visit our Office.</p>
                                <h1 class="text-md font-bold text-black mt-2">854305, Purnia Thana Chowk</h1>
                            </div>
                        </div>
                        <div class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/email.png" alt="Email Image" class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Have a project in mind?<br>Send a message.</p>
                                <h1 class="text-md font-bold text-black mt-2"> info@LearnSyntax.com</h1>
                            </div>
                        </div>
                        <div class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/phone.png" alt="Phone Image" class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Have a project in <br> mind? Send a message.</p>
                                <h1 class="text-md font-bold text-black mt-2">(+91) 9546805580</h1>
                            </div>
                        </div>
                        <div class="flex flex-col items-center sm:flex-row sm:items-start space-x-0 sm:space-x-4 text-center sm:text-left">
                            <img src="/assets/whatapp.png" alt="WhatsApp Image" class="w-15 h-15 sm:w-15 sm:h-15 mb-4 sm:mb-0">
                            <div>
                                <p>Would you like to <br> join our growing team?</p>
                                <h1 class="text-md font-bold text-black mt-2">(+91) 9546805580</h1>
                            </div>
                        </div>
                    </div>
                    

                </div>
                <div class="flex items-center justify-center">
                    <iframe class="rounded-xl w-full h-64 sm:h-72 md:h-96"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.629023335638!2d87.46747347465347!3d25.782814277338673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff97801471a9f%3A0xf8f622c46e9afaa9!2sLearn Syntax%20(Code%20with%20SadiQ)!5e0!3m2!1sen!2sin!4v1725219952931!5m2!1sen!2sin"
                        style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>



        <div class="container flex items-center justify-center text-slate-600 font-semibold mb-10 mt-10 px-4 sm:px-8 lg:px-16 ">
            <p>We’ll help you understand your needs, develop a customized plan, and execute the plan effectively. Our
                three-step approach is simple, but it’s effective.</p>
        </div>

        {{-- <div class="curve-bottom wave h-32 bg-gray-100"></div> --}}

        <section class="py-16 px-4 sm:px-8 md:px-20 bg-gray-100">
            <div class="flex flex-col items-center justify-center text-center">
                <h1 class="text-2xl sm:text-3xl font-bold mb-5">Get in touch with us!</h1>
                <p class="text-sm sm:text-base text-slate-700">Our Software Devlopment team is always keen to help. For any
                    queries/suggestions, kindly give us a call, send us an email, or fill out the form below.</p>
                <span class="elementor-divider-separator"></span>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('enquiry.store') }}" method="post" class="mt-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="flex flex-col">
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Name"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex flex-col">
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Email (optional)"
                            class="mt-1 block w-full p-2 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
                <div class="flex flex-col mt-5">
                    <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile No."
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="mt-5">
                    <textarea id="message" name="message" placeholder="Message (optional)" rows="4"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                </div>

                <div class="mt-8 flex justify-center">
                    <button type="submit"
                        class="bg-secondary text-white px-8 py-2 rounded-full shadow-md font-medium hover:bg-orange-600 transition duration-300">Send
                        Message</button>
                </div>
            </form>
        </section>


        

    </div>
@endsection

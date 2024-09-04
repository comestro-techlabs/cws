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

    .wave {
        clip-path: polygon(0 70%, 10% 65%, 25% 62%, 40% 68%, 55% 63%, 70% 70%, 85% 65%, 100% 60%, 100% 100%, 0 100%);
        /* clip-path: polygon(  0% 70%,
                10% 75%,
                20% 80%,
                30% 85%,
                40% 80%,
                50% 75%,
                60% 70%,
                70% 75%,
                80% 80%,
                90% 85%,
                100% 70%,
                100% 100%,
                0% 100%); */
    }
</style>

@section('content')
 
        <livewire:page-heading title="Get in Touch" description="We’re here to help with your digital marketing needs. Whether you have questions or need support, our
                    team is ready to assist you." image="about-header.png"/>

        <section class="py-16 px-16 sm:px-8 lg:px-16" id="contact-form">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="space-y-6">
                <h1 class="text-lg font-semibold text-slate-600">Contact Us for Web Designing Services</h1>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">How To Contact Us?</h2>
                <h2 class="text-sm md:text-md">We have world-class, flexible support via live chat, email and phone.</h2>

                <span class="elementor-divider-separator"></span>

                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                    <div>
                        <img src="/assets/location.png" alt="Location Image">
                        <div class="mt-4">
                            <p>Visit our headquarters
                                <br>
                                Reg Office:         
                            </p><br>
                            <h1 class="text-md font-bold text-black">Ramavtar Market, GandhiNagar, Madhubani, Purnea (Bihar) - 854301</h1>
                        </div>
                    </div>
                    <div>
                        <img src="/assets/email.png" alt="Email Image">
                        <div class="mt-4">
                            <p>Have a project in mind?<br>Send a message.</p><br>
                            <h1 class="text-md font-bold text-black">comestrotechlabs@gmail.com</h1>
                        </div>
                    </div>
                    <div>
                        <img src="/assets/phone.png" alt="Phone Image">
                        <div class="mt-4">
                            <p>Have a project in <br> mind? Send a message.</p>
                            <br>
                            <h1 class="text-md font-bold text-black"><a href="tel:{{env('PHONE_NO')}}">{{env('PHONE_NO')}}</a></h1>
                        </div>  
                    </div>
                    <div>
                        <img src="/assets/whatapp.png" alt="WhatsApp Image">
                        <div class="mt-4">
                            <p>Would you like to <br> join our growing team?</p>
                            <br>
                            <h1 class="text-md font-bold text-black"><a href="tel:{{env('PHONE_NO')}}">{{env('PHONE_NO')}}</a></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <iframe class="rounded-xl"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3592.629023335638!2d87.46747347465347!3d25.782814277338673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eff97801471a9f%3A0xf8f622c46e9afaa9!2sComestro%20(Code%20with%20SadiQ)!5e0!3m2!1sen!2sin!4v1725219952931!5m2!1sen!2sin"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <div class="container text-center text-gray-800 mb-10 mt-10 px-4 sm:px-8 lg:px-16">
        <p>We’ll help you understand your needs, develop a customized
            plan, and execute the plan effectively. Our three-step approach is simple, but it’s effective.</p>
    </div>

    <div class="curve-bottom wave h-32 bg-gray-100"></div>

    <section class="py-16 px-4 sm:px-8 md:px-20 bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl sm:text-3xl font-bold mb-5">Get in touch with us!</h1>
            <p class="text-sm sm:text-base text-slate-700 text-center">Our digital marketing team is always keen to help.
                For any queries/suggestions, kindly give us a call, send <br> us an email, or fill out the form below.</p>

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
                <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile No."
                    class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="px-4 sm:px-8">
                <textarea id="message" name="message" value="{{ old('message') }}" placeholder="Message (optional) " rows="4"
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

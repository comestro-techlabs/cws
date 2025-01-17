@extends('public.layout')

@section('title')
    Web Design
@endsection
@section('content')
<div class="bg-white 
 overflow-x-hidden">
    <livewire:page-heading title="Web Designing"
        description="Our TechLab services in India enhance your brand’s online presence, attract new customers,
                    and drive conversions, providing a competitive edge and securing new revenue sources for your
                    business."
        image="about-header.png" />




    <!-- Services Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">Our Web Design Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Service 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/assets/ab-2.jpg" alt="Responsive Design" class="mb-4 h-40 w-full object-cover rounded-md">
                    <h3 class="text-xl font-semibold mb-3">Responsive Web Design</h3>
                    <p class="text-gray-700 mb-4">
                        We create websites that look great on all devices, ensuring a seamless user experience
                        across desktops, tablets, and mobile phones.
                    </p>
                    <a href="#" class="text-orange-500 font-bold">Learn More</a>
                </div>
                <!-- Service 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/assets/ab-3.jpg" alt="E-commerce Solutions" class="mb-4 h-40 w-full object-cover rounded-md">
                    <h3 class="text-xl font-semibold mb-3">E-commerce Solutions</h3>
                    <p class="text-gray-700 mb-4">
                        We design and develop e-commerce platforms that drive sales and provide an exceptional shopping
                        experience.
                    </p>
                    <a href="#" class="text-orange-500 font-bold">Learn More</a>
                </div>
                <!-- Service 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <img src="/assets/branding.png" alt="Branding & Identity"
                        class="mb-4 h-40 w-full object-cover rounded-md">
                    <h3 class="text-xl font-semibold mb-3">Branding & Identity</h3>
                    <p class="text-gray-700 mb-4">
                        We help you create a unique brand identity that resonates with your audience and sets you apart from
                        the competition.
                    </p>
                    <a href="#" class="text-orange-500 font-bold">Learn More</a>
                </div>
                <!-- Add more services as needed -->
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-gray-100 py-16">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-12">What Our Clients Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-700 mb-4">"Learn Syntax has completely transformed our online presence. Their
                        design is modern, responsive, and exactly what we needed to grow our business."</p>
                    <p class="font-bold text-blue-900">- John Doe, CEO of Company A</p>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-700 mb-4">"The e-commerce site they built for us has been a game-changer. Sales have
                        increased by 40% since we launched."</p>
                    <p class="font-bold text-blue-900">- Jane Smith, Founder of Company B</p>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <p class="text-gray-700 mb-4">"Their team is incredibly skilled and easy to work with. They brought our
                        vision to life with creativity and precision."</p>
                    <p class="font-bold text-blue-900">- Mike Johnson, Marketing Director at Company C</p>
                </div>
                <!-- Add more testimonials as needed -->
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-16 px-4 sm:px-8 md:px-20 bg-gray-100 mt-10">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl sm:text-3xl font-bold mb-5">Get in touch with us!</h1>
            <p class="text-sm sm:text-base text-slate-700 text-center">Our Software Devlopment team is always keen to help.
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
</div>
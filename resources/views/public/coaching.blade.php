@extends('public.layout')
@section('content')
    <div class="bg-white py-12 overflow-x-hidden">
        <livewire:page-heading title="Coaching Management System"
            description="Our Comestro TechLab services is one of top techLab services agency in India. We provide 360º
                techLab Solutions to businesses across the globe."
            image="about-header.png" />

        <!-- body section -->
        <div class="flex flex-1">
            <section class="py-10 flex w-full flex-col">
                <div class="mx-4 sm:mx-10 lg:mx-20 px-4 sm:px-8 lg:px-16">
                    <div class="w-full lg:w-1/2">
                        <h2 class="text-lg font-semibold mb-4 text-gray-700 text-center lg:text-start">Coaching Management System</h2>
                        <h2 class="text-3xl font-bold mb-4 text-blue-900 text-center lg:text-start">
                            Empowering Education with Innovative, Affordable, and Professional Full-Stack Coaching Management Systems
                        </h2>
                    </div>
                    <p class="text-md text-gray-700 leading-relaxed mt-3"> 
                        <a href="/" class="font-bold text-orange-500">Com</a><span class="font-bold text-blue-600">estro</span> stands at the forefront of delivering cutting-edge full-stack coaching management systems, meticulously designed to support the unique needs of educational institutions and coaching centers. Our platforms are built with the latest technologies, offering a seamless blend of functionality, ease of use, and adaptability to ensure your operations run smoothly and efficiently.
                    </p>
                    <p class="text-md text-gray-700 leading-relaxed mt-3"> 
                        We understand that every educational institution has its own set of challenges and requirements. That's why our solutions are fully customizable, allowing you to tailor the system to meet your specific needs. Whether you’re managing student enrollments, tracking progress, or scheduling classes, our platform provides a comprehensive suite of tools to streamline every aspect of your coaching operations.
                    </p>
                    <p class="text-md text-gray-700 leading-relaxed mt-3"> 
                        Affordability is a core value at Comerstro. We believe that high-quality technology should be accessible to all, regardless of budget constraints. Our pricing models are designed to offer maximum value, ensuring that even small to medium-sized institutions can benefit from our state-of-the-art solutions without compromising on quality.
                    </p>
                    <p class="text-md text-gray-700 leading-relaxed mt-3"> 
                        Professionalism is at the heart of everything we do. From the initial consultation to ongoing support, our team of experts is dedicated to providing a seamless experience. We take pride in our responsive customer service, offering continuous assistance and guidance to help you get the most out of our systems. Our clients’ success is our success, and we are committed to building long-lasting relationships based on trust and excellence.
                    </p>
                    <p class="text-md text-gray-700 leading-relaxed mt-3"> 
                        Our full-stack systems are engineered with scalability in mind, ensuring that as your institution grows, our platform can grow with you. Whether you're expanding to new locations or increasing your student base, Comerstro’s solutions are designed to scale effortlessly, adapting to your evolving needs without disruption.
                    </p>
                    <p class="text-md text-gray-700 leading-relaxed mt-3"> 
                        Security and data integrity are paramount in today’s digital landscape, and Comerstro takes this responsibility seriously. Our systems are built with robust security measures to protect sensitive information, ensuring that student data, financial records, and other critical assets are kept safe and secure at all times. We adhere to industry best practices, providing peace of mind to educators and administrators alike.
                    </p>
                </div>
            </section>
        </div>
        
        <div class="flex flex-1 justify-center px-4 sm:px-8 lg:px-16">
            <h1 class="text-4xl font-bold mb-4 text-blue-900 text-center">What We Will Provide</h1>
        </div>
        
        <!-- grid box -->
        <div class="flex flex-1">
            <section class="py-10 flex w-full flex-col">
                <div class="mx-4 sm:mx-10 lg:mx-20 px-4 sm:px-8 lg:px-16">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <img class="object-cover  rounded-t-lg h-48 sm:h-96 md:h-auto md:w-32 md:rounded-none md:rounded-s-lg" src="assets/icons/school1.png" alt="">
                            <div class="flex flex-col items-center p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white mt-8">Manage Your Whole System</h5>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <img class="object-cover  rounded-t-lg h-48 sm:h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="assets/icons/graduated.png" alt="">
                            <div class="flex flex-col items-center p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white mt-8">You Can Manage Your Student</h5>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <img class="object-cover  rounded-t-lg h-48 sm:h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="assets/icons/tablet.png" alt="">
                            <div class="flex flex-col items-center p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white mt-8">We provide you Admin Panel</h5>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <img class="object-cover  rounded-t-lg h-48 sm:h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="assets/icons/webinar.png" alt="">
                            <div class="flex flex-col items-center p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white mt-8">You Can Manage Your Courses</h5>
                            </div>
                        </div>
                        <div class="flex flex-col items-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <img class="object-cover  ml-16 rounded-t-lg h-48 sm:h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="assets/icons/shield.png" alt="">
                            <div class="flex flex-col items-center p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white mt-8">Full Secure System</h5>
                            </div>
                        </div>
                        <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                            <img class="object-cover rounded-t-lg h-48 sm:h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="assets/icons/payment-method.png" alt="">
                            <div class="flex flex-col items-center p-4 leading-normal">
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 dark:text-white mt-8">Payment Gateway Integration</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <!--
    contact Us -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 md:px-10">
            <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-6">Get in Touch With Us!</h1>
            <p class="text-base md:text-lg text-center text-gray-700 mb-8">
                Our digital marketing team is always keen to help. For any queries or suggestions, kindly give us a call, send us an email,
                or fill out the form below.
            </p>

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

            <form action="{{ route('enquiry.store') }}" method="post" class="bg-white p-8 rounded-lg shadow-lg">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-gray-600 font-medium mb-2">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Your Name"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="email" class="block text-gray-600 font-medium mb-2">Email (optional)</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Your Email"
                            class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="mobile" class="block text-gray-600 font-medium mb-2">Mobile No.</label>
                        <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Your Mobile No."
                            class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="message" class="block text-gray-600 font-medium mb-2">Message (optional)</label>
                    <textarea id="message" name="message" placeholder="Your Message"
                        rows="6"
                        class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="mt-8 text-center">
                    <button type="submit"
                        class="bg-orange-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 transition duration-300">Send Message</button>
                </div>
            </form>
        </div>
    </section>
    </div>
@endsection

@extends('public.layout')

@section('title')
    Coaching Management System    
@endsection

@section('content')

<livewire:page-heading title="Coaching Management System" description="Our Comestro TechLab services is one of top techLab services agency in India. We provide 360º
                techLab Solutions to businesses across the globe." image="about-header.png"/>

<!-- body section -->
<div class="flex flex-1">
    <section class="py-10 flex w-full flex-col">
        <div class=" mx-20 px-16">
            <div class="w-1/2">
                <h2 class="text-lg font-semibold mb-4 text-gray-700 md:text-start w-1/2">Coaching Management System
                </h2>
                <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start">Empowering Education with Innovative, Affordable, and Professional Full-Stack Coaching Management Systems</h2>
            </div>

            <p class="text-md w-full text-gray-700 leading-relaxed">
                <a href="/" class="">
                    <span class="text-orange-500 font-bold">Com</span><span
                        class="text-blue-600 font-bold">estro</span></a>stands at the forefront of delivering cutting-edge full-stack coaching management systems, meticulously designed to support the unique needs of educational institutions and coaching centers. Our platforms are built with the latest technologies, offering a seamless blend of functionality, ease of use, and adaptability to ensure your operations run smoothly and efficiently.
            </p>
            <p class="text-md text-gray-700 leading-relaxed mt-3"> We understand that every educational institution has its own set of challenges and requirements. That's why our solutions are fully customizable, allowing you to tailor the system to meet your specific needs. Whether you’re managing student enrollments, tracking progress, or scheduling classes, our platform provides a comprehensive suite of tools to streamline every aspect of your coaching operations.
            </p>
            <p class="text-md text-gray-700 leading-relaxed mt-3">Affordability is a core value at Comerstro. We believe that high-quality technology should be accessible to all, regardless of budget constraints. Our pricing models are designed to offer maximum value, ensuring that even small to medium-sized institutions can benefit from our state-of-the-art solutions without compromising on quality.
            </p>
            <p class="text-md text-gray-700 leading-relaxed mt-3">Professionalism is at the heart of everything we do. From the initial consultation to ongoing support, our team of experts is dedicated to providing a seamless experience. We take pride in our responsive customer service, offering continuous assistance and guidance to help you get the most out of our systems. Our clients’ success is our success, and we are committed to building long-lasting relationships based on trust and excellence.
            </p>
            <p class="text-md text-gray-700 leading-relaxed mt-3">Our full-stack systems are engineered with scalability in mind, ensuring that as your institution grows, our platform can grow with you. Whether you're expanding to new locations or increasing your student base, Comerstro’s solutions are designed to scale effortlessly, adapting to your evolving needs without disruption.
            </p>
            <p class="text-md text-gray-700 leading-relaxed mt-3">Security and data integrity are paramount in today’s digital landscape, and Comerstro takes this responsibility seriously. Our systems are built with robust security measures to protect sensitive information, ensuring that student data, financial records, and other critical assets are kept safe and secure at all times. We adhere to industry best practices, providing peace of mind to educators and administrators alike.
            </p>

        </div>
    </section>
</div>

<div class="flex flex-1 justify-center">
    <h1 class="text-4xl font-bold mb-4 text-blue-900 md:text-start">What We Will Provide</h1>
</div>
<!-- grid box -->
<div class="flex flex-1 ">
    <section class="py-10 flex w-full  flex-col">
        <div class=" mx-20 px-16">
            <div class="grid grid-cols-2 py-5 gap-1">
                <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-32 md:rounded-none md:rounded-s-lg" src="{{asset('assets/icons/school1.png')}}" alt="">
                    <div class="flex flex-col  items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 mt-8 dark:text-white">Manage Your Whole System </h5> 
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="{{asset('assets/icons/graduated.png')}}"" alt="">
                    <div class="flex flex-col  items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 mt-8 dark:text-white">You Can Manage Your Student </h5> 
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="{{asset('assets/icons/tablet.png')}}" alt="">
                    <div class="flex flex-col  items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 mt-8 dark:text-white">We provide you Admin Panel</h5> 
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="{{asset('assets/icons/webinar.png')}}" alt="">
                    <div class="flex flex-col  items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 mt-8 dark:text-white">You Can Mangage Your Courses.</h5> 
                    </div>
                </div>
                <div class="flex flex-col items-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full ml-16 rounded-t-lg h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="{{asset('assets/icons/shield.png')}}" alt="">
                    <div class="flex flex-col  items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 mt-8 dark:text-white">Full Secure System</h5> 
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center mb-6 py-4 bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <img class="object-cover w-full rounded-t-lg h-96 md:h-auto md:w-28 md:rounded-none md:rounded-s-lg" src="{{asset('assets/icons/payment-method.png')}}" alt="">
                    <div class="flex flex-col  items-center p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-700 mt-8 dark:text-white">Payment Gatway Integration</h5> 
                    </div>
                </div>
             


            </div>


        </div>
    </section>
</div>
<!-- 
contact Us -->
<section class="py-16 px-4 sm:px-8 lg:px-16 bg-gray-100">
        <div class="flex flex-col items-center justify-center">
            <h1 class="text-2xl sm:text-3xl font-bold mb-5">Get in touch with us!</h1>
            <p class="text-sm sm:text-base text-slate-700 text-center">Our digital marketing team is always keen to help. For any queries/suggestions, kindly give us a call, send <br> us an email, or fill out the form below.</p>

            <span class="elementor-divider-separator"></span>
        </div>

        <form action="" method="post" class="mt-5">
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-5 p-4 sm:p-8">
                <div class="flex flex-col">
                    <input type="text" id="name" name="name" placeholder="Name" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <input type="email" id="email" name="email" placeholder="Email" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="company" name="company" placeholder="Company Name" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <input type="text" id="contact" name="contact" placeholder="Contact-Us" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex flex-col">
                    <select id="service" name="service" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option>Web Design</option>
                        <option>SEO</option>
                        <option>Content Marketing</option>
                        <option>Social Media Marketing</option>
                    </select>
                </div>
                <div class="flex flex-col">
                    <input type="text" id="budget" name="budget" placeholder="Enter Budget" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
            </div>
        
            <div class="px-4 sm:px-8">
                <textarea id="message" name="message" placeholder="Message" rows="6" class="mt-1 block w-full p-2 border border-gray-300 rounded-xl py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>
        
            <div class="mt-8 flex justify-center">
                <button type="submit" class="bg-orange-500 text-white px-6 py-3 rounded-full shadow-md font-medium hover:bg-orange-600 transition duration-300">Send Message</button>
            </div>
        </form>
        
    </section>






@endsection
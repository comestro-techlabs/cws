@extends('public.layout')

@section('content')
<!-- Hero Section -->
<section class="bg-blue-900 h-[430px] text-white py-12" style="padding-top: 6.5rem; clip-path: polygon(0 0, 100% 0%, 100% 81%, 0 100%);">
    <div class="container mx-auto px-4 flex flex-col md:flex-row items-center">
        <!-- Text Content -->
        <div class="text-start md:text-left mb-8 md:mb-0 w-1/2">
            <h1 class="text-4xl font-bold mb-4">Comestro TechLab Web Design (Services)</h1>
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
        <div class="flex justify-center md:w-1/2 px-8">
            <img src="/assets/service-header.png" alt="TechLab Illustration" class="max-w-full h-full">
        </div>
    </div>
</section>

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
                    We design and develop e-commerce platforms that drive sales and provide an exceptional shopping experience.
                </p>
                <a href="#" class="text-orange-500 font-bold">Learn More</a>
            </div>
            <!-- Service 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <img src="/assets/branding.png" alt="Branding & Identity" class="mb-4 h-40 w-full object-cover rounded-md">
                <h3 class="text-xl font-semibold mb-3">Branding & Identity</h3>
                <p class="text-gray-700 mb-4">
                    We help you create a unique brand identity that resonates with your audience and sets you apart from the competition.
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
                <p class="text-gray-700 mb-4">"Comestro TechLab has completely transformed our online presence. Their design is modern, responsive, and exactly what we needed to grow our business."</p>
                <p class="font-bold text-blue-900">- John Doe, CEO of Company A</p>
            </div>
            <!-- Testimonial 2 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-700 mb-4">"The e-commerce site they built for us has been a game-changer. Sales have increased by 40% since we launched."</p>
                <p class="font-bold text-blue-900">- Jane Smith, Founder of Company B</p>
            </div>
            <!-- Testimonial 3 -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <p class="text-gray-700 mb-4">"Their team is incredibly skilled and easy to work with. They brought our vision to life with creativity and precision."</p>
                <p class="font-bold text-blue-900">- Mike Johnson, Marketing Director at Company C</p>
            </div>
            <!-- Add more testimonials as needed -->
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="bg-blue-900 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-8">Ready to Start Your Project?</h2>
        <p class="text-lg mb-8">Get in touch with us to discuss your web design needs and how we can help your business grow.</p>
        <a href="/contact" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-8 rounded-full">Contact Us</a>
    </div>
</section>
@endsection

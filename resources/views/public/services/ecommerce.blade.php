@extends('public.layout')
@section('title')
    Ecommerce Web App Service
@endsection

@section('content')
<div class="bg-white
 overflow-x-hidden">
    <livewire:page-heading title="Ecommerce Website Development"
        description="Our Learn Syntax services is one of top Software Devlopment Company in India. We provide 360º
                    techLab Solutions to businesses across the globe."
        image="about-header.png" />

    <!-- Body Section -->
    <div class="flex flex-col md:flex-row w-full px-4 md:px-10">
        <section class="py-10 w-full">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-semibold mb-4 text-gray-800">Ecommerce Website Development</h2>
                <h1 class="text-3xl md:text-5xl font-bold mb-6 text-blue-900">Empowering Your Digital Presence with Innovative Web Solutions</h1>

                <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6">
                    <a href="/" class="text-primary font-semibold">Comestro</a> is a leading web development company
                    specializing in high-performance e-commerce websites designed to elevate your online
                    retail business. With a commitment to innovation and quality, we craft platforms that are visually
                    compelling, user-friendly, and optimized for conversion, ensuring your online store stands out and drives sales.
                </p>
                <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6">We understand that a successful e-commerce website is
                    more than just an online storefront—it’s a critical component of your business strategy. Our approach is
                    comprehensive, incorporating user experience (UX) design, search engine optimization (SEO), and
                    performance optimization to ensure your website attracts visitors and converts them into loyal customers.
                </p>
                <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6">Our development process is client-centered, beginning
                    with a deep dive into your business goals, brand identity, and customer demographics. From this
                    foundation, we develop a customized e-commerce solution that aligns with your vision while incorporating
                    industry best practices and the latest trends in online retail. We are dedicated to delivering projects
                    on time and within budget, with an unwavering focus on quality and precision.
                </p>
                <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6">Comestro's commitment to post-launch support ensures
                    that your website continues to perform optimally as your business evolves. Whether you’re a startup
                    looking to make your mark or an established company aiming to enhance your digital footprint, Comestro
                    is your trusted partner for comprehensive web solutions that deliver measurable results.
                </p>
                <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-6">At the core of our services is a profound
                    understanding of the digital sphere and an unwavering focus on leveraging this knowledge to benefit our
                    clients. We have spent billions on Google ads, achieving a remarkable improvement in campaign
                    performance, typically boosting existing performance by 30 to 40%. Moreover, our expertise extends to
                    monitoring online conversations about brands, ensuring their reputation remains stellar across digital
                    platforms.
                </p>
            </div>
        </section>
    </div>

    <!-- Feature List -->
    <div class="bg-gray-50 py-10">
        <div class="max-w-5xl mx-auto px-4 md:px-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 text-center">Our Key Features</h2>
            <ol class="space-y-6 text-gray-700 list-decimal list-inside">
                <li>
                    <h3 class="text-xl font-semibold text-blue-800">Custom E-Commerce Design</h3>
                    <ul class="mt-2 space-y-2 list-disc pl-5">
                        <li>Tailored design reflecting your brand with an intuitive shopping experience.</li>
                        <li>Visually appealing product pages with high-quality images and videos.</li>
                        <li>Customizable themes and layouts to match your brand identity.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="text-xl font-semibold text-blue-800">Responsive and Mobile-Optimized Design</h3>
                    <ul class="mt-2 space-y-2 list-disc pl-5">
                        <li>Fully responsive e-commerce websites ensuring a seamless experience across all devices.</li>
                        <li>Mobile-first design for better performance on smartphones and tablets.</li>
                        <li>Consistent user experience across different browsers and devices.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="text-xl font-semibold text-blue-800">Secure Payment Gateway Integration</h3>
                    <ul class="mt-2 space-y-2 list-disc pl-5">
                        <li>Integration with multiple payment gateways like PayPal, Stripe, and credit/debit card processors.</li>
                        <li>Support for various payment methods including digital wallets and BNPL options.</li>
                        <li>Secure, PCI-compliant transactions to protect customer data.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="text-xl font-semibold text-blue-800">Product Management System</h3>
                    <ul class="mt-2 space-y-2 list-disc pl-5">
                        <li>Easy-to-use admin panel for managing products, categories, and inventory.</li>
                        <li>Support for bulk product uploads, detailed product descriptions, and multiple variants.</li>
                        <li>Features like dynamic pricing, stock alerts, and product bundling.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="text-xl font-semibold text-blue-800">Scalability and Flexibility</h3>
                    <ul class="mt-2 space-y-2 list-disc pl-5">
                        <li>Scalable architecture to handle growing traffic and product lines.</li>
                        <li>Modular design for easy addition of new features and products.</li>
                        <li>Cloud integration for enhanced performance and scalability.</li>
                    </ul>
                </li>
                <li>
                    <h3 class="text-xl font-semibold text-blue-800">Post-Launch Support and Maintenance</h3>
                    <ul class="mt-2 space-y-2 list-disc pl-5">
                        <li>Ongoing support including regular updates, security patches, and performance checks.</li>
                        <li>24/7 technical support to resolve issues quickly.</li>
                        <li>Continuous optimization based on user feedback and evolving needs.</li>
                    </ul>
                </li>
            </ol>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="bg-white py-12">
        <div class="max-w-4xl mx-auto px-4 md:px-10">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-8 text-center">Frequently Asked Questions</h2>

            <div class="faq-item border border-gray-300 rounded-lg mb-4">
                <div class="faq-question px-6 py-4 text-lg font-semibold text-blue-800 cursor-pointer">
                    <span class="mr-4">+</span>What is the core idea of your work?
                </div>
                <div class="faq-answer px-6 py-4 text-gray-700 hidden">
                    The core idea of our work is to...
                </div>
            </div>

            <div class="faq-item border border-gray-300 rounded-lg mb-4">
                <div class="faq-question px-6 py-4 text-lg font-semibold text-blue-800 cursor-pointer">
                    <span class="mr-4">+</span>What social problem does this idea solve?
                </div>
                <div class="faq-answer px-6 py-4 text-gray-700 hidden">
                    The social problem we are addressing is...
                </div>
            </div>

            <div class="faq-item border border-gray-300 rounded-lg mb-4">
                <div class="faq-question px-6 py-4 text-lg font-semibold text-blue-800 cursor-pointer">
                    <span class="mr-4">+</span>What is the scale of your impact to date?
                </div>
                <div class="faq-answer px-6 py-4 text-gray-700 hidden">
                    The scale of our impact to date includes...
                </div>
            </div>

            <div class="faq-item border border-gray-300 rounded-lg mb-4">
                <div class="faq-question px-6 py-4 text-lg font-semibold text-blue-800 cursor-pointer">
                    <span class="mr-4">+</span>Why are you personally dedicated to this issue?
                </div>
                <div class="faq-answer px-6 py-4 text-gray-700 hidden">
                    I am personally dedicated to this issue because...
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4 md:px-10">
            <h1 class="text-2xl md:text-3xl font-bold text-center text-gray-800 mb-6">Get in Touch With Us!</h1>
            <p class="text-base md:text-lg text-center text-gray-700 mb-8">
                Our Software Devlopment team is always keen to help. For any queries or suggestions, kindly give us a call, send us an email,
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

<script>
    document.querySelectorAll('.faq-item').forEach(item => {
        item.addEventListener('click', () => {
            const answer = item.querySelector('.faq-answer');
            answer.classList.toggle('hidden');
            item.querySelector('.faq-question').classList.toggle('text-blue-700');
        });
    });
</script>

@endsection

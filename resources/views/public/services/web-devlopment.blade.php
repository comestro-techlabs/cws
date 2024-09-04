@extends('public.layout')

@section('title')
    Web Development
@endsection

<style>
    .faq-item {
        cursor: pointer;
        color: blue;
    }

    .faq-answer {
        display: none;
    }

    .faq-item.active .faq-answer {
        display: block;
    }
</style>
@section('content')

    <!-- Header Section -->
    <livewire:page-heading title="Web Developement"
        description="At Comestro TechLab, we pride ourselves on being one of India's leading tech lab service agencies. Our comprehensive 360º tech lab solutions are designed to support businesses worldwide, delivering cutting-edge technology and expert solutions to meet all your needs."
        image="about-header.png" />


    <!-- body section -->
    <div class="flex flex-1">
        <section class="py-10 flex w-full flex-col">
            <div class=" mx-20 px-16">
                <div class="w-1/2">
                    <h2 class="text-lg font-semibold mb-4 text-gray-700 md:text-start w-1/2">Ecommerce Website Devlopment
                    </h2>
                    <h2 class="text-3xl font-bold mb-4 text-blue-900 md:text-start">We’re Empowering Your Digital Presence
                        with Innovative Web Solutions</h2>
                </div>

                <p class="text-md w-full text-gray-700 leading-relaxed">
                    <a href="/" class="">
                        <span class="text-orange-500 font-bold">Com</span><span
                            class="text-blue-600 font-bold">estro</span></a> is a leading web development company
                    specializing in the creation of high-performance e-commerce websites designed to elevate your online
                    retail business. With a steadfast commitment to innovation and quality, we craft e-commerce platforms
                    that are visually compelling, user-friendly, and optimized for conversion, ensuring that your online
                    store not only stands out but also drives sales and customer engagement.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3"> We understand that a successful e-commerce website is
                    more than just an online storefront—it’s a critical component of your business strategy. Our approach is
                    comprehensive, incorporating user experience (UX) design, search engine optimization (SEO), and
                    performance optimization to ensure your website not only attracts visitors but also converts them into
                    loyal customers. We focus on creating a seamless, intuitive shopping experience that keeps customers
                    coming back.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">Our development process is client-centered, beginning
                    with a deep dive into your business goals, brand identity, and customer demographics. From this
                    foundation, we develop a customized e-commerce solution that aligns with your vision while incorporating
                    industry best practices and the latest trends in online retail. We are dedicated to delivering projects
                    on time and within budget, with an unwavering focus on quality and precision.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">Comestro's commitment to post-launch support ensures
                    that your website continues to perform optimally as your business evolves. Whether you’re a startup
                    looking to make your mark or an established company aiming to enhance your digital footprint, Comestro
                    is your trusted partner for comprehensive web solutions that deliver measurable results.
                </p>
                <p class="text-md text-gray-700 leading-relaxed mt-3">At the core of our services is a profound
                    understanding of the digital sphere and an unwavering focus on leveraging this knowledge to benefit our
                    clients. We have spent billions on Google ads, achieving a remarkable improvement in campaign
                    performance, typically boosting existing performance by 30 to 40%. Moreover, our expertise extends to
                    monitoring online conversations about brands, ensuring their reputation remains stellar across digital
                    platforms.
                </p>

            </div>



        </section>
    </div>
    <!-- feature list -->
    <div class="flex flex-1 ">
        <section class="py-10 flex w-full  flex-col">
            <div class=" mx-44 px-16">
                <ol class="space-y-4 text-gray-700 list-decimal list-inside dark:text-gray-400">
                    <li>
                        Custom E-Commerce Design
                        <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                            <li>Tailored design that reflects your brand and provides an intuitive shopping experience.</li>
                            <li>Visually appealing product pages with high-quality images and videos.</li>
                            <li>Customizable themes and layouts to match your brand identity.</li>
                        </ul>
                    </li>
                    <li>
                        . Responsive and Mobile-Optimized Design
                        <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                            <li>E-commerce websites that are fully responsive, ensuring a seamless shopping experience
                                across all devices.</li>
                            <li>Mobile-first design principles for better performance on smartphones and tablets.</li>
                            <li>Consistent user experience across different browsers and devices.</li>
                        </ul>
                    </li>
                    <li>
                        Secure Payment Gateway Integration
                        <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                            <li>Integration with multiple payment gateways like PayPal, Stripe, and credit/debit card
                                processors.</li>
                            <li>Support for various payment methods including digital wallets, bank transfers, and Buy Now,
                                Pay Later (BNPL) options.</li>
                            <li>Secure, PCI-compliant transactions to protect customer data.</li>
                        </ul>
                    </li>
                    <li>
                        Product Management System
                        <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                            <li>Easy-to-use admin panel for managing products, categories, and inventory.</li>
                            <li>Support for bulk product uploads, detailed product descriptions, and multiple variants
                                (e.g., sizes, colors).</li>
                            <li>Advanced features like dynamic pricing, stock alerts, and product bundling.</li>
                        </ul>
                    </li>
                    <li>
                        Scalability and Flexibility
                        <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                            <li>Scalable architecture to handle growing traffic and expanding product lines.</li>
                            <li>Modular design allowing easy addition of new features, products, and categories.</li>
                            <li>Cloud integration for seamless scaling and enhanced performance.</li>
                        </ul>
                    </li>
                    <li>
                        Post-Launch Support and Maintenance
                        <ul class="ps-5 mt-2 space-y-1 list-disc list-inside">
                            <li>Ongoing support services including regular updates, security patches, and performance
                                checks.</li>
                            <li>24/7 technical support to resolve any issues quickly.</li>
                            <li>Continuous optimization based on user feedback and evolving business needs.</li>
                        </ul>
                    </li>
                </ol>
            </div>
        </section>
    </div>

    <div class="max-w-6xl mx-auto bg-white p-10 border rounded-lg shadow-lg mt-20 mb-20">
        <h2 class="text-2xl font-bold mb-4">FAQ Answered by <a href="/" class="">
                <span class="text-orange-500 font-bold">Com</span><span class="text-blue-600 font-bold">estro</span>.</a>
        </h2>

        <div class="faq-item border border-gray-300 py-2 px-2">
            <div class="faq-question text-lg p-2 font-medium text-blue-600">
                <span class="mr-4">+</span>Please articulate the core idea of your work?
            </div>
            <div class="faq-answer mt-2 text-gray-700">
                The core idea of our work is to...
            </div>
        </div>

        <div class="faq-item border border-gray-300 py-2 px-2">
            <div class="faq-question text-lg p-2 font-medium text-blue-600">
                <span class="mr-4">+</span>What is the main social problem this idea is attempting to solve?
            </div>
            <div class="faq-answer mt-2 text-gray-700">
                The main social problem we are addressing is...
            </div>
        </div>

        <div class="faq-item border border-gray-300 py-2 px-2">
            <div class="faq-question text-lg p-2 font-medium text-blue-600">
                <span class="mr-4">+</span>What is the scale of the impact of your work to date?
            </div>
            <div class="faq-answer mt-2 text-gray-700">
                The scale of our impact to date includes...
            </div>
        </div>

        <div class="faq-item border border-gray-300 py-2 px-2">
            <div class="faq-question text-lg p-2 font-medium text-blue-600">
                <span class="mr-4">+</span>Why are you personally dedicated to the issue?
            </div>
            <div class="faq-answer mt-2 text-gray-700">
                I am personally dedicated to this issue because...
            </div>
        </div>

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
                <div class="flex flex-col">
                    <input type="tel" id="mobile" name="mobile" value="{{ old('mobile') }}" placeholder="Mobile No."
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-full px-4 py-3 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
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
    <script>
        document.querySelectorAll('.faq-item').forEach(item => {
            item.addEventListener('click', () => {
                item.classList.toggle('active');
            });
        });
    </script>

@endsection

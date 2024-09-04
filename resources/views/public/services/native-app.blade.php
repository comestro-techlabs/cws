@extends('public.layout')


@section('title')
    Native App Development
@endsection
@section('content')
<livewire:page-heading title="Native & Hybrid App Development" description="Tailored mobile app solutions for every business need." image="about-header.png"/>

<section class="py-12 bg-gray-100">
    <div class="container mx-auto flex flex-col md:flex-row items-center">
        <!-- Text Content -->
        <div class="md:w-1/2 p-6">
            <h3 class="text-3xl font-bold mb-4">Native Application Development</h3>
            <p class="mb-4">
                Our Native App Development services are designed to deliver high-performance applications with a seamless user experience. We build apps specifically for iOS and Android platforms using platform-specific languages and tools like Swift for iOS and Kotlin/Java for Android.
            </p>
            <p class="mb-4">
                Native apps offer the best performance and access to all device features, making them ideal for businesses looking for fast, reliable, and responsive mobile applications.
            </p>
            <ul class="list-disc list-inside mb-4">
                <li>Optimized for specific platforms</li>
                <li>High performance and speed</li>
                <li>Access to device-specific features</li>
                <li>Enhanced security and scalability</li>
            </ul>
            <p>Choose Native App Development for unparalleled user experiences and robust performance on mobile devices.</p>
        </div>
        <!-- App Image -->
        <div class="md:w-1/2 p-6 flex justify-center">

            <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[454px] max-w-[341px] md:h-[682px] md:max-w-[512px]">
                <div class="h-[32px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[72px] rounded-s-lg"></div>
                <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
                <div class="h-[46px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
                <div class="h-[64px] w-[3px] bg-gray-800 dark:bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
                <div class="rounded-[2rem] overflow-hidden h-[426px] md:h-[654px] bg-white dark:bg-gray-800">
                    <img src="{{asset('assets/tablet-mockup-image.png')}}" class="dark:hidden h-[426px] md:h-[654px]" alt="">
                    <img src="{{asset('assets/tablet-mockup-image-dark.png')}}" class="hidden dark:block h-[426px] md:h-[654px]" alt="">
                </div>
            </div>
                    </div>
    </div>
</section>

<!-- Hybrid App Development Section -->
<section class="py-12 bg-gray-200">
    <div class="container mx-auto flex flex-col md:flex-row items-center">
        <!-- App Image -->
        <div class="md:w-1/2 p-6 flex justify-center order-last md:order-first">

            <div class="relative mx-auto border-gray-800 dark:border-gray-800 bg-gray-800 border-[14px] rounded-[2.5rem] h-[600px] w-[300px] shadow-xl">
                <div class="w-[148px] h-[18px] bg-gray-800 top-0 rounded-b-[1rem] left-1/2 -translate-x-1/2 absolute"></div>
                <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[124px] rounded-s-lg"></div>
                <div class="h-[46px] w-[3px] bg-gray-800 absolute -start-[17px] top-[178px] rounded-s-lg"></div>
                <div class="h-[64px] w-[3px] bg-gray-800 absolute -end-[17px] top-[142px] rounded-e-lg"></div>
                <div class="rounded-[2rem] overflow-hidden w-[272px] h-[572px] bg-white dark:bg-gray-800">
                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/mockup-2-light.png" class="dark:hidden w-[272px] h-[572px]" alt="">
                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/hero/mockup-2-dark.png" class="hidden dark:block w-[272px] h-[572px]" alt="">
                </div>
            </div>
                    </div>
        <!-- Text Content -->
        <div class="md:w-1/2 p-6">
            <h3 class="text-3xl font-bold mb-4">Hybrid Application Development</h3>
            <p class="mb-4">
                Our Hybrid App Development services combine the best of both worlds, allowing you to reach users on multiple platforms with a single codebase. We use frameworks like React Native and Flutter to develop apps that work seamlessly on both iOS and Android.
            </p>
            <p class="mb-4">
                Hybrid apps are cost-effective, quicker to develop, and easier to maintain, making them an excellent choice for businesses looking to expand their mobile presence without the overhead of managing multiple native apps.
            </p>
            <ul class="list-disc list-inside mb-4">
                <li>Single codebase for multiple platforms</li>
                <li>Faster development and deployment</li>
                <li>Cost-effective solution</li>
                <li>Easy maintenance and updates</li>
            </ul>
            <p>Opt for Hybrid App Development to achieve broad reach and efficiency across platforms with minimal effort.</p>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-blue-900 text-white py-12">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-4">Let's Bring Your App Idea to Life</h3>
        <p class="mb-6">Contact us today to discuss your project and find out whether Native or Hybrid development is right for you.</p>
        <a href="{{route('public.contact')}}" class="bg-white text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-gray-200">Get Started</a>
    </div>
</section>

@endsection

@extends('public.layout')

@section('title')
    Mobile App Development
@endsection

@section('content')
<div class="bg-white 
 overflow-x-hidden">
    <livewire:page-heading title="Mobile App Development" description="Empower your business with cutting-edge mobile applications tailored to your needs." image="about-header.png"/>

    <section class="py-12">
        <div class="container mx-auto flex flex-col md:flex-row items-center">
            <!-- Text Content -->
            <div class="md:w-1/2 p-6">
                <h3 class="text-3xl font-bold mb-4">Transform Your Ideas into Reality</h3>
                <p class="mb-4">
                    At Learn Syntax , we specialize in creating innovative and user-friendly mobile apps that meet the unique demands of your business. Our team of experienced developers and designers work closely with you to bring your vision to life.
                </p>
                <p class="mb-4">
                    Whether you need a powerful enterprise solution, a sleek e-commerce platform, or an engaging social media app, we've got you covered. Our process includes:
                </p>
                <ul class="list-disc list-inside mb-4">
                    <li>Custom app design and development</li>
                    <li>Cross-platform solutions (iOS, Android)</li>
                    <li>Robust backend integration</li>
                    <li>Comprehensive testing and support</li>
                </ul>
                <p>Let us help you reach your audience wherever they are with a mobile app that stands out.</p>
            </div>
            <!-- App Image -->
            <div class="md:w-1/2 p-6 flex justify-center">
                
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
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-blue-900 text-white py-12">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-4">Ready to Build Your Next Mobile App?</h3>
            <p class="mb-6">Contact us today to discuss your project and see how we can bring your ideas to life.</p>
            <a href="{{route('public.contact')}}" class="bg-white text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-gray-200">Get Started</a>
        </div>
    </section>

@endsection
</div>
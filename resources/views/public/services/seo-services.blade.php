@extends('public.layout')

@section('title')
    SEO Services
@endsection
@section('content')

<livewire:page-heading title="SEO Services" description="Boost your online presence and drive more traffic to your website." image="about-header.png"/>

<section class="py-12">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-6">Comprehensive SEO Solutions</h3>
        <p class="text-lg mb-6">
            At Comestro Techlabs Pvt Ltd, we offer a full range of SEO services designed to help your business achieve higher search engine rankings, increased visibility, and more qualified leads. Our team of SEO experts uses the latest strategies and techniques to ensure your website ranks well in search results and reaches your target audience.
        </p>
    </div>
</section>

<!-- SEO Services Details Section -->
<section class="py-12 bg-gray-100">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Keyword Research -->
        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-blue-500">
            <h4 class="text-3xl font-bold text-blue-500 mb-4">Keyword Research</h4>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Discover the power of precise keyword research. We dive deep to find high-impact keywords that connect your business with the right audience, boosting your online visibility and engagement.
            </p>
            <img src="/assets/key-seo.webp" alt="Keyword Research" class="rounded-lg">
        </div>
        <!-- On-Page SEO -->
        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-blue-500">
            <h4 class="text-3xl font-bold text-blue-500 mb-4">On-Page SEO</h4>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Elevate your content with our on-page SEO expertise. We optimize every aspect of your webpages, from content to meta tags, ensuring your site ranks higher and attracts more visitors.
            </p>
            <img src="/assets/page-seo.webp" alt="On-Page SEO" class="rounded-lg">
        </div>
        <!-- Off-Page SEO -->
        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-blue-500">
            <h4 class="text-3xl font-bold text-blue-500 mb-4">Off-Page SEO</h4>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Strengthen your online presence with strategic off-page SEO. Through link building, social media, and influencer partnerships, we boost your website's authority and drive meaningful traffic.
            </p>
            <img src="/assets/offpage1-seo.webp" alt="Off-Page SEO" class="rounded-lg">
        </div>
        <!-- Technical SEO -->
        <div class="bg-white p-8 rounded-xl shadow-md border-l-4 border-blue-500">
            <h4 class="text-3xl font-bold text-blue-500 mb-4">Technical SEO</h4>
            <p class="text-gray-600 mb-6 leading-relaxed">
                Optimize your website’s infrastructure with our technical SEO services. We enhance site speed, mobile compatibility, and security, creating a seamless user experience and better search rankings.
            </p>
            <img src="/assets/seo-technical.webp" alt="Technical SEO" class="rounded-lg">
        </div>
    </div>
</section>



<!-- Call to Action -->
<section class="bg-blue-900 text-white py-12">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-4">Start Optimizing Your Website Today</h3>
        <p class="mb-6">Get in touch with our SEO experts and see how we can help you improve your online visibility and achieve your business goals.</p>
        <a href="{{route('public.contact')}}" class="bg-white text-blue-900 px-6 py-3 rounded-full font-bold hover:bg-gray-200">Contact Us</a>
    </div>
</section>

@endsection

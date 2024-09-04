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
<section class="py-12 bg-gray-200">
    <div class="container mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Keyword Research -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-2xl font-bold mb-4">Keyword Research</h4>
            <p class="mb-4">
                We conduct thorough keyword research to identify the most relevant and high-performing keywords for your business. This helps us create a targeted strategy that attracts the right audience to your website.
            </p>
            <img src="https://via.placeholder.com/400x300" alt="Keyword Research" class="rounded-lg">
        </div>
        <!-- On-Page SEO -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-2xl font-bold mb-4">On-Page SEO</h4>
            <p class="mb-4">
                Our on-page SEO services focus on optimizing individual pages on your website to improve their search engine rankings. This includes optimizing content, meta tags, images, and internal links to ensure your site is search engine-friendly.
            </p>
            <img src="https://via.placeholder.com/400x300" alt="On-Page SEO" class="rounded-lg">
        </div>
        <!-- Off-Page SEO -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-2xl font-bold mb-4">Off-Page SEO</h4>
            <p class="mb-4">
                Off-page SEO is essential for building your website's authority and reputation. We employ strategies like link building, social media marketing, and influencer outreach to enhance your online presence and drive more traffic to your site.
            </p>
            <img src="https://via.placeholder.com/400x300" alt="Off-Page SEO" class="rounded-lg">
        </div>
        <!-- Technical SEO -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h4 class="text-2xl font-bold mb-4">Technical SEO</h4>
            <p class="mb-4">
                Technical SEO ensures that your website meets the technical requirements of modern search engines. We optimize your site's structure, speed, mobile-friendliness, and security to provide a better user experience and improve search rankings.
            </p>
            <img src="https://via.placeholder.com/400x300" alt="Technical SEO" class="rounded-lg">
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

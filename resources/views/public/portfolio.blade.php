@extends('public.layout')

@section('title')
    Portfolio
@endsection

@section('meta')
    <meta name="description" content="Discover Learn Syntax, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies."/>
@endsection

@section('content')
<div class="bg-white overflow-x-hidden">
    <livewire:page-heading
        title="Welcome To My Portfolio"
        description="Showcasing my journey of innovation, creativity, and expertise through impactful projects and real-world solutions. Explore how I transform ideas into reality, deliver exceptional results, and continuously strive to push boundaries in the tech world."
        image="about-header.png"
    />

    <div class="p-8 w-full md:w-1/2  ml-4 md:ml-36" id="portfolio">
        <h3 class="text-secondary uppercase tracking-widest text-2xl border-b-2 border-blue-300 font-bold pb-2">
            My Portfolio
        </h3>
        <h1 class="text-2xl font-semibold text-gray-800 mt-4">
            Crafting Ideas into Reality Through My Work.
        </h1>
        <p class="text-gray-600 mt-2">
            Explore my journey through projects that highlight innovation, skill, and a commitment to excellence.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-8 ml-4 md:ml-36">
         @foreach($portfolios as $portfolio)
            <div class="relative group rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $portfolio->image) }}"
                     alt="{{ $portfolio->title }}"
                     class="w-full h-60 object-cover">
                <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center opacity-0 group-hover:opacity-100 transition duration-300">
                    <div class="flex items-center space-x-2">
                        <h2 class="text-white text-lg font-bold uppercase">{{ $portfolio->title }}</h2>
                        <a href="{{ $portfolio->url }}" target="_blank"
                           class="text-white text-xl hover:text-gray-300 transition duration-200">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    <p class="text-gray-300 text-center font-semibold uppercase text-sm px-4 mt-2">{{ $portfolio->description }}</p>
                </div>
            </div>
        @endforeach
        </div> 
</div>

@endsection

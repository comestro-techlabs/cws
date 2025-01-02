@extends('public.layout')

@section('title')
    Portfolio
@endsection

@section('meta')
    <meta name="description" content="Discover Comestro, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies."/>
@endsection

@section('content')
<div class="bg-white overflow-x-hidden">
    <livewire:page-heading 
        title="Welcome To My Portfolio"
        description="Our TechLab services in India enhance your brand’s online presence, attract new customers, and drive conversions."
        image="about-header.png" 
    />

    <div class="p-8 w-full md:w-1/2" id="portfolio">
        <h3 class="text-blue-400 uppercase tracking-widest text-2xl border-b-2 border-blue-300 font-bold pb-2">
            My Services
        </h3>
        <h1 class="text-4xl font-bold text-black mt-4">
            What Kinds of Work I Do?
        </h1>
    </div>

    
   
     <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-8">
        @foreach($portfolios as $portfolio)
            <a href="{{ $portfolio->url }}" target="_blank" class="relative">
                <img src="{{ asset('storage/' . $portfolio->image) }}" 
                     alt="{{ $portfolio->title }}" 
                     class="w-full h-90 object-cover">
                <div class="text-overlay">
                    <h2 class="text-lg font-bold uppercase">{{ $portfolio->title }}</h2>
                     <p class="text-sm text-gray-300 text-center">{{ $portfolio->description }}</p>
                </div>
            </a>
        @endforeach
    </div>
    
    
    
</div>

@endsection

<style>
    .text-overlay {
        position: absolute;
        bottom: 0;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 1rem;
        text-align: center;
    }
</style>

@extends('public.layout')

@section('title')
    Software Development
@endsection

@section('content')
    <!-- Page Heading -->
    <div class="bg-white py-16 overflow-x-hidden">
    <livewire:page-heading 
        title="Software Development"
        description="We craft custom software solutions tailored to your business needs, ensuring innovation, efficiency, and scalability at every step."
        image="about-header.png" 
    />        

    <!-- Services Section -->
    <section id="services" class="container mx-auto px-6 py-24">
        <h2 class="text-5xl font-extrabold text-center mb-16 text-teal-600">Our Services</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-teal-600 mb-4">Web Development</h3>
                    <p class="text-gray-700 leading-relaxed">Building responsive and high-performance websites tailored to your business goals.</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-teal-600 mb-4">Mobile Apps</h3>
                    <p class="text-gray-700 leading-relaxed">Developing user-friendly mobile applications for both Android and iOS platforms.</p>
                </div>
            </div>
            <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300">
                <div class="text-center">
                    <h3 class="text-3xl font-bold text-teal-600 mb-4">Cloud Solutions</h3>
                    <p class="text-gray-700 leading-relaxed">Providing scalable and secure cloud solutions to empower your business operations.</p>
                </div>
            </div>
        </div>
    </section>

     <!-- Hero Section -->
     <section class="relative bg-cover bg-center h-screen flex items-center justify-center"
     style="background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzzqIm6-db43QdiBLoypstdFsCVqZDiLtqNQ&s');">
     <div class="absolute inset-0 bg-blue-900 bg-opacity-50"></div>
     <div class="relative z-10 text-center text-white">
         <h1 class="text-6xl font-bold">Innovative Software Solutions</h1>
         <p class="text-2xl mt-4 max-w-xl mx-auto">Custom software tailored to your business needs</p>
         <a href="#services"
             class="mt-8 inline-block bg-teal-600 hover:bg-teal-500 text-white px-8 py-4 rounded shadow-lg text-lg font-semibold transition duration-300">Contact
             Us</a>
     </div>
 </section>

    
@endsection
    </div>
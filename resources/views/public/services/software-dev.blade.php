@extends('public.layout')

@section('title')
    Software Development
@endsection

@section('content')
    <livewire:page-heading title="Software Developement"
        description="We craft custom software solutions tailored to your business needs, ensuring innovation, efficiency, and scalability at every step.

"
        image="about-header.png" />

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Software Development</title>
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    </head>

    <body class="bg-gray-100 text-gray-900">

        <!-- Header Section -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <div class="text-xl font-bold text-teal-600">YourLogo</div>
                <nav class="space-x-6">
                    <a href="#" class="text-gray-600 hover:text-teal-600">Home</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600">Services</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600">Projects</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600">About Us</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600">Contact</a>
                </nav>
                <a href="#" class="bg-teal-600 text-white px-4 py-2 rounded">Get a Quote</a>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="bg-cover bg-center h-screen"
            style="background-image: url('https://source.unsplash.com/featured/?technology');">
            <div class="bg-teal-900 bg-opacity-50 h-full flex items-center">
                <div class="container mx-auto px-4 text-center">
                    <h1 class="text-5xl text-white font-bold">Innovative Software Solutions</h1>
                    <p class="text-xl text-gray-200 mt-4">Custom software tailored to your business needs</p>
                    <a href="#"
                        class="mt-6 inline-block bg-white text-teal-600 px-6 py-3 rounded shadow-lg text-lg font-semibold">Contact
                        Us</a>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section class="container mx-auto px-4 py-16">
            <h2 class="text-4xl font-bold text-center mb-12 text-teal-600">Our Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold text-teal-600 mb-4">Web Development</h3>
                    <p class="text-gray-700">Building responsive and high-performance websites tailored to your business
                        goals.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold text-teal-600 mb-4">Mobile Apps</h3>
                    <p class="text-gray-700">Developing user-friendly mobile applications for both Android and iOS
                        platforms.</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                    <h3 class="text-2xl font-semibold text-teal-600 mb-4">Cloud Solutions</h3>
                    <p class="text-gray-700">Providing scalable and secure cloud solutions to empower your business
                        operations.</p>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <footer class="bg-gray-800 text-gray-400 py-8">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2024 YourCompany. All rights reserved.</p>
                <div class="mt-4 space-x-4">
                    <a href="#" class="text-teal-600 hover:text-white">Privacy Policy</a>
                    <a href="#" class="text-teal-600 hover:text-white">Terms of Service</a>
                </div>
            </div>
        </footer>

    </body>

    </html>
@endsection

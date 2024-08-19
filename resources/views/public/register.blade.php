<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code with Sadique -Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-gray-200 via-gray-300 to-blue-400">
    <div class="flex h-screen">
       
        {{-- here is the image to visualize what we teach --}}
        <div class="w-4/12 relative flex items-center justify-center overflow-hidden">
            <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
                <div class="w-full flex-shrink-0 flex justify-center items-center">
                    <img src="https://cdn.pixabay.com/photo/2024/06/02/06/16/child-8803596_640.png" class="max-w-full max-h-full object-contain rounded-xl shadow-2xl" alt="Image 1">
                </div>
                <div class="w-full flex-shrink-0 flex justify-center items-center">
                    <img src="https://img.freepik.com/free-vector/programming-concept-it-education-student-writing-software-coding-application-java-script-it-project-digital-technology-development-website-interface-vector-illustration_613284-1712.jpg" class="max-w-full max-h-full object-contain rounded-xl shadow-2xl" alt="Image 2">
                </div>
                <div class="w-full flex-shrink-0 flex justify-center items-center">
                    <img src="https://media.istockphoto.com/id/1457290530/photo/asian-teenager-students-doing-robot-arm-and-robotic-cars-homework-project-in-house-using.jpg?s=612x612&w=0&k=20&c=UqJtQbOTZBu6Yw-JB9jHOxpgOCoB5in1W02JuxYlibY=" class="max-w-full max-h-full object-contain rounded-xl shadow-2xl" alt="Image 3">
                </div>
            </div>
            <button id="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition duration-300">&#10094;</button>
            <button id="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition duration-300">&#10095;</button>
        </div>
        

         
         <div class="w-1/2 flex flex-col justify-center items-center p-8">
            <h2 class="text-3xl font-bold mb-8 text-slate-100">Sign Up</h2>
            <form action="{{route('public.register')}}" method="POST" class="w-full max-w-md">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-2 text-slate-100">Name:</label>
                    <input type="text" value="{{old('name')}}" id="name" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500" >
                    @error('name')
                        <p class="text-red-600 text-xs">{{$message}}</p>
                    @enderror

                </div>
                <div class="mb-4">
                    <label for="email" class="block font-semibold mb-2 text-slate-100">Email:</label>
                    <input type="email" value="{{old('email')}}" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500" >
                    @error('email')
                        <p class="text-red-600 text-xs">{{$message}}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label for="password" class="block font-semibold mb-2 text-slate-100">Password:</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-sky-500" >
                    @error('password')
                        <p class="text-red-600 text-xs">{{$message}}</p>
                    @enderror
                </div>
                <button type="submit" class="w-full bg-sky-500 text-white py-2 rounded-md hover:bg-sky-600 transition duration-200">Register</button>
            </form>
        </div>
       
    
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carousel = document.getElementById('carousel');
            const prevButton = document.getElementById('prev');
            const nextButton = document.getElementById('next');
            const carouselItems = carousel.children;
            const totalItems = carouselItems.length;
            let currentIndex = 0;
    
            function updateCarousel() {
                const offset = -currentIndex * 100;
                carousel.style.transform = `translateX(${offset}%)`;
            }
    
            nextButton.addEventListener('click', function () {
                currentIndex = (currentIndex + 1) % totalItems;
                updateCarousel();
            });
    
            prevButton.addEventListener('click', function () {
                currentIndex = (currentIndex - 1 + totalItems) % totalItems;
                updateCarousel();
            });
        });
    </script>
    
</body>
</html>

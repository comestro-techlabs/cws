<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite("resources/css/app.css")
</head>
<body>
   @include('public.publicheader')


   @section('content')
       
   @show

   <footer class="bg-gray-800 text-gray-200 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">About Us</h3>
                <p class="text-gray-400">
                    At Code with Sadiq, we are committed to providing high-quality programming education that empowers students to excel in the IT industry. Our hands-on approach and real-world projects ensure that our students are job-ready.
                </p>
            </div>

            <!-- Links Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="/about" class="hover:text-gray-400">About</a>
                    </li>
                    <li>
                        <a href="/courses" class="hover:text-gray-400">Courses</a>
                    </li>
                    <li>
                        <a href="/admission" class="hover:text-gray-400">Admission</a>
                    </li>
                    <li>
                        <a href="/contact" class="hover:text-gray-400">Contact Us</a>
                    </li>
                    <li>
                        <a href="/faq" class="hover:text-gray-400">FAQ</a>
                    </li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">Contact Us</h3>
                <p class="text-gray-400">Code with Sadiq</p>
                <p class="text-gray-400">Purnea, Bihar, India</p>
                <p class="text-gray-400">Email: info@codewithsadiq.com</p>
                <p class="text-gray-400">Phone: +91-9876543210</p>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-700 pt-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; 2024 Code with Sadiq. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
@yield('js')

</body>
</html>
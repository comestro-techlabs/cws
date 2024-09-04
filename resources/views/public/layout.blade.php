<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | {{env('APP_NAME')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    @vite("resources/css/app.css")
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .roboto-thin {
  font-family: "Roboto", sans-serif;
  font-weight: 100;
  font-style: normal;
}

.roboto-light {
  font-family: "Roboto", sans-serif;
  font-weight: 300;
  font-style: normal;
}

.roboto-regular {
  font-family: "Roboto", sans-serif;
  font-weight: 400;
  font-style: normal;
}

.roboto-medium {
  font-family: "Roboto", sans-serif;
  font-weight: 500;
  font-style: normal;
}

.roboto-bold {
  font-family: "Roboto", sans-serif;
  font-weight: 700;
  font-style: normal;
}

.roboto-black {
  font-family: "Roboto", sans-serif;
  font-weight: 900;
  font-style: normal;
}

.roboto-thin-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 100;
  font-style: italic;
}

.roboto-light-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 300;
  font-style: italic;
}

.roboto-regular-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 400;
  font-style: italic;
}

.roboto-medium-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 500;
  font-style: italic;
}

.roboto-bold-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 700;
  font-style: italic;
}

.roboto-black-italic {
  font-family: "Roboto", sans-serif;
  font-weight: 900;
  font-style: italic;
}
        /* Keyframes for shaking animation */
        @keyframes shake {
            0%,
            100% {
                transform: translateY(0);
            }
            25% {
                transform: translateY(-8px);
            }
            50% {
                transform: translateY(8px);
            }
            75% {
                transform: translateY(-8px);
            }
        }
    
        .shake {
            animation: shake 2s infinite;
        }
    
        .bend-bottom {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 100% 100%);
        }
    </style>
</head>
<body>
   @include('public.publicheader')


   @section('content')
       
   @show

   <footer class="bg-gray-900 text-gray-200 py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-lg font-semibold text-white mb-4">About Us</h3>
                <p class="text-gray-400">
                    At Comestro, we are committed to providing high-quality programming education that empowers students to excel in the IT industry. Our hands-on approach and real-world projects ensure that our students are job-ready.
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
                <p class="text-gray-400">{{env('APP_NAME')}} TechLabs Pvt Ltd.</p>
                <p class="text-gray-400">Purnea, Bihar, India</p>
                <p class="text-gray-400">Email: info@codewithsadiq.com</p>
                <p class="text-gray-400">Phone: +91-9876543210</p>
            </div>
        </div>

        <div class="mt-8 border-t border-gray-700 pt-8 text-center">
            <p class="text-gray-500 text-sm">
                &copy; 2024 {{env('APP_NAME')}}. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
@yield('js')

</body>
</html>
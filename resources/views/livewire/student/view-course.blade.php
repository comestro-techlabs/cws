<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
        <div class="col-span-2">
            <div class="border-b pb-4 mb-6">
                <h1 class="text-3xl font-bold text-gray-800">{{ $course->title }}</h1>
            </div>

            <div class="relative mb-6">
                <img src="{{ asset('storage/course_images/' . $course->course_image) }}" alt="Course Image"
                    class="w-full h-64 object-cover rounded-lg shadow-md">
            </div>

            <div class="mb-8">
                <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
                <p class="text-gray-600 bg-gray-50 border border-gray-200 rounded-md p-4">{{ $course->description }}</p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Chapters</h2>
                <ul class="space-y-2">
                    @foreach ($course->chapters as $item)
                        <li class="bg-gray-50 border border-gray-200 rounded-md p-3">
                            <a href="#" class="text-blue-600 hover:underline">{{ $item->id }}. {{ $item->title }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div>
            <div class="bg-white shadow-md rounded-lg p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-700 font-medium">Duration: {{ $course->duration }} Weeks</span>
                    <span class="text-xl font-bold text-green-600">₹{{ $course->discounted_fees }}</span>
                </div>

                
                    <button id="pay-button"
                        class="flex items-center justify-center w-full bg-blue-600 text-white font-semibold rounded-lg mt-2 shadow-lg px-6 py-3 transition duration-300 ease-in-out transform hover:scale-105 hover:bg-blue-700 space-x-3">
                        <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png?f=webp&w=256"
                            alt="Razorpay Logo" class="w-8 h-8 object-contain">
                        <span>Proceed with Razorpay</span>
                    </button>
         
            </div>

            <div class="bg-slate-100 text-slate-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Features</h3>
                <ul class="space-y-2">
                    @foreach ($course->features as $feature)
                        <li class="flex items-center">
                            <i class="material-icons text-green-400 mr-2">check_circle</i>
                            <span>{{ $feature->name }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    
   
</div>

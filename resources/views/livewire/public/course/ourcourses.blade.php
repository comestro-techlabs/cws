<div>
    <x-slot:title> {{$course->title}} | Learn Syntax | Coding Classes in Purnea – C, C++, Python, JavaScript (Bihar)</x-slot>
    <x-slot:description> {{$course->title}} - Learn Syntax in Purnea, Bihar offers expert-led courses in C, C++, Python, JavaScript, Web Development, DBMS, Bootstrap, and more. Start coding with hands-on training, real-world projects, and certification!</x-slot>
    <!-- Course Header Section with Theme Color -->
    <div class="bg-[#662d91] text-white pt-28 pb-12 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-start">
                <!-- Left Section (Course Details) -->
                <div class="md:w-8/12 w-full pr-0 md:pr-8">
                    <!-- Breadcrumb -->
                    <nav class="text-sm mb-6">
                        <ol class="list-reset flex text-purple-200">
                            <li>
                                <a href="{{ route('public.index') }}" class="hover:text-white transition duration-200">Home</a>
                            </li>
                            <li><span class="mx-2">&raquo;</span></li>
                            <li>
                                <a href="#" class="hover:text-white transition duration-200">{{ $course->category->cat_title }}</a>
                            </li>
                            <li><span class="mx-2">&raquo;</span></li>
                            <li class="text-white">{{ $course->title }}</li>
                        </ol>
                    </nav>

                    <!-- Course Title and Description -->
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-4 capitalize">{{ $course->title }}</h1>
                    <p class="text-lg text-purple-50 mb-6">{{ $course->description }}</p>

                    <!-- Instructor and Ratings -->
                    <div class="flex items-center mb-6">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-orange-400 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-purple-100">Created by</span>
                            <a href="#" class="text-orange-300 hover:text-orange-200 ml-2 font-medium">{{ $course->instructor }}</a>
                        </div>
                    </div>

                    <!-- Last Updated and Language -->
                    <div class="flex items-center text-sm text-purple-100 space-x-4">
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>Last updated {{ \Carbon\Carbon::parse($course->updated_at)->format('m/Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Duration: {{ $course->duration }} Weeks</span>
                        </div>
                    </div>
                </div>

                <!-- Right Section (Course Card) -->
                <div class="md:w-4/12 w-full mt-8 md:mt-0">
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                        <!-- Course Preview Image -->
                        <div class="overflow-hidden">
                            <img src="{{  $course->course_image }}"
                                alt="{{ $course->title }}" class="w-full h-56 object-cover">
                        </div>

                        <div class="p-6">
                            <!-- Course Price -->
                            <div class="mb-6">
                                @if ($course->discounted_fees > 0)
                                    <div class="flex items-center justify-center">
                                        <span class="text-3xl font-bold text-gray-900">₹{{ $course->discounted_fees }}</span>
                                        <span class="text-gray-500 line-through ml-2">₹{{ $course->fees }}</span>
                                        <span class="text-green-600 ml-2 text-sm font-medium">({{ round((($course->fees - $course->discounted_fees) / $course->fees) * 100, 2) }}% off)</span>
                                    </div>
                                @else
                                    <p class="text-green-600 font-semibold text-xl text-center">Free</p>
                                @endif
                            </div>

                            @auth
                                @if ($payment_exist)
                                    <div class="bg-purple-50 border-l-4 border-[#662d91] text-purple-900 p-4 mb-4 rounded" role="alert">
                                        <p class="font-bold">Already Enrolled</p>
                                        <p class="text-sm mt-1">
                                            <a href="{{ route('student.dashboard') }}" class="text-[#662d91] font-medium hover:underline">
                                                Go to Dashboard
                                            </a>
                                        </p>
                                    </div>
                                @else
                                    <button type="button"
                                            wire:click="initiatePayment"
                                            wire:loading.attr="disabled"
                                            class="w-full flex justify-center items-center px-4 py-3 bg-orange-500 text-white font-medium rounded-lg hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors disabled:opacity-50">
                                        <span wire:loading.remove wire:target="initiatePayment">
                                            Enroll Now - ₹{{ $course->discounted_fees }}
                                        </span>
                                        <span wire:loading wire:target="initiatePayment" class="flex items-center">
                                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Processing...
                                        </span>
                                    </button>
                                @endif
                            @endauth

                            @guest
                                <a href="{{ route('auth.login') }}"
                                    class="flex items-center justify-center w-full bg-[#662d91] text-white font-medium rounded-lg py-3 px-6 transition duration-200 hover:bg-purple-800 focus:ring-2 focus:ring-purple-400 focus:ring-offset-2">
                                    <span class="mr-2">Sign in to Enroll</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V7.414l-4-4H3zm7 2a1 1 0 00-1 1v1H5a1 1 0 100 2h4v1a1 1 0 102 0V9h4a1 1 0 100-2h-4V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                            @endguest

                            <!-- Money-Back Guarantee -->
                            <div class="flex items-center justify-center mt-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-gray-600 text-sm">30-Day Money-Back Guarantee</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Mode Indicator -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center py-4 space-x-4">
                <div class="flex items-center">
                    @if($course->course_type === 'online')
                        <svg class="w-5 h-5 text-[#662d91] mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                    @else
                        <svg class="w-5 h-5 text-[#662d91] mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    @endif
                    <span class="text-gray-600 font-medium">
                        {{ $course->course_type === 'online' ? 'Live Online Course' : 'Classroom Training' }}
                    </span>
                </div>
                @if($course->course_type === 'online')
                    <div class="flex items-center text-green-600">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                        </svg>
                        <span>Live Interactive Sessions</span>
                    </div>
                @else
                    <div class="flex items-center text-blue-600">
                        <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>{{ $course->venue }}</span>
                    </div>
                @endif
                <div class="flex items-center text-gray-600">
                    <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>{{ $course->duration }} Weeks</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column (Course Content) -->
            <div class="md:col-span-2 space-y-8">
                <!-- Course Details Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Course Overview</h2>

                    <!-- Course Type Specific Features -->
                    @if($course->course_type === 'online')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-purple-100 rounded-lg">
                                        <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Live Online Classes</h3>
                                    <p class="text-sm text-gray-500">Interactive sessions with real-time doubt clearing</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-purple-100 rounded-lg">
                                        <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Platform Access</h3>
                                    <p class="text-sm text-gray-500">Learn on our custom learning platform</p>
                                </div>
                            </div>
                        </div>

                        <!-- Online Meeting Details -->
                        @if($payment_exist)
                            <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                                <h3 class="font-medium text-gray-900 mb-3">Meeting Details</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                        </svg>
                                        <span class="ml-2 text-sm text-blue-600 hover:underline">
                                            <a href="{{ $course->meeting_link }}" target="_blank">Join Meeting</a>
                                        </span>
                                    </div>
                                    @if($course->meeting_id)
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            </svg>
                                            <span class="ml-2 text-sm">ID: {{ $course->meeting_id }}</span>
                                        </div>
                                    @endif
                                    @if($course->meeting_password)
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                            <span class="ml-2 text-sm">Password: {{ $course->meeting_password }}</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @else
                        <!-- Offline Course Features -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-purple-100 rounded-lg">
                                        <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v.5M12 14v.5M16 14v.5M12 2v2M12 22v-2M20 12h2M2 12h2M19.071 19.071l-1.414-1.414M6.343 6.343L4.929 4.929M19.071 4.929l-1.414 1.414M6.343 17.657L4.929 19.071"/>
                                            <circle cx="12" cy="12" r="4" stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Classroom Training</h3>
                                    <p class="text-sm text-gray-500">Face-to-face learning with experts</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="p-3 bg-purple-100 rounded-lg">
                                        <svg class="w-5 h-5 text-[#662d91]" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h3 class="font-medium text-gray-900">Limited Batch Size</h3>
                                    <p class="text-sm text-gray-500">Personalized attention guaranteed</p>
                                </div>
                            </div>
                        </div>

                        <!-- Venue Details -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                            <h3 class="font-medium text-gray-900 mb-3">Location Details</h3>
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-[#662d91] mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <div>
                                    <p class="text-gray-600">{{ $course->venue }}</p>
                                    <a href="https://maps.google.com/?q={{ urlencode($course->venue) }}"
                                        target="_blank"
                                        class="text-sm text-blue-600 hover:underline mt-1 inline-block">
                                        View on Google Maps
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Course Description -->
                    <div class="prose max-w-none">
                        <p class="text-gray-600">{{ $course->description }}</p>
                    </div>
                </div>

                <!-- Features Card -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#662d91]">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">This Course Includes:</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($course->features as $feature)
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-[#662d91] mr-3" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path d="M10 15.172l-3.707-3.707a1 1 0 00-1.414 1.414l4.414 4.414a1 1 0 001.414 0l8.414-8.414a1 1 0 10-1.414-1.414L10 15.172z"></path>
                                </svg>
                                <span class="text-gray-700">{{ $feature->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Course Content Accordion -->

            </div>

            <!-- Right Column (Course Batches) -->
            <div class="space-y-8">
                <!-- Course Batches Section -->
                <div class="bg-white rounded-xl shadow-sm p-6 border-l-4 border-[#662d91]">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Course Batches</h2>
                    @if ($course->batches->isNotEmpty())
                        <div class="space-y-3">
                            @foreach ($course->batches as $batch)
                                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 hover:shadow-md transition duration-200">
                                    <div class="flex flex-col">
                                        <span class="font-semibold text-gray-800 mb-1">{{ $batch->batch_name }}</span>
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-[#662d91]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span>
                                                {{ \Carbon\Carbon::parse($batch->start_date)->format('d M, Y') }} to
                                                {{ \Carbon\Carbon::parse($batch->end_date)->format('d M, Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-600">No batches available at the moment.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('initCoursePayment', (data) => {
            console.log('Raw payment event data:', data);

            if (!Array.isArray(data) || !data[0] || !Array.isArray(data[0])) {
                console.error('Invalid payment data structure:', data);
                return;
            }

            const paymentData = data[0][0]; // Access first element of nested array
            console.log('Payment data:', paymentData);

            if (!paymentData || typeof paymentData !== 'object') {
                console.error('Payment data is not an object:', paymentData);
                return;
            }

            const options = {
                "key": paymentData.key,
                "amount": paymentData.amount,
                "currency": "INR",
                "name": "LearnSyntax",
                "description": paymentData.description,
                "image": paymentData.image,
                "order_id": paymentData.order_id,
                "handler": function (response) {
                    console.log('Payment success:', response);
                    @this.call('handlePaymentSuccess', response);
                },
                "prefill": {
                    "name": paymentData.prefill.name,
                    "email": paymentData.prefill.email
                },
                "theme": {
                    "color": "#662d91"
                }
            };

            console.log('Razorpay options:', options);

            try {
                const rzp = new Razorpay(options);
                rzp.on('payment.failed', function (response) {
                    console.error('Payment failed:', response);
                    @this.call('handlePaymentCancelled');
                });
                rzp.open();
            } catch (error) {
                console.error('Razorpay initialization error:', error);
            }
        });
    });
</script>

</div>

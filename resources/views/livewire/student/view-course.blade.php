@php
    $subs = (auth()->check() && auth()->user()->hasActiveSubscription() && auth()->user()->courses()->wherePivot('is_subs', 1)->count() == 0)
@endphp
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Course Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Course Header -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        {{ $course->course_type === 'online' ? 'bg-blue-100 text-blue-800' : 'bg-green-100 text-green-800' }}">
                        {{ ucfirst($course->course_type) }}
                    </span>
                </div>
                <div class="flex items-center gap-4 text-sm text-gray-600">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>{{ $course->instructor }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $course->duration }} weeks</span>
                    </div>
                </div>
            </div>

            <!-- Course Details Tabs -->
            <div class="bg-white rounded-lg shadow-sm">
                <nav class="flex divide-x divide-gray-200 border-b">
                    <button class="px-6 py-4 text-sm font-medium text-purple-600 bg-white border-b-2 border-purple-600">
                        Overview
                    </button>
                    <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                        Curriculum
                    </button>
                    <button class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                        Reviews
                    </button>
                </nav>

                <div class="p-6">
                    <!-- Course Description -->
                    <div class="prose max-w-none">
                        <h2 class="text-xl font-semibold mb-4">About This Course</h2>
                        <p class="text-gray-600">{{ $course->description }}</p>
                    </div>

                    <!-- Available Batches -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-4">Available Batches</h2>
                        <div class="grid gap-4">
                            @foreach($activeBatches as $batch)
                                <div class="border rounded-lg p-4 hover:border-purple-200 transition-colors">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-medium text-gray-900">{{ $batch->batch_name }}</h3>
                                        <span class="text-sm text-gray-500">
                                            {{ $batch->start_date->format('d M Y') }} - {{ $batch->end_date->format('d M Y') }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Course Features -->
                    <div class="mt-8">
                        <h2 class="text-xl font-semibold mb-4">What You'll Learn</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($course->features as $feature)
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-gray-600">{{ $feature->name }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Course Type Specific Details -->
                    @if($courseType['type'] === 'Online')
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold mb-4">Online Class Details</h2>
                            <div class="bg-blue-50 rounded-lg p-4">
                                <div class="space-y-2">
                                    <p class="flex items-center text-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        Meeting Link: {{ $courseType['details']['meeting_link'] }}
                                    </p>
                                    <p class="flex items-center text-blue-700">
                                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                        </svg>
                                        Meeting ID: {{ $courseType['details']['meeting_id'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="mt-8">
                            <h2 class="text-xl font-semibold mb-4">Venue Details</h2>
                            <div class="bg-green-50 rounded-lg p-4">
                                <p class="flex items-center text-green-700">
                                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $courseType['details']['venue'] }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Payment and Features -->
        <div class="space-y-6">
            <!-- Payment Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-24">
                <!-- Course Preview Image -->
                <div class="relative h-48">
                    <img src="{{ asset('storage/' . $course->course_image) }}" alt="{{ $course->title }}"
                        class="w-full h-full object-cover">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent"></div>
                    <!-- Course Info Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <p class="text-white/90 text-sm font-medium mb-1">Course Duration</p>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-white font-medium">{{ $course->duration }} Weeks</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Price Section -->
                    <div class="text-center pb-4 border-b border-gray-200">
                        @if ($subs)
                            <p class="text-sm text-gray-600 mb-1">Free</p>
                            <p class="text-4xl font-bold text-gray-900"><del>₹{{ $course->discounted_fees ?? $course->fees }}</del></p>
                        @else
                            <p class="text-sm text-gray-600 mb-1">Course Fee</p>
                            <p class="text-4xl font-bold text-gray-900">₹{{ $course->discounted_fees ?? $course->fees }}</p>
                        @endif
                    </div>


                    <!-- Enrollment Status -->
                    @if ($payment_exist)
                        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 text-center">
                            <p class="text-blue-600 font-semibold mb-2">Already Enrolled</p>
                            <a wire:navigate href="{{ route('student.dashboard') }}"
                                class="inline-flex items-center text-sm text-blue-700 hover:text-blue-800 font-medium">
                                Go to Dashboard
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @else

                        @if ($subs)
                            <button wire:click="enrollCourse({{ $course->id }})" wire:loading.attr="disabled"
                                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Free
                            </button>
                        @else
                            <button id="pay-button"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png?f=webp&w=256"
                                    alt="Razorpay" class="w-6 h-6 object-contain">
                                <span>Enroll Now with Razorpay</span>
                            </button>
                        @endif
                    @endif

                    <!-- Course Features -->
                    <div class="pt-4 border-t border-gray-200">
                        @if ($subs)
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">
                                Enjoy one free course of your choice with your active subscription. Enroll now!
                            </h3>

                        @else
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">What You'll Get</h3>
                        @endif
                        <ul class="space-y-3">
                            @foreach ($course->features as $feature)
                                <li class="flex items-center gap-3 text-gray-700">
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span>{{ $feature->name }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@auth
<script>
    document.getElementById('pay-button').onclick = async function (e) {
        e.preventDefault();
        const payButton = document.getElementById('pay-button');
        payButton.disabled = true;

        try {
            const response = await @this.initiatePayment();

            if (response && response.payment_id && response.order_id) {
                const amountToPay = {{ $course->discounted_fees ?? 0 }} > 0 ? {{ $course->discounted_fees ?? 0 }} : {{ $course->fees }};                
                var options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": amountToPay * 100,
                    "currency": "INR",
                    "name": "LearnSyntax",
                    "description": "{{ $course->title }}",
                    "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                    "order_id": response.order_id,
                    "handler": async function (razorpayResponse) {
                        const result = await @this.handlePaymentResponse({
                            payment_id: response.payment_id,
                            razorpay_payment_id: razorpayResponse.razorpay_payment_id,
                            razorpay_order_id: razorpayResponse.razorpay_order_id,
                            razorpay_signature: razorpayResponse.razorpay_signature
                        });

                        if (result.success) {
                            @this.dispatch('redirectToDashboard');
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: result.message || 'Payment verification failed',
                                icon: 'error',
                                confirmButtonText: 'OK',
                                confirmButtonColor: '#2563EB'
                            });
                        }
                    },
                    "prefill": {
                        "name": "{{ Auth::user()->name }}",
                        "email": "{{ Auth::user()->email }}"
                    },
                    "theme": {
                        "color": "#2563EB"
                    },
                    "modal": {
                        "ondismiss": function () {
                            payButton.disabled = false;
                        }
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            } else {
                throw new Error('Payment initialization failed');
            }
        } catch (error) {
            console.error("Payment Error:", error);
            Swal.fire({
                title: 'Error!',
                text: 'Payment initiation failed: ' + (error.message || ''),
                icon: 'error',
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563EB'
            });
            payButton.disabled = false;
        }
    };
</script>
@endauth


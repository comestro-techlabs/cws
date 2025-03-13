<div>
    <!-- Course Header Section with Theme Color -->
    <div class="bg-[#662d91] text-white pt-28 pb-12 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-start">
                <!-- Left Section (Course Details) -->
                <div class="md:w-7/12 w-full pr-0 md:pr-8">
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
                <div class="md:w-5/12 w-full mt-8 md:mt-0">
                    <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                        <!-- Course Preview Image -->
                        <div class="overflow-hidden">
                            <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
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
                                    <button id="pay-button"
                                        class="flex items-center justify-center w-full bg-orange-500 text-white font-medium rounded-lg py-3 px-6 transition duration-200 hover:bg-orange-600 focus:ring-2 focus:ring-orange-400 focus:ring-offset-2">
                                        <span class="mr-2">Enroll Now</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
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

    <!-- Course Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Left Column (Course Content) -->
            <div class="md:col-span-2 space-y-8">
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

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    @auth

        <script>
            document.getElementById('pay-button').onclick = function(e) {
                const payButton = document.getElementById('pay-button');
                payButton.disabled = true;
                e.preventDefault();

                const receipt_no = `${Date.now()}`;

                // First, initiate payment by sending the details to the backend
                fetch("{{ route('store.payment.initiation') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            student_id: "{{ Auth::id() }}" ?? 99,
                            course_id: "{{ $course->id }}",
                            receipt_no: receipt_no,
                            amount: "{{ $course->discounted_fees }}",
                            ip_address: "{{ request()->ip() }}",
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Use the Razorpay order_id received from backend
                            var options = {
                                "key": "{{ env('RAZORPAY_KEY') }}",
                                "amount": "{{ $course->discounted_fees }}" * 100, // amount in paise
                                "currency": "INR",
                                "name": "LearnSyntax",
                                "description": "Processing Fee",
                                "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                                "order_id": data.order_id, // Razorpay order ID
                                "handler": function(response) {
                                    // After successful payment, send the payment details to the backend
                                    fetch("{{ route('handle.payment.response') }}", {
                                            method: "POST",
                                            headers: {
                                                "Content-Type": "application/json",
                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                            },
                                            body: JSON.stringify({
                                                payment_id: data
                                                .payment_id, // Payment ID created in the backend
                                                razorpay_payment_id: response.razorpay_payment_id,
                                                razorpay_order_id: response.razorpay_order_id,
                                                razorpay_signature: response.razorpay_signature,
                                            })
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.success) {
                                                alert('Payment processed successfully');
                                                window.location.href = '/student/billing';
                                            } else {
                                                alert('Payment failed: ' + data.message);
                                                payButton.disabled = false;
                                            }
                                        })
                                        .catch(error => {
                                            console.error("Error in updating payment:", error);
                                            payButton.disabled = false;
                                        });
                                },
                                "prefill": {
                                    "name": "{{ Auth::user()->name }}",
                                    "email": "{{ Auth::user()->email }}"
                                },
                                "theme": {
                                    "color": "#0a64a3"
                                },
                                "modal": {
                                    "ondismiss": function() {
                                        alert('Payment process was cancelled.');
                                        payButton.disabled = false;
                                        window.location.href = '/student/billing';
                                        document.forms[0].submit();
                                    }
                                }
                            };

                            // Open the Razorpay payment modal
                            var rzp1 = new Razorpay(options);
                            rzp1.open();

                        } else {
                            alert("Error initiating payment: " + data.message);
                            payButton.disabled = false;
                        }
                    })
                    .catch(error => {
                        console.error("Error initiating payment:", error);
                        payButton.disabled = false;
                    });
            };
        </script>
    @endauth
</div>

<!-- Alert Messages with brand colors -->
@if (session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        confirmButtonColor: '#2563EB'
    });
</script>
@endif

@if (session('error'))
<script>
    Swal.fire({
        title: 'Error!',
        text: "{{ session('error') }}",
        icon: 'error',
        confirmButtonText: 'OK',
        confirmButtonColor: '#2563EB'
    });
</script>
@endif

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column: Course Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Course Title -->
            <div class="border-b border-gray-200 pb-4">
                <h1 class="text-3xl font-bold text-gray-900">{{ $course->title }}</h1>
            </div>


            <!-- Course Description -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">About This Course</h2>
                </div>
                <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-8">

                @foreach ($reviewedCourse as $review )
                <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transform transition-transform duration-300 hover:scale-105">
                    <div class="flex flex-col justify-between">
                        <div class="font-semibold text-lg text-gray-800">{{ $review->user->name }}</div>

                        <div class="flex justify-between items-center">
                            <div class="flex text-orange-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <=$review->rating)

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>
                                    @else

                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-3 h-3 text-gray-300">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                    </svg>
                                    @endif
                                    @endfor
                            </div>
                            <span class="text-xs text-gray-500 ml-1.5">
                                {{ $review?->rating }} ({{ $review->course->rating->count() }} reviews)
                            </span>
                        </div>

                    </div>

                    <div class="mt-3 text-gray-600 text-sm">
                        <p>{{ $review->review }}</p>
                    </div>

                    <div class="mt-4 text-xs text-gray-500">
                        <small>Reviewed on: {{ $review->created_at->format('Y-m-d') }}</small>
                    </div>
                </div>
                @endforeach


            </div>




        </div>

        <!-- Right Column: Payment and Features -->
        <div class="space-y-6">
            <!-- Payment Section -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden sticky top-24">
                <!-- Course Preview Image -->
                <div class="relative h-48">
                    <img src="{{ asset('storage/course_images/' . $course->course_image) }}"
                        alt="{{ $course->title }}"
                        class="w-full h-full object-cover">
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/70 to-transparent"></div>
                    <!-- Course Info Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <p class="text-white/90 text-sm font-medium mb-1">Course Duration</p>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-white font-medium">{{ $course->duration }} Weeks</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Price Section -->
                    <div class="text-center pb-4 border-b border-gray-200">
                        <p class="text-sm text-gray-600 mb-1">Course Fee</p>
                        <p class="text-4xl font-bold text-gray-900">₹{{ $course->discounted_fees }}</p>
                    </div>

                    <!-- Enrollment Status -->
                    @if ($payment_exist)
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4 text-center">
                        <p class="text-blue-600 font-semibold mb-2">Already Enrolled</p>
                        <a wire:navigate
                            href="{{ route('student.dashboard') }}"
                            class="inline-flex items-center text-sm text-blue-700 hover:text-blue-800 font-medium">
                            Go to Dashboard
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                    @else
                    <button id="pay-button"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png?f=webp&w=256"
                            alt="Razorpay"
                            class="w-6 h-6 object-contain">
                        <span>Enroll Now with Razorpay</span>
                    </button>
                    @endif

                    <!-- Course Features -->
                    <div class="pt-4 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">What You'll Get</h3>
                        <ul class="space-y-3">
                            @foreach ($course->features as $feature)
                            <li class="flex items-center gap-3 text-gray-700">
                                <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
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
    document.getElementById('pay-button').onclick = function(e) {
        const payButton = document.getElementById('pay-button');
        payButton.disabled = true;
        e.preventDefault();
        let course_amount = {
            {
                $course - > discounted_fees
            }
        }
        const receipt_no = `${Date.now()}`;

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
                    amount: course_amount,
                    ip_address: "{{ request()->ip() }}",
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": data.amount,
                        "currency": "INR",
                        "name": "LearnSyntax",
                        "description": "Course Enrollment",
                        "image": "{{ asset('assets/img/logo/logo.png') }}",
                        "order_id": data.order_id,
                        "handler": function(response) {
                            fetch("{{ route('handle.payment.response') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({
                                        payment_id: data.payment_id,
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Payment processed successfully',
                                            icon: 'success',
                                            confirmButtonColor: '#2563EB'
                                        }).then(() => {
                                            window.location.href = '/student/billing';
                                        });
                                    } else {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: data.message,
                                            icon: 'error',
                                            confirmButtonColor: '#2563EB'
                                        });
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
                            "color": "#2563EB"
                        },
                        "modal": {
                            "ondismiss": function() {
                                Swal.fire({
                                    title: 'Cancelled',
                                    text: 'Payment process was cancelled',
                                    icon: 'info',
                                    confirmButtonColor: '#2563EB'
                                });
                                payButton.disabled = false;
                            }
                        }
                    };

                    var rzp1 = new Razorpay(options);
                    rzp1.open();
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: data.message,
                        icon: 'error',
                        confirmButtonColor: '#2563EB'
                    });
                    payButton.disabled = false;
                }
            })
            .catch(error => {
                console.error("Error:", error);
                Swal.fire({
                    title: 'Error!',
                    text: 'An unexpected error occurred',
                    icon: 'error',
                    confirmButtonColor: '#2563EB'
                });
                payButton.disabled = false;
            });
    }
</script>
@endauth
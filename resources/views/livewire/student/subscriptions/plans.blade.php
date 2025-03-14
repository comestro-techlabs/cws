<div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Subscription Plans
            </h2>
            <p class="mt-4 text-lg text-gray-500">
                Choose the perfect plan for your learning journey
            </p>
        </div>

        <div class="mt-12 grid gap-8 lg:grid-cols-3">
            <!-- Basic Plan -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-8">
                    <h3 class="text-2xl font-bold text-purple-600">Basic</h3>
                    <p class="mt-4 text-gray-500">Perfect for getting started</p>
                    <p class="mt-8">
                        <span class="text-4xl font-bold text-gray-900">₹699</span>
                        <span class="text-gray-500">/month</span>
                    </p>
                    <button 
                        onclick="initializePayment('basic')"
                        class="mt-8 w-full bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700">
                        Subscribe Now
                    </button>
                </div>
                <div class="px-6 pt-6 pb-8">
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/>
                            </svg>
                            <span class="ml-3">Access to all courses</span>
                        </li>
                        <!-- Add more features -->
                    </ul>
                </div>
            </div>

            <!-- Pro Plan -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-purple-500">
                <div class="px-6 py-8">
                    <h3 class="text-2xl font-bold text-purple-600">Pro</h3>
                    <p class="mt-4 text-gray-500">Most popular choice</p>
                    <p class="mt-8">
                        <span class="text-4xl font-bold text-gray-900">₹1499</span>
                        <span class="text-gray-500">/quarter</span>
                    </p>
                    <button 
                        wire:click="subscribe('pro')"
                        class="mt-8 w-full bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700">
                        Subscribe Now
                    </button>
                </div>
                <div class="px-6 pt-6 pb-8">
                    <ul class="space-y-4">
                        <!-- Add features -->
                    </ul>
                </div>
            </div>

            <!-- Premium Plan -->
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-8">
                    <h3 class="text-2xl font-bold text-purple-600">Premium</h3>
                    <p class="mt-4 text-gray-500">Best value for money</p>
                    <p class="mt-8">
                        <span class="text-4xl font-bold text-gray-900">₹4999</span>
                        <span class="text-gray-500">/year</span>
                    </p>
                    <button 
                        wire:click="subscribe('premium')"
                        class="mt-8 w-full bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700">
                        Subscribe Now
                    </button>
                </div>
                <div class="px-6 pt-6 pb-8">
                    <ul class="space-y-4">
                        <!-- Add features -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function initializePayment(plan) {
        fetch(`/student/subscriptions/plans/subscribe/${plan}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const options = {
                    key: data.key,
                    amount: data.amount,
                    currency: "INR",
                    name: "LearnSyntax",
                    description: "Subscription Payment",
                    image: "{{ asset('front_assets/img/logo/logo.png') }}",
                    order_id: data.order_id,
                    handler: function(response) {
                        handlePaymentSuccess(response, data.payment_id);
                    },
                    prefill: {
                        name: "{{ auth()->user()->name }}",
                        email: "{{ auth()->user()->email }}"
                    },
                    theme: {
                        color: "#662d91"
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            } else {
                alert('Failed to initialize payment: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Payment initialization error:', error);
            alert('Failed to initialize payment');
        });
    }

    function handlePaymentSuccess(response, paymentId) {
        fetch("{{ route('student.subscriptions.process') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                payment_id: paymentId,
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_order_id: response.razorpay_order_id,
                razorpay_signature: response.razorpay_signature
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = '/student/dashboard';
            } else {
                alert('Payment verification failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Payment verification error:', error);
            alert('Payment verification failed');
        });
    }
</script>

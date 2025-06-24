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
            @foreach($subscriptionPlans as $plan)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden {{ $plan->slug === 'pro' ? 'border-2 border-purple-500' : '' }}">
                    <div class="px-6 py-8">
                        <h3 class="text-2xl font-bold text-purple-600">{{ $plan->name }}</h3>
                        <p class="mt-4 text-gray-500">{{ $plan->description }}</p>
                        <p class="mt-8">
                            <span class="text-4xl font-bold text-gray-900">₹{{ $plan->price }}</span>
                            <span class="text-gray-500">/{{ $plan->duration }}</span>
                        </p>
                        <button 
                            wire:click="subscribe('{{ $plan->slug }}')"
                            class="mt-8 w-full bg-purple-600 text-white rounded-md py-2 px-4 hover:bg-purple-700">
                            Subscribe Now
                        </button>
                    </div>
                    <div class="px-6 pt-6 pb-8">
                        <ul class="space-y-4">
                            @php
                                $planFeatures = is_string($plan->features) ? json_decode($plan->features, true) : $plan->features;
                            @endphp
                            @forelse($planFeatures ?? [] as $feature)
                                <li class="flex items-center space-x-3">
                                    <svg class="h-5 w-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-600">{{ $feature }}</span>
                                </li>
                            @empty
                                <li class="text-gray-500 text-sm">No features listed</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('initSubscriptionPayment', (data) => {
            console.log('Payment Data:', data[0]); // Debug payment data

            const paymentData = data[0];
            if (!paymentData || !paymentData.key || !paymentData.amount || !paymentData.order_id) {
                console.error('Invalid payment data:', paymentData);
                return;
            }

            try {
                // Show price summary modal before opening Razorpay
                if (paymentData.breakdown) {
                    Swal.fire({
                        title: 'Price Summary',
                        html: `
                            <table class='w-full text-sm text-left'>
                                <tr><td>Subscription Fee</td><td class='text-right'>₹${parseFloat(paymentData.breakdown['Course Fee']).toFixed(2)}</td></tr>
                                <tr><td>GST (18%)</td><td class='text-right'>₹${parseFloat(paymentData.breakdown['GST (18%)']).toFixed(2)}</td></tr>
                                <tr class='font-bold border-t'><td>Total</td><td class='text-right'>₹${parseFloat(paymentData.breakdown['Total']).toFixed(2)}</td></tr>
                            </table>
                        `,
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonText: 'Proceed to Pay',
                        cancelButtonText: 'Cancel',
                        confirmButtonColor: '#662d91',
                        cancelButtonColor: '#aaa',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            openRazorpay(paymentData);
                        }
                    });
                } else {
                    openRazorpay(paymentData);
                }

                function openRazorpay(paymentData) {
                    const options = {
                        key: paymentData.key,
                        amount: paymentData.amount,
                        currency: "INR",
                        name: "LearnSyntax",
                        description: paymentData.description || "Subscription Payment",
                        image: "{{ asset('front_assets/img/logo/logo.png') }}",
                        order_id: paymentData.order_id,
                        handler: function(response) {
                            fetch("{{ route('student.subscriptions.process') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    payment_id: paymentData.payment_id,
                                    razorpay_payment_id: response.razorpay_payment_id,
                                    razorpay_order_id: response.razorpay_order_id,
                                    razorpay_signature: response.razorpay_signature,
                                    plan_type: paymentData.plan_type,
                                    duration: paymentData.duration
                                })
                            })
                            .then(response => response.json())
                            .then(result => {
                                if (result.success) {
                                    window.location.href = '/student/dashboard';
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Payment Failed',
                                        text: result.message || 'Payment processing failed'
                                    });
                                }
                            });
                        },
                        prefill: {
                            name: paymentData.name,
                            email: paymentData.email
                        },
                        theme: {
                            color: "#662d91"
                        }
                    };
                    const rzp = new Razorpay(options);
                    rzp.open();
                }
            } catch (error) {
                console.error('Razorpay initialization error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to initialize payment'
                });
            }
        });
    });
</script>

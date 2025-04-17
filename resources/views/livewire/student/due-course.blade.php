<div>
    <div class="max-w-3xl mx-auto p-1 bg-white ">
        <!-- Loader Component -->
        <x-loader />

        @if (session()->has('error'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-lg">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Course and Payment Logic -->
        @if (!$course)
            <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <p class="mt-2 text-red-600 font-medium">Course not found.</p>
            </div>
        @elseif ($payment)
            <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 p-6 rounded-lg">
                <!-- Due Amount -->
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">Due Amount</h2>
                    <p class="text-2xl font-bold text-yellow-600">
                        ₹{{ number_format($payment->amount - $payment->total_amount, 2) }}</p>
                </div>

                <!-- Payment Deadline -->
                @if (!\Carbon\Carbon::parse($payment->created_at)->addDays(7)->isPast())
                    <div class="mb-6">
                        <label for="due_amount" class="block text-sm font-medium text-gray-700 mb-1">Enter Amount to Pay</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">₹</span>
                            <input type="number" wire:model.live="total_amount" id="due_amount"
                                class="pl-8 w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition duration-200"
                                min="{{ $minAmount = ($payment->payment_status === 'requested') ? ($payment->amount * 0.2) : (($payment->amount - $payment->total_amount) * 0.4) }}"
                                max="{{ $maxAmount = $payment->amount - $payment->total_amount }}" step="0.01"
                                placeholder="Enter amount" required>
                        </div>
                        @error('total_amount')
                            <span class="mt-1 text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Amount Information -->
                    <div class="grid grid-cols-2 gap-4 mb-6 text-sm text-gray-600">
                        <div>
                            <p>Minimum Amount:</p>
                            <p class="font-medium">₹{{ number_format($minAmount, 2) }}</p>
                        </div>
                        <div>
                            <p>Maximum Amount:</p>
                            <p class="font-medium">₹{{ number_format($maxAmount, 2) }}</p>
                        </div>
                        <div>
                            <p>Current Input:</p>
                            <p class="font-medium">{{ $total_amount ? '₹' . number_format($total_amount, 2) : 'Not set' }}</p>
                        </div>
                        <div>
                            <p>Deadline:</p>
                            <p class="font-medium">
                                {{ \Carbon\Carbon::parse($payment->created_at)->addDays(7)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Pay Button -->
                    <button wire:click="payDueAmount({{ $payment->id }})" wire:loading.attr="disabled"
                        class="w-full px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition duration-200">
                        <span wire:loading.remove>Pay Now</span>
                        <span wire:loading>Processing...</span>
                    </button>
                @else
                    <div class="text-center py-4">
                        <svg class="w-12 h-12 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="mt-2 text-red-600 font-medium">Payment period has expired.</p>
                    </div>
                @endif
            </div>
        @else
            <div class="text-center py-8">
                <svg class="w-16 h-16 mx-auto text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <p class="mt-2 text-red-600 font-medium">Payment not found.</p>
            </div>
        @endif
    </div>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    const RAZORPAY_KEY = "{{ config('services.razorpay.key') }}";

    document.addEventListener('livewire:navigated', function () {
        Livewire.on('initiate-payment', async (event) => {
            console.log('Initiate Payment Event Received:', event);

            const payButton = document.querySelector('[wire\\:click="payDueAmount"]');
            if (payButton) payButton.disabled = true;

            try {
                const response = await @this.initiatePayment(event.amount, event.paymentId);

                console.log('Payment Initiation Response:', response);

                if (response && response.payment_id && response.order_id) {
                    const amountToPay = response.amount;

                    var options = {
                        "key": RAZORPAY_KEY,
                        "amount": amountToPay * 100,
                        "currency": "INR",
                        "name": "LearnSyntax",
                        "description": "{{ $course ? addslashes($course->title) : 'Course Payment' }}",
                        "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                        "order_id": response.order_id,
                        "handler": async function (razorpayResponse) {
                            console.log('Razorpay Payment Response:', razorpayResponse);
                            const result = await @this.handlePaymentResponse({
                                payment_id: response.payment_id,
                                razorpay_payment_id: razorpayResponse.razorpay_payment_id,
                                razorpay_order_id: razorpayResponse.razorpay_order_id,
                                razorpay_signature: razorpayResponse.razorpay_signature,
                                amount: amountToPay
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
                            if (payButton) payButton.disabled = false;
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
                                if (payButton) payButton.disabled = false;
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
                if (payButton) payButton.disabled = false;
            }
        });
    });
</script>
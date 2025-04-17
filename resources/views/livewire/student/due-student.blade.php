
<div>
    <x-loader/>
    <!-- Success Message -->
    @if (session()->has('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if ($course)        
            <button wire:click="openModalForEnrollment({{ $course->id }})"
                class="w-full bg-yellow-600 hover:bg-yellow-700 text-white font-medium px-6 py-3 rounded-lg transition duration-200 flex items-center justify-center gap-3 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2">
                <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png?f=webp&w=256"
                    alt="Razorpay" class="w-6 h-6 object-contain">
                <span>Enroll Now</span>
            </button>        
    @else
        <p class="text-red-500">Course not available.</p>
    @endif

    <!-- Modal for Enrollment -->
    @if ($showModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                <h2 class="text-xl font-semibold mb-4">Enroll in {{ $course_title }}</h2>
                <p class="mb-4">Course Fee: ₹{{ number_format($amount, 2) }}</p>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Payment Option</label>
                    <div class="flex items-center mb-2">
                        <input type="radio" wire:model="paymentOption" value="pay_now" id="pay_now"
                            class="mr-2 focus:ring-yellow-500">
                        <label for="pay_now">Pay Now (Minimum 20%)</label>
                    </div>
                    <div class="flex items-center">
                        <input type="radio" wire:model="paymentOption" value="request_access" id="request_access"
                            class="mr-2 focus:ring-yellow-500">
                        <label for="request_access">Request Access (Pay within 7 days)</label>
                    </div>
                </div>

                @if ($paymentOption === 'pay_now')
                    <p class="mb-4">Minimum Payment (20%): ₹{{ number_format($amount * 0.2, 2) }}</p>
                    <div class="mb-4">
                        <label for="total_amount" class="block text-sm font-medium text-gray-700">Amount to Pay</label>
                        <input type="number" wire:model="total_amount" id="total_amount"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                            min="{{ $amount * 0.2 }}" max="{{ $amount }}" step="1">
                        @error('total_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                @else
                    <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded-lg">
                        <p>You will be granted access to the course immediately, but you must pay the full course fee (₹{{ number_format($amount, 2) }}) within 7 days from payment initiation. Failure to do so will result in account deactivation.</p>
                    </div>
                @endif

                <div class="flex justify-end gap-3">
                    <button wire:click="closeModal"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                    <button wire:click="enrollDue"
                        class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">
                        {{ $paymentOption === 'pay_now' ? 'Proceed to Pay' : 'Request Access' }}
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Display Due Amount (if any) -->
    @if ($showDue && $payment)
        <div class="mt-4 p-4 bg-yellow-100 rounded-lg">
            <p class="text-yellow-800">Due Amount: ₹{{ number_format($payment->amount - $payment->total_amount, 2) }}</p>
            @if ($payment->payment_status === 'requested' || $payment->payment_status === 'partial')
                <p class="text-yellow-800">Payment Deadline: {{ \Carbon\Carbon::parse($payment->created_at)->addDays(7)->format('d M Y') }}</p>
                @if (\Carbon\Carbon::parse($payment->created_at)->addDays(7)->isPast())
                    <p class="text-red-800 font-semibold">Your payment is overdue. Your account will be deactivated soon. Please contact support.</p>
                @elseif (\Carbon\Carbon::parse($payment->created_at)->addDays(6)->isPast())
                    <p class="text-red-800 font-semibold">Your payment is due within 1 day! Please pay to avoid account deactivation.</p>
                @endif
            @endif
            @if (!\Carbon\Carbon::parse($payment->created_at)->addDays(7)->isPast())
                <div class="mt-4">
                    <label for="due_amount" class="block text-sm font-medium text-gray-700">Pay Due Amount</label>
                    <input type="number" wire:model="total_amount" id="due_amount"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm"
                        min="{{ ($payment->payment_status === 'requested') ? ($payment->amount * 0.2) : (($payment->amount - $payment->total_amount) * 0.4) }}"
                        max="{{ $payment->amount - $payment->total_amount }}" step="1">
                    @error('total_amount') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <button wire:click="payDueAmount({{ $payment->id }})"
                    class="mt-4 px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700">Pay Due</button>
            @endif
        </div>
    @endif
</div>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    document.addEventListener('livewire:init', function () {
        Livewire.on('initiate-payment', async (event) => {
            const payButton = document.querySelector('[wire\\:click="enrollDue"], [wire\\:click="payDueAmount"]');
            if (payButton) payButton.disabled = true;

            try {
                const response = event.detail || await @this.initiatePayment(event.amount, event.paymentId);

                if (response && response.payment_id && response.order_id) {
                    const amountToPay = response.amount;

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
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>{{ $title ?? 'Student' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
    
</head>
<body x-data="{ sidebarOpen: false }" class="bg-gray-100">  
    <!-- Overlay for mobile -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false"
         class="fixed inset-0 z-30 transition-opacity duration-300 sm:hidden"
         :class="{'opacity-50': sidebarOpen, 'opacity-0': !sidebarOpen}">
    </div>

    <!-- Sidebar -->
    <div x-show="sidebarOpen"
         :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
         class="fixed top-0 left-0 z-40 w-64 h-screen bg-gray-50 border-r overflow-x-hidden transform transition-transform duration-300 ease-in-out sm:translate-x-0 sm:block"
         style="overflow: hidden;">
        <x-student-navbar/>
    </div>

    <!-- Main content -->
    <main :class="{'sm:ml-64': sidebarOpen, 'ml-0': !sidebarOpen}"
          class="flex-1 p-4 transition-all duration-300 sm:ml-64">
        <x-student-header />
        {{ $slot }}
    </main>

    @livewireScripts
</body>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
@auth
    <script>

        document.getElementById('membership-pay-button').onclick = function (e) {
            const payButton = document.getElementById('membership-pay-button');
            payButton.disabled = true;
            e.preventDefault();

            const receipt_no = `${Date.now()}`;

            let member_fee = 700;

            // First, initiate payment by sending the details to the backend
            fetch("{{ route('store.payment.initiation') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    student_id: "{{ Auth::id() }}" ?? 99,
                    receipt_no: receipt_no,
                    amount: member_fee,
                    ip_address: "{{ request()->ip() }}",
                    workshop_id: null,
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // console.log("check wp and crs id",data.workshop_id,data.course_id);
                        // Use the Razorpay order_id received from backend
                        var options = {
                            "key": "{{ env('RAZORPAY_KEY') }}",
                            "amount": member_fee, // amount in paise
                            "currency": "INR",
                            "name": "LearnSyntax",
                            "description": "Processing Fee",
                            "image": "{{ asset('front_assets/img/logo/logo.png') }}",
                            "order_id": data.order_id, // Razorpay order ID
                            "handler": function (response) {
                                // After successful payment, send the payment details to the backend
                                fetch("{{ route('handle.payment.response') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({
                                        payment_id: data.payment_id, // Payment ID created in the backend
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                    })
                                })
                                    .then(response => {
                                        return response.json();
                                    })
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
                                "ondismiss": function () {
                                    alert('Payment process was cancelled.');
                                    payButton.disabled = false;
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

</html>
@extends('public.layout')

@section('title')
Workshop
@endsection

@section('meta')
<meta name="description"
    content="Discover Learn Syntax, a leading Software Company based in Purnea Bihar, delivering 360º Software Solutions globally since 2009. With over 110 experts across Bihar, we help businesses thrive through innovative, data-driven marketing strategies." />
@endsection

@section('content')
<div class="bg-white overflow-x-hidden">
    <livewire:page-heading title="Welcome To My Workshop"
        description="Dive into a space where creativity meets innovation. Learn, build, and transform ideas into impactful solutions through hands-on experience and expert guidance."
        image="about-header.png" />

    <div class="p-4 sm:p-8 bg-gray-100">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($workshops as $workshop)
            <div
                class="flex flex-col items-center transform transition duration-300 hover:scale-105 hover:bg-gray-50 rounded-lg p-5 shadow-lg bg-white relative">
                <img src="{{ asset('storage/' . $workshop->image) }}" alt=""
                    class="w-full h-64 object-cover object-top rounded mb-4">

                <h3 class="text-xl sm:text-2xl font-semibold text-black mb-2 text-center">{{ $workshop->title }}
                </h3>

                <p class="text-gray-600 text-center">Date: <span
                        class="font-medium">{{ \Carbon\Carbon::parse($workshop->date)->format('F j, y') }}</span>
                </p>
                <p class="text-gray-600 text-center">Time: <span
                        class="font-medium">{{ \Carbon\Carbon::parse($workshop->time)->format('h:i, A') }}</span>
                </p>

                <p class="text-gray-600 text-center">Fees:
                    @if ($workshop->fees > 0)
                    ₹{{ $workshop->fees }}
                    @else
                    Free
                    @endif
                </p>

                @if ($workshop->fees > 0)

                <button id="pay-button"
                    class="flex items-center justify-center w-full bg-white border-4 border-double text-black  rounded-full mt-2 shadow-xl px-6 py-2  transition duration-300 ease-in-out transform hover:scale-105 space-x-3">
                    <img src="https://cdn.iconscout.com/icon/free/png-512/free-razorpay-logo-icon-download-in-svg-png-gif-file-formats--payment-gateway-brand-logos-icons-1399875.png?f=webp&w=256"
                        alt="PhonePe Logo" class="w-12 h-12 object-cover">
                    <span>Proceed with Razorpay</span>
                </button>
                @else
                <p class="mt-4 text-green-600 font-medium">This workshop is free to join!</p>
                @endif

            </div>

            @empty

            <div class="flex flex-col items-center justify-center col-span-1 md:col-span-3 p-8 bg-gray-100">
                <img src="{{asset('/workshop.jpg')}}"
                    alt="No workshops available"
                    class="w-64 h-64 mb-4">
                <h2 class="text-gray-800 text-2xl font-bold mb-2">No Workshops Available</h2>
                <p class="text-gray-600 text-lg text-center">
                    We're constantly adding new and exciting workshops to help you enhance your skills and knowledge. Stay tuned for upcoming sessions covering the latest in technology, programming, and more!
                </p>
                <p class="text-gray-600 text-md text-center mt-2">
                    Meanwhile, feel free to explore our other resources and learn at your own pace. Your journey to growth starts here.
                </p>
                <a href="/"
                    class="mt-6 px-6 py-2 bg-secondary text-white text-lg font-medium rounded-lg hover:bg-indigo-700 transition">
                    Go to Homepage
                </a>
            </div>




            @endforelse
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
                    receipt_no: receipt_no,
                    amount: "{{ $workshop->fees }}" ?? null,
                    ip_address: "{{ request()->ip() }}",
                    workshop_id: "{{ $workshop->id }}" ?? 1,
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Use the Razorpay order_id received from backend
                    var options = {
                        "key": "{{ env('RAZORPAY_KEY') }}",
                        "amount": "{{ $workshop->fees }}" * 100, // amount in paise
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
                                        payment_id: data.payment_id, // Payment ID created in the backend
                                        razorpay_payment_id: response.razorpay_payment_id,
                                        razorpay_order_id: response.razorpay_order_id,
                                        razorpay_signature: response.razorpay_signature,
                                    })
                                })
                                .then(response => {
                                    console.log('Response from backend:', response);
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
                            "ondismiss": function() {
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
@endsection